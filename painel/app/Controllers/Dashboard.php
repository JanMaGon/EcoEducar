<?php 
namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // Você pode passar dados para as views se necessário
        $data = [
            'title' => 'Dashboard',
            // outros dados...
        ];

        // Carrega as views em ordem, passando os dados para cada uma
        return view('templates/head', $data)
             . view('templates/sidebar', $data)
             . view('dashboard/index', $data)
             . view('templates/footer', $data);
    }
}