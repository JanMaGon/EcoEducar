<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\PostGalleryModel;

class Blog extends BaseController
{
    public function index()
    {

        $postModel = new PostModel();

        helper('video'); 
        helper('text_helper'); 
        
        $data['posts'] = $postModel
            ->where('deleted_at', null) 
            ->orderBy('created_at', 'DESC') 
            ->findAll();

        return view('templates/head', $data)
             . view('templates/navbar', $data)
             . view('blog/index', $data)
             . view('templates/footer', $data);
    }

    public function post($post_id)
    {
        
        $postModel    = new PostModel();
        $galleryModel = new PostGalleryModel();

        helper('video');

        $data['post'] = $postModel->find($post_id);

        if (!$data['post']) {
            // Se o post não for encontrado, redirecione ou exiba uma mensagem de erro
            return redirect()->to(base_url())->with('error', 'Post não encontrado.');
        }
    
        // Busca as imagens relacionadas ao post
        $data['gallery'] = $galleryModel->where('post_id', $post_id)->findAll();

        return view('templates/head', $data)
             . view('templates/navbar', $data)
             . view('blog/post', $data)
             . view('templates/footer', $data);
    }

}
