<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{

    public function actions_element()
    {
        return $this->belongsTo(Actions_element::class);
    }

    public function message()
    {
        return $this->hasOne(Message::class, 'action_id');
    }

    use HasFactory;

}
