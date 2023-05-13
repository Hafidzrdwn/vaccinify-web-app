<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $hidden = [
        'id',
        'id_card_number',
        'password',
        'regional_id',
        'login_tokens'
    ];
    public $timestamps = false;

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    public function makeToken()
    {
        return md5($this->id_card_number);
    }
}
