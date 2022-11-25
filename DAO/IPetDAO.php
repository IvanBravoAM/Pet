<?php namespace DAO;

use Models\Pet as Pet;

interface IPetDAO
{
    public function Add(Pet $Pet);
    public function GetAll();
    public function AddBD(Pet $Pet);
    public function GetAllBD();
    public function GetByIdBD($id);
    public function GetByUserIdBD($userId);
    public function Update($pet);
    public function Inactivate($petId);
    
}


?>