<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aadhar_data_with_user_info extends Model
{
    use HasFactory;
    protected $fillable = [
        'org_id',
        'user_id',
        'user_ref_id',
        'name',
        'email',
        'phoneNumber',
        'aadhaar_number',
        'res_genOtp_reference_id',
        'res_status',
        'res_name',
        'res_dob',
        'res_gender',
        'res_address',
        'res_care_of',
        'res_image',
        'aadhar_auth_status',
        'created_at',
        'updated_at'

    ];
}
        