<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'description',
		'sumary',
		'url',
	];

    public function champion()
    {
    	return $this->belongsTo(Champion::class);
    }
}
