<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function sobreOProjeto(): string
    {
        return view('templates/head')
             . view('templates/navbar')
             . view('pages/sobreOProjeto')
             . view('templates/footer');
    }

    public function locaisDeDescarte(): string
    {
        return view('templates/head')
             . view('templates/navbar')
             . view('pages/locaisDeDescarte')
             . view('templates/footer');
    }

    public function participe(): string
    {
        return view('templates/head')
             . view('templates/navbar')
             . view('pages/participe')
             . view('templates/footer');
    }

}
