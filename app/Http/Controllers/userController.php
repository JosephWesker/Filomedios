<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use App\fm_user;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;

class userController extends Controller
{
    public function postShowUsers(){
        $query = fm_user::select('use_id','use_username')->get();                                     
        return Response::json($query);
    }    

    public function postCreateUsers(){
        $values = Request::all();
       
 //BEGIN EMAIL
$rule_email=array(
 'use_username'=>'required|email|min:5|Regex:/^[A-Za-z0-9\-! ,"\/@\.:\(\)]+$/',
    );
       $vemail=Validator::make($values,$rule_email);
 if ($vemail->fails())
        {
                  
            return 'Dirección de correo no válida';
        }
      //END EMAIL

         //BEGIN PASSWORD
$rule_pass=array(
 'use_password'=>'Required|min:8',
  'repetir_use_password'=>'Required|min:8',
    );
       $vpass=Validator::make($values,$rule_pass);
 if ($vpass->fails())
        {
                  
            return 'Mínimo 8 caracteres para la contraseña';
        }
      //END PASSWORD
   


        $email = fm_user::where('use_username','like', $values['use_username'])->count();
        if($email>0){
            return 'Este correo ya esta registrado, por favor utilize uno diferente';
        }else {
            if($values['use_password']==$values['repetir_use_password']){
                $password_encrypted = Hash::make($values['use_password']);
                $fm_user = new fm_user;                    
                $fm_user->use_username = $values['use_username'];
                $fm_user->use_password = $password_encrypted;
                $fm_user->save();
                return 'Usuario registrado, su ID de empleado es ' . $fm_user->use_id;
            }else{
                return 'Las contraseñas no coinciden';
            }
        }
    }
        
    public function postDelateUsers(){
        $id = Request::input('id');
        $fm_user = fm_user::find($id);
        $fm_user->delete();
        return 'Usuario eliminado';
    }

    public function postUpdateUsers(){
        $values = Request::all();
      //END PASSWORDCHANGE
        $rule_passchange=array(
 'ant_u_use_password'=>'Required|min:8',
  'new_u_use_password'=>'Required|min:8',
    'rep_u_use_password'=>'Required|min:8',
    );
       $vpassc=Validator::make($values,$rule_passchange);
 if ($vpassc->fails())
        {
                  
            return 'Mínimo 8 caracteres para la contraseña';
        }
      //END PASSWORDCHANGE
        $password = fm_user::find($values['use_id'])->use_password;        
        if(Hash::check($values['ant_u_use_password'], $password)){
           if($values['new_u_use_password']==$values['rep_u_use_password']){
                $fm_user = fm_user::find($values['use_id']);
                $fm_user->use_password = Hash::make($values['new_u_use_password']);
                $fm_user->save();
                return 'Contraseña actualizada';
           }else{
               return 'La nueva contraseña NO coincide';
           } 
        }else{
            return 'La contraseña es incorrecta';
        }        
    }

}
