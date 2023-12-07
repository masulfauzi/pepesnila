<?php

namespace App\Modules\Juara\Models;

use App\Helpers\UsesUuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Tingkat\Models\Tingkat;


class Juara extends Model
{
	use SoftDeletes;
	use UsesUuid;

	protected $casts      = ['deleted_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
	protected $table      = 'juara';
	protected $fillable   = ['*'];	

	public function tingkat(){
		return $this->belongsTo(Tingkat::class,"id_tingkat","id");
	}

}
