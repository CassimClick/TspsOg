<?php namespace App\Libraries;

class CommonTasks{
    function processFile($file)
    {
        if ($file->isValid() && !$file->hasMoved()) {
            $randomName = $file->getRandomName();
            if ($file->move(FCPATH . '/uploads/images/', $randomName)) {


                return    base_url() . '/uploads/images/' . $randomName;
            }
        }
    }
    function processDocument($file)
    {
        if ($file->isValid() && !$file->hasMoved()) {
            $randomName = $file->getRandomName();
            if ($file->move(FCPATH . '/uploads/documents/', $randomName)) {


                return    base_url() . '/uploads/documents/' . $randomName;
            }
        }
    }
}
?>