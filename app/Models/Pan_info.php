<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pan_info extends Model
{
    use HasFactory;
    protected $fillable = [
        'org_id',
        'user_id',
        'pan',
        'name_as_per_pan',
        'date_of_birth',
        'consent',
        'reason',
        'status',
        'remarks',
        'name_as_per_pan_match',
        'date_of_birth_match',
        'category',
        'aadhaar_seeding_status'

    ];
}
