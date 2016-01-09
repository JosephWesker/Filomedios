<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session as Session;

class SessionControlMiddleware
{    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
    	$permissions = array('vendedor' => array('/', 'perfil', 'gestor_de_ordenes_de_servicio', 'nueva_orden_de_servicio', 'clientes'), 'administrador' => array('/', 'perfil', 'gestor_de_ordenes_de_servicio', 'nueva_orden_de_servicio', 'empleados', 'tesoreria', 'facturas', 'clientes', 'lista', 'videos', 'produccion', 'agenda', 'gestor_de_archivos', 'configuracion', 'unidades_negocio', 'programas', 'productos', 'paquetes', 'usuarios'), 'producción' => array('/', 'perfil', 'gestor_de_ordenes_de_servicio', 'lista', 'videos', 'produccion', 'agenda', 'gestor_de_archivos'), 'tesoreria' => array('/', 'perfil', 'gestor_de_ordenes_de_servicio', 'nueva_orden_de_servicio', 'tesoreria', 'facturas', 'clientes'), 'gerente de ventas' => array('/', 'perfil', 'gestor_de_ordenes_de_servicio', 'nueva_orden_de_servicio', 'clientes'));
        $permissions['desarrollador'] = array('/', 'perfil', 'gestor_de_ordenes_de_servicio', 'nueva_orden_de_servicio', 'empleados', 'tesoreria', 'facturas', 'clientes', 'lista', 'videos', 'produccion', 'agenda', 'gestor_de_archivos', 'configuracion', 'unidades_negocio', 'programas', 'productos', 'paquetes', 'usuarios');
        $arr = explode("/", $request->path(), 2);
        $first = $arr[0];
       	if ($first == '') {
       		$first = '/';
       	}
        if (Session::has('logged')) {
            if (in_array($first, $permissions[Session::get('type')])) {
                return $next($request);
            } 
            else {
                return 'Acceso Prohibido';
            }
        } 
        else {
            return redirect()->Route('login');            
        }
    }
}
