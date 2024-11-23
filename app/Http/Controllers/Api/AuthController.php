<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function login(Request $request){
    $validator = Validator::make(
        $request->all(),
        [
            'username' => 'required',
            'password' => 'required',
        ]
    
       );



    //    dd($request->all());
    
       if ($validator->fails()){
        return response()->json([
            'status' =>'error',
            'message' =>'validation error',
            'errors' =>$validator->errors(),
            'data' =>[]
        ]);
       }


    
       $user = User::where('username',$request->username)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'status' => 'error',
            'massage' => 'user/password salah', 
        ],);
    }
    
    $token = $user->createToken('auth_token')->plainTextToken;
    
    return response()->json([
        'status'=>'succes',
        'message'=>'oke',
        'data' => [
    'id'=>$user->id,
    'nama'=>$user->nama,
    'token'=>$token
        ]
        ],200);
    

  }  

  public function logout(Request $request)
  {
    $user = $request->user();

    if ($user){
        $user->tokens()->delete();

        return response()->json([
            'status' => 'succes',
            'massage' => 'logout berhasil',

        ],200);
    }else {
        return response()->json([
            'status' => 'error',
            'massage' => 'user tidak di temukan atau sudah logout',
        ],404);


    }


  }



}