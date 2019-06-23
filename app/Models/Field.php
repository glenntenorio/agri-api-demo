<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    //

    protected $fillable = [
        'user_id', 'name', 'crop_type', 'area'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
