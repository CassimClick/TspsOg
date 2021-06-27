<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class AnnouncementModel extends Model
{
  public $db;
  public $dataTable;
  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->dataTable = $this->db->table('announcements');
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

public function FunctionName()
{
  $name = 'Ian';
 echo 'Hello World54';
}


  public function getAllAnnouncements()
  {
    return $this->dataTable
    ->orderBy('id', 'DESC')
      ->get()
      ->getResult();
  }
  public function singleAnnouncement($id)
  {
    return $this->dataTable
    ->select()
      ->where(['id'=>$id])
      ->get()
      ->getRow();
  }

  public function updateAnnouncement($id,$data){

    return $this->dataTable
    ->set($data)
    ->where(['id'=>$id])
    ->update();

  }
  public function deleteAnnouncement($id){

    return $this->dataTable
    ->where(['id'=>$id])
    ->delete();

  }
  }