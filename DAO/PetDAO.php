<?php

namespace DAO;

use DAO\IPetDAO;
use Models\Pet;
use Models\PetType;

class PetDAO implements IPetDAO {
    private $petList = array();
    private $filename = ROOT."Data/Pets.json";
    private $tablename ="pet";
    private $connection;

    public function add(Pet $pet)
    {
        $this->retrieveData();
        $pet->setId($this->getNextId());
        array_push($this->petList, $pet);
        $this->saveData();
        return "Se ha agregado una nueva mascota!";
    }

    public function AddBD(Pet $pet){
        $response=null;
        try{
            $query = "INSERT INTO " .$this->tablename."(userId, petType, name, breed, size, description, photo, vaccines, video, isActive) VALUES ( :userId, :petType, :name, :breed, :size, :description, :photo, :vaccines, :video, :isActive);";

            // $parameters["id"] = $pet->getId();
            $parameters["userId"] = $pet->getUserId();
            $parameters["petType"] = $pet->getPetType();
            $parameters["name"] = $pet->getName();
            $parameters["breed"] = $pet->getBreed();
            $parameters["size"] = $pet->getSize();
            $parameters["description"] = $pet->getDescription();
            $parameters["photo"] = $pet->getPhoto();
            $parameters["vaccines"] = $pet->getVaccines();
            $parameters["video"] = $pet->getVideo();
            $parameters["isActive"] = $pet->getIsActive();

            $this->connection= Connection::GetInstance();

            $responseConnection = $this->connection->ExecuteNonQuery($query, $parameters);
            return "Se han modificado".$responseConnection."filas";

        }
        catch(Exception $ex){
            throw $ex;
            return "Error al insertar ".$this->responseConnection->getMessage();
        }
    }

