<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Secure extends Facade{
    public static function getFacadeAccessor(){
        return 'Secure';
    }
}