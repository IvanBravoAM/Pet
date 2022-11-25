<?php namespace DAO;

use Models\Keeper as Keeper;

interface IKeeperDAO
{
    public function Add(Keeper $Keeper);
    public function AddBD(Keeper $Keeper);
    public function GetAll();
    public function GetAllBD();

}


?>