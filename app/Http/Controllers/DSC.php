<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\MD;

class DSC extends Controller
{
    public static function getdata($id=false){
        if($id==false){
            $session = session('xkzxnjjsjd');
            if(isset($session)&&$session!==''){
                $user = DB::select("select * from user where id='$session'");
                if(count($user)>0){
                    return MD::row_array($user);
                }else{
                    return redirect('/logout');
                }
            }else{
                return redirect('/logout');
            }
        }else{
            $user = DB::select("select * from user where id='$id'");
            if(count($user)>0){
                return MD::row_array($user);
            }
        }
    }

    public static function getrole($id){
        return session('role');
    }
}
