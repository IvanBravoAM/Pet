<?php namespace DAO;

use Models\Reservation as Reservation;

interface IReservationDAO
{
    public function Add(Reservation $Reservation);
}
?>