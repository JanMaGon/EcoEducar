<?php 
namespace App\Controllers;

use \App\Models\PostModel;
use \App\Models\PostGalleryModel;

class Posts extends BaseController
{

    protected $postModel;
    protected $postGalleryModel;
    
    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->postGalleryModel = new PostGalleryModel();
    }

    public function index()
    {
        // passar dados para as views se necessário
        $session = session();
        $currentPage = $this->request->getVar('page') ?? 1;

        // Se não for admin, mostra apenas os posts do usuário
        /*if ($session->get('role') !== 'admin') {
            $this->postModel->where('user_id', $session->get('id'));
        }*/

        $posts = $this->postModel->orderBy('created_at', 'DESC')
                                ->paginate(20, 'default', $currentPage);

        $data = [
            'title' => 'Posts',
            'user' => [
                'role' => $session->get('role'),
                'name' => $session->get('name'),
                'id' => $session->get('id')
            ],
            'posts' => $posts,
            'pager' => $this->postModel->pager,
            'isTrash' => false
        ];

        // Carrega as views em ordem, passando os dados para cada uma
        return view('templates/head', $data)
             . view('templates/sidebar', $data)
             . view('posts/index', $data)
             . view('templates/footer', $data);
    }

    public function trash()
    {
        $session = session();
        $currentPage = $this->request->getVar('page') ?? 1;
        
        $this->postModel->onlyDeleted();
        
        // Se não for admin, mostra apenas os posts deletados do usuário
        if ($session->get('role') !== 'admin') {
            $this->postModel->where('user_id', $session->get('id'));
        }
        
        $posts = $this->postModel->orderBy('deleted_at', 'DESC')
                                ->paginate(20, 'default', $currentPage);
                                
        $data = [
            'title' => 'Lixeira',
            'user' => [
                'role' => $session->get('role'),
                'name' => $session->get('name'),
                'id' => $session->get('id')
            ],
            'posts' => $posts,
            'pager' => $this->postModel->pager,
            'isTrash' => true
        ];

        return view('templates/head', $data)
             . view('templates/sidebar', $data)
             . view('posts/index', $data)
             . view('templates/footer', $data);
    }

    public function delete($id)
    {
        $session = session();
        $post = $this->postModel->find($id);
        
        // Verifica permissão
        if (!$post || ($session->get('role') !== 'admin' && $post['user_id'] !== $session->get('id'))) {
            return redirect()->to('/posts')->with('error', 'Acesso negado');
        }
        
        $this->postModel->delete($id);
        return redirect()->to(base_url('posts'))->with('message', 'Post movido para lixeira');
    }

    public function forceDelete($id)
    {
        $session = session();
        $post = $this->postModel->onlyDeleted()->find($id);
        
        // Verifica permissão
        if (!$post || ($session->get('role') !== 'admin' && $post['user_id'] !== $session->get('id'))) {
            return redirect()->to('/posts/trash')->with('error', 'Acesso negado');
        }
        
        // Busca imagens da galeria
        $gallery = $this->postGalleryModel->where('post_id', $id)->findAll();
        
        // Remove arquivos físicos
        foreach ($gallery as $item) {
            $imagePath = FCPATH . 'assets/image/posts/gallery/' . $item['image_name'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        // Remove registro do banco
        $this->postModel->delete($id, true);
        
        return redirect()->to(base_url('posts/trash'))->with('message', 'Post excluído permanentemente');
    }

    public function restore($id)
    {
        
        $session = session();
        $post = $this->postModel->onlyDeleted()->find($id);
        
        // Verifica permissão
        if (!$post || ($session->get('role') !== 'admin' && $post['user_id'] !== $session->get('id'))) {
            return redirect()->to(base_url('posts/trash'))->with('error', 'Acesso negado');
        }
        
        // Verifica se o post foi encontrado
        if ($post) {
            // Restaura o post
            $this->postModel->update($id, ['deleted_at' => null]);
            return redirect()->to(base_url('posts/trash'))->with('message', 'Post restaurado');
        } else {
            return redirect()->to(base_url('posts/trash'))->with('error', 'Post não encontrado');
        }
    }
}