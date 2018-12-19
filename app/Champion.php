<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
	protected $fillable = [
        'id_hirex',
		'name',
		'roles',
		'title',
		'lore',
		'card_url',
		'icon_url',
		'coins',
		'health',
		'speed',
		'on_free_rotation',
		'pantheon',
		'pros',
		'type',
		'lastest_champion',
		'ret_msg',
    ];
    public function ability(){
        return $this->hasMany(Ability::class);
    }

    public function items(){
        return $this->hasMany(Item::class);
    }

}
