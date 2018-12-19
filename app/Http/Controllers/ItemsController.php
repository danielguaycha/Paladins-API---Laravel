<?php

namespace App\Http\Controllers;

use App\Champion;
use App\Item;
use Illuminate\Http\Request;
use Image;
class ItemsController extends Controller
{
    public function update(Request $request){

        $item = Item::find($request->get('id'))->first();

        if(count($item)>0) {
            $item->description = $request->description;
            $item->device_name = $request->device_name;
            $item->item_type = $request->item_type;
            $item->short_desc = $request->short_desc;

            $upload_img = $this->_multipleUpload($request, 'img_item', 'img/items');
            if ($upload_img != null) {
                $item->icon_url = $upload_img;
            }
            $item->save();
            return response()->json(['request' => $request->get('id'), 'img' => $upload_img]);
        }else{
            return response()->json(['m'=>'no se encontro el item']);
        }
    }

    public function store(Request $request){

        if($this->exist($request->item_id)){
            return response()->json(['m'=>'Este item ya existe :'.$request->item_id, 'r'=>'bad']);
        }

        $item = new Item();
        $item->description = $request->description;
        $item->device_name = $request->device_name;
        $item->icon_id = $request->icon_id;
        $item->item_id = $request->item_id;
        $item->price = $request->price;
        $item->short_desc = $request->short_desc;
        $item->champion_id = $request->champion_id;
        $item->item_type = $request->item_type;
        $item->ret_msg = $request->ret_msg;
        $item->talent_reward_level = $request->trl;

        $item->icon_url = $this->downloadImage($request->icon_url, public_path('\img\items'));

        $item->save();

        return response()->json(['m'=>'Guardado con exito', 'r'=>'done']);
    }

    public function exist($item_id){
        $i = Item::where('item_id', $item_id)->first();
        return (count($i)>0);
    }

    public function getExist(){
        $e = Item::select('item_id')->orderBy('item_id', 'asc')->get();
        $c = Champion::select('id_hirex', 'name', 'icon_url')->orderBy('id_hirex','asc')->get();
        $m = array();
        foreach ($e as $es){
            array_push($m, $es["item_id"]);
        }
        return response()->json(["values"=>$m, "champs"=>$c]);
    }
    // private functions
    protected function _multipleUpload($request, $var, $path, $image_name = null)
    {
        $img = '';
        $files =$request->file($var);//$var es el nombre del  array de imagenes
        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        $filename=null;
        foreach ($files as $file) {
            $destinationPath =  public_path($path); // Segunda variable que especifica en donde se subira la img
            $filename = ($image_name == null)?
                ($uploadcount+1).time(): strtolower($image_name);
            $filename = $filename.'.'.$file->getClientOriginalExtension();
            $upload_success = $file->move($destinationPath, $filename);
            $img.=($uploadcount == 0)?$filename:';'.$filename;
            $uploadcount ++;
        }
        if($uploadcount == $file_count){
            return $filename;
        } else {
            return null;
        }
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


}
