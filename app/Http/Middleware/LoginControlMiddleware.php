<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session as Session;

class LoginControlMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{		
		if(Session::has('logged')){
			return redirect()->Route('home');			
		}else{
			return $next($request);	
		}

	}

}
