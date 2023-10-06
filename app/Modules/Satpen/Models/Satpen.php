<?php

namespace App\Modules\Satpen\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Kelompok\Models\Kelompok;
use App\Modules\StatusSekolah\Models\StatusSekolah;


class Satpen extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'satpen';
	protected $fillable   = ['*'];	

	public function kelompok(){
		return $this->belongsTo(Kelompok::class,"id_kelompok","id");
	}
public function statusSekolah(){
		return $this->belongsTo(StatusSekolah::class,"id_status_sekolah","id");
	}

}
