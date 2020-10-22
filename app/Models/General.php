<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    public function espa()
    {
        return $this->belongsToMany(Espa::class);
    }
    use HasFactory;
}
