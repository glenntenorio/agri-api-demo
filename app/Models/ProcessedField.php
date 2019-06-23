<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessedField extends Model
{
    //
    protected $fillable = [
        'user_id', 'tractor_id', 'field_id', 'processed_at', 'area_processed', 'approved_by_user_id', 'approved_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function approved_by()
    {
        return $this->belongsTo('App\Models\User','approved_by_user_id');
    }

    public function tractor()
    {
        return $this->belongsTo('App\Models\Tractor','tractor_id');
    }

    public function field()
    {
        return $this->belongsTo('App\Models\Field','field_id');
    }
}
