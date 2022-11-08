<?php
    namespace DAO;

    use DAO\IReservationDAO as IReservationDAO;
    use Models\Reservation as Reservation;

    class ReservationDAO implements IReservationDAO 
    {
        private $ReservationList = array();
        private $filename = ROOT."Data/Reservations.json";

        public function Add(Reservation $Reservation)
        {
            $this->retrieveData();
            $Reservation->setId($this->getNextId());
            array_push($this->ReservationList, $Reservation);
            $this->saveData();
        }

        private function saveData()
        {
            $arrayToEncode = array();
            foreach($this->ReservationList as $Reservation)
            {
                $valuesArray=array();
        		$valuesArray["id"] = $Reservation->getId();
                $valuesArray["idOwner"]=$Reservation->getIdOwner();
                $valuesArray["idKeeper"]=$Reservation->getIdKeeper(); 
                $valuesArray["idPet"]=$Reservation->getIdPet(); 
                $valuesArray["initialDate"]=$Reservation->getInitialDate();
                $valuesArray["endDate"]=$Reservation->getendDate(); 
                $valuesArray["days"]=$Reservation->getDays(); 
                $valuesArray["totalPrice"]=$Reservation->gettotalPrice();
                $valuesArray["status"]=$Reservation->getStatus();

                array_push($arrayToEncode, $valuesArray);
            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->filename, $jsonContent);
        }

        private function retrieveData()
      	{
      		$this->ReservationList=array();
      		if(file_exists($this->filename))
      		{
      			$jsonContent = file_get_contents($this->filename);
      			$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
      	
      			foreach($arrayToDecode as $valuesArray)
      			{
      				$Reservation = new Reservation();
      				$Reservation->setId($valuesArray["id"]);
                    $Reservation->setIdOwner($valuesArray["idOwner"]);;
                    $Reservation->setIdKeeper($valuesArray["idKeeper"]); 
                    $Reservation->setIdPet($valuesArray["idPet"]); 
                    $Reservation->setInitialDate($valuesArray["initialDate"]);
                    $Reservation->setendDate($valuesArray["endDate"]);
                    $Reservation->setDays($valuesArray["days"]);
                    $Reservation->settotalPrice($valuesArray["totalPrice"]);
                    $Reservation->setStatus($valuesArray["status"]);

      				array_push($this->ReservationList, $Reservation);
      			}
      		}
      	}

        public function getAll()
        {
            $this->retrieveData();
            return $this->ReservationList;
        }

        public function getNextId()
        {
            $id=0;
            foreach($this->ReservationList as $Reservation)
            {
                if($Reservation->getId() > $id) $id=$Reservation->getId();
            }
            return $id+1;
        }
        
        public function getById($id)
        {
            $this->retrieveData();
            $Reservations = array_filter($this->ReservationList, function($Reservation) use($id) {
                return $Reservation->getIdOwner() == $id;
            });

            $Reservations = array_values($Reservations);

            return (count($Reservations) > 0) ? $Reservations : null;
        }

        public function getByReservationId($id)
        {
            $this->retrieveData();
            $Reservations = array_filter($this->ReservationList, function($Reservation) use($id) {
                return $Reservation->getId() == $id;
            });

            $Reservations = array_values($Reservations);

            return (count($Reservations) > 0) ? $Reservations[0] : null;
        }

        public function getByIdKeeper($id)
        {
            $this->retrieveData();
            $Reservations = array_filter($this->ReservationList, function($Reservation) use($id) {
                return $Reservation->getIdKeeper() == $id;
            });

            $Reservations = array_values($Reservations);

            return (count($Reservations) > 0) ? $Reservations : null;
        }

        public function Remove($idReservation) {
            $this->RetrieveData();

            $this->ReservationList = array_filter($this->ReservationList, function($Reservation) use($idReservation) {
                return $Reservation->getId() != $idReservation;
            });

            $this->SaveData();
        }

        public function Modify(Reservation $Reservation) {
            $this->RetrieveData();
            $this->Remove($Reservation->getId());

            array_push($this->ReservationList, $Reservation);

            $this->SaveData();
        }


    }