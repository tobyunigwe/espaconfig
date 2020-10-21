<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    protected $fillable = [
        'rule_id', 'what','text'
    ];
    public function match(){
        return $this->belongsTo(Rule::class);
    }
}
