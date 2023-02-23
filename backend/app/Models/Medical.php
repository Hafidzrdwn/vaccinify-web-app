<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    use HasFactory;

    protected $hidden = [
        'spot_id',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
