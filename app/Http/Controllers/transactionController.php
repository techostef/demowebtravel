<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MD;
use DB;
use Session;
use App\Http\Controllers\Secure\Secure;


class transactionController extends Controller
{
    public function daftar(){
        $user = DSC::getdata();
        $result = DB::select("select *, DATE_FORMAT(date, '%d/%m/%Y') as date from transaction where na='N'");
        $result = MD::result_array($result);
        $data = array(
            'user'=>$user,
            'result'=>$result
        );

        return view('transaction.daftar')->with($data);
    }

    public function daftar_restore(){
        $user = DSC::getdata();
        $result = DB::select("select *, DATE_FORMAT(date, '%d/%m/%Y') as date from transaction where na='Y'");
        $result = MD::result_array($result);
        $data = array(
            'user'=>$user,
            'result'=>$result
        );

        return view('transaction.daftar_restore')->with($data);
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
        $result = DB::select("select * from customer where na='n'");
        $result = MD::result_array($result);
        $data = array(
            'user'=>$user,
            'city'=>$city,
            'customer'=>$result,
        );
        return view('transaction.tambah')->with($data);
    }
    public function empty(){
        echo "Kesalahan keamanan,mencoba meretas keamanan";
    }

    public function edit($id){
        if(Secure::decode($id)==null){
            return redirect("/customer/empty")->with("error","Kesalahan keamanan,mencoba meretas keamanan");
        }
        $id = Secure::decode($id);
        $user = DSC::getdata();
        $city = DB::select("select * from kabkota");
        $city = MD::result_array($city);
        $userdata = DB::select("select *,DATE_FORMAT(date, '%d/%m/%Y') as date from transaction where id='$id'");
        $userdata = MD::row_array($userdata);
        $detail = DB::select("select * from transaction_detail where id_transaction='$id'");
        $detail = MD::result_array($detail);
        $customer = DB::select("select * from customer where na='n'");
        $customer = MD::result_array($customer);
        $data = array(
            'id_select'=>Secure::encode($id),
            'user'=>$user,
            'city'=>$city,
            'customer'=>$customer,
            'userData'=>$userdata,
            'detail'=>$detail,
        );
        return view('transaction.tambah')->with($data);
    }

    public function view($id){
        if(Secure::decode($id)==null){
            return redirect("/customer/empty")->with("error","Kesalahan keamanan,mencoba meretas keamanan");
        }
        $id = Secure::decode($id);
        $user = DSC::getdata();
        $city = DB::select("select * from kabkota");
        $city = MD::result_array($city);
        $userdata = DB::select("select a.*,b.name as name_customer,DATE_FORMAT(date, '%d/%m/%Y') as date from transaction a join customer b on a.id_customer=b.id where a.id='$id'");
        $userdata = MD::row_array($userdata);
        $detail = DB::select("select * from transaction_detail where id_transaction='$id'");
        $detail = MD::result_array($detail);
        $customer = DB::select("select * from customer where na='n'");
        $customer = MD::result_array($customer);
        $data = array(
            'id_select'=>Secure::encode($id),
            'user'=>$user,
            'city'=>$city,
            'customer'=>$customer,
            'userData'=>$userdata,
            'detail'=>$detail,
            'view'=>true
        );
        return view('transaction.tambah')->with($data);
    }

