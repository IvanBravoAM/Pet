<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;

    class UserDAO implements IUserDAO 
    {
        private $userList = array();
        private $filename = ROOT."Data/Users.json";
        private $tablename ='user';
        private $connection;

        public function add(User $user)
        {
            $this->retrieveData();
            $user->setId($this->getNextId());
            array_push($this->userList, $user);
            $this->saveData();
        }

        public function AddBD(User $user){
            $response=null;
            try{
                $query = "INSERT INTO " .$this->tablename."(username, password, name, lastname, dni, phone, email, userType) VALUES ( :username, :password, :name, :lastname, :dni, :phone, :email, :userType);";
    
                $parameters["username"] = $user->getUsername();
                $parameters["password"] = $user->getPassword();
                $parameters["name"] = $user->getName();
                $parameters["lastname"] = $user->getLastname();
                $parameters["dni"] = $user->getDni();
                $parameters["phone"] = $user->getPhone();
                $parameters["email"] = $user->getEmail();
                $parameters["userType"] = $user->getUserType();
    
                $this->connection= Connection::GetInstance();
    
                $responseConnection = $this->connection->ExecuteNonQuery($query, $parameters);
                return "Se ha agregado ".$responseConnection." con exito.";
    
            }
            catch(Exception $ex){
                throw $ex;
                return "Error al insertar ".$this->responseConnection->getMessage();
            }
        }

        public function getNextId()
        {
            $id=0;
            foreach($this->userList as $user)
            {
                if($user->getId() > $id) $id=$user->getId();
            }
            return $id+1;
        }

        private function saveData()
        {
            $arrayToEncode = array();
            foreach($this->userList as $user)
            {
                $arrayValues = array();
                $arrayValues["id"] = $user->getId();
                $arrayValues["username"] = $user->getUsername();
                $arrayValues["password"] = $user->getPassword();
                $arrayValues["name"] = $user->getName();
                $arrayValues["lastname"] = $user->getLastname();
                $arrayValues["dni"] = $user->getDni();
                $arrayValues["phone"] = $user->getPhone();
                $arrayValues["email"] = $user->getEmail();
                $arrayValues["userType"] = $user->getUserType();

                array_push($arrayToEncode, $arrayValues);
            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->filename, $jsonContent);
        }

        private function retrieveData()
        {
            $this->userList = array();

            if(file_exists($this->filename))
            {
                $jsonContent = file_get_contents($this->filename);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $arrayValues)
                {
                    $user = new User();
                    $user->setId($arrayValues["id"]);
                    $user->setUsername($arrayValues["username"]);
                    $user->setPassword($arrayValues["password"]);
                    $user->setName($arrayValues["name"]);
                    $user->setLastname($arrayValues["lastname"]);
                    $user->setDni($arrayValues["dni"]);
                    $user->setPhone($arrayValues["phone"]);
                    $user->setEmail($arrayValues["email"]);
                    $user->setUserType($arrayValues["userType"]);
                    array_push($this->userList, $user);
                }
            }
        } 

        public function GetAllBD(){
            try
            {
                $userList = array();

                $query = "SELECT * FROM ".$this->tablename;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){

                    $user = new User();
                    $user->setId($row["id"]);
                    $user->setUsername($row["username"]);
                    $user->setPassword($row["password"]);
                    $user->setName($row["name"]);
                    $user->setLastname($row["lastname"]);
                    $user->setDni($row["dni"]);
                    $user->setPhone($row["phone"]);
                    $user->setEmail($row["email"]);
                    $user->setUserType($row["userType"]);
                    array_push($this->userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetByUsernameBD($username){
            try
            {

                $query = "SELECT * FROM ".$this->tablename." WHERE username = '$username'";

                // $query = "SELECT * FROM $this->tablename WHERE (username = $username)";

            


                $parameters['username'] = $username;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
               
                $user = new User();
                $user->setId($resultSet[0]["id"]);
                $user->setUsername($resultSet[0]["username"]);
                $user->setPassword($resultSet[0]["password"]);
                $user->setName($resultSet[0]["name"]);
                $user->setLastname($resultSet[0]["lastname"]);
                $user->setDni($resultSet[0]["dni"]);
                $user->setPhone($resultSet[0]["phone"]);
                $user->setEmail($resultSet[0]["email"]);
                $user->setUserType($resultSet[0]["userType"]);

                return $user;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function delete($id)
        {
            $this->retrieveData();
            $positionToDelete = $this->getPositionById($id);
            if(!is_null($positionToDelete))
            {
                unset($this->userList[$positionToDelete]);
            }
            $this->saveData();
        }
        public function getPositionById($id)
        {
            $position=0;
            foreach($this->userList as $user)
            {
                if($user->getId()==$id) return $position;
                $position++;
            }
            return null;
        }
        public function getByUsername($username)
        {
            $this->retrieveData();
            foreach($this->userList as $user)
            {
                if($user->getUsername()==$username) return $user;
            }
            return null;
        }

        public function getById($id)
        {
            $this->retrieveData();
            foreach($this->userList as $user)
            {
                if($user->getId()==$id) return $user;           }
            return null;
        }

        public function getAll()
        {
            $this->retrieveData();
            return $this->userList;
        }

        public function modify(User $user)
        {
            $this->retrieveData();
            $this->delete($user->getId());
            array_push($this->userList, $user);
            $this->saveData();
        }



    }

?>