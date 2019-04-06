<?php

namespace App\Model;

class Ajax {
    public function alert($id,$method,$url,$message,$data=false,$Input=false,$Script=false){
        // example
        // {{AjaxCheck::alert(
        //     'username',
        //     'focusout',
        //     config('app.url').'/nasabah/checknorekening',
        //     'Tolong ganti no rekening, no rekening telah dipakai',
        //     ['i'=>'$("#no_rekening").val()'],
        //     ['name'=>'no_rekening','placeholder'=>'No Rekening',
        //     'class'=>'form-control','autocomplete'=>'off','value'=>$a]
        // )}}
        $attrInput = '';
        if(is_array($Input)&&count($Input)>0){
            foreach($Input as $a=>$key){
                $attrInput .= $a."='".$key."' ";
            }
        }
        $attrData = '';
        if(is_array($data)&&count($data)>0){
            foreach($data as $a=>$key){
                $attrData .= $a.":".$key.",";
            }
            rtrim($attrData,",");
        }
        

        $ajax= "headers: { 'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')},";
        $ajax.= 'type:"POST",data:{'.$attrData.'},url:"'.$url.'", ';
        $ajax.= 'success:function(data){';
        if($Script!==false){
            $ajax.= $Script;
        }
        $ajax.= ' data = jQuery.parseJSON(data); ';
        $ajax.= 'if(!data){';
        $ajax.= "alert('$message')";
        $ajax.= '}';
        $ajax.= '}';

        $view = '';
        $view.= '';
        $view.= "<input id='$id' type='text' $attrInput>";
        $view.= "<script>";
        //open jquery;
        $view.= "jQuery(document).ready(function($){";

        //open function;
        $view.= "$('#$id').$method(function(){";

        //open ajax;
        $view.= "\$.ajax({";
        $view.= $ajax;
        //close ajax;
        $view.= "})";

        //close function;
        $view.= "})";

        //close jquery;
        $view.= "})";
        $view.= "</script>";
        echo $view;
    }

    

}