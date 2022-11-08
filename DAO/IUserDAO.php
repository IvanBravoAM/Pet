<?php namespace DAO;

use Models\User as User;

interface IUserDAO
{
    public function Add(User $User);
    public function GetAll();
    
}


?>