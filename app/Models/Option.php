<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'type', 'is_required', 'is_global', 'position'
    ];

    public function values()
    {
        return $this->hasMany(OptionValue::class);
    }
}
