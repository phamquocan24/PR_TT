<?php
<<<<<<< HEAD
 
namespace Modules\Variation\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Variation extends Model
{
    use HasFactory, SoftDeletes;
 
=======

namespace Modules\Variation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variation extends Model
{
    use HasFactory, SoftDeletes;

>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'variations';
<<<<<<< HEAD
 
=======

>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'type',
        'is_global',
        'position',
    ];
<<<<<<< HEAD
 
=======

>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];
<<<<<<< HEAD
 
=======

>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_global' => 'boolean',
        'position' => 'integer',
    ];
}