<?php
namespace App\Modules\Juara\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Juara\Models\Juara;
use App\Modules\Tingkat\Models\Tingkat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JuaraController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Juara";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Juara::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Juara::juara', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		$ref_tingkat = Tingkat::all()->sortBy('urutan')->pluck('tingkat','id');
		$ref_tingkat->prepend('-PILIH SALAH SATU-', '');
		
		$data['forms'] = array(
			'id_tingkat' => ['Tingkat', Form::select("id_tingkat", $ref_tingkat, null, ["class" => "form-control select2"]) ],
			'juara' => ['Juara', Form::text("juara", old("juara"), ["class" => "form-control","placeholder" => ""]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Juara::juara_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'id_tingkat' => 'required',
			'juara' => 'required',
			
		]);

		$juara = new Juara();
		$juara->id_tingkat = $request->input("id_tingkat");
		$juara->juara = $request->input("juara");
		
		$juara->created_by = Auth::id();
		$juara->save();

		$text = 'membuat '.$this->title; //' baru '.$juara->what;
		$this->log($request, $text, ['juara.id' => $juara->id]);
		return redirect()->route('juara.index')->with('message_success', 'Juara berhasil ditambahkan!');
	}

	public function show(Request $request, Juara $juara)
	{
		$data['juara'] = $juara;

		$text = 'melihat detail '.$this->title;//.' '.$juara->what;
		$this->log($request, $text, ['juara.id' => $juara->id]);
		return view('Juara::juara_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Juara $juara)
	{
		$data['juara'] = $juara;

		$ref_tingkat = Tingkat::all()->pluck('tingkat','id');
		
		$data['forms'] = array(
			'id_tingkat' => ['Tingkat', Form::select("id_tingkat", $ref_tingkat, null, ["class" => "form-control select2"]) ],
			'juara' => ['Juara', Form::text("juara", $juara->juara, ["class" => "form-control","placeholder" => "", "id" => "juara"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$juara->what;
		$this->log($request, $text, ['juara.id' => $juara->id]);
		return view('Juara::juara_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'id_tingkat' => 'required',
			'juara' => 'required',
			
		]);
		
		$juara = Juara::find($id);
		$juara->id_tingkat = $request->input("id_tingkat");
		$juara->juara = $request->input("juara");
		
		$juara->updated_by = Auth::id();
		$juara->save();


		$text = 'mengedit '.$this->title;//.' '.$juara->what;
		$this->log($request, $text, ['juara.id' => $juara->id]);
		return redirect()->route('juara.index')->with('message_success', 'Juara berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$juara = Juara::find($id);
		$juara->deleted_by = Auth::id();
		$juara->save();
		$juara->delete();

		$text = 'menghapus '.$this->title;//.' '.$juara->what;
		$this->log($request, $text, ['juara.id' => $juara->id]);
		return back()->with('message_success', 'Juara berhasil dihapus!');
	}

}
