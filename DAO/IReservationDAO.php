<?php namespace DAO;

use Models\Reservation as Reservation;

interface IReservationDAO
{
    public function Add(Reservation $Reservation);
    public function AddBD(Reservation $Reservation);
    public function GetAllBD();
    public function GetByIdBD($id);
    public function GetByIdKeeperBD($idKeeper);
    public function GetByIdOwnerBD($idOwner) ;
    public function Confirm($ReservationId);
    public function Inactivate($ReservationId);

}
?>