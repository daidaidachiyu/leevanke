<?php

namespace App\Http\Controllers;


class AdminController extends Controller
{
    public function index()
    {

        return view('admin.index');
    }

    public function test()
    {

        return view('admin.test');
    }

    public function test1()
    {

        return view('admin.test1');
    }
}
