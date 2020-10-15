<?php

namespace App\Models;

use App\Handin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actions_element extends Model
{
    public function actions(){
        return $this->hasMany(Actions::class,'actions_element_id');
    }
}
