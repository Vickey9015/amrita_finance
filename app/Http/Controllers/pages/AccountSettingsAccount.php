<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aadhar_data_with_user_info;
use Illuminate\Support\Facades\DB;


class AccountSettingsAccount extends Controller
{
  public function index()
  {
    return view('content.pages.aadhar-authentication-validation');
  }
  public function aadharvalidate(Request $request)
  {

    if ($request->isMethod("post")) {


      $this->validate(
        request(),
        [
          "firstname" => "required",
          "lastname" => "required",
          "email" => "required|email",
          "phoneNumber" => "required|numeric|digits:10",
          "aadharno" => "required|numeric|digits:12"
        ],
        [],
        [
          "firstname" => "First Name",
          "lastname" => "Last name",
          "email" => "Email",
          "phoneNumber" => "Phone Number",
          "aadharno" => "Aadhar Number"

        ]
      );

      $entered_aadhar_data = array(
        "firstname" => $request->firstname,
        "lastname" => $request->lastname,
        "email" => $request->email,
        "phoneNumber" => $request->phoneNumber,
        "aadharno" => $request->aadharno
      );

      $maskedAadharNo =  str_pad(substr($request->aadharno, -4), strlen($request->aadharno), '*', STR_PAD_LEFT);

      $aadhar_data_with_user_info = array(
        'org_id' => session('org_id'),
        "user_ref_id" => session('user_ref_id'),
        "firstname" => $request->firstname,
        "lastname" => $request->lastname,
        "email" => $request->email,
        "phoneNumber" => $request->phoneNumber,
        "aadharno" => $maskedAadharNo

      );

      $check = Aadhar_data_with_user_info::create($aadhar_data_with_user_info);

      $res = aadharVerification($entered_aadhar_data);
      $response = json_decode($res);

      if ($response->status == 1) {
        // $aadhar_data_with_user_info['transaction_id'] = $response->data->transaction_id;
        $aadhar_data_with_user_info['transaction_id'] = 'TRSADHR'.RAND(10000,99999);
        $aadhar_data_with_user_info['status'] = 3;
        DB::table('aadhar_data_with_user_infos')
          ->where('id', $check['id'])
          ->update([
            'transaction_id' => $response->data->transaction_id,
            'status' => 3,
          ]);
      } else {
        DB::table('aadhar_data_with_user_infos')
          ->where('id', $check['id'])
          ->update([
            'status' => 2,
            'transaction_id' => 'N/A',
          ]);
      }

      $message = array("status" => TRUE, "statusDesc" => $response, 'aadhaarNumber' => '4555', 'last_id' => $check['id']);
      return response($message, 200);
    }
  }
  public function otp_verify(Request $request)
  {
    if ($request->isMethod("post")) {
      $this->validate(
        request(),
        [
          "otp" => "required|numeric|digits:6"
        ],
        [],
        [
          "otp" => "OTP"
        ]
      );

      $message = array("status" => TRUE, "statusDesc" => 'otp verified', 'aadhaarNumber' => '99898');
      return response($message, 200);
    }
  }
  public function aadhar_report_page()
  {
    $aadhar_details = Aadhar_data_with_user_info::all();
    return view('content.pages.aadhar_report_page',compact('aadhar_details'));
  }
}
