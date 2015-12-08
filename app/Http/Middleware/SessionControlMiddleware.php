<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session as Session;

class SessionControlMiddleware {

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
			return $next($request);
		}else{
			return redirect()->Route('login');			
		}

	}

}
