<?php


namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends DbRepository{

    public function __construct(User $user){
        $this->entity = $user;
    }

    public function createUser(array $data){
        return $this->entity->create([
            "username" => $data["username"],
            "email" => $data["email"],
            "password" => bcrypt($data["password"]),
        ]);
    }

    public function findUser(array $data){
        // return DB::table("users")
        //     ->where("username", "=", $data["usernameEmail"])
        //     ->orwhere("email", "=", $data["usernameEmail"])
        //     ->get();

        return $this->entity->where("username", "=", $data["usernameEmail"])->orWhere("email", "=", $data["usernameEmail"])->first();
    }

    public function getUserByName($name){
        return $this->entity->where("username", "=", $name);
    }

    public function getById($id){
        return DB::table("users")
            ->where("id", "=", $id)
            ->first();
      
    }


}