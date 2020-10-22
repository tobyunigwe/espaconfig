<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    public function espa()
    {
        return $this->belongsToMany(Espa::class);
    }

    public function main()
    {
        return $this->hasOne(Main::class);
    }

    public function heartbeat()
    {
        return $this->hasOne(Heartbeat::class);
    }

    public function communication()
    {
        return $this->hasOne(Communication::class);
    }

    public function logging()
    {
        return $this->hasMany(Logging::class);
    }

    use HasFactory;
}
