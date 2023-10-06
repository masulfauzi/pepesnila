<?php

namespace App\Modules\Ajuan\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\StatusAjuan\Models\StatusAjuan;
use App\Modules\Alumni\Models\Alumni;
use App\Modules\JenisAjuan\Models\JenisAjuan;


class Ajuan extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'ajuan';
	protected $fillable   = ['*'];	

	public function statusAjuan(){
		return $this->belongsTo(StatusAjuan::class,"id_status_ajuan","id");
	}
public function alumni(){
		return $this->belongsTo(Alumni::class,"id_alumni","id");
	}
public function jenisAjuan(){
		return $this->belongsTo(JenisAjuan::class,"id_jenis_ajuan","id");
	}

}
