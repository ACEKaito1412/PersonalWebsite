<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    public function index()
    {
        if ($this->session->get('admin_name') == null) {
            return redirect()->to(site_url('login'));
        } else {
            return redirect()->to(site_url('/'));
        }
    }

    public function loginPage()
    {
        if ($this->session->get('admin_name')) {
            return redirect()->to(site_url('admin'));
        }
        $data = [
            'page_title' => "Login",
            'page' => "admin/login",
            'breadcrumbs' => true
        ];

        echo view('/partials/header', $data);
        echo view('/partials/login');
        echo view('/partials/footer');
    }

    public function login()
    {
        $user_model = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $res = $user_model->where('email', $email)->first();

        if (password_verify($password, $res['password'])) {

            $start_session = [
                'admin_id' => $res['id'],
                'admin_email' => $email,
                'admin_password' => $password,
                'admin_name' => $res['name']
            ];

            $this->session->set($start_session);

            return redirect()->to(site_url('admin'));
        } else {
            return redirect()->to(site_url('login'));
        }
    }

    public function registerPage()
    {
        if ($this->session) {
            return redirect()->to(site_url('admin'));
        }

        $data = [
            'page_title' => "Register",
            'page' => "admin/register"
        ];

        echo view('/partials/header', $data);
        echo view('/partials/register');
        echo view('/partials/footer');
    }

    public function register()
    {
        $user_model = new UserModel();

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $hash_password = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hash_password
        ];

        $res = $user_model->insert($data);

        if ($res) {
            return redirect()->to(site_url('login/?success=true'));
        } else {
            return redirect()->to(site_url('register'));
        }
    }
}
