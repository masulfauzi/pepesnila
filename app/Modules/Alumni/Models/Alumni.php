<?php

namespace App\Modules\Alumni\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Satpen\Models\Satpen;


class Alumni extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'alumni';
	protected $fillable   = ['*'];	

	public function satpen(){
		return $this->belongsTo(Satpen::class,"id_satpen","id");
	}

}
