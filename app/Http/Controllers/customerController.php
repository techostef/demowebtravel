<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MD;
use DB;
use Session;
use App\Http\Controllers\Secure\Secure;


class customerController extends Controller
{
    public function daftar(){
        $user = DSC::getdata();
        $result = DB::select("select * from customer where na='N'");
        $result = MD::result_array($result);
        $data = array(
            'user'=>$user,
            'result'=>$result
        );

        return view('customer.daftar')->with($data);
    }

    public function daftar_restore(){
        $user = DSC::getdata();
        $result = DB::select("select * from customer where na='Y'");
        $result = MD::result_array($result);
        $data = array(
            'user'=>$user,
            'result'=>$result
        );

        return view('customer.daftar_restore')->with($data);
    }
    
    public function list(){
        $result = DB::select("select * from customer where na='N'");
        $result = MD::result_array($result);
        $data = array(
            'result'=>$result
        );

        return view('customer.list')->with($data);
    }

    public function tambah(){
        $user = DSC::getdata();
        $city = DB::select("select * from kabkota");
        $city = MD::result_array($city);
        $result = DB::select("select * from customer where na='N' ");
        $result = MD::result_array($result);
        $data = array(
            'user'=>$user,
            'city'=>$city,
            'customer'=>$result,
        );
        return view('customer.tambah')->with($data);
    }

    public function getinfo(Request $data){

        $id = $data->input("a");
        if(Secure::decode($id)==null){
            $msg = new \stdClass();
            $msg->status = false;
            $msg->msg = "Kesalahan keamanan,mencoba meretas keamanan.";
            echo json_encode($msg);
            die();
        }
        $id = Secure::decode($id);
        $result = DB::select("select * from customer where id='$id'");
        $result = MD::row_array($result);
        if(count($result)>0){
            $msg = new \stdClass();
            $msg->status = true;
            $msg->result = $result['city'];
            echo json_encode($msg);
            die();
        }else{
            $msg = new \stdClass();
            $msg->status = false;
            $msg->msg = "Data tidak ditemukan";
            echo json_encode($msg);
            die();
        }
    }

    public function empty(){
        echo "Kesalahan keamanan,mencoba meretas keamanan";
    }

    public function edit($id){
        if(Secure::decode($id)==null){
            return redirect("/customer/empty")->with("error","Kesalahan keamanan,mencoba meretas keamanan");
        }
        $user = DSC::getdata();
        $city = DB::select("select * from kabkota");
        $city = MD::result_array($city);
        $result = DB::select("select * from customer where id='".Secure::decode($id)."'");
        $result = MD::row_array($result);
        $data = array(
            'user'=>$user,
            'city'=>$city,
            'data'=>$result,
            'id_select'=>$id,
        );
        return view('customer.tambah')->with($data);
    }

    public function view($id){
        if(Secure::decode($id)==null){
            return redirect("/customer/empty")->with("error","Kesalahan keamanan,mencoba meretas keamanan");
        }
        $user = DSC::getdata();
        $city = DB::select("select * from kabkota");
        $city = MD::result_array($city);
        $result = DB::select("select * from customer where id='".Secure::decode($id)."'");
        $result = MD::row_array($result);
        $data = array(
            'user'=>$user,
            'city'=>$city,
            'data'=>$result,
            'id_select'=>$id,
            'view'=>true,
        );
        return view('customer.tambah')->with($data);
    }

    public function insertdata(Request $data){
        $user = DSC::getdata();

        $code = $data->input('code');
        $result = DB::select("select * from customer where code='$code'");
        $result = MD::result_array($result);
        if(count($result)>0){
            $msg = new \stdClass();
            $msg->status = false;
            $msg->msg = "Code sudah terdaftar di Customer,tolong pilih yang lain.";
            echo json_encode($msg);
            die();
        }
        $arr = [
            'code'=>$data->input('code'),
            'name'=>$data->input('nama'),
            'city'=>$data->input('city'),
        ];

        $id = DB::table('customer')->insertGetId($arr);

        // add history
        MD::history($user['name'],'customer','insert','id='.$id);

        $msg = new \stdClass();
        $msg->status = true;
        $msg->msg = "Berhasil Menambahkan.";
        echo json_encode($msg);
    }

    
    public function updatedata(Request $data){
        $user = DSC::getdata();

        $code = $data->input('code');
        $id = $data->input('id');

        if(Secure::decode($id)==null){
            $msg = new \stdClass();
            $msg->status = false;
            $msg->msg = "Kesalahan keamanan,mencoba meretas keamanan.";
            echo json_encode($msg);
            die();
        }
        $id = Secure::decode($id);
        
        $result = DB::select("select * from customer where code='$code' and id!='$id'");
        $result = MD::result_array($result);
        if(count($result)>0){
            $msg = new \stdClass();
            $msg->status = false;
            $msg->msg = "Code sudah terdaftar di Customer,tolong pilih yang lain.";
            echo json_encode($msg);
            die();
        }
        $arr = [
            'code'=>$data->input('code'),
            'name'=>$data->input('nama'),
            'city'=>$data->input('city'),
        ];

        DB::table('customer')->where('id',$id)->update($arr);

        // add history
        MD::history($user['name'],'customer','update','id='.$id);

        $msg = new \stdClass();
        $msg->status = true;
        $msg->msg = "Berhasil Mengupdate.";
        echo json_encode($msg);
    }

    public function delete($id){
        $user = DSC::getdata();
        if(Secure::decode($id)==null){
            $msg = new \stdClass();
            $msg->status = false;
            $msg->msg = "Kesalahan keamanan,mencoba meretas keamanan.";
            echo json_encode($msg);
            die();
        }
        $id = Secure::decode($id);
        $arr = [
            'na'=>'Y',
        ];

        DB::table('customer')->where('id',$id)->update($arr);
        // add history
        MD::history($user['name'],'customer','delete','id='.$id);

        $msg = new \stdClass();
        $msg->status = true;
        $msg->msg = "Berhasil menghapus";
        echo json_encode($msg);
        die();
    }

    public function restore($id){
        $user = DSC::getdata();
        if(Secure::decode($id)==null){
            return redirect('/customer_restore')->with("error","Kesalahan keamanan,mencoba meretas keamanan.");
        }
        $id = Secure::decode($id);

        $arr = [
            'na'=>'N',
        ];

        DB::table('customer')->where('id',$id)->update($arr);

        // add history
        MD::history($user['name'],'customer','restore','id='.$id);

        
        return redirect('/customer_restore')->with("success","Berhasil Mengembalikan Data");
    }

    public function delete_permanent($id){
        $user = DSC::getdata();
        if(Secure::decode($id)==null){
            return redirect('/customer_restore')->with("error","Kesalahan keamanan,mencoba meretas keamanan.");
        }
        $id = Secure::decode($id);

        DB::delete("delete from customer where id='$id'");

        return redirect('/customer_restore')->with("success","Berhasil menghapus");
    }

}
