<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pan_gst_api_subscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'org_id',
        'api_name',
        'credits',
        'api_calls_used' ,
        'start_date',
        'end_date'
    ];	

}
