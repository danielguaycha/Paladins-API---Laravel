<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Cache\Repository;
use Reflex\OnoiIlluminate\IlluminateCache;
use \Reflex\Paladins\API;
use Illuminate\Support\Facades\Config;
use App\Champion;
use App\Ability;
use Image;
class InitController extends Controller
{
    private $api;
	private $devId = your_dev_id;
	private $authKey = "your_auth_id";
	private $queue = ['casual'=>424, 'tdm'=>469, 'matanza'=>452, 'competitivo'=>428, 'asedio' =>465];
    private $tierMap = [
        'bronze5' => 1,
        'bronze4' => 2,
        'bronze3' => 3,
        'bronze2' => 4,
        'bronze1' => 5,
        'silver5' => 6,
        'silver4' => 7,
        'silver3' => 8,
        'silver2' => 9,
        'silver1' => 10,
        'gold5' => 11,
        'gold4' => 12,
        'gold3' => 13,
        'gold2' => 14,
        'gold1' => 15,
        'platinum5' => 16,
        'platinum4' => 17,
        'platinum3' => 18,
        'platinum2' => 19,
        'platinum1' => 20,
        'diamond5' => 21,
        'diamond4' => 22,
        'diamond3' => 23,
        'diamond2' => 24,
        'diamond1' => 25,
        'masters1' => 26,
    ];


	function __construct()
	{
		$cache = new IlluminateCache(app(Repository::class));
        $this->api = new API($this->devId, $this->authKey, 'http://api.paladins.com/paladinsapi.svc/');
        $this->api->preferredLanguage('es-419');
	}

	public function getData($data){
	    switch ($data){
            case 'used':
                $champs= $this->api->request('getdataused');
                break;
            case 'status':
                 $champs= $this->api->request('gethirezserverstatus');
                break;
            case 'top':
                $champs= $this->api->request('gettopmatches');
                break;
            default:
                $champs= $this->api->request('getdataused');
                break;
        }

        return response()->json(['data'=>$champs]);
    }

    public function getChamps(){
      $playerData= $this->api->request('getgods');
      return response()->json($playerData);
    }

    /**
     * Obtiene el rango de los campeones más jugador por X jugador
     * Parametro: nick
     **/

    public function getChampRanks($nick){
        $champs= $this->api->request('getchampionranks',$nick);
        return response()->json(['data'=>$champs]);
    }

    public function getFriends($nick){
        $champs= $this->api->request('getfriends',$nick);
        return response()->json(['data'=>$champs]);
    }

    public function getSessionData(){
        $champs= $this->api->request('getesportsproleaguedetails');
        return response()->json(['data'=>$champs]);
    }

    public function getChampions(){
        $champs= $this->api->request('getgods');
        return response()->json(['data'=>$champs]);
    }

    /*
        Obtiene el top mundial para un campeon de la seson actual
        Solo disponible para  queue 428 => 'competitivo'
    */
    public function getChampionLeaderboard($champ_id, $queue_temp){
        $leaders = $this->api->request('getchampionleaderboard', $champ_id, $this->queue[$queue_temp]);
        return response()->json(['data'=> $leaders]);
    }

    /*
        ETAPA DE RPUEBAS
        Obtiene las cards de un campeon
    */
    public function getChampionsCards($champ_id){
        try {
            $cards = $this->api->request('getchampioncards', $champ_id);
            return response()->json(['data'=> $cards]);
        } catch (\Throwable $th) {
            return $this->launchError('getchampioncards');
        }
    }

    /**
     * Obtiene todos los items del juego
    */

    public function getItems(){
        $champs= $this->api->request('getitems');
        return response()->json(['data'=>$champs]);
    }

    /**
     * Obtiene los datos de las partidas de un jugador
    */

    public function getMatches($nick){
        $champs= $this->api->request('getmatchhistory', $nick);
        return response()->json(['data'=>$champs]);
    }

    /**
     * Obtiene los datos de las partidas por un id
    */

    public function getMatchById($id){
        $champs= $this->api->request('getmatchdetails', $id);
        return response()->json(['data'=>$champs]);
    }

    /**
     * Obtiene las partidas pasadas por parametros
     * partida_id, partida_id, partida_id -> separadas por comas
    */

    public function getMatchBatch($matches){
        $champs= $this->api->request('getmatchdetailsbatch', $matches);
        return response()->json(['data'=>$champs]);
    }

    /**
     * Ver detalles de los jugadores que participaron en una partida
     * parametro: id de la partida
    */

    public function getMatchPlayerDetails($match_id){
        $champs= $this->api->request('getmatchdetailsbatch', $match_id);
        return response()->json(['data'=>$champs]);
    }

    /**
     * Ver el top por rango y season, solo provado en competitivo
    */

    public function getLeaderBoard($queue_temp, $rank, $season){
        $champs= $this->api->request('getleagueleaderboard', $this->queue[$queue_temp], $this->tierMap[$rank], $season);
        return response()->json(['data'=>$champs]);
    }

    /**
     * Ver season actuales
    */

    public function getLeagueSeasons($queue_temp){
        $champs= $this->api->request('getleagueseasons', $this->queue[$queue_temp]);
        return response()->json(['data'=>$champs]);
    }

    // Obsoleto

    public function getMotd(){
        $champs= $this->api->request('gettopmatches');
        return response()->json(['data'=>$champs]);
    }

    /**
     * Ver estadisticas de los campeones mas jugados, kills, wins
    */

