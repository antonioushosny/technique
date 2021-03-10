<?php

namespace Modules\Admin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('admin::admin.dashboard.home');
    }
}
