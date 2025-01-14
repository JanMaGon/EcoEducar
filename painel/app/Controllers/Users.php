<?php 
namespace App\Controllers;

use \App\Models\UserModel;

class Users extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

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

        $users = $this->userModel->orderBy('created_at', 'DESC')
                                ->paginate(20, 'default', $currentPage);

        $data = [
            'title' => 'Usuários',
            'user' => [
                'role' => $session->get('role'),
                'name' => $session->get('name'),
                'id' => $session->get('user_id')
            ],
            'users' => $users,
            'pager' => $this->userModel->pager,
            'isTrash' => false
        ];

        // Carrega as views em ordem, passando os dados para cada uma
        return view('templates/head', $data)
             . view('templates/sidebar', $data)
             . view('users/index', $data)
             . view('templates/footer', $data);
    }

    public function trash()
    {
        $session = session();
        $currentPage = $this->request->getVar('page') ?? 1;
        
        $this->userModel->onlyDeleted();
        
                
        $users = $this->userModel->orderBy('deleted_at', 'DESC')
                                ->paginate(20, 'default', $currentPage);
                                
        $data = [
            'title' => 'Lixeira',
            'user' => [
                'role' => $session->get('role'),
                'name' => $session->get('name'),
                'id' => $session->get('user_id')
            ],
            'users' => $users,
            'pager' => $this->userModel->pager,
            'isTrash' => true
        ];

        return view('templates/head', $data)
             . view('templates/sidebar', $data)
             . view('users/index', $data)
             . view('templates/footer', $data);
    }

    public function create()
    {
        $session = session();
        $data = [
            'title' => 'Novo Usuário',
            'user' => [
                'role' => $session->get('role'),
                'name' => $session->get('name'),
                'id' => $session->get('user_id')
            ]
        ];

        return view('templates/head', $data)
            . view('templates/sidebar', $data)
            . view('users/form', $data)
            . view('templates/footer', $data);
    }

    public function edit($id)
    {
        $session = session();
        $user = $this->userModel->find($id);
                
        $data = [
            'title' => 'Editar Usuário',
            'user' => [
                'role' => $session->get('role'),
                'name' => $session->get('name'),
                'id' => $session->get('user_id')
            ],
            'painel_user' => $user
        ];
    
        return view('templates/head', $data)
             . view('templates/sidebar', $data)
             . view('users/form', $data)
             . view('templates/footer', $data);
    }

    public function store()
    {
        
        $password = $this->userModel->hashPassword($this->request->getPost('password'));

        // Prepare user data
        $postData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $password,
            'deleted_at' => null
        ];


        // Save user
        if ($this->userModel->insert($postData)) {
            
            return redirect()->to(base_url('users'))->with('message', 'Usuário criado com sucesso');
            
        }
        
       return redirect()->to(base_url('users/create'))->with('error', 'Erro ao criar Usuário');
    }
    
}