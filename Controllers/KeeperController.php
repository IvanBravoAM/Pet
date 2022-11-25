<?php
    namespace Controllers;

    use DAO\KeeperDAO as KeeperDAO;
    use Models\Keeper as Keeper;



class KeeperController
    {

        public $keeperDAO;
		private $KeeperController;

		public function __construct()
		{
			$this->keeperDAO= new KeeperDAO();
		}

		public function add($petSize,$petType, $initDate, $endDate, $days, $price)
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$Keeper = new Keeper();
			$Keeper->setUserId($_SESSION['loggedUser']->getId());
			$Keeper->setPetSize($petSize);
			$Keeper->setPetType($petType);
			$Keeper->setInitialDate($initDate);
			$Keeper->setEndDate($endDate);
			$daysString = implode(",", $days);
			$Keeper->setDays($daysString);
			$Keeper->setPrice($price);
            $Keeper->setIsActive(true);

			$check = $this->checkDates($initDate, $endDate);

			if($check == 1) {
				$this->showAddView("Start Date past End Date"); }
			else if ($check == 2) { 
				$this->showAddView("Start Date previous current date"); }
			else
			{			
                $response=$this->keeperDAO->AddBD($Keeper);
                $this->showHomeView($response);
			}
		}


		public function showAddView($message='')
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$petTypeController = new PetTypeController();
            $petTypeList = $petTypeController->petTypeDAO->GetAllBD();
            $userId= $_SESSION['loggedUser']->getId();
            $check = $this->checkKeeper($userId);
            if($check != 0){
                $message='You are already registered as Keeper';
            }
			require_once(VIEWS_PATH . "add-keeper.php");
		}


		public function checkDates($initDate, $endDate)
		{	
			if($endDate < $nitDate){
				return 1;
			}
			if($initDate < date("Y/m/d")){
				return 2;
			}
			return 0;

		}
		public function showHomeView($response='')
		{
			require_once(VIEWS_PATH . "validate-session.php");
			require_once(VIEWS_PATH . "welcome-keeper.php");
		}

		public function showListView()
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$message=''; $message1='';$initDate=''; $endDate='';
			$keeperList=$this->keeperDAO->GetAllBD();
			require_once(VIEWS_PATH . "keeper-list.php");
		}

        private function checkKeeper($userId) 
		{
            $KeeperList = $this->keeperDAO->GetAllBD();
            foreach ($KeeperList as $Keeper) 
            {
                if ($Keeper->getUserId() == $userId) return 1;
                
            }
            return 0;
        }

        public function showProfile($keeperId='',$message=''){
            require_once(VIEWS_PATH . "validate-session.php");

			if($_SESSION['loggedUser']->getUserType() == "Owner"){
				$keeper = $this->keeperDAO->getByKeeperIdBD($keeperId);
				if(isset($keeper)){
					require_once(VIEWS_PATH . "keeper-profile.php");
				}
			}else{
				$user = $_SESSION["loggedUser"];
				$keeper = $this->keeperDAO->getByUserIdBD($user->getId());
				if(isset($keeper)){
					require_once(VIEWS_PATH . "keeper-profile.php");
				}else{
					$message='You are not registered as a Keeper';
				}
			}
        	

        	
        }

        public function showFilterListView($initialDate, $endDate) 
		{
			require_once(VIEWS_PATH . "validate-session.php");
			
			$check = $this->checkDates($initialDate, $endDate);

			if($check == 1) { $message1="Start Date past End Date"; $this->showListView(); }
			else if ($check == 2) { $message1="Start Date previous current date"; $this->showListView();}
			else
			{			
				$keeperList=$this->keeperDAO->GetAllBD();
				$keeperListFiltered = array();

				foreach ($keeperList as $keeper)
				{
					if($keeper->getInitialDate() >= $initialDate && $endDate >= $keeper->getEndDate())
					{
						array_push($keeperListFiltered, $keeper);
					}
				}

				$keeperList=$keeperListFiltered;
				if(empty($keeperList)) $message="No keepers available";
			}
			require_once(VIEWS_PATH . "keeper-list.php");
		}

    }

?>