<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_product;
use App\fil_service_production;
use App\fil_service_proyection;

class productController extends Controller
{
    public function postCreate() {
        
        $values = Request::all();
        if ($values['pro_name'] == '' || $values['pro_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo nombre requerido'));
        }
        if ($values['pro_description'] == '' || $values['pro_description'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo descripción requerido'));
        }
        if ($values['pro_type'] == '' || $values['pro_type'] == null || $values['pro_type'] == 'null') {
            return Response::json(array('success' => false, 'data' => 'Campo tipo requerido'));
        }
        if ($values['pro_type'] == 'transmisión') {
            if ($values['spy_proyection_media'] == '' || $values['spy_proyection_media'] == null || $values['spy_proyection_media'] == 'null') {
                return Response::json(array('success' => false, 'data' => 'Campo tipo de transmisión requerido'));
            }
            if ($values['spy_outlay'] == '' || $values['spy_outlay'] == null) {
                return Response::json(array('success' => false, 'data' => 'Campo inversión requerido'));
            }
            if ($values['spy_has_duration'] == 'true') {
                if ($values['spy_duration'] == '' || $values['spy_duration'] == null) {
                    return Response::json(array('success' => false, 'data' => 'Campo duración requerido'));
                }
            }
        } 
        else {
            if ($values['spr_outlay'] == '' || $values['spr_outlay'] == null) {
                return Response::json(array('success' => false, 'data' => 'Campo dirección requerido'));
            }
        }
        $product = new fil_product;
        $product->pro_name = $values['pro_name'];
        $product->pro_description = $values['pro_description'];
        $product->pro_type = $values['pro_type'];
        $product->pro_status = 'activo';
        if (!$product->save()) {
            return Response::json(array('success' => false, 'data' => 'Error al guardar el producto'));
        }
        if ($product->pro_type == 'transmisión') {
            $fil_service = new fil_service_proyection;
            $fil_service->spy_id = $product->pro_id;
            $fil_service->spy_proyection_media = $values['spy_proyection_media'];
            $fil_service->spy_has_show = $this->convertToTinyint($values['spy_has_show']);
            if ($values['spy_has_duration'] == 'true') {
                $fil_service->spy_duration = $values['spy_duration'];
            } 
            else {
                $fil_service->spy_duration = NULL;
            }
            $fil_service->spy_outlay = $values['spy_outlay'];
            if (!$fil_service->save()) {
                return Response::json(array('success' => false, 'data' => 'Error al guardar el producto'));
            }
        } 
        else {
            $fil_service = new fil_service_production;
            $fil_service->spr_id = $product->pro_id;
            $fil_service->spr_has_production_registry = $this->convertToTinyint($values['spr_has_production_registry']);
            $fil_service->spr_outlay = $values['spr_outlay'];
            if (!$fil_service->save()) {
                return Response::json(array('success' => false, 'data' => 'Error al guardar el producto'));
            }
        }
        $response = Response::json(array('success' => true, 'data' => 'Producto guardado con exito'));
        return $response;
    }
    
