<?php
namespace App\Modules\StatusAjuan\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\StatusAjuan\Models\StatusAjuan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatusAjuanController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Status Ajuan";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = StatusAjuan::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('StatusAjuan::statusajuan', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'status_ajuan' => ['Status Ajuan', Form::text("status_ajuan", old("status_ajuan"), ["class" => "form-control","placeholder" => ""]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('StatusAjuan::statusajuan_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'status_ajuan' => 'required',
			
		]);

		$statusajuan = new StatusAjuan();
		$statusajuan->status_ajuan = $request->input("status_ajuan");
		
		$statusajuan->created_by = Auth::id();
		$statusajuan->save();

		$text = 'membuat '.$this->title; //' baru '.$statusajuan->what;
		$this->log($request, $text, ['statusajuan.id' => $statusajuan->id]);
		return redirect()->route('statusajuan.index')->with('message_success', 'Status Ajuan berhasil ditambahkan!');
	}

	public function show(Request $request, StatusAjuan $statusajuan)
	{
		$data['statusajuan'] = $statusajuan;

		$text = 'melihat detail '.$this->title;//.' '.$statusajuan->what;
		$this->log($request, $text, ['statusajuan.id' => $statusajuan->id]);
		return view('StatusAjuan::statusajuan_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, StatusAjuan $statusajuan)
	{
		$data['statusajuan'] = $statusajuan;

		
		$data['forms'] = array(
			'status_ajuan' => ['Status Ajuan', Form::text("status_ajuan", $statusajuan->status_ajuan, ["class" => "form-control","placeholder" => "", "id" => "status_ajuan"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$statusajuan->what;
		$this->log($request, $text, ['statusajuan.id' => $statusajuan->id]);
		return view('StatusAjuan::statusajuan_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'status_ajuan' => 'required',
			
		]);
		
		$statusajuan = StatusAjuan::find($id);
		$statusajuan->status_ajuan = $request->input("status_ajuan");
		
		$statusajuan->updated_by = Auth::id();
		$statusajuan->save();


		$text = 'mengedit '.$this->title;//.' '.$statusajuan->what;
		$this->log($request, $text, ['statusajuan.id' => $statusajuan->id]);
		return redirect()->route('statusajuan.index')->with('message_success', 'Status Ajuan berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$statusajuan = StatusAjuan::find($id);
		$statusajuan->deleted_by = Auth::id();
		$statusajuan->save();
		$statusajuan->delete();

		$text = 'menghapus '.$this->title;//.' '.$statusajuan->what;
		$this->log($request, $text, ['statusajuan.id' => $statusajuan->id]);
		return back()->with('message_success', 'Status Ajuan berhasil dihapus!');
	}

}
