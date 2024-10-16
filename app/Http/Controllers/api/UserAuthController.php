<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function login(Request $request){
        
        $user=User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return ['result'=>"Unauthorised Access.","Success"=>false];
        }else{
            $success['token']=$user->createToken('MyApp')->plainTextToken; 
            $success['name']=$user->name;
            return['result'=>$success,'msg'=>"User logged In Successfully."];
        }
        
    }

    public function generate_token(Request $request){
        $api_key=$request->header('api-key');
        $user=User::where('api_key',$api_key)->first();
        if(!$user){
            return ['result'=>"Unauthorised Access.","Success"=>false];
        }else{
            $success['token']=$user->createToken('MyApp')->plainTextToken; 
            $success['name']=$user->name;
            return['result'=>$success,'msg'=>"User logged In Successfully."];
        }
    }

}
