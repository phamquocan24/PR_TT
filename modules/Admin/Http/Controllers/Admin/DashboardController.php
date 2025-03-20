<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Response;


class DashboardController
{
    /**
     * Display the dashboard with its widgets.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin::dashboard.index');
    }
}
