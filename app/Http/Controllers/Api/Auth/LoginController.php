<?php
namespace App\Http\Controllers\Api\Auth;
use App\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use JWTAuth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    use Helpers;

    private $userRepo;

    public function __construct(UserRepository $userRepo){
        $this->userRepo = $userRepo;
    }

    public function login(Request $request){
        // $user = $this->userRepo->findUser($request->all());
        $user = $this->userRepo->findUser($request->all());
        if($user && Hash::check($request["password"], $user->password)){
            
            $token = JWTAuth::fromUser($user);
            return $this->sendLoginResponse($request, $token, $user);
        }
        return [
            "errors" => "Username or Email incorrect."
        ];
    }

    public function sendLoginResponse(Request $request, $token, $user){
        $this->clearLoginAttempts($request);
        return $this->authenticated($token, $user);
    }

    public function authenticated($token, $user){
        return $this->response->array([
            'token' => $token,
            'status_code' => 200,
            'message' => 'success',
            "currentUser" => $user
        ]);
    }    
}