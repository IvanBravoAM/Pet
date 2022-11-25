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
            $petList = $this->petDAO->GetByUserIdBD($_SESSION['loggedUser']->getId());
            $petTypeController = new PetTypeController();
            $petTypeList = $petTypeController->petTypeDAO->GetAllBD();
            require_once(VIEWS_PATH . "pet-list.php");
    
        }

        public function Inactivate($petId){
            require_once(VIEWS_PATH."validate-session.php");
            
            $this->petDAO->Inactivate($petId);
            // $petList = $this->petDAO->GetByUserIdBD($_SESSION['loggedUser']->getId());
            $petList = $this->petDAO->GetByUserIdBD($_SESSION['loggedUser']->getId());

            $petTypeController = new PetTypeController();
            $petTypeList = $petTypeController->petTypeDAO->GetAllBD();
            require_once(VIEWS_PATH . "pet-list.php");
    
        }

        public function Update($PetId, $petName, $petBreed, $petSize,$Description,$photo,$vaccines,$video, $petTypeId){
            require_once(VIEWS_PATH."validate-session.php");
            $pet = $this->petDAO->GetByIdBD($PetId);;
            $petTypeController = new PetTypeController();
            $petType = $petTypeController->petTypeDAO->GetById($petTypeId);
            $pet->setName($petName);
            $pet->setBreed($petBreed);
            $pet->setSize($petSize);
            $pet->setPhoto($photo);
            $pet->setVaccines($vaccines);
            $pet->setVideo($video);
            $pet->setPetType($petType);
            $pet->setDescription($Description);
            $pet->setUserID($_SESSION['loggedUser']->getId());
            $pet->setIsActive(true);
            
            $message=$this->petDAO->Update($pet);
            $petList = $this->petDAO->GetByUserIdBD($_SESSION['loggedUser']->getId());
            
            $petTypeList = $petTypeController->petTypeDAO->GetAllBD();
            require_once(VIEWS_PATH . "pet-list.php");
    
        }
    
        public function ShowAddView($message= ''){
            $petTypeController = new PetTypeController();
            $petTypeList = $petTypeController->petTypeDAO->GetAllBD();
            
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH . "add-pet.php");
    
        }

        public function ShowModifyView($petId){
            $petTypeController = new PetTypeController();

            require_once(VIEWS_PATH."validate-session.php");
            if(!empty($petId)){
            $petTypeList = $petTypeController->petTypeDAO->GetAll();
            $pet = $this->petDAO->GetByIdBD($petId);
            require_once(VIEWS_PATH . "pet-modify.php");}
    
        }
    
        public function ShowPetProfile($PetId){
            require_once(VIEWS_PATH."validate-session.php");
            if(!empty($PetId)){
                $pet = $this->petDAO->GetById($PetId);
                require_once(VIEWS_PATH . "pet-profile.php");
            }
        }
    
        public function Add($petName, $petBreed, $petSize,$Description,$photo,$vaccines,$video, $petTypeId ){
            require_once(VIEWS_PATH."validate-session.php");

            $pet = new Pet();
            $pet->setName($petName);
            $pet->setBreed($petBreed);
            $pet->setSize($petSize);
            $pet->setPhoto($photo);
            $pet->setVaccines($vaccines);
            $pet->setVideo($video);
            
            $pet->setPetType($petTypeId);
            $pet->setDescription($Description);
            $pet->setUserID($_SESSION['loggedUser']->getId());
            $pet->setIsActive(true);
    
            $message=$this->petDAO->AddBD($pet);
            $this->ShowAddView($message);
        }
    

    }

?>