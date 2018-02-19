<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    

    public function pingSecure(){
        return [
            "success" => true,
            "message" => "Test avec token OK"
        ];
    }

    public function ping(){
        return [
            "success" => true,
            "message" => "Test sans token OK"
        ];
    }


}
