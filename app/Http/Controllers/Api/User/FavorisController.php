<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FavorisRepository;
use App\User;
use App\Favoris;

class FavorisController extends Controller
{   
    private $favorisRepo;

    public function __construct(FavorisRepository $favorisRepo){
        $this->favorisRepo = $favorisRepo;
    }

    public function getFavoris(Request $request){

        $favoris = $this->favorisRepo->getFavoris($request->id);

        // $user = User::find(1)->favoris;

        return $favoris;

    }

    public function addFavoris(Request $request){

        // $id = $request["id"];
        // $name = $request["name"];

        // $user = $this->userRepo->getById($îd);
        // $money = $this->moneyRepo->getByName($name);

        //getMoneyByname
        //getUserbyId
        //Create favoris



    }

    public function deleteFavoris(Request $request){

        $this->favorisRepo->deleteFavoris($request["id"], $request["name"]);

        return $request;
    }




}
