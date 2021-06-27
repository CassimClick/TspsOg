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
                $this->email = \Config\Services::email();
                helper(['form', 'url', 'array', 'date', 'regions']);
        }
        public function index()
        {
                $data = [];
                $data['validation'] = null;
                $data['page'] = [
                        'title' => 'sign up'
                ];

                if ($this->request->getMethod() == 'post') {

                        $rules = [
                                "firstname"       => "required|min_length[3]|max_length[15]",
                                "lastname"        => "required|min_length[3]|max_length[15]",
                                "email"           => "required|valid_email|is_unique[users.email]",
                                "city"            => "required",
                                "password"        => "required|min_length[6]|max_length[15]",
                                "confirmpassword" => "required|matches[password]",


                        ];

                        if ($this->validate($rules)) {
                                $uniqueId = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));
                                $userData = [
                                        "first_name" => $this->request->getVar('firstname', FILTER_SANITIZE_STRING),
                                        "last_name" => $this->request->getVar('lastname', FILTER_SANITIZE_STRING),
                                        "city" => $this->request->getVar('city', FILTER_SANITIZE_STRING),
                                        "email" => $this->request->getVar('email', FILTER_SANITIZE_STRING),
                                        "password" => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                                        "unique_id" => $uniqueId,
                                        "activation_date" => date("Y-m-d h:i:s")


                                ];

                                if ($this->registerModel->createUser($userData)) {
                                        $to = $this->request->getVar('email');
                                        $subject = 'Account activation WMA';
                                        $message = 'Hello' . ' ' . $this->request->getVar('firstname') . ' ' . $this->request->getVar('lastname') . '<br><br><br>' .
                                                "Your account has been created successfully,please click the link below to" . "activate your account<br><br><br>" .
                                                "<a href='" . base_url() . "/signup/activate/" . $uniqueId . "'>Activate Now</a>";

                                        // ================Email configurations==============
                                        $this->email->setTo($to);
                                        $this->email->setFrom('purposemany@gmail.com', 'WMA-MIS');
                                        $this->email->setSubject($subject);
                                        $this->email->setMessage($message);
                                        if ($this->email->send()) {
                                                $this->session->setFlashdata('Success', 'Account created successfully,visit your email to activate your account');
                                                return redirect()->to('login');
                                        } else {
                                                $this->session->setFlashdata('error', 'Unable to send activation email, please try again!');
                                                return redirect()->to(current_url());
                                                // $this->email->printDebugger(['headers']);
                                        }
                                } else {
                                        $this->session->setFlashdata('error', 'Unable to create an account please try again!');
                                        return redirect()->to(current_url());
                                }
                        } else {
                                $data['validation'] = $this->validator;
                        }
                }
                return view('Admin/signUp', $data);
        }

        public function activate($uniqueId = null)
        {
                $data = [];
                $data['page'] = [
                        'title' => 'Activation Page'
                ];
                if (!empty($uniqueId)) {
                        $userData = $this->registerModel->verifyUniqueId($uniqueId);

                        if ($userData) {
                                if ($this->verifyExpiryTime($userData->activation_date)) {
                                        if ($userData->status == 'inactive') {
                                                $status = $this->registerModel->updateStatus($uniqueId);

                                                if ($status) {
                                                        $data['Success'] = 'Your account is activated successfully ';
                                                }
                                        } else {
                                                $data['Success'] = 'Your account is already activated ';
                                        }
                                } else {
                                        $data['error'] = 'Activation link is expired ';
                                }
                        } else {
                                $data['error'] = 'Sorry we are unable to find your account';
                        }
                } else {
                        $data['error'] = 'Sorry we are unable to activate your account';
                }
                return view('pages/activation', $data);
        }

        public function verifyExpiryTime($registrationTime)
        {
                $currentTime = now();
                $regTime  = strtotime($registrationTime);
                $timeDifference = (int)$currentTime - (int)$regTime;

                if (43200 > $timeDifference) {
                        return true;
                } else {
                        return false;
                }
        }
}