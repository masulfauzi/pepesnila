<?php
namespace App\Modules\Alumni\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Alumni\Models\Alumni;
use App\Modules\Satpen\Models\Satpen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AlumniController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Alumni";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Alumni::query()->where('id_satpen', Auth::user()->id_satpen);
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Alumni::alumni', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_satpen = Satpen::all()->pluck('id_kelompok','id');
		
		$data['forms'] = array(
			'id_satpen' => ['', Form::hidden("id_satpen", Auth::user()->id_satpen) ],
			'nama_alumni' => ['Nama Alumni', Form::text("nama_alumni", old("nama_alumni"), ["class" => "form-control","placeholder" => ""]) ],
			'nik' => ['NIK', Form::text("nik", old("nik"), ["class" => "form-control nominal","placeholder" => ""]) ],
			'nama_ayah' => ['Nama Ayah', Form::text("nama_ayah", old("nama_ayah"), ["class" => "form-control","placeholder" => ""]) ],
			'nama_ibu' => ['Nama Ibu', Form::text("nama_ibu", old("nama_ibu"), ["class" => "form-control","placeholder" => ""]) ],
			'tgl_lahir' => ['Tanggal Lahir', Form::date("tgl_lahir", old("tgl_lahir"), ["class" => "form-control datepicker"]) ],
			'tempat_lahir' => ['Tempat Lahir', Form::text("tempat_lahir", old("tempat_lahir"), ["class" => "form-control","placeholder" => ""]) ],
			'nis' => ['NIS', Form::text("nis", old("nis"), ["class" => "form-control","placeholder" => ""]) ],
			'nisn' => ['NISN', Form::text("nisn", old("nisn"), ["class" => "form-control","placeholder" => ""]) ],
			// 'foto' => ['Foto', Form::text("foto", old("foto"), ["class" => "form-control","placeholder" => ""]) ],
			// 'kk' => ['Kk', Form::text("kk", old("kk"), ["class" => "form-control","placeholder" => ""]) ],
			// 'akta_lahir' => ['Akta Lahir', Form::text("akta_lahir", old("akta_lahir"), ["class" => "form-control","placeholder" => ""]) ],
			// 'ijazah_smp' => ['Ijazah Smp', Form::text("ijazah_smp", old("ijazah_smp"), ["class" => "form-control","placeholder" => ""]) ],
			// 'fc_rapor' => ['Fc Rapor', Form::text("fc_rapor", old("fc_rapor"), ["class" => "form-control","placeholder" => ""]) ],
			// 'fc_ijazah' => ['Fc Ijazah', Form::text("fc_ijazah", old("fc_ijazah"), ["class" => "form-control","placeholder" => ""]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Alumni::alumni_create', array_merge($data, ['title' => $this->title]));
	}

	public function upload(Alumni $alumni)
	{
		$data['data'] = $alumni;

		return view('Alumni::alumni_upload', array_merge($data, ['title' => $this->title]));
	}

	function aksi_upload(Request $request)
	{
		$request->validate([
            'file' => 'required|mimes:pdf,jpg,jpeg,png|max:10240'
        ]);

		$jenis = $request->get('jenis');
		$fileName = time().'.'.$request->file->extension();  

        $request->file->move(public_path('uploads/'.$jenis), $fileName);

		$alumni = Alumni::find($request->input('id'));

		$alumni->$jenis = $fileName;

		$alumni->save();

		return redirect()->route('alumni.upload.index', $request->input('id'))->with('message_success', 'Data Berhasil Disimpan');


	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_satpen' => 'required',
			'nama_alumni' => 'required',
			'nik' => 'required',
			'nama_ayah' => 'required',
			'nama_ibu' => 'required',
			'tgl_lahir' => 'required',
			'tempat_lahir' => 'required',
			// 'nis' => 'required',
			// 'nisn' => 'required',
			// 'foto' => 'required',
			// 'kk' => 'required',
			// 'akta_lahir' => 'required',
			// 'ijazah_smp' => 'required',
			// 'fc_rapor' => 'required',
			// 'fc_ijazah' => 'required',
			
		]);

		$alumni = new Alumni();
		$alumni->id_satpen = $request->input("id_satpen");
		$alumni->nama_alumni = $request->input("nama_alumni");
		$alumni->nik = $request->input("nik");
		$alumni->nama_ayah = $request->input("nama_ayah");
		$alumni->nama_ibu = $request->input("nama_ibu");
		$alumni->tgl_lahir = $request->input("tgl_lahir");
		$alumni->tempat_lahir = $request->input("tempat_lahir");
		$alumni->nis = $request->input("nis");
		$alumni->nisn = $request->input("nisn");
		$alumni->foto = $request->input("foto");
		$alumni->kk = $request->input("kk");
		$alumni->akta_lahir = $request->input("akta_lahir");
		$alumni->ijazah_smp = $request->input("ijazah_smp");
		$alumni->fc_rapor = $request->input("fc_rapor");
		$alumni->fc_ijazah = $request->input("fc_ijazah");
		
		$alumni->created_by = Auth::id();
		$alumni->save();

		$text = 'membuat '.$this->title; //' baru '.$alumni->what;
		$this->log($request, $text, ['alumni.id' => $alumni->id]);
		return redirect()->route('alumni.index')->with('message_success', 'Alumni berhasil ditambahkan!');
	}

	public function show(Request $request, Alumni $alumni)
	{
		$data['alumni'] = $alumni;

		$text = 'melihat detail '.$this->title;//.' '.$alumni->what;
		$this->log($request, $text, ['alumni.id' => $alumni->id]);
		return view('Alumni::alumni_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Alumni $alumni)
	{
		$data['alumni'] = $alumni;

		$ref_satpen = Satpen::all()->pluck('id_kelompok','id');
		
		$data['forms'] = array(
			'id_satpen' => ['Satpen', Form::select("id_satpen", $ref_satpen, null, ["class" => "form-control select2"]) ],
			'nama_alumni' => ['Nama Alumni', Form::text("nama_alumni", $alumni->nama_alumni, ["class" => "form-control","placeholder" => "", "id" => "nama_alumni"]) ],
			'nik' => ['Nik', Form::text("nik", $alumni->nik, ["class" => "form-control nominal","placeholder" => "", "id" => "nik"]) ],
			'nama_ayah' => ['Nama Ayah', Form::text("nama_ayah", $alumni->nama_ayah, ["class" => "form-control","placeholder" => "", "id" => "nama_ayah"]) ],
			'nama_ibu' => ['Nama Ibu', Form::text("nama_ibu", $alumni->nama_ibu, ["class" => "form-control","placeholder" => "", "id" => "nama_ibu"]) ],
			'tgl_lahir' => ['Tgl Lahir', Form::text("tgl_lahir", $alumni->tgl_lahir, ["class" => "form-control datepicker", "id" => "tgl_lahir"]) ],
			'tempat_lahir' => ['Tempat Lahir', Form::text("tempat_lahir", $alumni->tempat_lahir, ["class" => "form-control","placeholder" => "", "id" => "tempat_lahir"]) ],
			'nis' => ['Nis', Form::text("nis", $alumni->nis, ["class" => "form-control","placeholder" => "", "id" => "nis"]) ],
			'nisn' => ['Nisn', Form::text("nisn", $alumni->nisn, ["class" => "form-control","placeholder" => "", "id" => "nisn"]) ],
			'foto' => ['Foto', Form::text("foto", $alumni->foto, ["class" => "form-control","placeholder" => "", "id" => "foto"]) ],
			'kk' => ['Kk', Form::text("kk", $alumni->kk, ["class" => "form-control","placeholder" => "", "id" => "kk"]) ],
			'akta_lahir' => ['Akta Lahir', Form::text("akta_lahir", $alumni->akta_lahir, ["class" => "form-control","placeholder" => "", "id" => "akta_lahir"]) ],
			'ijazah_smp' => ['Ijazah Smp', Form::text("ijazah_smp", $alumni->ijazah_smp, ["class" => "form-control","placeholder" => "", "id" => "ijazah_smp"]) ],
			'fc_rapor' => ['Fc Rapor', Form::text("fc_rapor", $alumni->fc_rapor, ["class" => "form-control","placeholder" => "", "id" => "fc_rapor"]) ],
			'fc_ijazah' => ['Fc Ijazah', Form::text("fc_ijazah", $alumni->fc_ijazah, ["class" => "form-control","placeholder" => "", "id" => "fc_ijazah"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$alumni->what;
		$this->log($request, $text, ['alumni.id' => $alumni->id]);
		return view('Alumni::alumni_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_satpen' => 'required',
			'nama_alumni' => 'required',
			'nik' => 'required',
			'nama_ayah' => 'required',
			'nama_ibu' => 'required',
			'tgl_lahir' => 'required',
			'tempat_lahir' => 'required',
			'nis' => 'required',
			'nisn' => 'required',
			'foto' => 'required',
			'kk' => 'required',
			'akta_lahir' => 'required',
			'ijazah_smp' => 'required',
			'fc_rapor' => 'required',
			'fc_ijazah' => 'required',
			
		]);
		
		$alumni = Alumni::find($id);
		$alumni->id_satpen = $request->input("id_satpen");
		$alumni->nama_alumni = $request->input("nama_alumni");
		$alumni->nik = $request->input("nik");
		$alumni->nama_ayah = $request->input("nama_ayah");
		$alumni->nama_ibu = $request->input("nama_ibu");
		$alumni->tgl_lahir = $request->input("tgl_lahir");
		$alumni->tempat_lahir = $request->input("tempat_lahir");
		$alumni->nis = $request->input("nis");
		$alumni->nisn = $request->input("nisn");
		$alumni->foto = $request->input("foto");
		$alumni->kk = $request->input("kk");
		$alumni->akta_lahir = $request->input("akta_lahir");
		$alumni->ijazah_smp = $request->input("ijazah_smp");
		$alumni->fc_rapor = $request->input("fc_rapor");
		$alumni->fc_ijazah = $request->input("fc_ijazah");
		
		$alumni->updated_by = Auth::id();
		$alumni->save();


		$text = 'mengedit '.$this->title;//.' '.$alumni->what;
		$this->log($request, $text, ['alumni.id' => $alumni->id]);
		return redirect()->route('alumni.index')->with('message_success', 'Alumni berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$alumni = Alumni::find($id);
		$alumni->deleted_by = Auth::id();
		$alumni->save();
		$alumni->delete();

		$text = 'menghapus '.$this->title;//.' '.$alumni->what;
		$this->log($request, $text, ['alumni.id' => $alumni->id]);
		return back()->with('message_success', 'Alumni berhasil dihapus!');
	}

}
