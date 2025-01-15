<?php 
namespace App\Controllers;

use \App\Models\UserModel;

class Users extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

    }

    public function index()
    {
        // passar dados para as views se necessário
        $session = session();

        // Verifica se o usuário está logado
        if (isset($session) && $session->has('user_id')) {
            if (!$session->get('user_id')) {
                return redirect()->to(base_url())->with('error', 'Você precisa estar logado para acessar esta página.');
            }
        } else {
            return redirect()->to(base_url())->with('error', 'Você precisa estar logado para acessar esta página.');
        }

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

        // Verifica se o usuário está logado
        if (isset($session) && $session->has('user_id')) {
            if (!$session->get('user_id')) {
                return redirect()->to(base_url())->with('error', 'Você precisa estar logado para acessar esta página.');
            }
        } else {
            return redirect()->to(base_url())->with('error', 'Você precisa estar logado para acessar esta página.');
        }

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

        // Verifica se o usuário está logado
        if (isset($session) && $session->has('user_id')) {
            if (!$session->get('user_id')) {
                return redirect()->to(base_url())->with('error', 'Você precisa estar logado para acessar esta página.');
            }
        } else {
            return redirect()->to(base_url())->with('error', 'Você precisa estar logado para acessar esta página.');
        }

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

        // Verifica se o usuário está logado
        if (isset($session) && $session->has('user_id')) {
            if (!$session->get('user_id')) {
                return redirect()->to(base_url())->with('error', 'Você precisa estar logado para acessar esta página.');
            }
        } else {
            return redirect()->to(base_url())->with('error', 'Você precisa estar logado para acessar esta página.');
        }

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

    public function myProfile($id)
    {
        $session = session();

        // Verifica se o usuário está logado
        if (isset($session) && $session->has('user_id')) {
            if (!$session->get('user_id')) {
                return redirect()->to(base_url())->with('error', 'Você precisa estar logado para acessar esta página.');
            }
        } else {
            return redirect()->to(base_url())->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        $user = $this->userModel->find($id);
                
        $data = [
            'title' => 'Editar Meu Perfil',
            'user' => [
                'role' => $session->get('role'),
                'name' => $session->get('name'),
                'id' => $session->get('user_id')
            ],
            'painel_user' => $user
        ];
    
        return view('templates/head', $data)
             . view('templates/sidebar', $data)
             . view('users/myProfile', $data)
             . view('templates/footer', $data);
    }

    public function store()
    {
        
        $password = $this->userModel->hashPassword($this->request->getPost('password'));

        // Prepare user data
        $userData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role'  =>  $this->request->getPost('role'),
            'password' => $password,
            'deleted_at' => null
        ];


        // Save user
        if ($this->userModel->insert($userData)) {
            
            return redirect()->to(base_url('users'))->with('message', 'Usuário criado com sucesso');
            
        }
        
       return redirect()->to(base_url('users/create'))->with('error', 'Erro ao criar Usuário');
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);

        $return = $this->request->getPost('return');   
        
        if (!empty($user)) {
            if ($return === 'myp') {
                // Prepare user data
                $userData = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email')
                ];
            } else {
                // Prepare user data
                $userData = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'role'  =>  $this->request->getPost('role')
                ];
            }

            // Update user
            if ($this->userModel->update($id, $userData)) {
                if ($return === 'myp') {            
                    return redirect()->to(base_url('dashboard'))->with('message', 'Dados do usuário atualizado com sucesso');
                } else {
                    return redirect()->to(base_url('users'))->with('message', 'Dados do usuário atualizado com sucesso');
                }
            }
        }
        
        return redirect()->back()->withInput()->with('error', 'Erro ao atualizar dados do usuário');
    }

    public function updatePassword($id)
    {
        $user = $this->userModel->find($id);

        $password = $this->userModel->hashPassword($this->request->getPost('password'));

        $return = $this->request->getPost('return_pass');  
        
        if (!empty($user)) {
            // Prepare user data
            $userData = [
                'password' => $password
            ];

            // Update user
            if ($this->userModel->update($id, $userData)) {
                if ($return === 'myp') { 
                    return redirect()->to(base_url('dashboard'))->with('message', 'Senha do usuário alterada com sucesso');
                } else {
                    return redirect()->to(base_url('users'))->with('message', 'Senha do usuário alterada com sucesso');
                }
            }
        }
        
        return redirect()->back()->withInput()->with('error', 'Erro ao tentar alterar a senha do usuário');
    }

    public function delete($id)
    {
        $session = session();
        $user = $this->userModel->find($id);
        
        // Verifica permissão
        if (!$user || ($session->get('role') !== 'admin' && $user['user_id'] !== $session->get('id'))) {
            return redirect()->to(base_url())->with('error', 'Acesso negado');
        }
        
        $this->userModel->delete($id);
        return redirect()->to(base_url('users'))->with('message', 'Usuário movido para lixeira');
    }

    public function forceDelete($id)
    {
        $session = session();
        $user = $this->userModel->onlyDeleted()->find($id);
                
        // Verifica permissão
        if (!$user || ($session->get('role') !== 'admin' && $user['user_id'] !== $session->get('id'))) {
            return redirect()->to(base_url())->with('error', 'Acesso negado');
        }
        
        // Remove registro do banco
        $this->userModel->delete($id, true);
        
        return redirect()->to(base_url('users/trash'))->with('message', 'Usuário excluído permanentemente');
       
    }

    public function restore($id)
    {
        
        $session = session();
        $user = $this->userModel->onlyDeleted()->find($id);
        
        // Verifica permissão
        if (!$user || ($session->get('role') !== 'admin' && $user['user_id'] !== $session->get('id'))) {
            return redirect()->to(base_url())->with('error', 'Acesso negado');
        }
        
        // Verifica se o post foi encontrado
        if ($user) {
            // Restaura o post
            $this->userModel->update($id, ['deleted_at' => null]);
            return redirect()->to(base_url('users/trash'))->with('message', 'Post restaurado');
        } else {
            return redirect()->to(base_url('users/trash'))->with('error', 'Post não encontrado');
        }
    }
    
}