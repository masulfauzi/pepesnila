<?php
namespace App\Modules\JenisAjuan\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\JenisAjuan\Models\JenisAjuan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JenisAjuanController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Jenis Ajuan";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = JenisAjuan::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('JenisAjuan::jenisajuan', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'jenis_ajuan' => ['Jenis Ajuan', Form::text("jenis_ajuan", old("jenis_ajuan"), ["class" => "form-control","placeholder" => ""]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('JenisAjuan::jenisajuan_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'jenis_ajuan' => 'required',
			
		]);

		$jenisajuan = new JenisAjuan();
		$jenisajuan->jenis_ajuan = $request->input("jenis_ajuan");
		
		$jenisajuan->created_by = Auth::id();
		$jenisajuan->save();

		$text = 'membuat '.$this->title; //' baru '.$jenisajuan->what;
		$this->log($request, $text, ['jenisajuan.id' => $jenisajuan->id]);
		return redirect()->route('jenisajuan.index')->with('message_success', 'Jenis Ajuan berhasil ditambahkan!');
	}

	public function show(Request $request, JenisAjuan $jenisajuan)
	{
		$data['jenisajuan'] = $jenisajuan;

		$text = 'melihat detail '.$this->title;//.' '.$jenisajuan->what;
		$this->log($request, $text, ['jenisajuan.id' => $jenisajuan->id]);
		return view('JenisAjuan::jenisajuan_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, JenisAjuan $jenisajuan)
	{
		$data['jenisajuan'] = $jenisajuan;

		
		$data['forms'] = array(
			'jenis_ajuan' => ['Jenis Ajuan', Form::text("jenis_ajuan", $jenisajuan->jenis_ajuan, ["class" => "form-control","placeholder" => "", "id" => "jenis_ajuan"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$jenisajuan->what;
		$this->log($request, $text, ['jenisajuan.id' => $jenisajuan->id]);
		return view('JenisAjuan::jenisajuan_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'jenis_ajuan' => 'required',
			
		]);
		
		$jenisajuan = JenisAjuan::find($id);
		$jenisajuan->jenis_ajuan = $request->input("jenis_ajuan");
		
		$jenisajuan->updated_by = Auth::id();
		$jenisajuan->save();


		$text = 'mengedit '.$this->title;//.' '.$jenisajuan->what;
		$this->log($request, $text, ['jenisajuan.id' => $jenisajuan->id]);
		return redirect()->route('jenisajuan.index')->with('message_success', 'Jenis Ajuan berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$jenisajuan = JenisAjuan::find($id);
		$jenisajuan->deleted_by = Auth::id();
		$jenisajuan->save();
		$jenisajuan->delete();

		$text = 'menghapus '.$this->title;//.' '.$jenisajuan->what;
		$this->log($request, $text, ['jenisajuan.id' => $jenisajuan->id]);
		return back()->with('message_success', 'Jenis Ajuan berhasil dihapus!');
	}

}
