<?php


namespace App\Repositories;

use App\Favoris;
use Illuminate\Support\Facades\DB;

class FavorisRepository extends DbRepository{

    public function __construct(Favoris $favoris){
        $this->entity = $favoris;
    }


    public function createFavoris($userId, $moneyId){
        DB::table("favoris")
            ->insert([
                "user_id" => $userId,
                "money_id" => $moneyId
            ]);
    }

    public function getFavoris($id){
            $favoris = DB::table("favoris")
                ->where("user_id" ,"=", $id)
                ->join("moneys", function($join) use($id){
                  $join->on("moneys.id", "=", "favoris.money_id");
                })->orderBy("favoris.money_id", 'asc')
                ->get(); 

            if(count($favoris) != 0){
                return $favoris;
            }else{
                return json_encode("empty");
            }
    }

    public function deleteFavoris($id, $name){
        $favoris = DB::table("favoris")
            ->where("user_id", "=", $id)
            ->where("money_id", "=", $name)
            ->delete();
    }

    public function checkFavExist($userId, $moneyName){

            $favoris = DB::table("favoris")
                ->where("user_id" ,"=", $userId)
                ->join("moneys", function($join) use($moneyName){
                    $join->on("moneys.id", "=", "favoris.money_id")
                    ->where("moneys.name", "=", $moneyName);
                })->first();

                if($favoris){
                    return $favoris;
                }else{
                    $money = DB::table("moneys")
                        ->where("name", "=", $moneyName)
                        ->first();
                    return $money->id;
                }
    }



}