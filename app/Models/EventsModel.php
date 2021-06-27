<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class EventsModel extends Model
{
  public $db;
  public $dataTable;
  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->dataTable = $this->db->table('events');
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
  

  public function getAllEvents()
  {
    return $this->dataTable
    ->select()
    ->orderBy('id', 'DESC')
  
      ->get()
      ->getResult();
  }
  public function getSingleEvent($id)
  {
    return $this->dataTable
    ->select()
    ->where(['id'=>$id])
      ->get()
      ->getRow();
  }
  public function getSixEvents()
  {
    return $this->dataTable
    ->orderBy('id', 'DESC')
    ->limit(6)
      ->get()
      ->getResult();
  }
  public function singleEvent($id)
  {
    return $this->dataTable
    ->select()
      ->where(['id'=>$id])
      ->get()
      ->getRow();
  }

  public function updateEvent($id,$data){

    return $this->dataTable
    ->set($data)
    ->where(['id'=>$id])
    ->update();

  }
  public function deleteEvent($id){

    return $this->dataTable
    ->where(['id'=>$id])
    ->delete();

  }
  }