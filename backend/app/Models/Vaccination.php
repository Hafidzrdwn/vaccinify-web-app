<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $hidden = [
        'id',
        'date',
        'spot_id',
        'society_id',
        'vaccine_id',
        'doctor_id',
        'officer_id',
        'created_at',
        'updated_at'
    ];
    public $timestamps = false;

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    public function vaccinator()
    {
        return $this->belongsTo(Medical::class, 'doctor_id');
    }
}
