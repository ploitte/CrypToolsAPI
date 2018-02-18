<?php


namespace App\Repositories;

use App\Money;
use Illuminate\Support\Facades\DB;

class MoneyRepository extends DbRepository{

    public function __construct(Money $money){
        $this->money = $money;
    }

    public function pushMoney($idMoney){

        if(!$money){
            DB::table("moneys")
            ->insert([
                "name" => $idMoney,
            ]);
        }

    }

    public function getByName($name){
        return $this->entity->where("name", "=", $name);
    }

    public function findMoney($idmoney){
        
        $money = $this->entity->where("name", "=", $idMoney);
        return $money;
    }

}