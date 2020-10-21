<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'espa_id', 'name',
    ];

    public function espa()
    {
        return $this->belongsToMany(Espa::class);
    }

    public function match()
    {
        return $this->hasmany('App\Models\Match');
    }

}
