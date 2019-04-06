<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DSC;
use App\Http\Controllers\MD;
use DB;

class DashboardController extends Controller
{
    public function index(){
        $user = DSC::getdata();
        $data = array(
            'user'=>$user
        );
        // set tanggan bungan untuk tabungan
        $d = 28;
        $day = date("Y-m-d");
        // MD::updatedenda($day);
        $result = DB::select("select * from tabungan_status order by id desc limit 1");
        $result = MD::row_array($result);
        $range = MD::dateRange($result['create_at'],$day," +1 month");
        if($range>=0){
            if($result['status']==0){
                $m = date("m",strtotime($result['create_at']));
                $y = date("Y",strtotime($result['create_at']));
                MD::updatebunga($m,$y);
                if($m==12){
                    $arr = array(
                        'create_at'=>($y+1)."-".(1)."-".$d,
                        'status'=>0,
                    );
                }else{
                    $arr = array(
                        'create_at'=>$y."-".($m+1)."-".$d,
                        'status'=>0,
                    );
                }
                $id = DB::table('tabungan_status')->insertGetId($arr);
                $ID = $result['id'];
                $arr = ['status'=>1];
                DB::table("tabungan_status")->where("id",$ID)->update($arr);
            }
        }
        $select = "";
        $query = "select count(id_users) as jml from users ";
        $query .= "union all select count(id_nasabah) as jml from nasabah ";
        $query .= "union all select count(id_tabungan) as jml from tabungan ";
        $result = DB::select($query);
        $result = MD::result_array($result);
        return view('dashboard.index')->with($data);
    }
}
