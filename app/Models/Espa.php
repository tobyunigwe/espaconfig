<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espa extends Model
{
    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function receivers()
    {
        return $this->hasMany(Receiver::class);
    }

    public function generals()
    {
        return $this->hasMany(General::class);
    }
    use HasFactory;
}
