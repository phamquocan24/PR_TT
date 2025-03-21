<?php
 
namespace Modules\Variation\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Variation extends Model
{
    use HasFactory, SoftDeletes;
 
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'variations';
 
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
 
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];
 
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