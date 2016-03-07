<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corpus extends Model {

	protected $table = 'corpus';
	public $timestamps = true;

	public function sentences()
	{
		return $this->hasMany('App\Models\Sentence');
	}

}