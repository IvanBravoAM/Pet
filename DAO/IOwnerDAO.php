<?php namespace DAO;

use Models\Owner as Owner;

interface IOwnerDAO
{
    public function Add(Owner $Owner);
    public function GetAll();
    public function Remove($id);
    public function GetStudentOwners($id);
    public function ChangeStatus($id);
    public function CheckOwnerStatus($id);
}


?>