<?php
    namespace DAO;

    use DAO\IPetTypeDAO as IPetTypeDAO;
    use Models\PetType as PetType;

    class PetTypeDAO implements IPetTypeDAO 
    {
        private $PetTypeList = array();
        private $filename = ROOT."Data/PetTypes.json";
        private $tablename ='pettype';
        private $connection;

        public function Add(PetType $PetType)
        {
            $this->retrieveData();
            $PetType->setId($this->getNextId());
            array_push($this->PetTypeList, $PetType);
            $this->saveData();
        }

        private function saveData()
        {
            $arrayToEncode = array();
            foreach($this->PetTypeList as $petType)
            {
                $valuesArray=array();
        		$valuesArray["id"] = $petType->getId();
        		$valuesArray["name"] = $petType->getName();

                array_push($arrayToEncode, $valuesArray);
            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->filename, $jsonContent);
        }

        private function retrieveData()
      	{
      		$this->PetTypeList=array();
      		if(file_exists($this->filename))
      		{
      			$jsonContent = file_get_contents($this->filename);
      			$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
      	
      			foreach($arrayToDecode as $valuesArray)
      			{
      				$petType = new petType();
      				$petType->setId($valuesArray["id"]);
      				$petType->setName($valuesArray["name"]);

      				array_push($this->PetTypeList, $petType);
      			}
      		}
      	}

        public function getAll()
        {
            $this->retrieveData();
            return $this->PetTypeList;
        }

        public function getNextId()
        {
            $id=0;
            foreach($this->PetTypeList as $petType)
            {
                if($petType->getId() > $id) $id=$petType->getId();
            }
            return $id+1;
        }
        
        public function getById($id)
        {
            $this->retrieveData();

            $petTypes = array_filter($this->PetTypeList, function($petType) use($id) {
                return $petType->getId() == $id;
            });

            $petTypes = array_values($petTypes);

            return (count($petTypes) > 0) ? $petTypes[0] : null;
        }

        public function AddBD(PetType $pettype){
            $response=null;
            try{
                $query = "INSERT INTO " .$this->tablename."(name) VALUES ( :name);";
    
                $parameters["name"] = $pet->getName();
    
                $this->connection= Connection::GetInstance();
    
                $responseConnection = $this->connection->ExecuteNonQuery($query, $parameters);
                return "Se han modificado".$responseConnection."filas";
    
            }
            catch(Exception $ex){
                throw $ex;
                return "Error al insertar ".$this->responseConnection->getMessage();
            }
        }


    }