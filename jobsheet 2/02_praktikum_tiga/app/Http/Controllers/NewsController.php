<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __invoke($param = null)
    {
        return view('news', ['article' => $param]); 
    }
}
