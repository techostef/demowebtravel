<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MD extends Controller
{
    public static function row_array($data){
        if(count($data)>0){
            $data = $data[0];
            return (array)$data;
        }else{
            return (array)$data;
        }
    }

    public static function prevent($string){
        $string = str_replace("'","\\'",$string);
        $string = str_replace("'",'\\"',$string);
        return $string;
    }

    public static function result_array($data){
        $data = (array)$data;
        foreach($data as &$z){
            $z = (array)$z;
        }
        return $data;
    }

    // menambah history dengan tiga column yaitu status,by, time
    // paramater who (siapa)
    public static function history($who,$table,$type,$where){
        $history = DB::select("select history from $table where $where");
        $history = MD::row_array($history);
        // mengecek history ada atau tidak 
        // untuk memulai dari awal atau menambah
        if($history['history']==null){
            $history = array();
        }else{
            $history = json_decode($history['history']);
        }
        $object = new \stdClass();
        $object->status = $type;
        $object->by = $who;
        $object->time = date("Y-m-d H:i:s");
        array_push($history,$object);
        $arr = [
            'history'=>json_encode($history)
        ];
        // where string "id=2"
        // memisahkan string dengan =
        $where = explode("=",$where);
        DB::table($table)->where($where[0],$where[1])->update($arr);
    }

    // mendapatkan history dari table dengan column history
    // jika dapat akan mengembalikan
    // jika tidak mengembalikan array

    public static function parse_number($number, $dec_point=null) {
        
        if (empty($dec_point)) {
            $locale = localeconv();
            $dec_point = $locale['decimal_point'];
        }
        return floatval(str_replace($dec_point, '.', preg_replace('/[^\d'.preg_quote($dec_point).']/', '', $number)));
    }

    public static function gethistory($table,$where){
        $history = DB::select("select history from $table where $where");
        $history = MD::row_array($history);
        if($history['history']==null){
            $history = array();
        }else{
            $history = json_decode($history['history']);
        }
        return $history;
    }

    public static function preprint($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    public static function removeMask($data){
        $data = preg_replace('/\./', '', $data);
        $data = preg_replace('/\,/', '.', $data);
        return $data;
    }

    public static function inttomoney($data,$res=''){
        if($data==''){
            return 0;
        }
        $n = '';
        $temp = '';
        $data = (String)$data;
        
        $data = preg_replace('/\./', ',', $data);
        if(strpos($data, ',') != false){
            $n = strpos($data, ',');
            $data = preg_replace('/\,/', '.', $data);
            $data = number_format((float)$data, 2, '.', '');
            $temp = substr($data,$n,strlen($data));
            $data = substr($data,0,$n);
        }
        
        $data = preg_replace('/[^\d,-]/', '', $data);
        $cut = 3;
        
        if(strlen($data)>3){
            $length = strlen($data);
            $temp = preg_replace('/\./', ',', $temp);
            if($res==''){
                $res = substr($data,$length-$cut,$cut).$res.$temp;
            }else{
                $res = substr($data,$length-$cut,$cut).".".$res.$temp;
            }
            $data = substr($data,0,$length-$cut);
           
            return self::inttomoney($data,$res);
        }else{
            $temp = preg_replace('/\./', ',', $temp);
            if(strlen($res)>=3){
                return $data.".".$res.$temp;
            }else{
                return $data.$res.$temp;
            }
        }
    }

    public static function updatesaldo($id){
        $query = "select a+c-b as total from (SELECT SUM(simpan) as a,SUM(ambil) as b,SUM(bunga) as c ";
        $query .= "FROM `histori_tabungan` WHERE id_tabungan='$id') as z";
        $result = DB::select($query);
        $result = MD::row_array($result);
        $result = $result['total'];
        $arr = array(
            'saldo'=>$result,
        );
        DB::table('tabungan')->where('id_tabungan',$id)->update($arr);
    }


    public static function getsaldo($id,$date=false){
        if($date==false){
            $query = "select a+c-b as total from (SELECT SUM(simpan) as a,SUM(ambil) as b,SUM(bunga) as c ";
            $query .= "FROM `histori_tabungan` WHERE id_tabungan='$id') as z";
            $result = DB::select($query);
            $result = MD::row_array($result);
            $result = $result['total'];
            return $result;
        }else{
            $query = "SELECT sum(simpan)+sum(bunga)-SUM(ambil) as total FROM histori_tabungan WHERE create_at<='$date' and id_tabungan=$id";
            $result = DB::select($query);
            $result = MD::row_array($result);
            $result = $result['total'];
            return $result;
        }
    }
    public static function rangemonth(){
        $day = "2018-02-28";
        $day = "2018-03-25";
        $month = array(31,28,31,30,31,30,31,31,30,31,30,31);
    }

    public static function dayinmonth($month,$year=false){
        $arr = array(31,28,31,30,31,30,31,31,30,31,30,31);
        $arr1 = array(31,29,31,30,31,30,31,31,30,31,30,31);

        if($year==false){
            return $arr[$month-1];
        }else{
            if($year%4==0){
                return $arr1[$month-1];
            }else{
                return $arr[$month-1];
            }
        }
    }

    public static function validDate($date){
        $arr = explode("-",$date);
        $y = $arr[0];
        $m = $arr[1];
        $d = $arr[2];
        $day = MD::dayinmonth($m,$y);
        if($d>$day){
            return false;
        }else{
            return true;
        }
    }

    public static function plusmonth($date,$M){
        $arr = explode("-",$date);
        $y = $arr[0];
        $m = $arr[1]+$M;
        $d = $arr[2];
        if($m>12){
            $m = 1;
            $y+= 1;
        }
        $date = $y."-".$m."-".$d;
        if(MD::validDate($date)){
            return $date;
        }else{
            $d = MD::dayinmonth($m,$y);
            return $date = $y."-".$m."-".$d;
        }
    }
    
    public static function dateRange( $first, $last, $step = '+1 day', $format = 'Y-m-d' ) {

        $dates = array();
        $current = strtotime( $first );
        $last = strtotime( $last );
    
        while( $current <= $last ) {
    
            $dates[] = date( $format, $current );
            $current = strtotime( $step, $current );
        }
        $range = count($dates)-1;    
        return $range;
    }
    
    public static function inttoromawi($number){
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
    
    public static function changemonth($date,$m){
        $arr = explode("-",$date);
        $y = $arr[0];
        $m = $m;
        $d = $arr[2];
        if($m>12){
            $m = 1;
            $y+= 1;
        }
        $date = $y."-".$m."-".$d;
        if(MD::validDate($date)){
            return $date;
        }else{
            $d = MD::dayinmonth($m,$y);
            return $date = $y."-".$m."-".$d;
        }
    }

    public static function updatebunga($M=false,$Y=false){
        $day = 28;
        $month = date('m');
        if($M!=false){
            $month = $M;
        }
        $year = date('Y');
        if($Y!=false){
            $year = $Y;
        }
        $query = "SELECT z.* FROM (
            SELECT a.id_tabungan,a.bunga,b.histori_saldo,b.id,b.create_at,0 as typebonus FROM tabungan a
            left join histori_tabungan b on a.id_tabungan=b.id_tabungan 
            left join tabungan_bunga c on (c.id_tabungan=a.id_tabungan and c.create_at=b.create_at)
            WHERE histori_saldo = ( 
            SELECT MIN(histori_saldo) FROM histori_tabungan d where a.id_tabungan=d.id_tabungan 
            and month(d.create_at)=$month and year(d.create_at)=$year
            and c.id is null 
            )
            union all
            SELECT a1.id_tabungan,a1.bunga,b1.histori_saldo,b1.id,b1.create_at,1 as typebonus FROM tabungan a1
            left join histori_tabungan b1 on a1.id_tabungan=b1.id_tabungan 
            left join tabungan_bunga c1 on (c1.id_tabungan=a1.id_tabungan and c1.create_at=b1.create_at)
            WHERE b1.id =  ( 
            SELECT MAX(d1.id) FROM histori_tabungan d1 where a1.id_tabungan=d1.id_tabungan 
            and month(d1.create_at)<$month and year(d1.create_at)=$year
            )
            GROUP by a1.id_tabungan
        ) as z where z.id=(
            SELECT max(z1.id) FROM (
                SELECT a.id_tabungan,a.bunga,b.histori_saldo,b.id,b.create_at,0 as typebonus FROM tabungan a
                left join histori_tabungan b on a.id_tabungan=b.id_tabungan 
                left join tabungan_bunga c on (c.id_tabungan=a.id_tabungan and c.create_at=b.create_at)
                WHERE histori_saldo =  ( 
                SELECT MIN(histori_saldo) FROM histori_tabungan d where a.id_tabungan=d.id_tabungan 
                and month(d.create_at)=$month and year(d.create_at)=$year
                and c.id is null 
                )
                union all
                SELECT a1.id_tabungan,a1.bunga,b1.histori_saldo,b1.id,b1.create_at,1 as typebonus FROM tabungan a1
                left join histori_tabungan b1 on a1.id_tabungan=b1.id_tabungan 
                left join tabungan_bunga c1 on (c1.id_tabungan=a1.id_tabungan and c1.create_at=b1.create_at)
                WHERE b1.id =  ( 
                SELECT MAX(d1.id) FROM histori_tabungan d1 where a1.id_tabungan=d1.id_tabungan 
                and month(d1.create_at)<$month and year(d1.create_at)=$year
                )
                GROUP by a1.id_tabungan
            ) as z1 where z.id_tabungan=z1.id_tabungan
        )";
        $result = DB::select($query);
        $result = MD::result_array($result);
        foreach($result as $row){
            if($row['typebonus']==0){
                $date = $year.'-'.$month.'-'.$day;
                // MD::preprint("Date : $date");
                // MD::preprint(MD::inttomoney($row['histori_saldo'])." last");

                $min = (($row['bunga']/100)*$row['histori_saldo']);
                $id = $row['id_tabungan'];
                if($row['histori_saldo']<100000){
                    $min = 0;
                }
                $arr = array(
                    'id_tabungan'=>$row['id_tabungan'],
                    'id_users'=>null,
                    'simpan'=>0,
                    'ambil'=>0,
                    'bunga'=>$min,
                    'bunga_persen'=>$row['bunga'],
                    'create_at'=>$date
                );
                // MD::preprint($arr);
                $ID = DB::table('histori_tabungan')->insertGetId($arr);

                MD::updatesaldo($id);

                $saldo = MD::getsaldo($id);
                $arr = ['histori_saldo'=>$saldo];
                DB::table('histori_tabungan')->where('id',$ID)->update($arr);
                $arr = [
                    'id_tabungan'=>$id,
                    'bunga'=>$min,
                    'create_at'=>$date,
                ];
                DB::table('tabungan_bunga')->insertGetId($arr);
            }elseif($row['typebonus']==1){
                $i = 0;
                $m1 = $month;
                $m2 = date("m",strtotime($row['create_at']));
                $n = $m1-$m2;
                for($i=0;$i<$n;$i++){
                    $i1 = $i+1;
                    // MD::preprint(MD::inttomoney($row['histori_saldo'])." last");
                    $min = (($row['bunga']/100)*$row['histori_saldo']);
                    $id = $row['id_tabungan'];
                    if($row['histori_saldo']<100000){
                        $min = 0;
                    }
                    $arr = array(
                        'id_tabungan'=>$row['id_tabungan'],
                        'id_users'=>null,
                        'simpan'=>0,
                        'ambil'=>0,
                        'bunga'=>$min,
                        'bunga_persen'=>$row['bunga'],
                        'create_at'=>MD::plusmonth($row['create_at'],$i1),
                    );
                    // MD::preprint($arr);

                    $ID = DB::table('histori_tabungan')->insertGetId($arr);

                    MD::updatesaldo($id);

                    $saldo = MD::getsaldo($id);
                    $arr = ['histori_saldo'=>$saldo];
                    DB::table('histori_tabungan')->where('id',$ID)->update($arr);
                    $arr = [
                        'id_tabungan'=>$id,
                        'bunga'=>$min,
                        'create_at'=>MD::plusmonth($row['create_at'],$i1),
                    ];
                    DB::table('tabungan_bunga')->insertGetId($arr);
                }
            }
        }
    }

    public static function fixbunga($M=false,$Y=false,$id,$ID){
        $day = 28;
        $month = date('m');
        if($M!=false){
            $month = $M;
        }
        $year = date('Y');
        if($Y!=false){
            $year = $Y;
        }
        // MD::preprint("Month : $month");
        // MD::preprint("Year : $year");
        $day = MD::dayinmonth($month,$year);
        $query = "SELECT z.* FROM (
            SELECT a.id_tabungan,a.bunga,b.histori_saldo,b.id,b.create_at,0 as typebonus FROM tabungan a
            left join histori_tabungan b on a.id_tabungan=b.id_tabungan 
            left join tabungan_bunga c on (c.id_tabungan=a.id_tabungan and c.create_at=b.create_at)
            WHERE histori_saldo = ( 
            SELECT MIN(histori_saldo) FROM histori_tabungan d where a.id_tabungan=d.id_tabungan 
            and month(d.create_at)=$month and year(d.create_at)=$year
            )
            union all
            SELECT a1.id_tabungan,a1.bunga,b1.histori_saldo,b1.id,b1.create_at,1 as typebonus FROM tabungan a1
            left join histori_tabungan b1 on a1.id_tabungan=b1.id_tabungan 
            WHERE b1.id =  ( 
            SELECT MAX(d1.id) FROM histori_tabungan d1 where a1.id_tabungan=d1.id_tabungan 
            and month(d1.create_at)<$month and year(d1.create_at)=$year
            )
            GROUP by a1.id_tabungan
        ) as z where z.id=(
            SELECT max(z1.id) FROM (
                SELECT a.id_tabungan,a.bunga,b.histori_saldo,b.id,b.create_at,0 as typebonus FROM tabungan a
                left join histori_tabungan b on a.id_tabungan=b.id_tabungan 
                left join tabungan_bunga c on (c.id_tabungan=a.id_tabungan and c.create_at=b.create_at)
                WHERE histori_saldo =  ( 
                SELECT MIN(histori_saldo) FROM histori_tabungan d where a.id_tabungan=d.id_tabungan 
                and month(d.create_at)=$month and year(d.create_at)=$year
                )
                union all
                SELECT a1.id_tabungan,a1.bunga,b1.histori_saldo,b1.id,b1.create_at,1 as typebonus FROM tabungan a1
                left join histori_tabungan b1 on a1.id_tabungan=b1.id_tabungan 
                WHERE b1.id =  ( 
                SELECT MAX(d1.id) FROM histori_tabungan d1 where a1.id_tabungan=d1.id_tabungan 
                and month(d1.create_at)<$month and year(d1.create_at)=$year
                )
                GROUP by a1.id_tabungan
            ) as z1 where z.id_tabungan=z1.id_tabungan
        ) and id_tabungan='$id'";
        $rowData = DB::select($query);
        $rowData = MD::row_array($rowData);
        // MD::preprint($query);
        $date = $year.'-'.$month.'-'.$day;
        if(isset($rowData['typebonus'])){
            if($rowData['typebonus']===0){
                // MD::preprint(MD::inttomoney($rowData['histori_saldo'])." last");

                $min = (($rowData['bunga']/100)*$rowData['histori_saldo']);
                $id = $rowData['id_tabungan'];
                if($rowData['histori_saldo']<100000){
                    $min = 0;
                }
                $arr = array(
                    'bunga'=>$min,
                );
                // MD::preprint("ID : $ID");
                // MD::preprint($arr);
                DB::table('histori_tabungan')->where('id',$ID)->update($arr);
                $saldo = MD::getsaldo($id,$date);
                // MD::preprint("Saldo1 : ".$saldo);
                $arr = ['histori_saldo'=>$saldo];
                DB::table('histori_tabungan')->where('id',$ID)->update($arr);
                MD::updatesaldo($id);
    
            }elseif($rowData['typebonus']==1){
                $i = 0;
                $m1 = $month;
                $m2 = date("m",strtotime($rowData['create_at']));
                $n = $m1-$m2;
                for($i=0;$i<$n;$i++){
                    $i1 = $i+1;
                    MD::preprint(MD::inttomoney($rowData['histori_saldo'])." last");
                    $min = (($rowData['bunga']/100)*$rowData['histori_saldo']);
                    $id = $rowData['id_tabungan'];
                    if($rowData['histori_saldo']<100000){
                        $min = 0;
                    }
                    $arr = array(
                        'bunga'=>$min,
                    );
                    // MD::preprint("ID : $ID");
                    // MD::preprint($arr);
                    DB::table('histori_tabungan')->where('id',$ID)->update($arr);
                    $saldo = MD::getsaldo($id,$date);
                    // MD::preprint("Saldo2 : ".$saldo);
                    $arr = ['histori_saldo'=>$saldo];
                    DB::table('histori_tabungan')->where('id',$ID)->update($arr);
                    MD::updatesaldo($id);
                }
            }
        }
    }

    public static function updatedenda($date){
        $denda_persen = 0.03;
        $time = strtotime($date);
        $d = date("d",$time);
        $m = date("m",$time);
        $y = date("Y",$time);
        $query = "SELECT * FROM (
            SELECT a.id_kredit,a.id_nasabah, a.pokok, a.bunga, b.id as id_denda,
            b.create_at as denda_create_at, 
            c.id as id_denda_d, c.create_at as denda_d_create_at
            FROM `kredit` a
            left join kredit_denda b on b.id_kredit=a.id_kredit
            left join kredit_denda_d c on a.id_kredit=c.id_kredit
            where b.create_at = (
                SELECT 
                max(b1.create_at)
                FROM `kredit` a1
                left join kredit_denda b1 on b1.id_kredit=a1.id_kredit
                left join kredit_denda_d c1 on a1.id_kredit=c1.id_kredit
                where b.id_kredit = b1.id_kredit and (
                    b.create_at<'$date'
                ) and b.status = 0
            )
        ) as z where z.denda_d_create_at = (
            SELECT 
            max(c1.create_at)
            FROM `kredit` a1
            left join kredit_denda b1 on b1.id_kredit=a1.id_kredit
            left join kredit_denda_d c1 on a1.id_kredit=c1.id_kredit
            where z.id_kredit = b1.id_kredit and c1.create_at!='$date'
        ) or z.denda_d_create_at is null";
        $result = DB::select($query);
        $result = MD::result_array($result);
        foreach($result as $row){
            $angsuran = $row['pokok']+$row['bunga'];
            $range = MD::dateRange($row['denda_create_at'],$date," +1 day");
            $d = ($denda_persen*$angsuran);
            $denda = ($denda_persen*$angsuran)*$range;
            $arr = [
                'denda'=>$denda,
                'denda_day'=>$range,
            ];
            DB::table("kredit_denda")->where("id",$row['id_denda'])->update($arr);
            $arr = [
                'id_kredit'=>$row['id_kredit'],
                'create_at'=>$date,
                'status'=>0,
            ];
            $ID = DB::table("kredit_denda_d")->insertGetId($arr);
        }
    }
}
