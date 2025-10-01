<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('login_view');
    }

    public function process()
    {
        $session = session();
        $userModel = new UserModel();
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user) {
            if (md5($password) == $user['password']) {
                $sessionData = [
                    'user_id'       => $user['id'],
                    'user_name'     => $user['name'],
                    'user_email'    => $user['email'],
                    'user_role'     => $user['role'],
                    'isLoggedIn'    => TRUE
                ];
                $session->set($sessionData);

                return redirect()->to('/dashboard');
            }
        }

        $session->setFlashdata('error', 'Email atau Password salah.');
        return redirect()->to('/login');
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}