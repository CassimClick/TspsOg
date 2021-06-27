<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class Results extends Model
{
  public $db;
  public $dataTable;
  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->dataTable = $this->db->table('results');
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
  

  public function getFiles()
  {
    return $this->dataTable
    ->select()
  // ->where(['year'=>$year])
      ->get()
      ->getResult();
  }
 
 
 
  public function deleteResult($id){

    return $this->dataTable
    ->where(['id'=>$id])
    ->delete();

  }
  }