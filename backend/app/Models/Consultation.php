<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $hidden = ['society_id', 'doctor_id'];
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $with = ['doctor'];

    public function doctor()
    {
        return $this->belongsTo(Medical::class, 'doctor_id', 'id');
    }
}
