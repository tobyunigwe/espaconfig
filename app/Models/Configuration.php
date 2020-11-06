<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'config', 'mac_address',
    ];

    protected $casts = [

        // if its name was different you could use:
        // 'another_column' => 'json',
        'data' => 'array',
    ];

    public function getLinkAttribute()
    {
        return '/api/configurations/' . $this->id;
    }

}
