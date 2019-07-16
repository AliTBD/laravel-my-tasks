<?php

namespace App\Http\Controllers;

use App\Task;

class PagesController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about-us');
    }

}
