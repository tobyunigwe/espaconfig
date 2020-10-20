<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Espa extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'config_id', 'enabled',
    ];

    public function config(){
        return $this->belongsTo(Config::class);
    }

}
