<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('templates/head')
             . view('templates/navbar')
             . view('home/index')
             . view('templates/footer');
    }
}
