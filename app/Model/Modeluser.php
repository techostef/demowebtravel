<?php

namespace App\Model;
use App\Http\Controllers\DSC;
use DB;
Class Modeluser {
    public function fotourl(){
        $user = DSC::getdata();
        $url = config('app.url').'/images/avatar.png';
        if(isset($user['foto'])&&$user['foto']!=''){
            $file = config('app.url').$user['foto'];
            $replace = self::getnamefoto($user['foto']);
            $file = str_replace($replace,rawurlencode($replace),$file);
            $file_headers = @get_headers($file);
            if($file_headers[0] == 'HTTP/1.1 200 OK') {
                $url = $file;
            }
        }
        echo $url;
    }

    public static function getnamefoto($data){
        $name = explode("/",$data);
        if(gettype($name)=="array"&&count($name)>0){
            return $name[count($name)-1];
        }else{
            return "";
        }
    }

    private function myUrlDecode($string) {
        $entities = array('%20','%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
        $replacements = array(' ','!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
        return str_replace($entities, $replacements, urlencode($string));
    }

    private function myUrlEncode($string) {
        $entities = array('%20','%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
        $replacements = array(' ','!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
        return str_replace($replacements,$entities, urlencode($string));
    }

    public function viewdata($data){
        if($data==''){
            return '';
        }
        $user = DSC::getdata();
        return $user[$data];
    }

    public function getrole(){
        return session('role');
    }
    
    public function getrole_array(){
        return session('role');
    }

    public static function datetotanggal($date,$format="d-m-Y"){
        $arr = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $int = strtotime($date);
        $y = date("Y",$int);
        $m = date("m",$int);
        $m = $arr[$m-1];
        $d = date("d",$int);
        if($format=="d-m-Y"){
            return $d." ".$m." ".$y;
        }
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

    public function checkrole($id){
        //for button (add,change,delete)
        $user = DSC::getdata();
        $role = DSC::getrole($user['id']);
        
        if($user['user_level']==-1){
            return true;
        }else{
            file_put_contents("debug.txt","permission : ".$id);
            if(in_array($id,$role)){
                return true;
            }else{
                return false;
            }
        }
    }

    public static function terbilang($x)
    {
        $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        if ($x < 12)
            return " " . $abil[$x];
        elseif ($x < 20)
            return Modeluser::terbilang($x - 10) . " Belas";
        elseif ($x < 100)
            return Modeluser::terbilang($x / 10) . " Puluh" . Modeluser::terbilang($x % 10);
        elseif ($x < 200)
            return " Seratus" . Modeluser::terbilang($x - 100);
        elseif ($x < 1000)
            return Modeluser::terbilang($x / 100) . " Ratus" . Modeluser::terbilang($x % 100);
        elseif ($x < 2000)
            return " Seribu" . Modeluser::terbilang($x - 1000);
        elseif ($x < 1000000)
            return Modeluser::terbilang($x / 1000) . " Ribu" . Modeluser::terbilang($x % 1000);
        elseif ($x < 1000000000)
            return Modeluser::terbilang($x / 1000000) . " Juta" . Modeluser::terbilang($x % 1000000);
        elseif ($x < 1000000000000)
            return Modeluser::terbilang($x / 1000000000) . " Milyar" . Modeluser::terbilang($x % 1000000000);
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
    
}