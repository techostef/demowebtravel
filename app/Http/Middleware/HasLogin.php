<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class HasLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $session = session('xkzxnjjsjd');
        if(isset($session)&&$session!==''){
            $id_users = session('xkzxnjjsjd');
            $user = DB::select("select * from user where id='$id_users'");
            if(count($user)>0){
                return redirect('/user/profileku');
            }
        }
        return $next($request);
    }
}
