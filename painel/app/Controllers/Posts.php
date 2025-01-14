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

        $session = session();
        // Verifica se o usuário está logado
        if (!$session->get('user_id')) {
            return redirect()->to(base_url())->with('error', 'Você precisa estar logado para acessar esta página.');
        }
    }

    public function index()
    {
        // passar dados para as views se necessário
        $session = session();
        $currentPage = $this->request->getVar('page') ?? 1;

        $posts = $this->postModel->orderBy('created_at', 'DESC')
                                ->paginate(20, 'default', $currentPage);

        $data = [
            'title' => 'Posts',
            'user' => [
                'role' => $session->get('role'),
                'name' => $session->get('name'),
                'id' => $session->get('user_id')
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
                'id' => $session->get('user_id')
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

    public function create()
    {
        $session = session();
        $data = [
            'title' => 'Novo Post',
            'user' => [
                'role' => $session->get('role'),
                'name' => $session->get('name'),
                'id' => $session->get('user_id')
            ]
        ];

        return view('templates/head', $data)
            . view('templates/sidebar', $data)
            . view('posts/form', $data)
            . view('templates/footer', $data);
    }

    public function edit($id)
    {
        $session = session();
        $post = $this->postModel->find($id);
        
        // Check permission
        if (!$post || ($session->get('role') !== 'admin' && $post['user_id'] !== $session->get('id'))) {
            return redirect()->to(base_url('posts'))->with('error', 'Acesso negado');
        }
        
        $data = [
            'title' => 'Editar Post',
            'user' => [
                'role' => $session->get('role'),
                'name' => $session->get('name'),
                'id' => $session->get('user_id')
            ],
            'post' => $post,
            'gallery' => $this->postGalleryModel->where('post_id', $id)->findAll()
        ];
    
        return view('templates/head', $data)
             . view('templates/sidebar', $data)
             . view('posts/form', $data)
             . view('templates/footer', $data);
    }

    public function store()
    {
        $session = session();
        
        if (empty($this->request->getPost('cover_type'))) {
            $cover_type = null;
        } else {
            $cover_type = $this->request->getPost('cover_type');
        }

        $allFiles = $this->request->getFiles();

        // Prepare post data
        $postData = [
            'user_id' => $session->get('user_id'),
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'author_name' => $this->request->getPost('author_name'),
            'cover_type' => $cover_type,
            'cover_content' => null,
            'deleted_at' => null
        ];

        // Handle cover upload/content
        if ($postData['cover_type'] === 'image') {
            $cover = $allFiles['cover_image'];
            if ($cover->isValid() && !$cover->hasMoved()) {
                $newName = $cover->getRandomName();
                $cover->move('C:/wamp64/www/ecoeducar/public/assets/image/posts/covers', $newName);
                $postData['cover_content'] = $newName;
            }
        } else if ($postData['cover_type'] === 'video') {
            $postData['cover_content'] = $this->request->getPost('cover_video');
        }

        // Save post
        if ($this->postModel->insert($postData)) {

            $postId = $this->postModel->getInsertID();
           
            // Verifica se há arquivos da galeria
            if (!empty($allFiles['gallery'])) {

                $galleryFiles = $allFiles['gallery'];                

                foreach ($galleryFiles as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move('C:/wamp64/www/ecoeducar/public/assets/image/posts/gallery', $newName);
                        // Associar a imagem ao post usando o ID do post
                        $this->postGalleryModel->insert([
                            'post_id' => $postId,
                            'image_name' => $newName
                        ]);
                    }
                }
            }
            
            return redirect()->to(base_url('posts'))->with('message', 'Post criado com sucesso');
            
        }
        
       return redirect()->to(base_url('posts/create'))->with('error', 'Erro ao criar post');
    }

    public function update($id)
    {
        $session = session();
        $post = $this->postModel->find($id);

        $allFiles = $this->request->getFiles();
        
        // Check permission
        if (!$post || ($session->get('role') !== 'admin' && $post['user_id'] !== $session->get('id'))) {
            return redirect()->to(base_url('posts'))->with('error', 'Acesso negado');
        }
        
        // Prepare post data
        $postData = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'author_name' => $this->request->getPost('author_name'),
            'cover_type' => $this->request->getPost('cover_type'),
        ];

        // Handle cover upload/content
        if ($postData['cover_type'] === 'image') {
            
            $cover = $allFiles['cover_image'];
            if ($cover && $cover->isValid() && !$cover->hasMoved()) {
                // Remove old cover image if exists
                if ($post['cover_type'] === 'image' && $post['cover_content']) {
                    $oldCoverPath = 'C:/wamp64/www/ecoeducar/public/assets/image/posts/covers/' . $post['cover_content'];
                    if (file_exists($oldCoverPath)) {
                        unlink($oldCoverPath);
                    }
                }
                
                $newName = $cover->getRandomName();
                $cover->move('C:/wamp64/www/ecoeducar/public/assets/image/posts/covers', $newName);
                $postData['cover_content'] = $newName;
            }
        } else if ($postData['cover_type'] === 'video') {
            $postData['cover_content'] = $this->request->getPost('cover_video');
            
            // Remove old cover image if exists
            if ($post['cover_type'] === 'image' && $post['cover_content']) {
                $oldCoverPath = 'C:/wamp64/www/ecoeducar/public/assets/image/posts/covers/' . $post['cover_content'];
                if (file_exists($oldCoverPath)) {
                    unlink($oldCoverPath);
                }
            }
        } else {
            $postData['cover_content'] = null;
            
            // Remove old cover image if exists
            if ($post['cover_type'] === 'image' && $post['cover_content']) {
                $oldCoverPath = 'C:/wamp64/www/ecoeducar/public/assets/image/posts/covers/' . $post['cover_content'];
                if (file_exists($oldCoverPath)) {
                    unlink($oldCoverPath);
                }
            }
        }

        // Update post
        if ($this->postModel->update($id, $postData)) {
            return redirect()->to(base_url('posts'))->with('message', 'Post atualizado com sucesso');
        }
        
        return redirect()->back()->withInput()->with('error', 'Erro ao atualizar post');
    }

    // Handle gallery image uploads via AJAX
    public function uploadGallery($postId)
    {
        $session = session();
        
        // If postId is provided, verify permission
        if ($postId) {
            $post = $this->postModel->find($postId);
            if (!$post || ($session->get('role') !== 'admin' && $post['user_id'] !== $session->get('id'))) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Acesso negado'
                ]);
            }
        }
        
        $allFiles = $this->request->getFiles();
        $files    = $allFiles['gallery'];
        $response = ['success' => true, 'files' => []];
        
        foreach ($files as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('C:/wamp64/www/ecoeducar/public/assets/image/posts/gallery', $newName);
                
                if ($postId) {
                    $galleryData = [
                        'post_id' => $postId,
                        'image_name' => $newName
                    ];
                    
                    $imageId = $this->postGalleryModel->insert($galleryData);
                } else {
                    $imageId = 'temp_' . time(); // Temporary ID for new posts
                }
                
                $response['files'][] = [
                    'id' => $imageId,
                    'name' => $newName,
                    'url' => 'http://localhost/ecoeducar/assets/image/posts/gallery/' . $newName
                ];
            }
        }
        
        return $this->response->setJSON($response);
    }

    // Remove gallery image
    public function removeGalleryImage($id)
    {
        $session = session();
        $image = $this->postGalleryModel->find($id);
        
        if (!$image) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Imagem não encontrada'
            ]);
        }
        
        // Verify permission through post ownership
        $post = $this->postModel->find($image['post_id']);
        if (!$post || ($session->get('role') !== 'admin' && $post['user_id'] !== $session->get('id'))) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Acesso negado'
            ]);
        }
        
        // Remove physical file
        $imagePath = 'C:/wamp64/www/ecoeducar/public/assets/image/posts/gallery/' . $image['image_name'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        
        // Remove database record
        $this->postGalleryModel->delete($id);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Imagem removida com sucesso'
        ]);
    }

    public function delete($id)
    {
        $session = session();
        $post = $this->postModel->find($id);
        
        // Verifica permissão
        if (!$post || ($session->get('role') !== 'admin' && $post['user_id'] !== $session->get('id'))) {
            return redirect()->to(base_url('posts'))->with('error', 'Acesso negado');
        }
        
        $this->postModel->delete($id);
        return redirect()->to(base_url('posts'))->with('message', 'Post movido para lixeira');
    }

    public function forceDelete($id)
    {
        $session = session();
        $post = $this->postModel->onlyDeleted()->find($id);
        var_dump($post);
        
        // Verifica permissão
        if (!$post || ($session->get('role') !== 'admin' && $post['user_id'] !== $session->get('id'))) {
            return redirect()->to(base_url('posts/trash'))->with('error', 'Acesso negado');
        }

        if ($post['cover_type'] === 'image') {                       
            if (!empty($post['cover_content'])) {
                $imagePath = 'C:/wamp64/www/ecoeducar/public/assets/image/posts/covers/' . $post['cover_content'];
                if (file_exists($imagePath)) {                   
                    unlink($imagePath);
                }
            }            
        }
        
        // Busca imagens da galeria
        $gallery = $this->postGalleryModel->where('post_id', $id)->findAll();
        
        if (!empty($gallery)) {
            // Remove arquivos físicos
            foreach ($gallery as $item) {
                $imagePath = 'C:/wamp64/www/ecoeducar/public/assets/image/posts/gallery/' . $item['image_name'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                // Remove registro da tabela post_gallery
                $this->postGalleryModel->delete($item['id'], true);
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