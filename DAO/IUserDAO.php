<?php namespace DAO;

use Models\User as User;

interface IUserDAO
{
    public function Add(User $User);
    public function GetAll();
    public function AddBD(User $user);
    public function GetAllBD();
    public function GetByUsernameBD($username);
    
}


?>