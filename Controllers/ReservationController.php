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
         $KeeperIDate,
         $KeeperEDate,
         $keeperPetType,
         $keeperPetSize ,
		 $idPet, 
		 $initialDate,
		 $endDate,
         $days, 
		 $totalPrice
         )
        {
            $PetController = new PetController();
            $pet = $this->PetController->petDAO->GetByIdBD($idPet);
            if($pet->getSize() == $keeperPetSize && $pet->getPetType() == $keeperPetType){
                if($this->checkDates($initialDate,$endDate,$KeeperIDate,$KeeperEDate)){
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
            }else{
                $message="Please select dates between the specified dates available for this keeper";
                $this->showAddView($idKeeper,$message);
            }
            }else{
                $message="This Keeper do not pet this pet type or size";
                $this->showAddView($idKeeper,$message);
            }
            
            
        }
 
        

        public function Confirm($idReservation)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $Reservation = $this->ReservationDAO->GetByIdBD($idReservation);

            if($Reservation->getStatus() == 'created')
            {
                $this->ReservationDAO->Confirm($Reservation->getId());
                $this->showListView();
            }else{
                $this->showListView();
            }
        }


        public function showAddView($keeperId, $message = "")
        {   
            require_once(VIEWS_PATH . "validate-session.php");
            $petList = $this->PetController->petDAO->GetByUserIdBD($_SESSION['loggedUser']->getId());
            $petTypeController = new PetTypeController();
            $petTypeList = $petTypeController->petTypeDAO->GetAllBD();
            
            $Keeper = $this->keeperController->keeperDAO->getByKeeperIdBD($keeperId);
            require_once(VIEWS_PATH."add-reservation.php");
        }

        public function showListView()
        {
            require_once(VIEWS_PATH . "validate-session.php");
            if($_SESSION['loggedUser']->getUserType() == 'Owner'){
                 $ReservationList = $this->ReservationDAO->GetByIdOwnerBD($_SESSION['loggedUser']->getId());
            }else{
                $kID=$this->keeperController->keeperDAO->getByUserIdBD($_SESSION['loggedUser']->getId());
                $ReservationList = $this->ReservationDAO->GetByIdKeeperBD($kID->getKeeperId());
            }
            //echo $_SESSION['loggedUser']->getId();
            require_once(VIEWS_PATH."reservation-list.php");
        }

        public function remove($id)
        {
            $this->ReservationDAO->delete($id);

            $this->showListView();
        }

        public function Inactivate($idReservation){
            
            require_once(VIEWS_PATH . "validate-session.php");
            $Reservation = $this->ReservationDAO->GetByIdBD($idReservation);
            
            $this->ReservationDAO->Inactivate($Reservation->getId());
            $this->showListView();
            
        
        }

        public function checkDates($initialDate, $endDate,$KeeperIDate,$KeeperEDate){
            if ($initialDate > $KeeperIDate && $endDate < $KeeperEDate)
            {
                return true;
            }
            else
            {
            return false;  
            }
        }
    }
?>