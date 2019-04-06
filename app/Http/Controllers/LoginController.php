<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MD;
use DB;
use Session;

class LoginController extends Controller
{
    public function index(){
        return view('layout.login');
    }


    public function auth(Request $data){
        $this->validate($data,[
            'username'=>'required',
            'password'=>'required'
        ]);
        $username = $data->input('username');
        $username = MD::prevent($username);
        $password = $data->input('password');
        $password = MD::prevent($password);

        if($password!=''){
            $password = md5($password);
        }

        $user = DB::select("select * from user where username='$username' and password='$password' ");
        if(count($user)>0){
            $user = MD::row_array($user);
            $userole = DB::select("select * from user_permission where id_user_level='".$user['user_level']."' and code='1'");
            $userole = MD::result_array($userole);
            $arr = array();
            if(is_array($userole)){
                foreach($userole as $o){
                    array_push($arr,$o['name']);
                }
            }
            session(['xkzxnjjsjd'=>$user['id']]);
            session(['role'=>$arr]);
            return redirect('/user/profileku');
        }else{
            return redirect('/login')->with('error','Username atau Password Salah');
        }
    }

    public function logout(){
        Session::forget('xkzxnjjsjd');
        return redirect('/login'); 
    }
}
