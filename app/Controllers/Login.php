<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\LoginModel;

class Login extends BaseController
{
    public $loginModel;
    public $session;
    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->session = session();
        helper(['form', 'url', 'array']);
    }

    public function index()
    {

//         if ($this->session->has('loggedUser')) {
        //             return redirect()->to('/dashboard');
        //       }

        $data = [];
        $data['validation'] = null;
        $data['page'] = [
            'title' => 'Log In',
        ];

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
                    if (password_verify($password, $userData['password'])) {
                        if ($userData['status'] === 'active') {

                            if ($userData['role'] == 1) {
                                $this->session->set('loggedUser', $userData['unique_id']);
                                $this->session->set('role', $userData['role']);
                                $this->session->set('city', $userData['city']);
                                return redirect()->to('/dashboard');
                            }
                            if ($userData['role'] == 2) {
                                $this->session->set('loggedUser', $userData['unique_id']);
                                $this->session->set('role', $userData['role']);
                                $this->session->set('city', $userData['city']);
                                return redirect()->to('/manager');
                            }
                            if ($userData['role'] == 3) {
                                $this->session->set('loggedUser', $userData['unique_id']);
                                $this->session->set('role', $userData['role']);
                                $this->session->set('city', $userData['city']);
                                return redirect()->to('/directorDashboard');
                            }
                            if ($userData['role'] == 7) {
                                $this->session->set('loggedUser', $userData['unique_id']);
                                $this->session->set('role', $userData['role']);
                                $this->session->set('city', $userData['city']);
                                return redirect()->to('/AdminDashboard');
                            }
                        } else {
                            $this->session->setFlashdata('error', 'please activate our account first');
                            return redirect()->to(current_url());
                        }
                    } else {
                        $this->session->setFlashdata('error', 'Wrong password entered for the email');
                        return redirect()->to(current_url());
                    }
                } else {
                    $this->session->setFlashdata('error', 'Sorry email does not exist');
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('pages/auth/UserLogin', $data);
    }
}