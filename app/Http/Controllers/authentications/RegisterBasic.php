<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Org_register_data;
use Illuminate\Support\Facades\Hash;


class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }
  public function register(Request $request)
  {
    if ($request->isMethod("post")) {
      // 

      $this->validate(
        request(),
        [
          "org_name" => "required",
          "org_email" => "required",
          "password" => "required",
          "re_password" => "required"

        ],
        [],
        [
          "org_name" => "Organisation Name",
          "org_email" => "Organisation Email",
          "password" => "Password",
          "re_password" => "Re-Password"


        ]
      );
      $randno='AMR'.rand(1000,9999);
      $org_register_data = array(
        "org_name" => $request->org_name,
        "org_email" => $request->org_email,
        "password" => Hash::make($request->password),
        "org_ref_id" =>$randno

      );


      $org_id =Org_register_data::create($org_register_data);
      if($org_id){
        $success_msj='Organisation Successfully Registered.';
        session()->flash('success', 'Registration successful!');
        return view('content.authentications.auth-register-basic',compact('success_msj'));

      }
    }
    return view('content.authentications.auth-register-basic');
  }
}
