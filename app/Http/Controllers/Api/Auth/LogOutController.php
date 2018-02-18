<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class LogOutController extends Controller
{
    public function logOut(Request $request){

        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token); 

        return "DONE";
    }
}
