<?php


namespace App\Repositories;

use App\Favoris;
use Illuminate\Support\Facades\DB;

class FavorisRepository extends DbRepository{

    public function __construct(Favoris $favoris){
        $this->entity = $favoris;
    }

    public function getFavoris($id){
        $favoris = DB::table("favoris")
            ->where("user_id", "=", $id)
            ->select("favoris.name")
            ->get();

        return $favoris;
    }

    public function deleteFavoris($id, $name){
        $favoris = DB::table("favoris")
            ->where("user_id", "=", $id)
            ->where("name", "=", $name)
            ->delete();
    }

    public function createFavoris($userId, $moneyId){
        DB::table("favoris")
            ->insert([
                "user_id" => $userId,
                "name" => $moneyId
            ]);
    }



}