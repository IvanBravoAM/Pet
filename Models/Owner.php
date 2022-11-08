<?php namespace Models;

class Owner
{
    private $OwnerId;
    private $OwnerDate;
   
    private $description;
    private $active;

    

    public function getOwnerId(){ return $this->OwnerId; }
    public function setOwnerId($OwnerId): self { $this->OwnerId = $OwnerId; return $this; }

    public function getOwnerDate(){ return $this->OwnerDate; }
    public function setOwnerDate($OwnerDate): self { $this->OwnerDate = $OwnerDate; return $this; }

    public function getStudent(){ return $this->student; }
    public function setStudent($student): self { $this->student = $student; return $this; }

    public function getActive(){ return $this->active; }
    public function setActive($active): self { $this->active = $active; return $this; }
}

?>