<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class JoiningInstruction extends Model
{
  public $db;
  public $dataTable;
  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->dataTable = $this->db->table('joining');
  }

  public function saveData($data)
  {

    return  $this->dataTable->insert($data);
   
  }
  

  public function getFiles()
  {
    return $this->dataTable
    ->select()
  // ->where(['year'=>$year])
      ->get()
      ->getResult();
  }
 
 
 
  public function deleteJoining($id){

    return $this->dataTable
    ->where(['id'=>$id])
    ->delete();

  }
  }