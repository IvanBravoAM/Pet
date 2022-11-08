<?php 

	namespace Controllers;

	use Models\Pet as Pet;
    use Controllers\PetTypeController;
    use DAO\PetDAO;

    class PetController{

        public $petDAO;

        public function __construct()
        {
            $this->petDAO = new PetDAO();
        }
    
        public function ShowPetListView(){
            require_once(VIEWS_PATH."validate-session.php");
            $petList = $this->petDAO->GetByUserId($_SESSION['loggedUser']->getId());
            require_once(VIEWS_PATH . "pet-list.php");
    
        }
    
        public function ShowAddView($message= ''){
            $petTypeController = new PetTypeController();
            $petTypeList = $petTypeController->petTypeDAO->GetAll();
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH . "add-pet.php");
    
        }
    
        public function ShowPetProfile($PetId){
            require_once(VIEWS_PATH."validate-session.php");
            if(!empty($PetId)){
                $pet = $this->petDAO->GetById($PetId);
                require_once(VIEWS_PATH . "pet-profile.php");
            }
        }
    
        public function Add($petName, $petBreed, $petSize,$Description, $petTypeId ){
            require_once(VIEWS_PATH."validate-session.php");
            $petTypeController = new PetTypeController;
            $petType = $petTypeController->petTypeDAO->GetById($petTypeId);
            $pet = new Pet();
            $pet->setName($petName);
            #$pet->setVaccineCert($fileName3);
            $pet->setBreed($petBreed);
            $pet->setSize($petSize);
            #$pet->setPetPics($fileName);
            #$pet->setPetVideo($fileName2);
            
            $pet->setPetType($petType);
            $pet->setDescription($Description);
            $pet->setUserID($_SESSION['loggedUser']->getId());
            $pet->setIsActive(true);
    
            $this->petDAO->AddBD($pet);
            $this->ShowAddView();
        }
    

    }

?>