<?php

namespace App\Http\Controllers;

use App\Ability;
use App\Item;
use Illuminate\Http\Request;
use App\Champion;

class ChampionController extends Controller
{
	public function index(){
		return view('pages.champion.index');
	}

    public function json_view(){
    	return Champion::all();
    }

    public function view($champ_name){
        $c = Champion::where('name', $champ_name)->first();
	    if(count($c)>0) {
            $a = Champion::find($c->id)->ability;
            $i = Item::where('champion_id', $c->id_hirex)->get();
            return response()->json(['champion' => $c, 'abilities' => $a, 'items'=>$i,'r'=>'done']);
        }
        return response()->json(['m'=> 'No se encontro el campeon', 'r'=>'bad']);
    }
}
