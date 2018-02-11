<?php

namespace App\Http\Controllers\Api\Auth;


use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\RegistersUsers;
use JWTAuth;
use Illuminate\Support\Facades\Validator;



class RegisterController extends Controller
{

    use RegistersUsers;
    use Helpers;
    
    private $userRepo;

    public function __construct(UserRepository $userRepo){
        $this->userRepo = $userRepo;
    }


    public function register(Request $request){

        $validator = $this->validator($request->all());


        if($validator->fails()){
            
            $errors = $validator->errors()->all();

            return $this->response->array([
                "message" => "error",
                "errors" => $errors
            ]);
        }


        $user = $this->userRepo->createUser($request->all());

        if($user){

            $token = JWTAuth::fromUser($user);

            return $this->response->array([
                "token" => $token,
                "message" => "success",
                "status_code" => 201,
                "currentUser" => $user
            ]);
        }else{
            return $this->response->error("User not found...", 404);
        }
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'username' => 'required|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);        
    }

}
