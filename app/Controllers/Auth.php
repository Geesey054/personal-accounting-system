<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginPost()
    {
        $userModel = new UserModel();

        $email    = trim($this->request->getPost('email'));
        $password = trim($this->request->getPost('password'));

        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Email-kan ma jiro'
            ]);
        }

        // ✅ PLAIN PASSWORD CHECK
        if ($password !== $user['password']) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Password-ka waa qalad'
            ]);
        }

        session()->set([
            'user_id'   => $user['id'],
            'user_name' => $user['name'],
            'logged_in' => true
        ]);

        return $this->response->setJSON([
            'status' => 'success'
        ]);
    }

   public function logout()
{
    session()->destroy();
    return redirect()->to('/login');
}

}
