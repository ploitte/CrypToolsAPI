<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FavorisRepository;
use App\Repositories\MoneyRepository;
use App\User;
use App\Favoris;

class FavorisController extends Controller
{   
    private $favorisRepo;
    private $moneyRepo;

    public function __construct(FavorisRepository $favorisRepo, MoneyRepository $moneyRepo){
        $this->favorisRepo = $favorisRepo;
        $this->moneyRepo = $moneyRepo;

    }

    public function getFavoris(Request $request){

        $id = $request["id"];
        $favoris = $this->favorisRepo->getFavoris($id);

        if(!$favoris){
            return json_encode("Pas de favoris");
        }else{
            return $favoris;
        }

    }

    public function addFavoris(Request $request){

        $id = $request["id"];
        $name = $request["name"];

        $favoris = $this->favorisRepo->checkFavExist($id, $name);



        if(is_numeric($favoris)){
            $this->favorisRepo->createFavoris($id, $favoris);
            return json_encode("Favoris added");
        }else{
            return json_encode("Favoris exist");
        }       
    }

    public function deleteFavoris(Request $request){

        
            $id = $request["id"];
            $name = $request["name"];

            $favoris = $this->favorisRepo->checkFavExist($id, $name);

            if(!is_numeric($favoris)){
                $this->favorisRepo->deleteFavoris($id, $favoris->money_id);
                return json_encode("Favoris deleted");
            }else{
                return json_encode("Ce favoris n'existe pas");
            }  
    }




}
