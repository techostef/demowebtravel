<?php

namespace App\Model;

class Secure{
    function encrypt($key, $payload) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-ecb'));
        $encrypted = openssl_encrypt($payload, 'aes-256-ecb', $key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    function decrypt($key, $garble) {
        if(count(explode('::', base64_decode($garble), 2))<=1){
            return null;
        }else{
            list($encrypted_data, $iv) = explode('::', base64_decode($garble), 2);
            return openssl_decrypt($encrypted_data, 'aes-256-ecb', $key, 0, $iv);
        }
    }

    public function encode($data){
        $key = 'a6b5c9f7d21483db';
        return Secure::encrypt($key,$data);
    }
    public function decode($data){
        $key = 'a6b5c9f7d21483db';
        return Secure::decrypt($key,$data);
    }
}