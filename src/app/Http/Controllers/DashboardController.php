<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock']);

        return view('pages/dashboards.index');
    }
}
