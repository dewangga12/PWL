<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function marbeledu()
    {
        return view('category', ['title' => 'Marbel Edu Games']);
    }
    public function marbelkids()
    {
        return view('category', ['title' => 'Marbel And Friends Kids Games']);
    }
    public function riristory()
    {
        return view('category', ['title' => 'Riri Story Book']);
    }
    public function kolaksongs()
    {
        return view('category', ['title' => 'Kolak Kids Songs']);
    }
}
