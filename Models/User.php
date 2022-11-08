<?php

    namespace Models;

    class User {
        private $id;
        private $userType;
        private $name;
        private $lastName;
        private $userName;
        private $password;
        private $email;
        private $phone;
        private $DNI;

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of userType
         */ 
        public function getUserType()
        {
                return $this->userType;
        }

        /**
         * Set the value of userType
         *
         * @return  self
         */ 
        public function setUserType($userType)
        {
                $this->userType = $userType;

                return $this;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of lastName
         */ 
        public function getlastName()
        {
                return $this->lastName;
        }

        /**
         * Set the value of lastName
         *
         * @return  self
         */ 
        public function setlastName($lastName)
        {
                $this->lastName = $lastName;

                return $this;
        }

        /**
         * Get the value of userName
         */ 
        public function getUserName()
        {
                return $this->userName;
        }

        /**
         * Set the value of userName
         *
         * @return  self
         */ 
        public function setUserName($userName)
        {
                $this->userName = $userName;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of phone
         */ 
        public function getphone()
        {
                return $this->phone;
        }

        /**
         * Set the value of phone
         *
         * @return  self
         */ 
        public function setphone($phone)
        {
                $this->phone = $phone;

                return $this;
        }

        /**
         * Get the value of DNI
         */ 
        public function getDNI()
        {
                return $this->DNI;
        }

        /**
         * Set the value of DNI
         *
         * @return  self
         */ 
        public function setDNI($DNI)
        {
                $this->DNI = $DNI;

                return $this;
        }
    }
?>