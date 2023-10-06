<?php
namespace App\Modules\Kelompok\Controllers;

use Form;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Modules\Log\Models\Log;
use App\Modules\Kelompok\Models\Kelompok;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KelompokController extends Controller
{
	use Logger;
	protected $log;
	protected $title = "Kelompok";
	
	public function __construct(Log $log)
	{
		$this->log = $log;
	}

	public function index(Request $request)
	{
		$query = Kelompok::query();
		if($request->has('search')){
			$search = $request->get('search');
			// $query->where('name', 'like', "%$search%");
		}
		$data['data'] = $query->paginate(10)->withQueryString();

		$this->log($request, 'melihat halaman manajemen data '.$this->title);
		return view('Kelompok::kelompok', array_merge($data, ['title' => $this->title]));
	}

	public function create(Request $request)
	{
		
		$data['forms'] = array(
			'kelompok' => ['Kelompok', Form::text("kelompok", old("kelompok"), ["class" => "form-control","placeholder" => ""]) ],
			
		);

		$this->log($request, 'membuka form tambah '.$this->title);
		return view('Kelompok::kelompok_create', array_merge($data, ['title' => $this->title]));
	}

	function store(Request $request)
	{
		$this->validate($request, [
			'kelompok' => 'required',
			
		]);

		$kelompok = new Kelompok();
		$kelompok->kelompok = $request->input("kelompok");
		
		$kelompok->created_by = Auth::id();
		$kelompok->save();

		$text = 'membuat '.$this->title; //' baru '.$kelompok->what;
		$this->log($request, $text, ['kelompok.id' => $kelompok->id]);
		return redirect()->route('kelompok.index')->with('message_success', 'Kelompok berhasil ditambahkan!');
	}

	public function show(Request $request, Kelompok $kelompok)
	{
		$data['kelompok'] = $kelompok;

		$text = 'melihat detail '.$this->title;//.' '.$kelompok->what;
		$this->log($request, $text, ['kelompok.id' => $kelompok->id]);
		return view('Kelompok::kelompok_detail', array_merge($data, ['title' => $this->title]));
	}

	public function edit(Request $request, Kelompok $kelompok)
	{
		$data['kelompok'] = $kelompok;

		
		$data['forms'] = array(
			'kelompok' => ['Kelompok', Form::text("kelompok", $kelompok->kelompok, ["class" => "form-control","placeholder" => "", "id" => "kelompok"]) ],
			
		);

		$text = 'membuka form edit '.$this->title;//.' '.$kelompok->what;
		$this->log($request, $text, ['kelompok.id' => $kelompok->id]);
		return view('Kelompok::kelompok_update', array_merge($data, ['title' => $this->title]));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'kelompok' => 'required',
			
		]);
		
		$kelompok = Kelompok::find($id);
		$kelompok->kelompok = $request->input("kelompok");
		
		$kelompok->updated_by = Auth::id();
		$kelompok->save();


		$text = 'mengedit '.$this->title;//.' '.$kelompok->what;
		$this->log($request, $text, ['kelompok.id' => $kelompok->id]);
		return redirect()->route('kelompok.index')->with('message_success', 'Kelompok berhasil diubah!');
	}

	public function destroy(Request $request, $id)
	{
		$kelompok = Kelompok::find($id);
		$kelompok->deleted_by = Auth::id();
		$kelompok->save();
		$kelompok->delete();

		$text = 'menghapus '.$this->title;//.' '.$kelompok->what;
		$this->log($request, $text, ['kelompok.id' => $kelompok->id]);
		return back()->with('message_success', 'Kelompok berhasil dihapus!');
	}

}
