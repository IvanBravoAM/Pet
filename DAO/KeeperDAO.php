<?php namespace DAO;

    use DAO\IKeeperDAO as IKeeperDAO;
    use Models\Keeper as Keeper;

class KeeperDAO implements IKeeperDAO
    {

        private $keepersList = array();
		private $filename = ROOT . "Data/Keepers.json";
		private $tablename ='keeper';

		public function add(Keeper $keeper)
		{
			
            $this->retrieveData();
			$keeper->setKeeperId($this->getNextId());
			array_push($this->keepersList, $keeper);
			$this->saveData();
		}

		public function AddBD(Keeper $keeper){
            $response=null;
            try{
                $query = "INSERT INTO " .$this->tablename."(userId, petSize, petType, initialDate, endDate, days, price, isActive) VALUES ( :userId, :petSize, :petType, :initialDate, :endDate, :days, :price, :isActive);";
    
				$parameters["userId"] = $keeper->getUserId();
				$parameters["petSize"] = $keeper->getPetSize();
				$parameters["petType"] = $keeper->getPetType();
				$parameters["initialDate"] = $keeper->getInitialDate();
				$parameters["endDate"] = $keeper->getEndDate();
				$parameters["days"] = $keeper->getDays();
				$parameters["price"] = $keeper->getPrice();
                $parameters["isActive"] = $keeper->getIsActive();
    
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
			try{
			$keepersList = array();
            $query = "SELECT * FROM " . $this->tablename;
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($query);
		
			foreach($resultSet as $valuesArray)
			{
				$keeper = new Keeper();
				$keeper->setKeeperId($valuesArray["keeperId"]);
				$keeper->setUserId($valuesArray["userId"]);
				$keeper->setPetSize($valuesArray["petSize"]);
				$keeper->setPetType($valuesArray["petType"]);
				$keeper->setInitialDate($valuesArray["initialDate"]);
				$keeper->setEndDate($valuesArray["endDate"]);
				$daysArray = explode(",",$valuesArray["days"]);
				$keeper->setDays($daysArray);
				$keeper->setPrice($valuesArray["price"]);
				$keeper->setIsActive($valuesArray["isActive"]);					
				array_push($keepersList, $keeper);
			}
			return (count($keepersList) > 0) ? $keepersList : null;}
			catch(\PDOException $ex)
			{
				throw $ex;
			}
        }

		public function getByKeeperIdBD($keeperId) 
        {
        try
        {

            $query = "SELECT * FROM $this->tablename WHERE (keeperId = $keeperId)";
            
            $parameters['keeperId'] = $keeperId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            $keeper = new Keeper();
			$keeper->setKeeperId($resultSet[0]["keeperId"]);
			$keeper->setUserId($resultSet[0]["userId"]);
			$keeper->setPetSize($resultSet[0]["petSize"]);
			$keeper->setPetType($resultSet[0]["petType"]);
			$keeper->setInitialDate($resultSet[0]["initialDate"]);
			$keeper->setEndDate($resultSet[0]["endDate"]);
			$daysArray = explode(",",$resultSet[0]["days"]);
			$keeper->setDays($daysArray);
			$keeper->setPrice($resultSet[0]["price"]);
			$keeper->setIsActive($resultSet[0]["isActive"]);

            return $keeper;
        }
        catch(\PDOException $ex)
        {
            throw $ex;
        }
        }

		public function getByUserIdBD($userId) 
        {
        try
        {

            // $query = "SELECT * FROM ".$this->tablename. "WHERE (userId = {$userId})";
			$query = "SELECT * FROM $this->tablename WHERE (userId = $userId)";
            
            $parameters['userId'] = $userId;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query, $parameters);
            
            $keeper = new Keeper();
			$keeper->setKeeperId($resultSet[0]["keeperId"]);
			$keeper->setUserId($resultSet[0]["userId"]);
			$keeper->setPetSize($resultSet[0]["petSize"]);
			$keeper->setPetType($resultSet[0]["petType"]);
			$keeper->setInitialDate($resultSet[0]["initialDate"]);
			$keeper->setEndDate($resultSet[0]["endDate"]);
			$daysArray = explode(",",$resultSet[0]["days"]);
			$keeper->setDays($daysArray);
			$keeper->setPrice($resultSet[0]["price"]);
			$keeper->setIsActive($resultSet[0]["isActive"]);

            return $keeper;
        }
        catch(\PDOException $ex)
        {
            throw $ex;
        }
        }

		private function saveData()
		{
			$arrayToEncode = array();
			foreach($this->keepersList as $keeper)
			{
				$valuesArray=array();
				$valuesArray["keeperId"] = $keeper->getKeeperId();
				$valuesArray["userId"] = $keeper->getUserId();
				$valuesArray["petSize"] = $keeper->getPetSize();
				$valuesArray["initialDate"] = $keeper->getInitialDate();
				$valuesArray["endDate"] = $keeper->getEndDate();
				$valuesArray["days"] = $keeper->getDays();
				$valuesArray["price"] = $keeper->getPrice();
                $valuesArray["isActive"] = $keeper->getIsActive();
				array_push($arrayToEncode, $valuesArray);
			}
		
			$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
			file_put_contents($this->filename, $jsonContent);
		
		}
		private function retrieveData()
		{
			$this->keepersList=array();
			if(file_exists($this->filename))
			{
				$jsonContent = file_get_contents($this->filename);
				$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
		
				foreach($arrayToDecode as $valuesArray)
				{
					$keeper = new Keeper();
					$keeper->setKeeperId($valuesArray["keeperId"]);
					$keeper->setUserId($valuesArray["userId"]);
					$keeper->setPetSize($valuesArray["petSize"]);
					$keeper->setInitialDate($valuesArray["initialDate"]);
					$keeper->setEndDate($valuesArray["endDate"]);
					$keeper->setDays($valuesArray["days"]);
					$keeper->setPrice($valuesArray["price"]);
                    $keeper->setIsActive($valuesArray["isActive"]);					
								
					array_push($this->keepersList, $keeper);
				}
			}
		}

        public function getNextId()
        {
            $id=0;
            foreach($this->keepersList as $keeper)
            {
                if($keeper->getKeeperId() > $id) $id=$keeper->getKeeperId();
            }
            return $id+1;
        }

        public function delete($id)
        {
        	$this->retrieveData();

        	$keeperToDelete = $this->getById($id);
        	$keeperToDelete->setIsActive(false);

        	$this->saveData();
        }

        public function getAll()
        {
        	$this->retrieveData();
        	return $this->keepersList;
        }
        public function getById($id)
        {
        	$this->retrieveData();
        	foreach($this->keepersList as $keeper)
        	{
        		if($keeper->getUserId()==$id) return $keeper;
        	}
        	return null;
        }

        public function getByKeeperId($id)
        {
        	$this->retrieveData();
        	foreach($this->keepersList as $keeper)
        	{
        		if($keeper->getKeeperId()==$id) return $keeper;
        	}
        	return null;
        }

        public function modify($keeper)
        {
        	$this->retrieveData();
        	$this->delete($keeper->getKeeperId());
        	array_push($this->keepersList, $keeper);
        	$this->saveData();
        }


    }

?>
