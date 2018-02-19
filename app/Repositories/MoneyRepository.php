<?php


namespace App\Repositories;

use App\Money;
use Illuminate\Support\Facades\DB;

class MoneyRepository extends DbRepository{

    public function __construct(Money $money){
        $this->money = $money;
    }

    public function pushMoney($idMoney){
        DB::table("moneys")
        ->insert([
            "name" => $idMoney,
        ]);
    }

    public function getByName($name){
        $money = DB::table("moneys")
            ->where("name" ,"=", $name)
            ->first();
        if($money){
            return $money;
        }else{
            return false;
        }
    }

}