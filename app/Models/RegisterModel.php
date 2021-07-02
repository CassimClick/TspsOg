<?php

namespace App\Models;

use CodeIgniter\Model;



class RegisterModel extends Model
{
  public $db;
  public $dataTable;
  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->dataTable = $this->db->table('users');
  }

  public function createUser($data)
  {
    return $this->dataTable->insert($data);
  
  }

 

 
}