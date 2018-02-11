<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class TestController extends Controller
{

    private $userRepo;

    public function __construct(UserRepository $userRepo){
        $this->userRepo = $userRepo;
    }

    public function testApi(){

        $users = $this->userRepo->getAll();
    
        var_dump($users);
        die();

    }
}
