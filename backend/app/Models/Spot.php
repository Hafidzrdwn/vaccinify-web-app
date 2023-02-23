<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $hidden = [
        'regional_id',
        'created_at',
        'updated_at'
    ];

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }
}
