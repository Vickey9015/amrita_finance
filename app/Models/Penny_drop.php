<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penny_drop extends Model
{
    use HasFactory;
    protected $fillable = [
        'org_id',
        'user_id',
        'name',
        'mobile',
        'account_number',
        'status',
        'message',
        'account_exists',
        'name_at_bank',
        'utr',
        'amount_deposited',
        'ifsc'

    ];
}
