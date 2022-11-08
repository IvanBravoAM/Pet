<?php
    namespace Controllers;

    use DAO\UserDAO;
    //use Controller\UserController;

    class HomeController{

        //private $userController=new UserController();

        // public function __construct() {
        //     $this->userController = new UserController();
        // }


        public function Index($message = "") {
            require_once(VIEWS_PATH . "home.php");
        }

        public function ShowWelcomeView() {
            if($_SESSION["loggedUser"]->getUserType() == "Owner"){
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH . "welcome.php");
            }else{
                require_once(VIEWS_PATH."validate-session.php");
                require_once(VIEWS_PATH . "welcome-keeper.php");
            }

        }

        public function Test() {
            echo 'funciona el test';
        }

        public function Login($userName, $password) {
            $userController=new UserController();
            $user= $userController->UserDAO->GetByUserName($userName);
            
            if(($user != null) && ($user->getPassword() === $password))
            {
                $_SESSION["loggedUser"] = $user;

                $this->ShowWelcomeView();
            } else {
                $message = "Incorrect Username/Password";
                $this->Index($message);
            }
        }

        public function Logout() {
            session_destroy();
            $this->Index();
        }
    }

?>