<?php

namespace App\Models;

use App\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    public function api()
    {
        return $this->belongsTo(Api::class);
    }

    public function general()
    {
        return $this->belongsTo(General::class);
    }

    public function actions_element()
    {
        return $this->belongsTo(Actions_element::class);
    }

    public function espa()
    {
        return $this->belongsTo(Espa::class);
    }

    public function sdr()
    {
        return $this->belongsTo(Sdr::class);
    }

    public function modem()
    {
        return $this->belongsTo(Modem::class);
    }


}
