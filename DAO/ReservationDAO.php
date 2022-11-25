<?php
    namespace DAO;

    use DAO\IReservationDAO as IReservationDAO;
    use Models\Reservation as Reservation;

    class ReservationDAO implements IReservationDAO 
    {
        private $ReservationList = array();
        private $filename = ROOT."Data/Reservations.json";
        private $tablename ='reservation';
        private $connection;

        public function Add(Reservation $Reservation)
        {
            $this->retrieveData();
            $Reservation->setId($this->getNextId());
            array_push($this->ReservationList, $Reservation);
            $this->saveData();
        }

        public function AddBD(Reservation $Reservation){
            $response=null;
            try{
                $query = "INSERT INTO " .$this->tablename."(idOwner, idKeeper, idPet, initialDate, endDate, days, totalPrice, status) VALUES ( :idOwner, :idKeeper, :idPet, :initialDate, :endDate, :days, :totalPrice, :status);";
    
                $parameters["idOwner"]=$Reservation->getIdOwner();
                $parameters["idKeeper"]=$Reservation->getIdKeeper(); 
                $parameters["idPet"]=$Reservation->getIdPet(); 
                $parameters["initialDate"]=$Reservation->getInitialDate();
                $parameters["endDate"]=$Reservation->getendDate(); 
                // $daysArray = explode(",",$Reservation["days"]);
                $parameters["days"]=$Reservation->getDays(); 
                $parameters["totalPrice"]=$Reservation->gettotalPrice();
                $parameters["status"]=$Reservation->getStatus();
    
                $this->connection= Connection::GetInstance();
    
                $responseConnection = $this->connection->ExecuteNonQuery($query, $parameters);
                return "Se han modificado".$responseConnection."filas";
    
            }
            catch(Exception $ex){
                throw $ex;
                return "Error al insertar ".$this->responseConnection->getMessage();
            }
        }

        public function GetAllBD()
		{
			$ReservationList = array();
            $query = "SELECT * FROM " . $this->tableName;
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($query);
		
			foreach($resultSet as $valuesArray)
            {
                $Reservation = new Reservation();
                $Reservation->setId($valuesArray["id"]);
                $Reservation->setIdOwner($valuesArray["idOwner"]);;
                $Reservation->setIdKeeper($valuesArray["idKeeper"]); 
                $Reservation->setIdPet($valuesArray["idPet"]); 
                $Reservation->setInitialDate($valuesArray["initialDate"]);
                $Reservation->setendDate($valuesArray["endDate"]);
                $daysArray = explode(",",$valuesArray["days"]);
                $Reservation->setDays($daysArray);
                $Reservation->settotalPrice($valuesArray["totalPrice"]);
                $Reservation->setStatus($valuesArray["status"]);

                array_push($ReservationList, $Reservation);
            }
			
		}

        public function GetByIdBD($id) 
        {
        try
        {

            $query = "SELECT * FROM $this->tablename WHERE (id = $id)";
            
            $parameters['id'] = $id;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            $Reservation = new Reservation();
            $Reservation->setId($resultSet[0]["id"]);
            $Reservation->setIdOwner($resultSet[0]["idOwner"]);;
            $Reservation->setIdKeeper($resultSet[0]["idKeeper"]); 
            $Reservation->setIdPet($resultSet[0]["idPet"]); 
            $Reservation->setInitialDate($resultSet[0]["initialDate"]);
            $Reservation->setendDate($resultSet[0]["endDate"]);
            $daysArray = explode(",",$resultSet[0]["days"]);
            $Reservation->setDays($daysArray);
            $Reservation->settotalPrice($resultSet[0]["totalPrice"]);
            $Reservation->setStatus($resultSet[0]["status"]);

            return $Reservation;
        }
        catch(\PDOException $ex)
        {
            throw $ex;
        }
        }

        public function GetByIdKeeperBD($idKeeper) 
        {
        try
        {
            $ReservationList = array ();
            $query = "SELECT * FROM $this->tablename WHERE (idKeeper = $idKeeper)";
            
            $parameters['idKeeper'] = $idKeeper;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach($resultSet as $valuesArray)
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

                array_push($ReservationList, $Reservation);
            }

            return (count($ReservationList) > 0) ? $ReservationList : null;

        }
        catch(\PDOException $ex)
        {
            throw $ex;
        }
        }

        public function GetByIdOwnerBD($idOwner) 
        {
        try
        {
            $ReservationList = array ();
            $query = "SELECT * FROM $this->tablename WHERE (idOwner = $idOwner)";
            
            $parameters['idOwner'] = $idOwner;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach($resultSet as $valuesArray)
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

                array_push($ReservationList, $Reservation);
            }
            return (count($ReservationList) > 0) ? $ReservationList : null;
        }
        catch(\PDOException $ex)
        {
            throw $ex;
        }
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

        public function Confirm($ReservationId) {
            try {
    
                $query = "UPDATE $this->tablename SET status = 'confirmed' WHERE (id=$ReservationId);";
    
                $parameters["ReservationId"] = $ReservationId;
    
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
    
                $responseConnection = $this->connection->ExecuteNonQuery($query, $parameters);
                return "Se han modificado".$responseConnection." filas correctamente";
    
            }
            catch(Exception $ex){
                throw $ex;
                return "Error al insertar ".$this->responseConnection->getMessage();
            }
        }

        public function Inactivate($ReservationId) {
            try {
    
                $query = "UPDATE $this->tablename SET status = 'inactive' WHERE (id=$ReservationId);";
    
                $parameters["ReservationId"] = $ReservationId;
    
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
    
                $responseConnection = $this->connection->ExecuteNonQuery($query, $parameters);
                return "Se han modificado".$responseConnection." filas correctamente";
    
            }
            catch(Exception $ex){
                throw $ex;
                return "Error al insertar ".$this->responseConnection->getMessage();
            }
        }


    }