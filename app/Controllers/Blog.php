<?php

namespace App\Controllers;

class Blog extends BaseController
{
    public function index()
    {
        return view('templates/head')
             . view('templates/navbar')
             . view('blog/index')
             . view('templates/footer');
    }

    public function post($post_id)
    {
        return view('templates/head')
             . view('templates/navbar')
             . view('blog/post')
             . view('templates/footer');
    }

}
