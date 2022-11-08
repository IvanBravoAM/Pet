<?php namespace DAO;

use Models\Pet as Pet;

interface IPetDAO
{
    public function Add(Pet $Pet);
    public function GetAll();
    
}


?>