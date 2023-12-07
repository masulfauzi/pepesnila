<?php
namespace App\Modules\Prestasi\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Prestasi\Models\Prestasi;
use App\Modules\Satpen\Models\Satpen;
use App\Modules\Juara\Models\Juara;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PrestasiController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Prestasi";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		// dd(session()->get('active_role')['id']);

		$query = Prestasi::query();
		$chart = $query->clone();

		$data['chart'] = $chart->select('tahun')->selectRaw('count(*) as jml')->groupBy('tahun')->get();

		// dd($chart->select('tahun')->selectRaw('count(*) as jml')->groupBy('tahun')->get());

		if(session()->get('active_role')['id'] == 'a5086fe7-87c2-4b3a-82bb-e71c5154faa4')
		{
			$query->whereIdSatpen(Auth::user()->id_satpen);
		}
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Prestasi::prestasi', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{

		// $ref_satpen = Satpen::all()->pluck('id_kelompok','id');
		$ref_juara = Juara::all()->pluck('juara','id');
		$ref_juara->prepend('-PILIH SALAH SATU-', '');
		
		$data['forms'] = array(
			'id_satpen' => ['', Form::hidden("id_satpen", Auth::user()->id_satpen) ],
			'id_juara' => ['Juara', Form::select("id_juara", $ref_juara, null, ["class" => "form-control select2"]) ],
			'prestasi' => ['Prestasi', Form::text("prestasi", old("prestasi"), ["class" => "form-control","placeholder" => ""]) ],
			// 'tahun' => ['Tahun', Form::text("tahun", old("tahun"), ["class" => "form-control","placeholder" => ""]) ],
			'tgl_perolehan' => ['Tgl Perolehan', Form::text("tgl_perolehan", old("tgl_perolehan"), ["class" => "form-control datepicker"]) ],
			'sertifikat' => ['Sertifikat', Form::file("sertifikat",  ["class" => "form-control","placeholder" => ""]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Prestasi::prestasi_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_satpen' => 'required',
			'id_juara' => 'required',
			'prestasi' => 'required',
			// 'tahun' => 'required',
			'tgl_perolehan' => 'required',
			'sertifikat' => 'required|mimes:pdf,jpg,jpeg,png|max:10240'
			
		]);

		$fileName = time().'.'.$request->sertifikat->extension();  

        $request->sertifikat->move(public_path('uploads/sertifikat/'), $fileName);

		$pecah = explode('-', $request->input('tgl_perolehan'));

		$tahun = $pecah['0'];

		$prestasi = new Prestasi();
		$prestasi->id_satpen = $request->input("id_satpen");
		$prestasi->id_juara = $request->input("id_juara");
		$prestasi->prestasi = $request->input("prestasi");
		$prestasi->tahun = $tahun;
		$prestasi->tgl_perolehan = $request->input("tgl_perolehan");
		$prestasi->sertifikat = $fileName;
		
		$prestasi->created_by = Auth::id();
		$prestasi->save();

		$text = 'membuat '.$this->title; //' baru '.$prestasi->what;
		$this->log($request, $text, ['prestasi.id' => $prestasi->id]);
		return redirect()->route('prestasi.index')->with('message_success', 'Prestasi berhasil ditambahkan!');
	}

	public function show(Request $request, Prestasi $prestasi)
	{
		$data['prestasi'] = $prestasi;

		$text = 'melihat detail '.$this->title;//.' '.$prestasi->what;
		$this->log($request, $text, ['prestasi.id' => $prestasi->id]);
		return view('Prestasi::prestasi_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Prestasi $prestasi)
	{
		$data['prestasi'] = $prestasi;

		$ref_satpen = Satpen::all()->pluck('id_kelompok','id');
		$ref_juara = Juara::all()->pluck('id_tingkat','id');
		
		$data['forms'] = array(
			'id_satpen' => ['Satpen', Form::select("id_satpen", $ref_satpen, null, ["class" => "form-control select2"]) ],
			'id_juara' => ['Juara', Form::select("id_juara", $ref_juara, null, ["class" => "form-control select2"]) ],
			'prestasi' => ['Prestasi', Form::text("prestasi", $prestasi->prestasi, ["class" => "form-control","placeholder" => "", "id" => "prestasi"]) ],
			'tahun' => ['Tahun', Form::text("tahun", $prestasi->tahun, ["class" => "form-control","placeholder" => "", "id" => "tahun"]) ],
			'tgl_perolehan' => ['Tgl Perolehan', Form::text("tgl_perolehan", $prestasi->tgl_perolehan, ["class" => "form-control datepicker", "id" => "tgl_perolehan"]) ],
			'sertifikat' => ['Sertifikat', Form::text("sertifikat", $prestasi->sertifikat, ["class" => "form-control","placeholder" => "", "id" => "sertifikat"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$prestasi->what;
		$this->log($request, $text, ['prestasi.id' => $prestasi->id]);
		return view('Prestasi::prestasi_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_satpen' => 'required',
			'id_juara' => 'required',
			'prestasi' => 'required',
			'tahun' => 'required',
			'tgl_perolehan' => 'required',
			'sertifikat' => 'required',
			
		]);
		
		$prestasi = Prestasi::find($id);
		$prestasi->id_satpen = $request->input("id_satpen");
		$prestasi->id_juara = $request->input("id_juara");
		$prestasi->prestasi = $request->input("prestasi");
		$prestasi->tahun = $request->input("tahun");
		$prestasi->tgl_perolehan = $request->input("tgl_perolehan");
		$prestasi->sertifikat = $request->input("sertifikat");
		
		$prestasi->updated_by = Auth::id();
		$prestasi->save();


		$text = 'mengedit '.$this->title;//.' '.$prestasi->what;
		$this->log($request, $text, ['prestasi.id' => $prestasi->id]);
		return redirect()->route('prestasi.index')->with('message_success', 'Prestasi berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$prestasi = Prestasi::find($id);
		$prestasi->deleted_by = Auth::id();
		$prestasi->save();
		$prestasi->delete();

		$text = 'menghapus '.$this->title;//.' '.$prestasi->what;
		$this->log($request, $text, ['prestasi.id' => $prestasi->id]);
		return back()->with('message_success', 'Prestasi berhasil dihapus!');
	}

}
