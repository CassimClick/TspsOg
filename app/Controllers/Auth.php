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

  
    public function register()
    {
      
        $data['page'] = [
            'title' => 'Resister Account',
        ];

        return view('Admin/registerPage');
    }

    public function login()
    {
        $data = [];
        $data['validation'] = null;

        
        $data['page'] = [
            'title' => 'Login',
        ];

        $data['adminExists'] = $this->loginModel->checkAdmin();
        if ($this->request->getMethod() == 'post') {
            $rules = [

                "email" => "required|valid_email",
                "password" => "required|min_length[6]|max_length[20]",
            ];
            if ($this->validate($rules)) {

                $email = $this->request->getVar('email', FILTER_SANITIZE_STRING);
                $password = $this->request->getVar('password', FILTER_SANITIZE_STRING);

                $userData = $this->loginModel->verifyEmail($email);

                if ($userData) {
                    if (password_verify($password, $userData->password)) {
                        $this->session->set('loggedUser',$userData->unique_id);
                        return redirect()->route('dashBoard');
                      
                    } else {
                        $this->session->setFlashdata('error', 'Wrong password entered for the email');
                        return redirect()->to('login');
                    }
                } else {
                    $this->session->setFlashdata('error', 'Sorry email does not exist');
                    return redirect()->to('login');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('Admin/loginPage',$data);

        //TODO:fix the sign up page
    }
    public function registerUser()
    {

        if ($this->request->getMethod() == 'post') {
        

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

    
    public function logout()
    {
            $this->session->remove('loggedUser');
            $this->session->remove('role');
            $this->session->destroy();
            return redirect()->to(\base_url().'/login');
    }

}