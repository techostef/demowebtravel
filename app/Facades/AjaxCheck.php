<?php 

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AjaxCheck extends Facade{
    public static function getFacadeAccessor(){
        return 'AjaxCheck';
    }
}