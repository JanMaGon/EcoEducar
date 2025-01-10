<?php 
namespace App\Controllers;

use \App\Models\PostModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // passar dados para as views se necessário
        $session = session();
        $postModel = new PostModel();
        // Busca os últimos 10 posts
        $posts = $postModel->orderBy('created_at', 'DESC')
                          ->limit(10)
                          ->findAll();
        $data = [
            'title' => 'Dashboard',
            'user' => [
                'role' => $session->get('role'),
                'name' => $session->get('name')
            ],
            'posts' => $posts
        ];

        // Carrega as views em ordem, passando os dados para cada uma
        return view('templates/head', $data)
             . view('templates/sidebar', $data)
             . view('dashboard/index', $data)
             . view('templates/footer', $data);
    }
}