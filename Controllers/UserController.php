<?php 

	namespace Controllers;

	use Models\User;	
	use DAO\UserDAO as UserDAO;	

	class UserController
	{
		public $UserDAO;

		public function __construct()
		{
			$this->UserDAO = new UserDAO();
		}


		public function Add ($username, $password, $name, $lastname, $dni, $phone, $email, $userType)
		{
			$user = new User();
			$_SESSION["loggedUser"]=null;

			$user->setUsername($username);
			$user->setPassword($password);
			$user->setName($name);
			$user->setLastName($lastname);
			$user->setDni($dni);
			$user->setPhone($phone);
			$user->setEmail($email);
            $user->setUserType($userType);

			$check = $this->checkUser($user);

			if($check==1){ 
				$this->ShowAddView("This Username is already registered"); }
			else if($check==2) {
				$this->ShowAddView("This Email is already registered"); }
			else if($check==3) {
				$this->ShowAddView("This DNI is already registered"); }
			else
			{
				$response=$this->UserDAO->AddBD($user);
				$_SESSION["loggedUser"] = $user;
				$this->ShowAddView($response);
			}
		}

        public function ShowAddView($message="")
        {
            //require_once("validate-session.php");
            require_once(VIEWS_PATH."add-user.php");
        }

		private function checkUser($newUser) 
		{
            $userList = $this->UserDAO->GetAllBD();
            foreach ($userList as $user) 
            {
                if ($newUser->getUsername() == $user->getUsername()) return 1;
                else if($newUser->getEmail() == $user->getEmail()) return 2;
				else if($newUser->getDni() == $user->getDni()) return 3;
            }
            return 0;
        }

        public function showProfile(){
            require_once(VIEWS_PATH . "validate-session.php");
        	$user = $_SESSION["loggedUser"];
        	require_once(VIEWS_PATH . "user-profile.php");
        }


	}

 ?>