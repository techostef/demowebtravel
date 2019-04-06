<?php

namespace App\Http\Middleware;

use App\Http\controllers\MD;
use Closure;
use DB;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role=false)
    {
        $session = session('xkzxnjjsjd');
        if(isset($session)&&$session!==''){
            $id = session('xkzxnjjsjd');
            $user = DB::select("select * from user where id='$id'");
            if(count($user)>0){
                $user = MD::row_array($user);
                if($role==1){
                    return $next($request);
                }
                if($role!==false){
                    if($user['user_level']!=-1){
                        $arr = session('role');
                        if(!in_array($role,$arr)){
                            return redirect("/user/profileku")->with('error','Anda tidak punya akses');
                        }
                    }
                }else{
                    if($user['user_level']!=-1){
                        return redirect("/user/profileku")->with('error','Anda tidak punya akses');
                    }
                }
                
                return $next($request);
            }else{
                return redirect('/login');
            }
        }else{
            return redirect('/login');
        }
        // return $next($request);

    }
}
