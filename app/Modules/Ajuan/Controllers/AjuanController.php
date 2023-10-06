<?php
namespace App\Modules\Ajuan\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Ajuan\Models\Ajuan;
use App\Modules\StatusAjuan\Models\StatusAjuan;
use App\Modules\Alumni\Models\Alumni;
use App\Modules\JenisAjuan\Models\JenisAjuan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjuanController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Ajuan";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$admin = [
			'70e568d3-cd38-4b22-b8e0-8f39caaaa86c'
		];

		if(in_array(session('active_role')['id'], $admin))
		{
			return redirect()->route('ajuan.admin.index');
		}

		$query = Ajuan::query()->join('alumni', 'alumni.id', 'ajuan.id_alumni')
								->select('ajuan.*')
								->where('id_satpen', Auth::user()->id_satpen)
								->where('id_status_ajuan', '25e33720-6db4-45c6-aa32-8a790c0a88bd');
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Ajuan::ajuan', array_merge($data, ['title' => $this->title]));
	}

	public function index_admin(Request $request, String $id_status_ajuan = '25e33720-6db4-45c6-aa32-8a790c0a88bd')
	{
		// dd($request);
		$query = Ajuan::join('alumni', 'alumni.id', 'ajuan.id_alumni')
						->select('ajuan.*')
						->where('id_status_ajuan', $id_status_ajuan);

		if(session('active_role')['id'] == 'a5086fe7-87c2-4b3a-82bb-e71c5154faa4')
		{
			$query->where('id_satpen', Auth::user()->id_satpen);
		}

		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Ajuan::ajuan_admin', array_merge($data, ['title' => $this->title]));
	}

	public function ajuan_verval(Request $request)
	{
		return $this->index_admin($request, 'd3855fc0-ddaf-426e-a7ca-7e98b7a1d22d');
	}
	
	public function ajuan_ditolak(Request $request)
	{
		return $this->index_admin($request, 'b641d25c-7121-4355-9734-f79a8b09c27a');
	}

	public function detail_ajuan(Request $request, Ajuan $ajuan)
	{
		// dd($ajuan->alumni);
		$data['ajuan'] = $ajuan;
		$data['status'] = StatusAjuan::get();

		return view('Ajuan::ajuan_detail_admin', array_merge($data, ['title' => $this->title]));
	}

	public function ubah_status_ajuan(Request $request, Ajuan $ajuan, String $status_ajuan)
	{
		$data = $ajuan;

		$data->id_status_ajuan = $status_ajuan;

		$data->save();

		return redirect()->route('ajuan.admin.index')->with('message_success', 'Data Berhasil Disimpan');
	}

	public function uploads(Ajuan $ajuan)
	{
		// dd($ajuan);
		$data['data'] = $ajuan;

		return view('Ajuan::ajuan_upload', array_merge($data, ['title' => $this->title]));
	}

	function aksi_upload(Request $request)
	{
		$request->validate([
            'file' => 'required|mimes:pdf,jpg,jpeg,png|max:10240'
        ]);

		$jenis = $request->get('jenis');
		$fileName = time().'.'.$request->file->extension();  

        $request->file->move(public_path('uploads/'.$jenis), $fileName);

		$alumni = Ajuan::find($request->input('id'));

		$alumni->$jenis = $fileName;

		$alumni->save();

		return redirect()->route('ajuan.upload.index', $request->input('id'))->with('message_success', 'Data Berhasil Disimpan');
	}

	public function create(Request $request)
	{
		$alumni = Alumni::find($request->input('id_alumni'));

		// dd($alumni);
		// $ref_status_ajuan = StatusAjuan::all()->pluck('status_ajuan','id');
		// $ref_alumni = Alumni::all()->pluck('id','id');
		$ref_jenis_ajuan = JenisAjuan::all()->pluck('jenis_ajuan','id');

		$ref_jenis_ajuan->prepend('-PILIH SALAH SATU-', '');
		
		$data['forms'] = array(
			'id_status_ajuan' => ['', Form::hidden("id_status_ajuan", '25e33720-6db4-45c6-aa32-8a790c0a88bd')],
			'id_alumni' => ['', Form::hidden("id_alumni", $alumni->id) ],
			'nama_alumni' => ['Nama Alumni', Form::text("nama_alumni", $alumni->nama_alumni, ["class" => "form-control", "disabled" => "disabled"]) ],
			'id_jenis_ajuan' => ['Jenis Ajuan', Form::select("id_jenis_ajuan", $ref_jenis_ajuan, null, ["class" => "form-control select2"]) ],
			// 'surat_tanggung_jawab' => ['Surat Tanggung Jawab', Form::text("surat_tanggung_jawab", old("surat_tanggung_jawab"), ["class" => "form-control","placeholder" => ""]) ],
			// 'surat_kehilangan' => ['Surat Kehilangan', Form::text("surat_kehilangan", old("surat_kehilangan"), ["class" => "form-control","placeholder" => ""]) ],
			// 'super_1' => ['Super 1', Form::text("super_1", old("super_1"), ["class" => "form-control","placeholder" => ""]) ],
			// 'super_2' => ['Super 2', Form::text("super_2", old("super_2"), ["class" => "form-control","placeholder" => ""]) ],
			// 'foto_saksi_1' => ['Foto Saksi 1', Form::text("foto_saksi_1", old("foto_saksi_1"), ["class" => "form-control","placeholder" => ""]) ],
			// 'foto_saksi_2' => ['Foto Saksi 2', Form::text("foto_saksi_2", old("foto_saksi_2"), ["class" => "form-control","placeholder" => ""]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Ajuan::ajuan_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_status_ajuan' => 'required',
			'id_alumni' => 'required',
			'id_jenis_ajuan' => 'required',
			// 'surat_tanggung_jawab' => 'required',
			// 'surat_kehilangan' => 'required',
			// 'super_1' => 'required',
			// 'super_2' => 'required',
			// 'foto_saksi_1' => 'required',
			// 'foto_saksi_2' => 'required',
			
		]);

		$ajuan = new Ajuan();
		$ajuan->id_status_ajuan = $request->input("id_status_ajuan");
		$ajuan->id_alumni = $request->input("id_alumni");
		$ajuan->id_jenis_ajuan = $request->input("id_jenis_ajuan");
		$ajuan->surat_tanggung_jawab = $request->input("surat_tanggung_jawab");
		$ajuan->surat_kehilangan = $request->input("surat_kehilangan");
		$ajuan->super_1 = $request->input("super_1");
		$ajuan->super_2 = $request->input("super_2");
		$ajuan->foto_saksi_1 = $request->input("foto_saksi_1");
		$ajuan->foto_saksi_2 = $request->input("foto_saksi_2");
		
		$ajuan->created_by = Auth::id();
		$ajuan->save();

		$text = 'membuat '.$this->title; //' baru '.$ajuan->what;
		$this->log($request, $text, ['ajuan.id' => $ajuan->id]);
		return redirect()->route('ajuan.index')->with('message_success', 'Ajuan berhasil ditambahkan!');
	}

	public function show(Request $request, Ajuan $ajuan)
	{
		$data['ajuan'] = $ajuan;

		$text = 'melihat detail '.$this->title;//.' '.$ajuan->what;
		$this->log($request, $text, ['ajuan.id' => $ajuan->id]);
		return view('Ajuan::ajuan_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Ajuan $ajuan)
	{
		$data['ajuan'] = $ajuan;

		$ref_status_ajuan = StatusAjuan::all()->pluck('status_ajuan','id');
		$ref_alumni = Alumni::all()->pluck('id_satpen','id');
		$ref_jenis_ajuan = JenisAjuan::all()->pluck('jenis_ajuan','id');
		
		$data['forms'] = array(
			'id_status_ajuan' => ['Status Ajuan', Form::select("id_status_ajuan", $ref_status_ajuan, null, ["class" => "form-control select2"]) ],
			'id_alumni' => ['Alumni', Form::select("id_alumni", $ref_alumni, null, ["class" => "form-control select2"]) ],
			'id_jenis_ajuan' => ['Jenis Ajuan', Form::select("id_jenis_ajuan", $ref_jenis_ajuan, null, ["class" => "form-control select2"]) ],
			'surat_tanggung_jawab' => ['Surat Tanggung Jawab', Form::text("surat_tanggung_jawab", $ajuan->surat_tanggung_jawab, ["class" => "form-control","placeholder" => "", "id" => "surat_tanggung_jawab"]) ],
			'surat_kehilangan' => ['Surat Kehilangan', Form::text("surat_kehilangan", $ajuan->surat_kehilangan, ["class" => "form-control","placeholder" => "", "id" => "surat_kehilangan"]) ],
			'super_1' => ['Super 1', Form::text("super_1", $ajuan->super_1, ["class" => "form-control","placeholder" => "", "id" => "super_1"]) ],
			'super_2' => ['Super 2', Form::text("super_2", $ajuan->super_2, ["class" => "form-control","placeholder" => "", "id" => "super_2"]) ],
			'foto_saksi_1' => ['Foto Saksi 1', Form::text("foto_saksi_1", $ajuan->foto_saksi_1, ["class" => "form-control","placeholder" => "", "id" => "foto_saksi_1"]) ],
			'foto_saksi_2' => ['Foto Saksi 2', Form::text("foto_saksi_2", $ajuan->foto_saksi_2, ["class" => "form-control","placeholder" => "", "id" => "foto_saksi_2"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$ajuan->what;
		$this->log($request, $text, ['ajuan.id' => $ajuan->id]);
		return view('Ajuan::ajuan_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_status_ajuan' => 'required',
			'id_alumni' => 'required',
			'id_jenis_ajuan' => 'required',
			'surat_tanggung_jawab' => 'required',
			'surat_kehilangan' => 'required',
			'super_1' => 'required',
			'super_2' => 'required',
			'foto_saksi_1' => 'required',
			'foto_saksi_2' => 'required',
			
		]);
		
		$ajuan = Ajuan::find($id);
		$ajuan->id_status_ajuan = $request->input("id_status_ajuan");
		$ajuan->id_alumni = $request->input("id_alumni");
		$ajuan->id_jenis_ajuan = $request->input("id_jenis_ajuan");
		$ajuan->surat_tanggung_jawab = $request->input("surat_tanggung_jawab");
		$ajuan->surat_kehilangan = $request->input("surat_kehilangan");
		$ajuan->super_1 = $request->input("super_1");
		$ajuan->super_2 = $request->input("super_2");
		$ajuan->foto_saksi_1 = $request->input("foto_saksi_1");
		$ajuan->foto_saksi_2 = $request->input("foto_saksi_2");
		
		$ajuan->updated_by = Auth::id();
		$ajuan->save();


		$text = 'mengedit '.$this->title;//.' '.$ajuan->what;
		$this->log($request, $text, ['ajuan.id' => $ajuan->id]);
		return redirect()->route('ajuan.index')->with('message_success', 'Ajuan berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$ajuan = Ajuan::find($id);
		$ajuan->deleted_by = Auth::id();
		$ajuan->save();
		$ajuan->delete();

		$text = 'menghapus '.$this->title;//.' '.$ajuan->what;
		$this->log($request, $text, ['ajuan.id' => $ajuan->id]);
		return back()->with('message_success', 'Ajuan berhasil dihapus!');
	}

}
