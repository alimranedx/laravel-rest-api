<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:4'

        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validate(),
            ['password' => bcrypt($request->password)]
        ));
        if($user){
            return response()->json([
                'message' => 'User Register Successfully',
                'user' => $user
            ], 200);
        }

    }
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required|min:4'

        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }
        if(!$token = auth()->attempt($validator->validate())){
            return response()->json(['error' => 'unauthorized'], 401);
        }
        return $this->createToken($token);
    }
    public function createToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()*60,
            'user' => auth()->user()
        ]);

    }

    public function profile(){
        dd(session()->all());
        return response()->json(auth()->user());
    }
    public function logout(){
        auth()->logout();
        return response()->json([
            'message' => "User logout successfully"
        ]);
    }
}
