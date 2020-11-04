<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'json', 'mac_address',
    ];

    protected $casts = [

        // if its name was different you could use:
        // 'another_column' => 'json',
        'espasdr' => 'json',
    ];

    public function getLinkAttribute()
    {
        return '/api/configurations/' . $this->id;
    }

}
