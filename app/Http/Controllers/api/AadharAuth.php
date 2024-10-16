<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aadhar_data_with_user_info;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AadharAuth extends Controller
{
    public function aadharvalidation_details(Request $request)
    {
        try {
            $orgId = Auth::user()->org_id;
            $userId = Auth::user()->id;

            $rules = [
                "name" => "required",
                "email" => "required|email",
                "phoneNumber" => "required|numeric|digits:10",
                "aadhaar_number" => "required|numeric|digits:12"
            ];
            $labels = [
                "name" => "Name",
                "email" => "Email",
                "phoneNumber" => "Phone Number",
                "aadhaar_number" => "Aadhar Number"
            ];

            $validation = Validator::make($request->all(), $rules, [], $labels);

            if ($validation->fails()) {
                return $validation->errors();
            }

            $api_subs_detail = DB::table('Aadhar_api_subscriptions')
                ->where('org_id', '=', $orgId)
                ->get();

            if ($api_subs_detail[0]->credits == 0) {
                $error = array("StatusDesc" => "API usage limit reached.", "StatusCode" => "AIV003");
                return response($error, 200);
            }

            $credits_left = $api_subs_detail[0]->credits - 1;
            $api_calls_used = $api_subs_detail[0]->api_calls_used + 1;
            $new_pan_credit_use_data = [
                'credits'       => $credits_left,
                'api_calls_used' => $api_calls_used
            ];

            DB::table('Aadhar_api_subscriptions')
                ->where('id', $api_subs_detail[0]->id)
                ->update($new_pan_credit_use_data);

            // $maskedaadhaar_number =  str_pad(substr($request->aadhaar_number, -4), strlen($request->aadhaar_number), '*', STR_PAD_LEFT);

            $aadhar_data_with_user_info = array(
                'org_id' => Auth::user()->org_id,
                "user_id" => Auth::user()->id,
                "name" => $request->name,
                "email" => $request->email,
                "phoneNumber" => $request->phoneNumber,
                "aadhaar_number" => $request->aadhaar_number
            );
            $request_input = array(
                "reason" => 'verification',
                "consent" => 'y',
                "aadhaar_number" => $request->aadhaar_number
            );


            $entry_res = Aadhar_data_with_user_info::create($aadhar_data_with_user_info);

            $generateToken = generateSandBoxToken();
            $decodeToken = json_decode($generateToken, true);
            $authorization = $decodeToken['access_token'];
            $res = AadharGenerateOtp($request_input, $authorization);
            $response = json_decode($res);

            if ($response->code = 200) {
                if ($response->data->message == 'OTP sent successfully') {
                    $update_data = [
                        'res_genOtp_reference_id' => $response->data->reference_id,
                        'aadhar_auth_status' => 'Pending'
                    ];
                } else {

                    $update_data = [
                        'aadhar_auth_status' => $response->data->message
                    ];
                }
            } else {
                $update_data = [
                    'aadhar_auth_status' => 'Invalid Aadhaar number pattern'
                ];
            }

            DB::table('aadhar_data_with_user_infos')
                ->where('id', $entry_res['id'])
                ->update($update_data);



            $message = array("status" => TRUE, "statusDesc" => $response->data, 'aadhaar_number' => $request->aadhaar_number, 'last_id' => $entry_res['id']);
            return response($message, 200);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json([
                'error' => 'Something went wrong!',
                'message' => $e->getMessage()
            ], 500);
        }
    }




    public function otp_verify_aadharVal(Request $request)
    {
        try {

            $rules = [
                "otp" => "required|numeric|digits:6",
                "reference_id" => "required"
            ];
            $labels = [
                "otp" => "Otp",
                "reference_id" => "Reference Id"
            ];

            $validation = Validator::make($request->all(), $rules, [], $labels);

            if ($validation->fails()) {
                return $validation->errors();
            }

            $sandboxOtpData = [
                'otp' => $request->otp,
                'reference_id' => $request->reference_id
            ];

            $generateToken = generateSandBoxToken();
            $decodeToken = json_decode($generateToken, true);
            $authorization = $decodeToken['access_token'];

            $otp_submit_res = VerifyAadharOtp($sandboxOtpData, $authorization);
            $response = json_decode($otp_submit_res);

            if (!empty($response->data->reference_id)) {
                $aadharData = Aadhar_data_with_user_info::where(['res_genOtp_reference_id' => $request->reference_id])->first();

                DB::table('aadhar_data_with_user_infos')
                    ->where('id', $aadharData['id'])
                    ->update([
                        'res_name' => $response->data->name,
                        'res_dob' => $response->data->date_of_birth,
                        'res_gender' => $response->data->gender,
                        'res_address' => $response->data->full_address,
                        'res_care_of' => $response->data->care_of,
                        'res_image' => $response->data->photo,
                        'res_status' => $response->data->status,
                        'aadhar_auth_status' => 'Success'
                    ]);
            }

            $message = array("status" => TRUE, "statusDesc" => $response);
            return response($message, 200);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json([
                'error' => 'Something went wrong!',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
