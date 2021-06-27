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
    $result =  $this->dataTable->insert($data);
    if ($result->connID->affected_rows >= 1) {
      return true;
    } else {
      return false;
    }
  }

  public function verifyUniqueId($id)
  {
    $builder = $this->dataTable;
    $builder->select('activation_date,unique_id,status');
    $builder->where('unique_id', $id);
    $result =  $builder->get();

    if ($builder->countAll() >= 1) {
      return $result->getRow();
    } else {
      return false;
    }
  }

  public function updateStatus($id)
  {
    $builder = $this->dataTable;
    $builder->where('unique_id', $id);
    $builder->update(['status' => 'active']);

    if ($this->db->connID->affected_rows == 1) {
      return true;
    } else {
      return false;
    }
  }
}
