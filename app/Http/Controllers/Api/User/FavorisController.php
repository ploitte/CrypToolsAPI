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

        $favoris = $this->favorisRepo->getFavoris($request->id);

        // $user = User::find(1)->favoris;

        return $favoris;

    }

    public function addFavoris(Request $request){

        $id = $request["id"];
        $name = $request["name"];
        $money =$this->moneyRepo->getByName($name);
        $favoris = $this->favorisRepo->checkFavExist($id, $money->id);

        if(!$favoris){
            $this->createFavoris($id, $money->id);
        }else{
            return json_encode("Favoris exist");
        }       

    }

    public function deleteFavoris(Request $request){

        $this->favorisRepo->deleteFavoris($request["id"], $request["name"]);

        return $request;
    }




}