    public function postRead() {
        $values = Request::all();
        $data = fil_product::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los datos del producto'));
        }
        if ($data->pro_type == 'transmisión') {
            $data->serviceProyection;
        } 
        else {
            $data->serviceProduction;
        }
        $response = Response::json(array('success' => true, 'data' => $data));
        return $response;
    }
    
    public function postUpdate() {
        $values = Request::all();
        if ($values['pro_name'] == '' || $values['pro_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo nombre requerido'));
        }
        if ($values['pro_description'] == '' || $values['pro_description'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo descripción requerido'));
        }
        if ($values['pro_type'] == '' || $values['pro_type'] == null || $values['pro_type'] == 'null') {
            return Response::json(array('success' => false, 'data' => 'Campo tipo requerido'));
        }
        if ($values['pro_type'] == 'transmisión') {
            if ($values['spy_proyection_media'] == '' || $values['spy_proyection_media'] == null || $values['spy_proyection_media'] == 'null') {
                return Response::json(array('success' => false, 'data' => 'Campo tipo de transmisión requerido'));
            }
            if ($values['spy_outlay'] == '' || $values['spy_outlay'] == null) {
                return Response::json(array('success' => false, 'data' => 'Campo inversión requerido'));
            }
            if ($values['spy_has_duration'] == 'true') {
                if ($values['spy_duration'] == '' || $values['spy_duration'] == null) {
                    return Response::json(array('success' => false, 'data' => 'Campo duración requerido'));
                }
            }
        } 
        else {
            if ($values['spr_outlay'] == '' || $values['spr_outlay'] == null) {
                return Response::json(array('success' => false, 'data' => 'Campo dirección requerido'));
            }
        }
        $product = fil_product::find($values['id']);
        $product->pro_name = $values['pro_name'];
        $product->pro_description = $values['pro_description'];
        $product->pro_type = $values['pro_type'];
        if (!$product->save()) {
            return Response::json(array('success' => false, 'data' => 'Error al guardar el producto'));
        }
        if ($product->pro_type == 'transmisión') {
            $fil_service = $product->serviceProyection;
            $fil_service->spy_proyection_media = $values['spy_proyection_media'];
            $fil_service->spy_has_show = $this->convertToTinyint($values['spy_has_show']);
            if ($values['spy_has_duration'] == 'true') {
                $fil_service->spy_duration = $values['spy_duration'];
            } 
            else {
                $fil_service->spy_duration = NULL;
            }
            $updatePackages = false;
            if ($fil_service->spy_outlay != $values['spy_outlay']) {
                $updatePackages = true;
            }
            
            $fil_service->spy_outlay = $values['spy_outlay'];
            if (!$fil_service->save()) {
                return Response::json(array('success' => false, 'data' => 'Error al guardar el producto'));
            }
            
            if ($updatePackages) {
                foreach ($product->packagesDetail as $detail) {
                    if (((float)$detail->pad_discount) <= 100) {
                        $detail->pad_final_price = (float)$values['spy_outlay'] - ((((float)$detail->pad_discount) / 100) * ((float)$values['spy_outlay']));
                    } 
                    else {
                        $detail->pad_final_price = ((float)$values['spy_outlay']) + ((float)$values['spy_outlay'] * (((float)$detail->pad_discount) - 100) / 100);
                    }
                    $detail->save();
                    $this->updatePackage($detail->package);
                }
            }
        } 
        else {
            $fil_service = $product->serviceProduction;
            $fil_service->spr_has_production_registry = $this->convertToTinyint($values['spr_has_production_registry']);
            $fil_service->spr_outlay = $values['spr_outlay'];
            if (!$fil_service->save()) {
                return Response::json(array('success' => false, 'data' => 'Error al guardar el producto'));
            }
        }
        $response = Response::json(array('success' => true, 'data' => 'Producto actualizado con exito'));
        return $response;
    }
    
    public function updatePackage($package) {
        $total_outlay = 0;
        foreach ($package->packagesDetail as $detail) {
            $pad_subtotal = 0;
            //if (($detail->product->serviceProyection->spy_proyection_media == 'televisión') and ($detail->product->serviceProyection->spy_has_show == "0")) {
            //    $pad_subtotal = (float)$detail->pad_final_price * (float)$detail->pad_validity * (float)$detail->pad_impacts * 10;
            //} 
            //else {
                $pad_subtotal = (float)$detail->pad_final_price * (float)$detail->pad_validity * (float)$detail->pad_impacts;
            //}
            $total_outlay+= $pad_subtotal;
        }
        $package->pac_outlay = $total_outlay;
        $package->save();
    }
    
    public function postDelete() {
        $values = Request::all();
        $data = fil_product::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Producto a eliminar no encontrado'));
        }
        $data->pro_status = 'eliminado';
        if (!$data->save()) {
            return Response::json(array('success' => false, 'data' => 'Error al eliminar el producto'));
        }
        foreach ($data->packagesDetail as $detail) {
            $package = $detail->package;
            $detail->delete();
            $this->updatePackage($package);
        }
        $response = Response::json(array('success' => true, 'data' => 'Producto eliminado exitosamente'));
        return $response;
    }
    
    public function postActivate() {
        $values = Request::all();
        $data = fil_product::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Producto a restaurar no encontrado'));
        }
        $data->pro_status = 'activo';
        if (!$data->save()) {
            return Response::json(array('success' => false, 'data' => 'Error al restaurar el producto'));
        }
        $response = Response::json(array('success' => true, 'data' => 'Producto restaurado exitosamente'));
        return $response;
    }

    public function postReadAll() {
        $data = fil_product::where('pro_status', 'like', 'activo')->get();
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer información de los productos'));
        }
        $finalArray = [];
        foreach ($data as $row) {
            $tempRow['pro_id'] = $row->pro_id;
            $tempRow['pro_name'] = $row->pro_name;
            $tempRow['pro_description'] = $row->pro_description;
            $tempRow['pro_type'] = $row->pro_type;
            $tempRow['pro_status'] = $row->pro_status;
            if ($row->pro_type == 'transmisión') {
                $temp = $row->serviceProyection;
                $tempRow['pro_details'] = 'Medio de transmisión: ' . $temp->spy_proyection_media . '<br>Requiere Programa: ' . $this->convertToYesNo($temp->spy_has_show) . '<br>Duración: ' . $this->checkDuration($temp->spy_duration);
                $tempRow['pro_outlay'] = $temp->spy_outlay;
            } 
            else {
                $temp = $row->serviceProduction;
                $tempRow['pro_details'] = 'Requiere registro de producción: ' . $this->convertToYesNo($temp->spr_has_production_registry);
                $tempRow['pro_outlay'] = $temp->spr_outlay;                
            }
            $finalArray[] = $tempRow;
        }
        $response = Response::json(array('success' => true, 'data' => $finalArray));
        return $response;
    }

    public function postReadAllDelete() {
        $data = fil_product::where('pro_status', 'like', 'eliminado')->get();
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer información de los productos'));
        }
        $finalArray = [];
        foreach ($data as $row) {
            $tempRow['pro_id'] = $row->pro_id;
            $tempRow['pro_name'] = $row->pro_name;
            $tempRow['pro_description'] = $row->pro_description;
            $tempRow['pro_type'] = $row->pro_type;
            $tempRow['pro_status'] = $row->pro_status;
            if ($row->pro_type == 'transmisión') {
                $temp = $row->serviceProyection;
                $tempRow['pro_details'] = 'Medio de transmisión: ' . $temp->spy_proyection_media . '<br>Requiere Programa: ' . $this->convertToYesNo($temp->spy_has_show) . '<br>Duración: ' . $this->checkDuration($temp->spy_duration);
                $tempRow['pro_outlay'] = $temp->spy_outlay;
            } 
            else {
                $temp = $row->serviceProduction;
                $tempRow['pro_details'] = 'Requiere registro de producción: ' . $this->convertToYesNo($temp->spr_has_production_registry);
                $tempRow['pro_outlay'] = $temp->spr_outlay;
            }
            $finalArray[] = $tempRow;
        }
        $response = Response::json(array('success' => true, 'data' => $finalArray));
        return $response;
    }
    
    function convertToTinyint($value) {
        if ($value == 'true') {
            return 1;
        } 
        else {
            return 0;
        }
    }
    
    function convertToYesNo($value) {
        if ($value == '1') {
            return 'Si';
        } 
        else {
            return 'No';
        }
    }
    
    function checkDuration($value) {
        if ($value == 0) {
            return 'No tiene';
        } 
        else {
            return $value;
        }
    }
}
