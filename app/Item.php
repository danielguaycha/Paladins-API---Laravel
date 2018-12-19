<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'description',
        'device_name',
        'icon_id',
        'item_id',
        'price',
        'short_desc',
        'champion_id',
        'icon_url',
        'item_type',
        'ret_msg',
        'talent_reward_level',
    ];
    public function champion(){
        return $this->belongsTo(Champion::class);
    }
}
