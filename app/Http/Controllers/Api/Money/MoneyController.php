<?php

namespace App\Http\Controllers\Api\Money;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MoneyRepository;
use App\Repositories\UserRepository;

class MoneyController extends Controller
{
    private $moneyRepo;
    private $userRepo;


    public function __construct(MoneyRepository $moneyRepo, UserRepository $userRepo){
        $this->moneyRepo = $moneyRepo;
        $this->userRepo = $userRepo;
    }

    public function insertAllMoney(Request $request){

        $id = $request["id"];
        $moneys = $request["moneys"]; 

        var_dump($request);
        die();


        $user = $this->userRepo->getById($id);


        if($user->rights == 1){

            
            foreach($moneys as $money){

                // $this->moneyRepo->pushMoney($money["id"]);

                return "salut";
                
                
            }   

        }else{
            return [
                "message" => "No Rights!",
                "status_code" => 666
            ];
        }
    }
}
