<?php

namespace App\Models;

use CodeIgniter\Model;



class LoginModel extends Model
{
  public $db;
  public $dataTable;
  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->dataTable = $this->db->table('users');
  }

  public function verifyEmail($email)
  {
    $builder = $this->dataTable;
    $builder->select('unique_id,status,password,role,city');
    $builder->where('email', $email);
    $result =  $builder->get();

    if (count($result->getResultArray()) == 1) {
      return $result->getRowArray();
    }
  }
}