    public function insertdata(Request $data){
        $user = DSC::getdata();

        $code = $data->input('code');
        $date = $data->input('date');
        $customer = $data->input('customer');
        $city = $data->input('city');
        $total_item = $data->input('total_item');
        $total_price = $data->input('total_price');
        $itemname = $data->input('itemname');
        $itemqty = $data->input('itemqty');
        $itemprice = $data->input('itemprice');
        $itemsubtotal = $data->input('itemsubtotal');
        
        $result = DB::select("select * from transaction where code='$code'");
        $result = MD::result_array($result);

        $date = explode("/",$date);
        if(count($date)!=3){
            return redirect('/transaction/tambah')->with("error","Invalid Tanggal");
        }
        $date = $date[2]."-".$date[1]."-".$date[0];

        if(count($result)>0){
            return redirect('/transaction/tambah')->with("error","Kode sudah terdaftar, mohon pilih yang lain");

        }

        if(Secure::decode($customer)==null){
            return redirect('/transaction')->with("error","Kesalahan keamanan,mencoba meretas keamanan.");
        }

        $customer = Secure::decode($customer);

        $price = $data->input('total_price');
        $price = str_replace(".","",$price);
        $price = str_replace(",",".",$price);
        $arr = [
            'date'=>$date,
            'code'=>$data->input('code'),
            'id_customer'=>$customer,
            'city'=>$data->input('city'),
            'total_item'=>$data->input('total_item'),
            'total_price'=>$price,
        ];

        $id = DB::table('transaction')->insertGetId($arr);
        
        if(gettype($itemname)=='array'){
            $i = 0;
            foreach($itemname as $row){

                $name = $itemname[$i];
                $qty = $itemqty[$i];
                $price = $itemprice[$i];
                $subtotal = $itemsubtotal[$i];

                if($name=="")continue;
                if($qty=="")continue;
                if($price=="")continue;
                if($subtotal=="")continue;

                $arr = [
                    'id_transaction'=>$id,
                    'item'=>$name,
                    'qty'=>$qty,
                    'price'=>$price,
                    'subtotal'=>$subtotal
                ];
        
                DB::table('transaction_detail')->insertGetId($arr);

                $i++;
            }
        }

        // add history
        MD::history($user['name'],'transaction','insert','id='.$id);

        return redirect('/transaction')->with("success","Berhasil Menambahkan Data.");
    }

    
    public function updatedata(Request $data){
        $user = DSC::getdata();

        $id = $data->input('id');
        $code = $data->input('code');
        $date = $data->input('date');
        $customer = $data->input('customer');
        $city = $data->input('city');
        $total_item = $data->input('total_item');
        $total_price = $data->input('total_price');
        $itemiddelete = $data->input('itemiddelete');
        $itemid = $data->input('itemid');

        $itemname = $data->input('itemname');
        $itemqty = $data->input('itemqty');
        $itemprice = $data->input('itemprice');
        $itemsubtotal = $data->input('itemsubtotal');

        if(Secure::decode($id)==null){
            return redirect('/transaction')->with("error","Kesalahan keamanan,mencoba meretas keamanan.");
        }

        $id = Secure::decode($id);

        $result = DB::select("select * from transaction where code='$code' and id!='$id' ");
        $result = MD::result_array($result);

        $date = explode("/",$date);
        if(count($date)!=3){
            return redirect('/transaction/tambah')->with("error","Invalid Tanggal");
        }
        $date = $date[2]."-".$date[1]."-".$date[0];

        if(count($result)>0){
            return redirect('/transaction/tambah')->with("error","Kode sudah terdaftar, mohon pilih yang lain");

        }

        

        if(Secure::decode($customer)==null){
            return redirect('/transaction')->with("error","Kesalahan keamanan,mencoba meretas keamanan.");
        }

        $customer = Secure::decode($customer);

        $price = $data->input('total_price');
        $price = str_replace(".","",$price);
        $price = str_replace(",",".",$price);
        $arr = [
            'date'=>$date,
            'code'=>$data->input('code'),
            'id_customer'=>$customer,
            'city'=>$data->input('city'),
            'total_item'=>$data->input('total_item'),
            'total_price'=>$price,
        ];

        DB::table('transaction')->where('id',$id)->update($arr);
        
        if(gettype($itemname)=='array'){
            $i = 0;
            foreach($itemname as $row){


                $name = $itemname[$i];
                $qty = $itemqty[$i];
                $price = $itemprice[$i];
                $subtotal = $itemsubtotal[$i];

                if($name=="")continue;
                if($qty=="")continue;
                if($price=="")continue;
                if($subtotal=="")continue;

                $arr = [
                    'id_transaction'=>$id,
                    'item'=>$name,
                    'qty'=>$qty,
                    'price'=>$price,
                    'subtotal'=>$subtotal
                ];
                
        
                if(isset($itemid[$i])){
                    DB::table('transaction_detail')->where('id',$itemid[$i])->update($arr);
                }else{
                    DB::table('transaction_detail')->insert($arr);
                }
                $i++;
            }
        }
        if(gettype($itemiddelete)=='array'){
            foreach($itemiddelete as $row){
                DB::delete("delete from transaction_detail where id='$row'");
            }
        }

        // add history
        MD::history($user['name'],'transaction','update','id='.$id);

        return redirect('/transaction')->with("success","Berhasil Mengupdate Data.");
    }

    public function delete($id){
        $user = DSC::getdata();
        if(Secure::decode($id)==null){
            return redirect('/transaction')->with("error","Kesalahan keamanan,mencoba meretas keamanan.");
        }
        $id = Secure::decode($id);
        $arr = [
            'na'=>'Y',
        ];

        DB::table('transaction')->where('id',$id)->update($arr);
        // add history
        MD::history($user['name'],'transaction','delete','id='.$id);

        return redirect('/transaction')->with("success","Berhasil menghapus data.");
    }

    public function restore($id){
        $user = DSC::getdata();
        if(Secure::decode($id)==null){
            return redirect('/transaction_restore')->with("error","Kesalahan keamanan,mencoba meretas keamanan.");
        }
        $id = Secure::decode($id);

        $arr = [
            'na'=>'N',
        ];

        DB::table('transaction')->where('id',$id)->update($arr);

        // add history
        MD::history($user['name'],'transaction','restore','id='.$id);

        
        return redirect('/transaction_restore')->with("success","Berhasil Mengembalikan Data");
    }

    public function delete_permanent($id){
        $user = DSC::getdata();
        if(Secure::decode($id)==null){
            return redirect('/transaction_restore')->with("error","Kesalahan keamanan,mencoba meretas keamanan.");
        }
        $id = Secure::decode($id);

        DB::delete("delete from transaction where id='$id'");

        return redirect('/transaction_restore')->with("success","Berhasil menghapus");
    }

}
