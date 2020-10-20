<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Config extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
         'version'
    ];

    public function espa()
    {
        return $this->hasone('App\Models\Espa');
    }


}
