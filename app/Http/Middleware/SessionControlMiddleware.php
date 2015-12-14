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
    	$permissions = array('vendedor' => array('/', 'gestor_de_ordenes_de_servicio', 'nueva_orden_de_servicio', 'clientes'), 'administrador' => array('/', 'gestor_de_ordenes_de_servicio', 'nueva_orden_de_servicio', 'empleados', 'tesoreria', 'facturas', 'clientes', 'lista', 'videos', 'produccion', 'agenda', 'gestor_de_archivos', 'configuracion', 'unidades_negocio', 'programas', 'productos', 'paquetes', 'usuarios'), 'producción' => array('/', 'gestor_de_ordenes_de_servicio', 'lista', 'videos', 'produccion', 'agenda', 'gestor_de_archivos'), 'tesoreria' => array('/', 'gestor_de_ordenes_de_servicio', 'nueva_orden_de_servicio', 'tesoreria', 'facturas', 'clientes'), 'gerente de ventas' => array('/', 'gestor_de_ordenes_de_servicio', 'nueva_orden_de_servicio', 'clientes'));
        $arr = explode("/", $request->path(), 2);
        $first = $arr[0];
       	if ($first == '') {
       		$first = '/';
       	}
        if (in_array($first, $permissions[Session::get('type') ])) {
            if (Session::has('logged')) {
                return $next($request);
            } 
            else {
                return redirect()->Route('login');
            }
        } 
        else {
            return 'Acceso Prohibido';
        }
    }
}
