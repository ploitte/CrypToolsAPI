<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class CheckController extends Controller
{
    public function checkAuth(Request $request){

        $tokenFetch = JWTAuth::parseToken()->authenticate();

        if($tokenFetch){
            return [
                "message" => "good",
                "status_code" => 666
            ];
        }else{
            return [
                "message" => "bad",
                "status_code" => 666
            ] ;
        }
    }

}
