<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Pivot
{
    protected $table = 'product_categories';
}
