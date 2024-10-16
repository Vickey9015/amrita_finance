<?php

namespace App\Http\Controllers\authentications;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Org_register_data;



class LoginBasic extends Controller
{

  public function index(Request $request)
  {

    if ($request->isMethod("post")) {
      // print_r($request->email);die();

      $this->validate(
        request(),
        [
          "email" => "required",
          "password" => "required"
        ],
        [],
        [
          "email" => "Email",
          "password" => "Password"

        ]
      );

      if (Auth::attempt([
        "email" => $request->email,
        "password" => $request->password
      ])) {
        // dd(auth()->user());
        Session::put('org_id', auth()->user()->org_id);
        Session::put('user_ref_id', auth()->user()->user_ref_id);

        Session::put('org_id', auth()->user()->org_id );
        Session::put('org_name', auth()->user()->name );
        Session::put('org_ref_id', auth()->user()->user_ref_id );

        Session::put('login_type', 'org_user');

        return to_route("dashboard-analytics");
      } else {

        return to_route("auth-login-basic")->with("error", "Invalid login details");
      }
    }
    return view("content.authentications.auth-login-basic");
  }
  public function logout()
  {

    if (Session::get('login_type') == 'orgs') {
      Session::flush();

      Auth::logout();
      return to_route("organisation-login")->with("success", "Logged out successfully");
    } else if (Session::get('login_type') == 'org_user') {
      Session::flush();

      Auth::logout();
      return to_route("auth-login-basic")->with("success", "Logged out successfully");
    }
  }
  public function org_login(Request $request)
  {
    if ($request->isMethod("post")) {
      // print_r($request->password);die();

      $this->validate(
        request(),
        [
          "email" => "required",
          "password" => "required"
        ],
        [],
        [
          "email" => "Email",
          "password" => "Password"

        ]
      );
      $aadhar_details = Org_register_data::all();


      $customer = Org_register_data::attempt([
        "org_email" => $request->email,
        "password" => $request->password
      ]);
      // return $customer;
      // echo "<pre>";
      // print_r($customer );
      // print_r($customer['org_name'] );
      // die('lllk'); 

      if ($customer) {

        Session::put('org_id', $customer['id'] );
        Session::put('org_name', $customer['org_name'] );
        Session::put('org_ref_id', $customer['org_ref_id'] );
        Session::put('login_type', 'orgs');
        // dd('dd');
        return to_route("dashboard-analytics");
      } else {

        return to_route("auth-login-basic")->with("error", "Invalid login details");
      }
    }
    return view("content.authentications.auth-login_org-basic");
  }
}
