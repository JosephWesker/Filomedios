<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_package;
use App\fil_product;
use App\fil_package_detail;

class packageController extends Controller
{
    public function postCreate() {
        $values = Request::all();
        if ($values['pac_name'] == '' || $values['pac_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo nombre requerido'));
        }
        if ($values['pac_description'] == '' || $values['pac_description'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo descripción requerido'));
        }
        fil_package::create($values);
        $response = Response::json(array('success' => true, 'data' => 'Paquete guardado con exito'));
        return $response;
    }
    
    public function postRead() {
        $values = Request::all();
        $data = fil_package::select(['pac_name', 'pac_description'])->find($values['id']);
        $response = null;
        if ($data == null) {
            $response = Response::json(array('success' => false, 'data' => 'Error al leer el Paquete'));
        } 
        else {
            $response = Response::json(array('success' => true, 'data' => $data));
        }
        return $response;
    }
    
    public function postUpdate() {
        $values = Request::all();
        if ($values['pac_name'] == '' || $values['pac_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo nombre requerido'));
        }
        if ($values['pac_description'] == '' || $values['pac_description'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo descripción requerido'));
        }
        $data = fil_package::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el Paquete a actualizar'));
        }
        $data->pac_name = $values['pac_name'];
        $data->pac_description = $values['pac_description'];
        $response = null;
        if ($data->save()) {
            $response = Response::json(array('success' => true, 'data' => 'Paquete actualizado con exito'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al guardar el Paquete'));
        }
        return $response;
    }
    
    public function postDelete() {
        $values = Request::all();
        $data = fil_package::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el Paquete a eliminar'));
        }
        $response = null;
        if ($data->delete()) {
            $response = Response::json(array('success' => true, 'data' => 'Paquete eliminado exitosamente'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al eliminar el Paquete'));
        }
        return $response;
    }
    
    public function postReadAll() {
        $data = fil_package::all();
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer información de los paquetes'));
        }
        $response = Response::json(array('success' => true, 'data' => $data));
        return $response;
    }
    
    public function showDetail($id) {
        $finalArray = [];
        $details = fil_package::find($id)->packagesDetail;
        foreach ($details as $detail) {
            $product = $detail->product;
            $tempRow['pad_id'] = $detail->pad_id;
            $tempRow['pro_name'] = $product->pro_name;
            if ($product->pro_type == 'transmisión') {
                $tempRow['pro_outlay'] = $product->serviceProyection->spy_outlay;
                $tempRow['pad_subtotal'] = (float)$detail->pad_final_price * (float)$detail->pad_validity * (float)$detail->pad_impacts;
                $tempRow['pad_impacts'] = $detail->pad_impacts;
                $tempRow['pad_validity'] = $detail->pad_validity . ' Días';
            } 
            else {
                $tempRow['pro_outlay'] = $product->serviceProduction->spr_outlay;
                $tempRow['pad_subtotal'] = (float)$detail->pad_final_price;
                $tempRow['pad_impacts'] = 'No Aplica';
                $tempRow['pad_validity'] = 'No Aplica';
            }            
            $tempRow['pad_discount'] = $detail->pad_discount . ' %';
            $tempRow['pad_finalPrice'] = $detail->pad_final_price;
            //if (($product->serviceProyection->spy_proyection_media == 'televisión') and ($product->serviceProyection->spy_has_show == "0")) {
            //    $tempRow['pad_subtotal'] = (float)$tempRow['pad_finalPrice'] * (float)$detail->pad_validity * (float)$detail->pad_impacts * 10;
            //    $tempRow['pad_impacts'] = (int)$detail->pad_impacts * 10;
            //} 
            //else {                
            //}
            
            $finalArray[] = $tempRow;
        }
        $data['total_outlay'] = fil_package::find($id)->pac_outlay;
        $data['package'] = fil_package::find($id);
        $data['details'] = $finalArray;
        return view('detalle_paquetes', $data);
    }
    
    public function postCreateDetail() {
        $values = Request::all();
        if ($values['pad_fk_package'] == '' || $values['pad_fk_package'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo paquete requerido'));
        }
        if ($values['pad_fk_product'] == '' || $values['pad_fk_product'] == null || $values['pad_fk_product'] == 'null') {
            return Response::json(array('success' => false, 'data' => 'Campo producto requerido'));
        }
        if(fil_product::find($values['pad_fk_product'])->pro_type == 'transmisión'){
            if ($values['pad_impacts'] == '' || $values['pad_impacts'] == null) {
                return Response::json(array('success' => false, 'data' => 'Campo impactos requerido'));
            }
            if ($values['pad_validity'] == '' || $values['pad_validity'] == null) {
                return Response::json(array('success' => false, 'data' => 'Campo vigencia requerido'));
            }   
        }        
        if ($values['pad_discount'] == '' || $values['pad_discount'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo descuento requerido'));
        }
        if ($values['pad_final_price'] == '' || $values['pad_final_price'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo precio final requerido'));
        }
        fil_package_detail::create($values);
        $response = Response::json(array('success' => true, 'data' => 'Producto guardado con exito'));
        return $response;
    }
    
    public function postReadDetail() {
        $values = Request::all();
        $dataDetail = fil_package_detail::find($values['id']);
        if ($dataDetail == null) {
            return Response::json(array('success' => false, 'data' => 'Detalle de paquete no encontrado'));
        }
        $dataProduct = $dataDetail->product;
        $price = '';
        if ($dataProduct->pro_type == 'transmisión') {
            $price = $dataProduct->serviceProyection->spy_outlay;
        } 
        else {
            $price = $dataProduct->serviceProduction->spr_outlay;
        }
        $finalData = array('pro_id' => $dataProduct->pro_id, 'pro_outlay' => $price, 'pad_impacts' => $dataDetail->pad_impacts, 'pad_validity' => $dataDetail->pad_validity, 'pad_discount' => $dataDetail->pad_discount, 'pad_final_price' => $dataDetail->pad_final_price, 'type' => $dataProduct->pro_type);
        $response = Response::json(array('success' => true, 'data' => $finalData));
        return $response;
    }
    
    public function postUpdateDetail() {
        $values = Request::all();
        if ($values['pad_impacts'] == '' || $values['pad_impacts'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo impactos requerido'));
        }
        if ($values['pad_validity'] == '' || $values['pad_validity'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo vigencia requerido'));
        }
        if ($values['pad_discount'] == '' || $values['pad_discount'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo descuento requerido'));
        }
        if ($values['pad_final_price'] == '' || $values['pad_final_price'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo precio final requerido'));
        }
        $data = fil_package_detail::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Producto no encontrado'));
        }
        $data->pad_impacts = $values['pad_impacts'];
        $data->pad_validity = $values['pad_validity'];
        $data->pad_discount = $values['pad_discount'];
        $data->pad_final_price = $values['pad_final_price'];
        $response = null;
        if ($data->save()) {
            $response = Response::json(array('success' => true, 'data' => 'Producto actualizado con exito'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al guardar el producto'));
        }
        
        return $response;
    }
    
    public function postDeleteDetail() {
        $values = Request::all();
        $data = fil_package_detail::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Producto no encontrado'));
        }
        $response = null;
        if ($data->delete()) {
            $response = Response::json(array('success' => true, 'data' => 'Producto eliminado exitosamente'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al eliminar el producto'));
        }
        return $response;
    }
    
    public function postReadAllDetail() {
        $values = Request::all();
        $finalArray = [];
        $total_outlay = 0;
        $details = fil_package::find($values['pad_fk_package'])->packagesDetail;
        foreach ($details as $detail) {
            $product = $detail->product;
            $tempRow['pad_id'] = $detail->pad_id;
            $tempRow['pro_name'] = $product->pro_name;
            if ($product->pro_type == 'transmisión') {
                $tempRow['pro_outlay'] = $product->serviceProyection->spy_outlay;
                $tempRow['pad_subtotal'] = (float)$detail->pad_final_price * (float)$detail->pad_validity * (float)$detail->pad_impacts;
                $tempRow['pad_impacts'] = $detail->pad_impacts;
                $tempRow['pad_validity'] = $detail->pad_validity . ' Días';
            } 
            else {
                $tempRow['pro_outlay'] = $product->serviceProduction->spr_outlay;
                $tempRow['pad_subtotal'] = (float)$detail->pad_final_price;
                $tempRow['pad_impacts'] = 'No Aplica';
                $tempRow['pad_validity'] = 'No Aplica';
            }            
            $tempRow['pad_discount'] = $detail->pad_discount . ' %';
            $tempRow['pad_finalPrice'] = $detail->pad_final_price;
            //if (($product->serviceProyection->spy_proyection_media == 'televisión') and ($product->serviceProyection->spy_has_show == "0")) {
            //    $tempRow['pad_subtotal'] = (float)$tempRow['pad_finalPrice'] * (float)$detail->pad_validity * (float)$detail->pad_impacts * 10;
            //    $tempRow['pad_impacts'] = (int)$detail->pad_impacts * 10;
            //} 
            //else {
                
            //}
            $total_outlay+= (float)$tempRow['pad_subtotal'];
            $finalArray[] = $tempRow;
        }
        $package = fil_package::find($values['pad_fk_package']);
        $package->pac_outlay = $total_outlay;
        $package->save();
        $response = Response::json(array('success' => true, 'data' => $finalArray, 'total_outlay' => $total_outlay));
        return $response;
    }
    
    public function postLoadProducts() {
        $data = fil_product::where('pro_status', 'like', 'activo')->select('pro_id', 'pro_name')->get();
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los productos'));
        }
        $response = Response::json(array('success' => true, 'data' => $data));
        return $response;
    }
    
    public function postLoadPriceProduct() {
        $values = Request::all();
        $product = fil_product::find($values['pro_id']);
        if ($product == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los productos'));
        }
        $data = null;
        if ($product->pro_type == 'transmisión') {
            $data = $product->serviceProyection->spy_outlay;
        } 
        else {
            $data = $product->serviceProduction->spr_outlay;
        }
        $response = Response::json(array('success' => true, 'data' => $data, 'type' => $product->pro_type));
        return $response;
    }
    
    public function postReadPrice(){
        $values = Request::all();
        $package = fil_package::find($values['id']);
        return Response::json(array('success' => true, 'data' => $package->pac_outlay));
    }
    
    //Update the price based on the number of products in the package, isn't exact
    /*public function postUpdatePrice(){
        $values = Request::all();
        $package = fil_package::find($values['pac_id']);
        $count = count($package->packagesDetail);
        $outlayPerDetail = ((float) $values['pac_outlay']) / $count;
        $totalOutlay = 0;
        foreach ($package->packagesDetail as $detail) {
            if($detail->product->pro_type == 'transmisión'){
                $newPrice = round($outlayPerDetail / (((float) $detail->pad_impacts) * ((float) $detail->pad_validity)),2);
                $percent = ($newPrice * 100) / ((float) $detail->product->serviceProyection->spy_outlay);
                $detail->pad_final_price = $newPrice;
                if($percent>100){
                    $detail->pad_discount = $percent;
                }else{
                    $detail->pad_discount = (100 - $percent);
                }
                $detail->save();
                $totalOutlay += (((float) $detail->pad_impacts) * ((float) $detail->pad_validity) * ((float) $detail->pad_final_price));
            }else{
                $percent = ($outlayPerDetail * 100) / ((float) $detail->product->serviceProduction->spr_outlay);
                $detail->pad_final_price = $outlayPerDetail;
                if($percent>100){
                    $detail->pad_discount = $percent;
                }else{
                    $detail->pad_discount = (100 - $percent);
                }
                $detail->save();
                $totalOutlay += $outlayPerDetail;                
            }
        }
        $package->pac_outlay = $totalOutlay;
        $package->save();
        return Response::json(array('success' => true, 'data' => 'Paquete guardado correctamente'));
    }*/
    
    //To set the first element with the new price and set the rest in 0, isn't exact
    public function postUpdatePrice(){
        $values = Request::all();
        $package = fil_package::find($values['pac_id']);        
        $count = count($package->packagesDetail);
        if($package->packagesDetail[0]->product->pro_type == "transmisión"){
            $newPrice = round(((float) $values['pac_outlay']) / (((float) $package->packagesDetail[0]->pad_impacts) * ((float) $package->packagesDetail[0]->pad_validity)),2);
            $percent = ($newPrice * 100) / ((float) $package->packagesDetail[0]->product->serviceProyection->spy_outlay);
            $package->packagesDetail[0]->pad_final_price = $newPrice;
            if($percent>100){
                $package->packagesDetail[0]->pad_discount = $percent;
            }else{
                $package->packagesDetail[0]->pad_discount = (100 - $percent);
            }
            $package->packagesDetail[0]->save();
            $package->pac_outlay = (((float) $package->packagesDetail[0]->pad_impacts) * ((float) $package->packagesDetail[0]->pad_validity) * ((float) $package->packagesDetail[0]->pad_final_price)); 
        }else{
            $package->packagesDetail[0]->pad_final_price = $values['pac_outlay'];
            $percent = (((float) $values['pac_outlay']) * 100) / ((float) $package->packagesDetail[0]->product->serviceProduction->spr_outlay);
            if($percent>100){
                $package->packagesDetail[0]->pad_discount = $percent;
            }else{
                $package->packagesDetail[0]->pad_discount = (100 - $percent);
            }
            $package->packagesDetail[0]->save();
            $package->pac_outlay = $values['pac_outlay'];
        }
        for ($i=1; $i <= $count-1; $i++) { 
            $package->packagesDetail[$i]->pad_discount = 100;
            $package->packagesDetail[$i]->pad_final_price = 0;
            $package->packagesDetail[$i]->save();
            
        }
        $package->save();
        return Response::json(array('success' => true, 'data' => 'Paquete guardado correctamente'));
    }
}
