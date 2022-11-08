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

		public function add($petSize, $initDate, $endDate, $days, $price)
		{
			require_once(VIEWS_PATH . "validate-session.php");
			$Keeper = new Keeper();
			$Keeper->setUserId($_SESSION['loggedUser']->getId());
			$Keeper->setPetSize($petSize);
			$Keeper->setInitialDate($initDate);
			$Keeper->setEndDate($endDate);
			$Keeper->setDays($days);
			$Keeper->setPrice($price);
            $Keeper->setIsActive(true);

			$check = $this->checkDates($initDate, $endDate);

			if($check == 1) {
				$this->showAddView("Start Date past End Date"); }
			else if ($check == 2) { 
				$this->showAddView("Start Date previous current date"); }
			else
			{			
                $response=$this->keeperDAO->add($Keeper);
                $this->showHomeView($response);
			}
		}


		public function showAddView($message='')
		{
			require_once(VIEWS_PATH . "validate-session.php");
    
            $userId= $_SESSION['loggedUser']->getId();
            $check = $this->checkKeeper($userId);
            if($check != 0){
                $message='You are already registered as Keeper';
            }
			require_once(VIEWS_PATH . "add-keeper.php");
		}


		public function checkDates($initDate, $endDate)
		{	
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
			$keeperList=$this->keeperDAO->getAll();
			require_once(VIEWS_PATH . "keeper-list.php");
		}

        private function checkKeeper($userId) 
		{
            $KeeperList = $this->keeperDAO->getAll();

            foreach ($KeeperList as $Keeper) 
            {
                if ($Keeper->getUserId() == $userId) return 1;
                
            }
            return 0;
        }

        public function showProfile($message=''){
            require_once(VIEWS_PATH . "validate-session.php");
        	$user = $_SESSION["loggedUser"];
            $keeper = $this->keeperDAO->getById($user->getId());
			if(isset($keeper)){
				require_once(VIEWS_PATH . "keeper-profile.php");
			}else{
				$message='You are not registered as a Keeper';
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
				$keeperList=$this->keeperDAO->getAll();
				$keeperListFiltered = array();

				foreach ($keeperList as $keeper)
				{
					if($keeper->getInitialDate() <= $initialDate && $endDate <= $keeper->getEndDate())
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