<?php
namespace App\Modules\StatusSekolah\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\StatusSekolah\Models\StatusSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatusSekolahController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Status Sekolah";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = StatusSekolah::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('StatusSekolah::statussekolah', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'status_sekolah' => ['Status Sekolah', Form::text("status_sekolah", old("status_sekolah"), ["class" => "form-control","placeholder" => ""]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('StatusSekolah::statussekolah_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'status_sekolah' => 'required',
			
		]);

		$statussekolah = new StatusSekolah();
		$statussekolah->status_sekolah = $request->input("status_sekolah");
		
		$statussekolah->created_by = Auth::id();
		$statussekolah->save();

		$text = 'membuat '.$this->title; //' baru '.$statussekolah->what;
		$this->log($request, $text, ['statussekolah.id' => $statussekolah->id]);
		return redirect()->route('statussekolah.index')->with('message_success', 'Status Sekolah berhasil ditambahkan!');
	}

	public function show(Request $request, StatusSekolah $statussekolah)
	{
		$data['statussekolah'] = $statussekolah;

		$text = 'melihat detail '.$this->title;//.' '.$statussekolah->what;
		$this->log($request, $text, ['statussekolah.id' => $statussekolah->id]);
		return view('StatusSekolah::statussekolah_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, StatusSekolah $statussekolah)
	{
		$data['statussekolah'] = $statussekolah;

		
		$data['forms'] = array(
			'status_sekolah' => ['Status Sekolah', Form::text("status_sekolah", $statussekolah->status_sekolah, ["class" => "form-control","placeholder" => "", "id" => "status_sekolah"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$statussekolah->what;
		$this->log($request, $text, ['statussekolah.id' => $statussekolah->id]);
		return view('StatusSekolah::statussekolah_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'status_sekolah' => 'required',
			
		]);
		
		$statussekolah = StatusSekolah::find($id);
		$statussekolah->status_sekolah = $request->input("status_sekolah");
		
		$statussekolah->updated_by = Auth::id();
		$statussekolah->save();


		$text = 'mengedit '.$this->title;//.' '.$statussekolah->what;
		$this->log($request, $text, ['statussekolah.id' => $statussekolah->id]);
		return redirect()->route('statussekolah.index')->with('message_success', 'Status Sekolah berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$statussekolah = StatusSekolah::find($id);
		$statussekolah->deleted_by = Auth::id();
		$statussekolah->save();
		$statussekolah->delete();

		$text = 'menghapus '.$this->title;//.' '.$statussekolah->what;
		$this->log($request, $text, ['statussekolah.id' => $statussekolah->id]);
		return back()->with('message_success', 'Status Sekolah berhasil dihapus!');
	}

}