    public function getPlayerStats($player, $queue_temp){
        $champs= $this->api->request('getqueuestats',$player,$this->queue[$queue_temp]);
        return response()->json(['data'=>$champs]);
    }

    public function getPlayer($nick){
        $champs= $this->api->request('getplayer', $nick);
        return response()->json(['data'=>$champs]);
    }

    public function getPlayerData($player_id){
        $champs= $this->api->request('getplayerachievements', $player_id);
        return response()->json(['data'=>$champs]);
    }

    public function getPlayerStatus($player){
        $champs= $this->api->request('getplayerstatus', $player);
        return response()->json(['data'=>$champs]);
    }

    public function getPlayerLoadOuts($player_id){
        $champs= $this->api->request('getplayerloadouts', $player_id, 1);
        return response()->json(['data'=>$champs]);
    }


    // STORE METHODS

    // obtiene todos los campeones sus datos y habilidades para guardar en la base de datos
    // Esta funcion no es parte de la api....

    public function index(){
      $playerData= $this->api->request('getgods');
      $i = 0;
      foreach ($playerData as $data) {
      if(!$this->existChampion($data->Name)){
          if($i<100){
            $champion = new Champion();
            $champion->id_hirex = $data->id;
            $champion->name = $data->Name;
            $champion->roles = $data->Roles;
            $champion->title = $data->Title;
            $champion->lore = $data->Lore;
            $champion->card_url = $data->ChampionCard_URL;
            $champion->icon_url = $this->downloadImage($data->ChampionIcon_URL, public_path('\img\champions'));
            $champion->coins = $data->Cons;
            $champion->health = $data->Health;
            $champion->speed = $data->Speed;
            $champion->on_free_rotation = $data->OnFreeRotation;
            $champion->pantheon = $data->Pantheon;
            $champion->pros = $data->Pros;
            $champion->type = $data->Type;
            $champion->lastest_champion = $data->latestChampion;
            $champion->ret_msg = $data->ret_msg;

            $champion->save();

            $a1 = new Ability();
            $a1->description = $data->abilityDescription1;
            $a1->sumary = $data->Ability_1->Summary;
            $a1->url = $this->downloadImage($data->ChampionAbility1_URL, public_path('\img\abilities'));

            $a2 = new Ability();
            $a2->description = $data->abilityDescription2;
            $a2->sumary = $data->Ability_2->Summary;
            $a2->url = $this->downloadImage($data->ChampionAbility2_URL, public_path('/img/abilities'));

            $a3 = new Ability();
            $a3->description = $data->abilityDescription3;
            $a3->sumary = $data->Ability_3->Summary;
            $a3->url = $this->downloadImage($data->ChampionAbility3_URL, public_path('/img/abilities'));

            $a4 = new Ability();
            $a4->description = $data->abilityDescription4;
            $a4->sumary = $data->Ability_4->Summary;
            $a4->url = $this->downloadImage($data->ChampionAbility4_URL, public_path('/img/abilities'));

            $champion->ability()->save($a1);
            $champion->ability()->save($a2);
            $champion->ability()->save($a3);
            $champion->ability()->save($a4);
          }
        }
        $i++;
      }
    }

    // Esta funcion es usada para guardar todos los items en la base de datos
    // no forma parte de la api
    public function loadItems(){
        $champs= $this->api->request('getitems');

        $ch = array_reverse($champs);
        $i = 0;
      foreach ($ch as $c => $row){
            echo "[$i]".$c->champion_id.'<br>';
            $i++;
          /*  if(!$this->existItem($c->ItemId)) {
              $item = new Item();
              $item->description = $c->Description;
              $item->device_name = $c->DeviceName;
              $item->icon_id = $c->IconId;
              $item->item_id = $c->ItemId;
              $item->price = $c->Price;
              $item->short_desc = $c->ShortDesc;
              if($c->champion_id !== 0) {
                  $item->champion_id = $c->champion_id;
              }else{
                  $item->champion_id = null;
              }
              $item->icon_url = $this->downloadImage($c->itemIcon_URL, public_path('\img\items'));
              $item->item_type = $c->item_type;
              $item->ret_msg = $c->ret_msg;
              $item->talent_reward_level = $c->talent_reward_level;

              $item->save();
          }*/
      }
        echo 'Successful';
    }


    // PRIVATE METHODS
    private function existChampion($name){
    	$c = Champion::where('name', $name)->get();
    	return (count($c)>0);
    }

    private function existItem($itemId){
        $i = Item::where('item_id', $itemId)->get();
        return (count($i)>0);
    }

    private function downloadImage($url, $path = false, $name = false){
    	if($url == "" || $url == null)
    		return "null";
    	if($name === false)
    		$name = basename($url);
    	if($path === false)
    		$path = '/img';
    	if(!file_exists($path.'/'.$name)){
    	    try {
                if (!Image::make($url)->save($path . '/' . $name)) {
                    return $url;
                }
            }catch (\Exception $e){
    	        return $url;
            }
    	}
    	return $name;
    }

    private function launchError($method){
        return response()->json(['data'=> "Esta función se encuentra en pruebas, o existe un error",
            'solución'=>"Revisa el siguiente link, el método '".$method."'",
            "link"=>'https://docs.google.com/document/d/1OFS-3ocSx-1Rvg4afAnEHlT3917MAK_6eJTR6rzr-BM/edit#']); 
    }
}
