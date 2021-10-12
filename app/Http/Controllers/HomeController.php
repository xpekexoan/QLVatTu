<?php

namespace App\Http\Controllers;

use App\Helpers\Facade\FormatDate;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
}
