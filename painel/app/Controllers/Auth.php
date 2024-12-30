<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin() {
        
        header('Content-Type: application/json');
        try {
            $userModel = new UserModel();
            
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            // Validação básica
            if (!$email || !$password) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'E-mail e senha são obrigatórios'
                ]);
            }
            
            // Busca usuário
            $user = $userModel->where('email', $email)
                            ->where('deleted_at IS NULL')
                            ->first();
            
            if (!$user) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Usuário não encontrado'
                ]);
            }
            
            // Verifica senha
            if (!password_verify($password, $user['password'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Senha incorreta'
                ]);
            }
            
            // Cria sessão
            $session = session();
            $sessionData = [
                'user_id' => $user['id'],
                'name'    => $user['name'],
                'email'   => $user['email'],
                'role'    => $user['role'],
                'logged_in' => true
            ];
            $session->set($sessionData);
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Login realizado com sucesso',
                'redirect' => base_url('dashboard')
            ]);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Erro interno do servidor'
            ]);
        }
       
    }
    
    public function recoverPassword() {
        $email = $this->request->getPost('email');
        // Processar recuperação
        return $this->response->setJSON(['success' => true]);
    }
}