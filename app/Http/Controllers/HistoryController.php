<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MD;
use DB;
use Session;
use App\Http\Controllers\Secure\Secure;

class HistoryController extends Controller
{
    public function index(){
        $table = empty($_GET['a'])?"":urldecode($_GET['a']);
        $where = empty($_GET['b'])?"":urldecode($_GET['b']);
        if(Secure::decode($table)==null){
            return redirect('/home');
        }
        if(Secure::decode($where)==null){
            return redirect('/home');
        }
        $table = Secure::decode($table);
        $where = Secure::decode($where);
        $history = MD::gethistory($table,$where);
        echo json_encode($history);
    }

}