    public function GetAllBD() {
        try {
            $petList = array();
            $query = "SELECT * FROM $this->tableName" ;
            // $query = "SELECT * FROM 'pet'" ;
            echo $query ;
            //echo $this->tablename;
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $arrayValues)
            {      
                $petType = new PetType();
                $petType->setId($arrayValues["petType"]);

                $pet = new Pet();
                $pet->setId($arrayValues["id"]);
                $pet->setUserId($arrayValues["userId"]);
                $pet->setPetType($petType);
                $pet->setName($arrayValues["name"]);
                $pet->setBreed($arrayValues["breed"]);
                $pet->setSize($arrayValues["size"]);
                $pet->setDescription($arrayValues["description"]);
                $pet->setPhoto($arrayValues["photo"]);
                $pet->setVaccines($arrayValues["vaccines"]);
                $pet->setVideo($arrayValues["video"]);
                $pet->setIsActive($arrayValues["isActive"]);
                
                array_push($petList, $pet);
            }
            return $petList;
        } catch(Exception $ex) {
            throw $ex;
        }
    }

    public function GetByUserIdBD($userId) 
    {
        try
        {
            $petList = array();

            // $query = "SELECT * FROM 'pet' WHERE (userId = 3)";

            // $query = "SELECT * FROM ".$this->tableName;

            $query = "SELECT * FROM $this->tablename WHERE (userId = $userId)";

            


             $parameters['userId'] = $userId;

            // $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $arrayValues)
            {      
                $petType = new PetType();
                $petType->setId($arrayValues["petType"]);

                $pet = new Pet();
                $pet->setId($arrayValues["id"]);
                $pet->setUserId($arrayValues["userId"]);
                $pet->setPetType($petType);
                $pet->setName($arrayValues["name"]);
                $pet->setBreed($arrayValues["breed"]);
                $pet->setSize($arrayValues["size"]);
                $pet->setDescription($arrayValues["description"]);
                $pet->setPhoto($arrayValues["photo"]);
                $pet->setVaccines($arrayValues["vaccines"]);
                $pet->setVideo($arrayValues["video"]);
                $pet->setIsActive($arrayValues["isActive"]);
                
                array_push($petList, $pet);
            }

            return (count($petList) > 0) ? $petList : null;
        }
        catch(\PDOException $ex)
        {
            throw $ex;
        }
    }    

    public function GetByIdBD($id) 
    {
        try
        {
            $petList = array();
            $query = "SELECT * FROM $this->tablename WHERE (id = $id)";
            $parameters['id'] = $id;


            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            foreach ($resultSet as $arrayValues)
            {      
                $petType = new PetType();
                $petType->setId($arrayValues["petType"]);

                $pet = new Pet();
                $pet->setId($arrayValues["id"]);
                $pet->setUserId($arrayValues["userId"]);
                $pet->setPetType($petType);
                $pet->setName($arrayValues["name"]);
                $pet->setBreed($arrayValues["breed"]);
                $pet->setSize($arrayValues["size"]);
                $pet->setDescription($arrayValues["description"]);
                $pet->setPhoto($arrayValues["photo"]);
                $pet->setVaccines($arrayValues["vaccines"]);
                $pet->setVideo($arrayValues["video"]);
                $pet->setIsActive($arrayValues["isActive"]);
                
                array_push($petList, $pet);
            }

            return (count($petList) > 0) ? $petList[0] : null;
        }
        catch(\PDOException $ex)
        {
            throw $ex;
        }
    }    

    public function getNextId()
    {
        $id=0;
        foreach($this->petList as $pet)
        {
            if($pet->getId() > $id) $id=$pet->getId();
        }
        return $id+1;
    }

    private function saveData()
    {
        $arrayToEncode = array();
        foreach($this->petList as $pet)
        {
            $arrayValues = array();
            $arrayValues["id"] = $pet->getId();
            $arrayValues["userId"] = $pet->getUserId();
            $arrayValues["petType"] = $pet->getPetType()->getId();
            $arrayValues["name"] = $pet->getName();
            $arrayValues["breed"] = $pet->getBreed();
            $arrayValues["size"] = $pet->getSize();
            $arrayValues["description"] = $pet->getDescription();
            $arrayValues["photo"] = $pet->getPhoto();
            $arrayValues["vaccines"] = $pet->getVaccines();
            $arrayValues["video"] = $pet->getVideo();
            $arrayValues["isActive"] = $pet->getIsActive();

            array_push($arrayToEncode, $arrayValues);
        }
        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->filename, $jsonContent);
    }

    private function retrieveData()
    {
        $this->petList = array();

        if(file_exists($this->filename))
        {
            $jsonContent = file_get_contents($this->filename);
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $arrayValues)
            {
                $petType = new PetType();
                $petType->setId($arrayValues["petType"]);

                $pet = new Pet();
                $pet->setId($arrayValues["id"]);
                $pet->setUserId($arrayValues["userId"]);
                $pet->setPetType($petType);
                $pet->setName($arrayValues["name"]);
                $pet->setBreed($arrayValues["breed"]);
                $pet->setSize($arrayValues["size"]);
                $pet->setDescription($arrayValues["description"]);
                $pet->setPhoto($arrayValues["photo"]);
                $pet->setVaccines($arrayValues["vaccines"]);
                $pet->setVideo($arrayValues["video"]);
                $pet->setIsActive($arrayValues["isActive"]);

                array_push($this->petList, $pet);
            }
        }
    }

    public function delete($id)
    {
        $this->retrieveData();
        $positionToDelete = $this->getPositionById($id);
        if(!is_null($positionToDelete))
        {
            unset($this->petList[$positionToDelete]);
        }
        $this->saveData();
    }
    public function getPositionById($id)
    {
        $position=0;
        foreach($this->petList as $pet)
        {
            if($pet->getId()==$id) return $position;
            $position++;
        }
        return null;
    }

    public function getAll()
    {
        $this->retrieveData();
        return $this->petList;
    }

    public function getById($id)
    {
        $this->retrieveData();

        $pets = array_filter($this->petList, function($pet) use($id) {
            return $pet->getId() == $id;
        });

        $pets = array_values($pets);

        return (count($pets) > 0) ? $pets[0] : null;
    }

    public function getByUserId($UserId)
    {
        $this->retrieveData();

        $pets = array_filter($this->petList, function($pet) use($UserId) {
            return $pet->getUserId() == $UserId;
        });

        $pets = array_values($pets);

        return (count($pets) > 0) ? $pets : null;
    }


    public function modify(Pet $pet){
        $this->retrieveData();

        $id = $pet->getId();
        $this->delete($id);

        array_push($this->petList, $pet);

        $this->saveData();
    }

    public function Update($pet) {
        try {

            $query = "UPDATE " .$this->tablename." SET userId = :userId, petType = :petType, name = :name,  breed = :breed, size = :size, description = :description, photo = :photo, vaccines = :vaccines, video = :video, isActive = :isActive WHERE id = {$pet->getId()};";

            // $query = "INSERT INTO " .$this->tablename."(userId, petType, name, breed, size, description, photo, vaccines, video, isActive) VALUES ( :userId, :petType, :name, :breed, :size, :description, :photo, :vaccines, :video, :isActive);";
            
            $parameters["userId"] = $pet->getUserId();
            $parameters["petType"] = $pet->getPetType()->getId();
            $parameters["name"] = $pet->getName();
            $parameters["breed"] = $pet->getBreed();
            $parameters["size"] = $pet->getSize();
            $parameters["description"] = $pet->getDescription();
            $parameters["photo"] = $pet->getPhoto();
            $parameters["vaccines"] = $pet->getVaccines();
            $parameters["video"] = $pet->getVideo();
            $parameters["isActive"] = $pet->getIsActive();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        } catch(Exception $ex) {
            throw $ex;
        }
    }

    public function Inactivate($petId) {
        try {

            $query = "UPDATE {$this->tablename} SET isActive = false WHERE id={$petId};";

            $parameters["petId"] = $petId;
            

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

?>
