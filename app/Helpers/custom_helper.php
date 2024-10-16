<?php

function generateSandBoxToken()
{
  
  env('SANDBOX_SECRET', false);
  
  $sandBoxKey = env('SANDBOX_KEY', false);
  $sandBoxSecret = env('SANDBOX_SECRET', false);


  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.sandbox.co.in/authenticate",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => array(
      'x-api-key: ' . $sandBoxKey,
      'x-api-secret: ' .  $sandBoxSecret,
      'x-api-version: 3.4.0'
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    $error = "cURL Error #:" . $err;
    return $error;
  } else {
    return $response;
  }
}


function SandBoxvalidatePan1($pan, $authorization)
{
  $sandBoxKey = env('SANDBOX_KEY', false);

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.sandbox.co.in/pans/' . $pan . '/verify?consent=Y&reason=For%2520opening%2520Demat%2520account',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'x-api-key: ' . $sandBoxKey,
      'Authorization: ' . $authorization,
      'x-api-version: 3.5'
    ),
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
    $error = "cURL Error #:" . $err;
    return $error;
  } else {
    return $response;
  }
}




function SandBoxvalidatePan($sandBoxRequestDatas, $authorization)
{
  $sandBoxKey = env('SANDBOX_KEY', false);
  $sandBoxRequestDatas['@entity'] = 'in.co.sandbox.kyc.pan_verification.request';

  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.sandbox.co.in/kyc/pan/verify",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($sandBoxRequestDatas),
    CURLOPT_HTTPHEADER => [
      'x-api-key: ' . $sandBoxKey,
      'authorization: ' . $authorization,
      "accept: application/json",
      "content-type: application/json",
      "x-api-version: 3.5"
    ],
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}


function AadharGenerateOtp($sandBoxRequestDatas, $authorization)
{

  $sandBoxKey = env('SANDBOX_KEY', false);
  $sandBoxRequestDatas['@entity'] = 'in.co.sandbox.kyc.aadhaar.okyc.otp.request';
  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.sandbox.co.in/kyc/aadhaar/okyc/otp",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($sandBoxRequestDatas),
    CURLOPT_HTTPHEADER => [
      'x-api-key: ' . $sandBoxKey,
      'authorization: ' . $authorization,
      "accept: application/json",
      "content-type: application/json",
      "x-api-version: 2.0"
    ]
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}

function VerifyAadharOtp($sandBoxRequestDatas, $authorization)
{
  $sandBoxKey = env('SANDBOX_KEY', false);
  $sandBoxRequestDatas['@entity'] = 'in.co.sandbox.kyc.aadhaar.okyc.request';

  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.sandbox.co.in/kyc/aadhaar/okyc/otp/verify",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($sandBoxRequestDatas),
    CURLOPT_HTTPHEADER => [
      'x-api-key: ' . $sandBoxKey,
      'authorization: ' . $authorization,
      "accept: application/json",
      "content-type: application/json",
      "x-api-version: 2.0"
    ],
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}

function SandBoxPenny_drop($sandBoxRequestDatas, $authorization)
{

  $ifsc = $sandBoxRequestDatas['ifsc'];
  $account_no = $sandBoxRequestDatas['account_number'];
  $sandBoxKey = env('SANDBOX_KEY', false);

  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.sandbox.co.in/bank/$ifsc/accounts/$account_no/verify",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
      'x-api-key: ' . $sandBoxKey,
      'authorization: ' . $authorization,
      "accept: application/json",
      "content-type: application/json",
      "x-api-version: 2.0"
    ],
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}
