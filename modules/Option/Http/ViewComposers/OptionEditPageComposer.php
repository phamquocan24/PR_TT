<?php

namespace Modules\Product\Http\ViewComposers;

use Illuminate\View\View;

class OptionEditPageComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([]);
    }
}
