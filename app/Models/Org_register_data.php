<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Org_register_data extends Model
{
    use HasFactory;
    protected $fillable = [
        'org_id',
        'org_ref_id',
        'org_name',
        'org_email',
        'org_phone',
        'org_gst_no',
        'org_address',
        'password',
    ];
    public static function attempt(array $credentials)
    {
        // Assume credentials contain 'email' and 'password'
        $customer = self::where('org_email', $credentials['org_email'])->first();
        // echo "<pre>";
        // print_r(check($credentials['password'], $customer->password)); die('ll');
        // if ($customer && Hash::check($credentials['password'], $customer->password)) {
        

        if ($customer && Hash::check($credentials['password'], $customer->password)) {
            // Authentication successful, you can log them in manually or take some action
            return $customer;
        }

        // Authentication failed
        return false;
    }
}
