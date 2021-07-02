<?php

namespace App\Controllers;

use \App\Models\LoginModel;
use \App\Models\RegisterModel;

class Auth extends BaseController
{
    public $registerModel;
    public $loginModel;
    public $session;
    public $email;
    public $commonTasks;
    public function __construct()
    {
        $this->registerModel = new RegisterModel();
        $this->loginModel = new LoginModel();
        $this->session = session();
        // $this->email = \Config\Services::email();
        helper(['form', 'url', 'array', 'date', 'regions']);
    }

    public function login()
    {

        $data['page'] = [
            'title' => 'Login',
        ];

        return view('Admin/loginPage');
    }
    public function register()
    {
        $data = [];
        $data['validation'] = null;
        $data['page'] = [
            'title' => 'Resister Account',
        ];

        return view('Admin/registerPage');
    }

    public function logUser()
    {
        if ($this->request->getMethod() == 'post') {

            $email = $this->request->getVar('email', FILTER_SANITIZE_STRING);
            $password = $this->request->getVar('password', FILTER_SANITIZE_STRING);

            $userData = $this->loginModel->verifyEmail($email);

            if ($userData) {

                print_r($userData);
                if (password_verify($password, $userData->password)) {
                    echo 'logged in';
                } else {
                    $this->session->setFlashdata('error', 'Wrong password');
                    return redirect()->to('login');
                }
            } else {
                $this->session->setFlashdata('error', 'Sorry email does not exist');
                return redirect()->to('login');
            }
        }

    }
    public function registerUser()
    {

        if ($this->request->getMethod() == 'post') {
            // print_r($_POST);

            $uniqueId = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));
            $userData = [
                "first_name" => $this->request->getVar('firstname', FILTER_SANITIZE_STRING),
                "last_name" => $this->request->getVar('lastname', FILTER_SANITIZE_STRING),
                "email" => $this->request->getVar('email', FILTER_SANITIZE_STRING),
                "password" => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                "unique_id" => $uniqueId,

            ];
            $request = $this->registerModel->createUser($userData);

            if ($request) {
                $this->session->setFlashdata('success', 'Account Created successful');
                return redirect()->to('login');

            } else {
                $this->session->setFlashdata('error', 'Failed to Create Account');
                return redirect()->back();
            }

        }

    }

}