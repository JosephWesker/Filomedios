<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controller;
use App\fil_videos;
use App\Helpers\VideoStream;

class videoController extends Controller
{
    public function postUploadVideo(){
        $detailId = Input::get('det_id');
        $order = Input::get('service_order');
        $name = Input::get('vid_name');
        $file = Input::file('file');
        $type = Input::get('vid_type');
        $show = Input::get('vid_show');
        $startDate = Input::get('vid_start_date');
        $endDate = Input::get('vid_end_date');
        if($order == null || $order == 'null'){
            if($startDate == null || $startDate == 'null'){
                return Response::json(array('success' => false, 'data' => 'No ha elegido una fecha de inicio'));
            }
            if($endDate == null || $endDate == 'null'){
                return Response::json(array('success' => false, 'data' => 'No ha elegido una fecha de termino'));
            }
            if($type == 'programación'){
                if($show == null || $show == 'null'){
                    return Response::json(array('success' => false, 'data' => 'No ha elegido un programa'));
                }
            }
        }else{
            if ($detailId == null || $detailId == 'null') {
                return Response::json(array('success' => false, 'data' => 'No ha elegido un producto para asociar'));
            }  
        }        
        if ($file == null || $file == 'null') {
            return Response::json(array('success' => false, 'data' => 'No ha seleccionado un video'));
        }
        $finalName = $file->getClientOriginalName();
        if($name != ''){
            $finalName = $name.'.mp4';
        }
        
        $path = 'videos/';
        if(Storage::exists($path.$finalName)){
            return Response::json(array('success' => false, 'data' => 'El nombre ya esta en uso por otro video, utilize otro'));
        }
        Storage::put($this->normaliza($path.$finalName), File::get($file));
        $row = new fil_videos;
        $row->vid_detail_product = $detailId;
        $row->vid_name = $this->normaliza($finalName);
        $row->vid_type = $type;
        $getID3 = new \getID3;
        $analizedFile = $getID3->analyze($file);
        $row->vid_duration = $analizedFile['playtime_string'];
        $row->vid_url = Storage_path().'/app/'.$this->normaliza($path.$finalName);
        if($order == null || $order == 'null'){
            $row->vid_detail_product = null;
            $row->vid_start_date = $startDate;
            $row->vid_end_date = $endDate;
            $row->vid_show = $show;
        }else{
            $row->vid_start_date = $row->detailProduct->serviceOrder->ser_start_date;
            $row->vid_end_date = $row->detailProduct->serviceOrder->ser_end_date;
            $row->vid_show = $row->detailProduct->show->sho_id;
        }
        $row->save();
        return Response::json(array('success' => true, 'data' => 'Video Registrado'));
    }
    
    public function postReadAll(){
        $array = fil_videos::all();
        $finalArray = [];
        foreach ($array as $video) {
            $row = [];
            $row['id'] = $video->vid_id;
            $row['name'] = $video->vid_name;
            $row['type'] = $video->vid_type;            
            if($video->detailProduct == null){
                $row['service_order'] = 'Varias';
                $row['detail'] ='<b>Producto</b>: Varios<br><b>Duración:</b> '.$video->vid_duration.'<br><b>Fecha de Inicio:</b> '.$video->vid_start_date.'<br><b>Fecha de Termino:</b> '.$video->vid_end_date;
            }else{
                $row['service_order'] = $video->detailProduct->serviceOrder->ser_id;
                $row['detail'] ='<b>Producto</b>: '.$video->detailProduct->product->pro_name.'<br><b>Duración:</b> '.$video->vid_duration.'<br><b>Fecha de Inicio:</b> '.$video->vid_start_date.'<br><b>Fecha de Termino:</b> '.$video->vid_end_date;
            }
            $finalArray[] = $row;
        }
        return Response::json(array('success' => true, 'data' => $finalArray));
    }
    
    function normaliza($cadena) {
        $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $cadena = utf8_decode($cadena);
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        $cadena = strtolower($cadena);
        return utf8_encode($cadena);
    }
    
    public function postDelete(){
        $values = Request::all();
        $row = fil_videos::find($values['id']);
        Storage::delete('/videos/'.$row->vid_name);
        $row->delete();
        return Response::json(array('success' => true, 'data' => 'Video eliminado'));
    }
    
    public function getVideoStreaming($name){
        $path = Storage_path().'/app/'.'/videos/'.$name;
        $stream = new VideoStream($path);
        $stream->start(); 
    }
}
