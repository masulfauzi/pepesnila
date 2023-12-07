<?php

namespace App\Modules\Prestasi\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Satpen\Models\Satpen;
use App\Modules\Juara\Models\Juara;


class Prestasi extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'prestasi';
	protected $fillable   = ['*'];	

	public function satpen(){
		return $this->belongsTo(Satpen::class,"id_satpen","id");
	}
public function juara(){
		return $this->belongsTo(Juara::class,"id_juara","id");
	}

}
