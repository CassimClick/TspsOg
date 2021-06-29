<?php

namespace App\Controllers;

use \App\Models\RegisterModel;
use \App\Libraries\CommonTasksLibrary;
use \CodeIgniter\Validation\Rules;


class Signup extends BaseController
{
        public $registerModel;
        public $session;
        public $email;
        public $commonTasks;
        public function __construct()
        {
                $this->registerModel = new RegisterModel();
                $this->session = session();
                // $this->email = \Config\Services::email();
                helper(['form', 'url', 'array', 'date', 'regions']);
        }
        public function index()
        {
                $data = [];
                $data['validation'] = null;
                $data['page'] = [
                        'title' => 'sign up'
                ];

                if ($this->request->getMethod() === 'post') {

                        $rules = [
                                "firstname"       => "required|min_length[3]|max_length[15]",
                                "lastname"        => "required|min_length[3]|max_length[15]",
                                "email"           => "required|valid_email|is_unique[users.email]",
                                "password"        => "required|min_length[6]|max_length[15]",
                                "confirmpassword" => "required|matches[password]",


                        ];

                        if ($this->validate($rules)) {
                                $uniqueId = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));
                                $userData = [
                                        "first_name" => $this->request->getVar('firstname', FILTER_SANITIZE_STRING),
                                        "last_name" => $this->request->getVar('lastname', FILTER_SANITIZE_STRING),
                                        "email" => $this->request->getVar('email', FILTER_SANITIZE_STRING),
                                        "password" => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                                        "unique_id" => $uniqueId,
                                        
                                        


                                ];
                                $this->registerModel->createUser($userData);
                               
                        } else {
                                $data['validation'] = $this->validator;
                        }
                }
                return view('Admin/signUp', $data);
        }

       

        
}