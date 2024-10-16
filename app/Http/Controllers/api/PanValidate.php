<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pan_info;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PanValidate extends Controller
{
    public function pan_validate(Request $request)
    {
        try {
            $orgId = Auth::user()->org_id;
            $userId = Auth::user()->id;

            $rules = [
                "pan" => "required",
                "name_as_per_pan" => "required",
                "date_of_birth" => "required",
                "reason" => "required",
            ];
            $labels = [
                "pan" => "Pan Number",
                "name_as_per_pan" => "Name As Per Pan",
                "date_of_birth" => "Date Of Birth",
                "reason" => "Reason",
            ];

            $validation = Validator::make($request->all(), $rules, [], $labels);

            if ($validation->fails()) {
                return $validation->errors();
            }

            $api_subs_detail = DB::table('Pan_gst_api_subscriptions')
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

            DB::table('Pan_gst_api_subscriptions')
                ->where('id', $api_subs_detail[0]->id)
                ->update($new_pan_credit_use_data);

            $checkPan = DB::table('Pan_infos')
                ->where('pan', '=', $request->pan)
                ->get();
            $generateToken = generateSandBoxToken();

            $decodeToken = json_decode($generateToken, true);
            $sandbox_req_data = [
                "pan" => $request->pan,
                "name_as_per_pan" => $request->name_as_per_pan,
                "date_of_birth" => $request->date_of_birth,
                "consent" => "Y",
                "reason" => $request->reason
            ];
            $authorization = $decodeToken['access_token'];
            $res = SandBoxvalidatePan($sandbox_req_data, $authorization);

            $decode_data = json_decode($res, true);

            if (isset($decode_data['data']['status']) && !empty($decode_data['data']['status'])) {
                $entered_pan_data = array(
                    "org_id" => $orgId,
                    "user_id" => $userId,
                    'pan'       => $request->pan,
                    "name_as_per_pan" => $request->name_as_per_pan,
                    "date_of_birth" => $request->date_of_birth,
                    "consent" => "Y",
                    "reason" => $request->reason,
                    'status'         => $decode_data['data']['status'],
                    "remarks" => $decode_data['data']['remarks'],
                    "name_as_per_pan_match" => $decode_data['data']['name_as_per_pan_match'],
                    "date_of_birth_match" => $decode_data['data']['date_of_birth_match'],
                    "category" => $decode_data['data']['category'],
                    "aadhaar_seeding_status" => $decode_data['data']['aadhaar_seeding_status']
                );

                $entry_res = Pan_info::create($entered_pan_data);
                $message = array("StatusCode" => "AIV000", "StatusDesc" => $decode_data['data']);
                return response($message, 200);
            } else {
                $message = array("StatusCode" => "AIV002", "StatusDesc" => $decode_data);
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
