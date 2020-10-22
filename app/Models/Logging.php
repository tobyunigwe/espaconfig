<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logging extends Model
{
    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }

    use HasFactory;
}
