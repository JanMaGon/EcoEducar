<?php

namespace App\Controllers;

use App\Models\PostModel;

class Home extends BaseController
{
    public function index(): string
    {
        $postModel = new PostModel();

        helper('video'); 
        helper('text_helper'); 

        // Busca os últimos três posts onde deleted_at é null
        $data['posts'] = $postModel
            ->where('deleted_at', null) // Filtra posts não deletados
            ->orderBy('created_at', 'DESC') // Ordena por created_at em ordem decrescente
            ->findAll(3); // Limita o resultado a 3 registros

        return view('templates/head', $data)
             . view('templates/navbar', $data)
             . view('home/index', $data)
             . view('templates/footer', $data);
    }
}
