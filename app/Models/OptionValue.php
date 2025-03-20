<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    protected $fillable = [
        'option_id', 'price', 'price_type', 'position'
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
