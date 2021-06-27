<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class FeedBack extends Model
{
  public $db;
  public $dataTable;
  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->dataTable = $this->db->table('feedback');
  }

  public function saveData($data)
  {

    $result =  $this->dataTable->insert($data);
    if ($result->connID->affected_rows >= 1) {
      return true;
    } else {
      return false;
    }
  }
  

 

  public function getFeedBack()
  {
    return $this->dataTable
    ->select()
    ->orderBy('id', 'DESC')
      ->get()
      ->getResult();
  }

  public function deleteFeedback($id)
  {
    return $this->dataTable
    ->where(['id'=> $id])
    ->delete();
      
  }
 

  }