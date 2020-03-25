<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
    	# code...
    }

    /**
     * [dashboard index view]
     * @return [type] [blde templade view in dashboard index]
     */
    public function dashboard()
    {
    	return view('admin.dashboard.index');
    }

}
