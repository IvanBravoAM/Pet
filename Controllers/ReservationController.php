<?php
    namespace Controllers;

    use Models\Reservation;
    use Models\User;
    use DAO\ReservationDAO;
    use Controllers\KeeperController;
    use Controllers\PetController;

    class ReservationController
    {
        public $ReservationDAO;
        private $keeperController;
        private $PetController;

        public function __construct()
        {
            $this->ReservationDAO = new ReservationDAO();
            $this->keeperController=new KeeperController();
            $this->PetController=new PetController();
        }
        
        public function add(
		 $idKeeper, 
		 $idPet, 
		 $initialDate,
		 $endDate,
         $days, 
		 $totalPrice
         )
        {
            $Reservation = new Reservation();
            $Reservation->setIdOwner(($_SESSION["loggedUser"]->getId())); 
            $Reservation->setIdKeeper($idKeeper); 
            $Reservation->setIdPet($idPet); 
            $Reservation->setInitialDate($initialDate);
            $Reservation->setendDate($endDate);
            $Reservation->setDays($days);
            $Reservation->settotalPrice($totalPrice);
            $Reservation->setStatus('created');

            $this->ReservationDAO->AddBD($Reservation);
            $this->showListView();
        }

        public function Action()
        {
            if(isset($_POST['confirm'])){
                echo $_POST['confirm'];
                $this->Confirm($_POST['confirm']);
            }
            else if(isset($_POST['deactivate'])){
            }
            
        }

        public function Confirm($idReservation)
        {
            $Reservation = $this->ReservationDAO->getByReservationId($idReservation);

            if($Reservation->getStatus() == 'created')
            {
                $Reservation->setStatus('confirmed');
                $this->ReservationDAO->Modify($Reservation);
                require_once(VIEWS_PATH."reservation-list.php");
            }
        }


        public function showAddView($keeperId)
        {   
            require_once(VIEWS_PATH . "validate-session.php");
            $petList = $this->PetController->petDAO->GetByUserId($_SESSION['loggedUser']->getId());
            require_once(VIEWS_PATH . "pet-list.php");
            
            $Keeper = $this->keeperController->keeperDAO->getByKeeperId($keeperId);
            require_once(VIEWS_PATH."add-reservation.php");
        }

        public function showListView()
        {
            if($_SESSION['loggedUser']->getUserType() == 'Owner'){
                 $ReservationList = $this->ReservationDAO->getById($_SESSION['loggedUser']->getId());
            }else{
                $kID=$this->keeperController->keeperDAO->getById($_SESSION['loggedUser']->getId());
                $ReservationList = $this->ReservationDAO->getByIdKeeper($kID->getKeeperId());
            }
            //echo $_SESSION['loggedUser']->getId();
            require_once(VIEWS_PATH."reservation-list.php");
        }

        public function remove($id)
        {
            $this->ReservationDAO->delete($id);

            $this->showListView();
        }
    }
?>