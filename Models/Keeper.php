<?php namespace Models;

class Keeper
{
    private $KeeperId;

    private $isActive;

    private $userId;
    private $petSize;
    private $petType;
    private $initialDate;
    private $endDate;
    private $days=array();
    private $price;
 
 
 
    public function getKeeperId()
    {
        return $this->KeeperId;
    }

    public function setKeeperId($KeeperId)
    {
        $this->KeeperId = $KeeperId;

        return $this;
    }
    	    
   
    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    public function getPetSize()
    {
        return $this->petSize;
    }

    public function setPetSize($petSize)
    {
        $this->petSize = $petSize;

        return $this;
    }


    public function getInitialDate()
    {
        return $this->initialDate;
    }

    public function setInitialDate($initialDate)
    {
        $this->initialDate = $initialDate;

        return $this;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getDays()
    {
        return $this->days;
    }

    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }
    

    /**
     * Get the value of petType
     */ 
    public function getPetType()
    {
        return $this->petType;
    }

    /**
     * Set the value of petType
     *
     * @return  self
     */ 
    public function setPetType($petType)
    {
        $this->petType = $petType;

        return $this;
    }
}

?>