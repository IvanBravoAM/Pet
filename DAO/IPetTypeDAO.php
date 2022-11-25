<?php namespace DAO;

use Models\PetType as PetType;

interface IPetTypeDAO
{
    public function Add(PetType $PetType);
    public function GetAllBD();
    public function AddBD(PetType $pettype);
    public function GetByIdBD($id) ;
    
}


?>