<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Penny_drop;


class PennyDrop extends Controller
{
    public function penny_drop(Request $request)
    {
        try {
            $orgId = Auth::user()->org_id;
            $userId = Auth::user()->id;

            $rules = [
                "name" => "required",
                "mobile" => "required",
                "account_number" => "required",
                "ifsc" => "required"
            ];
            $labels = [
                "name" => "Name",
                "mobile" => "Mobile No.",
                "account_number" => "Account Number",
                "ifsc" => "IFSC"

            ];

            $validation = Validator::make($request->all(), $rules, [], $labels);

            if ($validation->fails()) {
                return $validation->errors();
            }

            $api_subs_detail = DB::table('PennyDrop_api_subscriptions')
                ->where('org_id', '=', $orgId)
                ->get();


            if ($api_subs_detail[0]->credits == 0) {
                $error = array("StatusDesc" => "API usage limit reached.", "StatusCode" => "AIV003");
                return response($error, 200);
            }

            $credits_left = $api_subs_detail[0]->credits - 1;
            $api_calls_used = $api_subs_detail[0]->api_calls_used + 1;
            $new_pennyDrop_credit_use_data = [
                'credits'       => $credits_left,
                'api_calls_used' => $api_calls_used
            ];

            DB::table('PennyDrop_api_subscriptions')
                ->where('id', $api_subs_detail[0]->id)
                ->update($new_pennyDrop_credit_use_data);


            $generateToken = generateSandBoxToken();

            $decodeToken = json_decode($generateToken, true);

            $authorization = $decodeToken['access_token'];
            // return $authorization;
            $sandBoxRequestDatas = array(
                'name'       => $request->name,
                'mobile'       => $request->mobile,
                'account_number' => $request->account_number,
                'ifsc'       => $request->ifsc
            );
            $res = SandBoxPenny_drop($sandBoxRequestDatas, $authorization);
            $response = json_decode($res, true);
            // return ($response['code']);

            if ($response['code'] == 200) {

                if (isset($response['data']['utr']) && !empty($response['data']['utr'])) {
                    $penny_data = array(
                        "org_id" => $orgId,
                        "user_id" => $userId,
                        'name'       => $request->name,
                        'mobile'       => $request->mobile,
                        'account_number' => $request->account_number,
                        'ifsc'       => $request->ifsc,
                        'status' => 'Success',
                        'message' => $response['data']['message'],
                        'account_exists' => $response['data']['account_exists'],
                        'name_at_bank' => $response['data']['name_at_bank'],
                        'utr' => $response['data']['utr'],
                        'amount_deposited' => $response['data']['amount_deposited']

                    );
                    $entry_res = Penny_drop::create($penny_data);
                    $message = array("StatusCode" => "AIV000", "StatusDesc" => $response['data']);
                    return response($message, 200);
                } else {
                    $penny_data = array(
                        "org_id" => $orgId,
                        "user_id" => $userId,
                        'name'       => $request->name,
                        'mobile'       => $request->mobile,
                        'account_number' => $request->account_number,
                        'ifsc'       => $request->ifsc,
                        'status' => 'Failed',
                        'message' => $response['data']['message']

                    );
                    $entry_res = Penny_drop::create($penny_data);

                    $message = array("StatusCode" => "AIV002", "StatusDesc" => $response);
                    return response($message, 200);
                }
            } else {
                $penny_data = array(
                    "org_id" => $orgId,
                    "user_id" => $userId,
                    'name'       => $request->name,
                    'mobile'       => $request->mobile,
                    'account_number' => $request->account_number,
                    'ifsc'       => $request->ifsc,
                    'status' => 'Failed',
                    'message' => $response['message']

                );
                $entry_res = Penny_drop::create($penny_data);

                $message = array("StatusCode" => "AIV002", "StatusDesc" => $response);
                return response($message, 200);
            }
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json([
                'error' => 'Something went wrong!',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
