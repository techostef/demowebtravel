<?php

namespace App\Http\Controllers\Secure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Secure extends Controller
{
    private static function encrypt($key, $payload) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-ecb'));
        $encrypted = openssl_encrypt($payload, 'aes-256-ecb', $key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    private static function decrypt($key, $garble) {
        if(count(explode('::', base64_decode($garble), 2))<=1){
            return null;
        }else{
            list($encrypted_data, $iv) = explode('::', base64_decode($garble), 2);
            return openssl_decrypt($encrypted_data, 'aes-256-ecb', $key, 0, $iv);
        }
    }

    public static function encode($data){
        $key = 'a6b5c9f7d21483db';
        return self::encrypt($key,$data);
    }
    public static function decode($data){
        $key = 'a6b5c9f7d21483db';
        return self::decrypt($key,$data);
    }
}
