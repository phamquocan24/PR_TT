<?php
<<<<<<< HEAD

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
=======
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'is_required',
        'is_global',
        'position',
    ];

    protected $dates = ['deleted_at'];
}
>>>>>>> ffbf1d3 (20250321)
