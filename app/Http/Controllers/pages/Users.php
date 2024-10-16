<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class Users extends Controller
{
  public function index()
  {
    $user_details = User::all();
    return view('content.pages.users_view', compact('user_details'));
  }

  public function addUser(Request $request)
  {
    // return $request;
    if ($request->isMethod("post")) {

      // $this->validate(
      //   request(),
      //   [
      //     "name" => "required",
      //     "email" => "required",
      //     "phone" => "required",
      //     "password" => "required",

      //   ],
      //   [],
      //   [
      //     "name" => "Name",
      //     "email" => "Email",
      //     "phone" => "Phone",
      //     "password" => "Password"


      //   ]
      // );


      $validator = Validator::make(
        $request->all(),
        [
          'name' => 'required|string|max:255',
          'email' => 'required|email|unique:users',
          "phone" => "required",
          'password' => 'required|string|min:6',
        ],
        [],
        [
          "name" => "Name",
          "email" => "Email",
          "phone" => "Phone",
          "password" => "Password"


        ]
      );

      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }


      // return "kk";

      $randno = 'AMR' . rand(1000, 9999) . 'UR' . rand(1000, 9999);
      $user_data = array(
        "org_id" => session('org_id'),
        "name" => $request->name,
        "email" => $request->email,
        "phone" => $request->phone,
        "password" => Hash::make($request->password),
        "user_ref_id" => $randno

      );
      // return $user_data;


      $user_id = User::create($user_data);
      if ($user_id) {
        // $success_msj='User Added.';
        // session()->flash('success', 'Registration successful!');
        // return view('content.authentications.auth-register-basic',compact('success_msj'));
        return to_route('users')->with('success', 'User created successfully.');
      }
    }
    // return view('content.authentications.auth-register-basic');
  }
}
