<?php

namespace Modules\Product\Table;

use Modules\Admin\UI\AdminTable;

class ProductTable extends AdminTable
{
    protected array $rawColumns = ['price', 'in_stock'];

    public function make()
    {

    }
}
