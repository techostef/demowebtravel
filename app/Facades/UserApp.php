<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UserApp extends Facade{
    public static function getFacadeAccessor(){
        return 'UserApp';
    }
}