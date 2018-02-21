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

        return $favoris;
        
    }

    public function addFavoris(Request $request){

        $id = $request["id"];
        $name = $request["name"];

        $favoris = $this->favorisRepo->checkFavExist($id, $name);

        if(is_numeric($favoris)){
            $this->favorisRepo->createFavoris($id, $favoris);
            return json_encode("added");
        }else{
            return json_encode("exist");
        }       
    }

    public function deleteFavoris(Request $request){
        
            $id = $request["id"];
            $name = $request["name"];

            $favoris = $this->favorisRepo->checkFavExist($id, $name);

            if(!is_numeric($favoris)){
                $this->favorisRepo->deleteFavoris($id, $favoris->money_id);
                return json_encode("deleted");
            }else{
                return json_encode("noexist");
            }  
    }




}
