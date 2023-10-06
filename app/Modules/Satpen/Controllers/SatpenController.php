<?php
namespace App\Modules\Satpen\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Satpen\Models\Satpen;
use App\Modules\Kelompok\Models\Kelompok;
use App\Modules\StatusSekolah\Models\StatusSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SatpenController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Satpen";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Satpen::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Satpen::satpen', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_kelompok = Kelompok::all()->pluck('kelompok','id');
		$ref_status_sekolah = StatusSekolah::all()->pluck('status_sekolah','id');

		$ref_kelompok->prepend('-PILIH SALAH SATU-', '');
		$ref_status_sekolah->prepend('-PILIH SALAH SATU-','');
		
		$data['forms'] = array(
			'satpen' => ['Nama Satuan Pendidikan', Form::text("satpen", old("satpen"), ["class" => "form-control","placeholder" => ""]) ],
			'id_kelompok' => ['Kelompok', Form::select("id_kelompok", $ref_kelompok, null, ["class" => "form-control select2"]) ],
			'id_status_sekolah' => ['Status Sekolah', Form::select("id_status_sekolah", $ref_status_sekolah, null, ["class" => "form-control select2"]) ],
			'yayasan' => ['Yayasan', Form::text("yayasan", old("yayasan"), ["class" => "form-control","placeholder" => ""]) ],
			'alamat' => ['Alamat', Form::textarea("alamat", old("alamat"), ["class" => "form-control rich-editor"]) ],
			'npsn' => ['NPSN', Form::text("npsn", old("npsn"), ["class" => "form-control","placeholder" => ""]) ],
			'nss' => ['NSS', Form::text("nss", old("nss"), ["class" => "form-control","placeholder" => ""]) ],
			'nama_ks' => ['Nama Kepala Sekolah', Form::text("nama_ks", old("nama_ks"), ["class" => "form-control","placeholder" => ""]) ],
			'nip_ks' => ['NIP Kepala Sekolah', Form::text("nip_ks", old("nip_ks"), ["class" => "form-control","placeholder" => ""]) ],
			'no_telp' => ['No Telp', Form::text("no_telp", old("no_telp"), ["class" => "form-control","placeholder" => ""]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Satpen::satpen_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_kelompok' => 'required',
			'id_status_sekolah' => 'required',
			'satpen' => 'required',
			// 'yayasan' => 'required',
			'alamat' => 'required',
			'npsn' => 'required',
			// 'nss' => 'required',
			'nama_ks' => 'required',
			'nip_ks' => 'required',
			'no_telp' => 'required',
			
		]);

		$satpen = new Satpen();
		$satpen->id_kelompok = $request->input("id_kelompok");
		$satpen->id_status_sekolah = $request->input("id_status_sekolah");
		$satpen->satpen = $request->input("satpen");
		$satpen->yayasan = $request->input("yayasan");
		$satpen->alamat = $request->input("alamat");
		$satpen->npsn = $request->input("npsn");
		$satpen->nss = $request->input("nss");
		$satpen->nama_ks = $request->input("nama_ks");
		$satpen->nip_ks = $request->input("nip_ks");
		$satpen->no_telp = $request->input("no_telp");
		
		$satpen->created_by = Auth::id();
		$satpen->save();

		$text = 'membuat '.$this->title; //' baru '.$satpen->what;
		$this->log($request, $text, ['satpen.id' => $satpen->id]);
		return redirect()->route('satpen.index')->with('message_success', 'Satpen berhasil ditambahkan!');
	}

	public function show(Request $request, Satpen $satpen)
	{
		$data['satpen'] = $satpen;

		$text = 'melihat detail '.$this->title;//.' '.$satpen->what;
		$this->log($request, $text, ['satpen.id' => $satpen->id]);
		return view('Satpen::satpen_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Satpen $satpen)
	{
		$data['satpen'] = $satpen;

		$ref_kelompok = Kelompok::all()->pluck('kelompok','id');
		$ref_status_sekolah = StatusSekolah::all()->pluck('status_sekolah','id');
		
		$data['forms'] = array(
			'id_kelompok' => ['Kelompok', Form::select("id_kelompok", $ref_kelompok, null, ["class" => "form-control select2"]) ],
			'id_status_sekolah' => ['Status Sekolah', Form::select("id_status_sekolah", $ref_status_sekolah, null, ["class" => "form-control select2"]) ],
			'satpen' => ['Satpen', Form::text("satpen", $satpen->satpen, ["class" => "form-control","placeholder" => "", "id" => "satpen"]) ],
			'yayasan' => ['Yayasan', Form::text("yayasan", $satpen->yayasan, ["class" => "form-control","placeholder" => "", "id" => "yayasan"]) ],
			'alamat' => ['Alamat', Form::textarea("alamat", $satpen->alamat, ["class" => "form-control rich-editor"]) ],
			'npsn' => ['Npsn', Form::text("npsn", $satpen->npsn, ["class" => "form-control","placeholder" => "", "id" => "npsn"]) ],
			'nss' => ['Nss', Form::text("nss", $satpen->nss, ["class" => "form-control","placeholder" => "", "id" => "nss"]) ],
			'nama_ks' => ['Nama Ks', Form::text("nama_ks", $satpen->nama_ks, ["class" => "form-control","placeholder" => "", "id" => "nama_ks"]) ],
			'nip_ks' => ['Nip Ks', Form::text("nip_ks", $satpen->nip_ks, ["class" => "form-control","placeholder" => "", "id" => "nip_ks"]) ],
			'no_telp' => ['No Telp', Form::text("no_telp", $satpen->no_telp, ["class" => "form-control","placeholder" => "", "id" => "no_telp"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$satpen->what;
		$this->log($request, $text, ['satpen.id' => $satpen->id]);
		return view('Satpen::satpen_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_kelompok' => 'required',
			'id_status_sekolah' => 'required',
			'satpen' => 'required',
			'yayasan' => 'required',
			'alamat' => 'required',
			'npsn' => 'required',
			'nss' => 'required',
			'nama_ks' => 'required',
			'nip_ks' => 'required',
			'no_telp' => 'required',
			
		]);
		
		$satpen = Satpen::find($id);
		$satpen->id_kelompok = $request->input("id_kelompok");
		$satpen->id_status_sekolah = $request->input("id_status_sekolah");
		$satpen->satpen = $request->input("satpen");
		$satpen->yayasan = $request->input("yayasan");
		$satpen->alamat = $request->input("alamat");
		$satpen->npsn = $request->input("npsn");
		$satpen->nss = $request->input("nss");
		$satpen->nama_ks = $request->input("nama_ks");
		$satpen->nip_ks = $request->input("nip_ks");
		$satpen->no_telp = $request->input("no_telp");
		
		$satpen->updated_by = Auth::id();
		$satpen->save();


		$text = 'mengedit '.$this->title;//.' '.$satpen->what;
		$this->log($request, $text, ['satpen.id' => $satpen->id]);
		return redirect()->route('satpen.index')->with('message_success', 'Satpen berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$satpen = Satpen::find($id);
		$satpen->deleted_by = Auth::id();
		$satpen->save();
		$satpen->delete();

		$text = 'menghapus '.$this->title;//.' '.$satpen->what;
		$this->log($request, $text, ['satpen.id' => $satpen->id]);
		return back()->with('message_success', 'Satpen berhasil dihapus!');
	}

}
