<?php 

	namespace Models;

	class Reservation
	{
		private $id;
		private $idOwner;
		private $idKeeper; 
		private $idPet; 
		private $initialDate;
		private $endDate; 
		private $days;
		private $totalPrice;
        private $status;

		/**
		 * Get the value of id
		 */ 
		public function getId()
		{
				return $this->id;
		}

		/**
		 * Set the value of id
		 *
		 * @return  self
		 */ 
		public function setId($id)
		{
				$this->id = $id;

				return $this;
		}

		/**
		 * Get the value of idOwner
		 */ 
		public function getIdOwner()
		{
				return $this->idOwner;
		}

		/**
		 * Set the value of idOwner
		 *
		 * @return  self
		 */ 
		public function setIdOwner($idOwner)
		{
				$this->idOwner = $idOwner;

				return $this;
		}

		/**
		 * Get the value of idPet
		 */ 
		public function getIdPet()
		{
				return $this->idPet;
		}

		/**
		 * Set the value of idPet
		 *
		 * @return  self
		 */ 
		public function setIdPet($idPet)
		{
				$this->idPet = $idPet;

				return $this;
		}

		/**
		 * Get the value of initialDate
		 */ 
		public function getInitialDate()
		{
				return $this->initialDate;
		}

		/**
		 * Set the value of initialDate
		 *
		 * @return  self
		 */ 
		public function setInitialDate($initialDate)
		{
				$this->initialDate = $initialDate;

				return $this;
		}

		/**
		 * Get the value of endDate
		 */ 
		public function getEndDate()
		{
				return $this->endDate;
		}

		/**
		 * Set the value of endDate
		 *
		 * @return  self
		 */ 
		public function setEndDate($endDate)
		{
				$this->endDate = $endDate;

				return $this;
		}

		/**
		 * Get the value of totalPrice
		 */ 
		public function getTotalPrice()
		{
				return $this->totalPrice;
		}

		/**
		 * Set the value of totalPrice
		 *
		 * @return  self
		 */ 
		public function setTotalPrice($totalPrice)
		{
				$this->totalPrice = $totalPrice;

				return $this;
		}

        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
                return $this->status;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */ 
        public function setStatus($status)
        {
                $this->status = $status;

                return $this;
        }

		/**
		 * Get the value of idKeeper
		 */ 
		public function getIdKeeper()
		{
				return $this->idKeeper;
		}

		/**
		 * Set the value of idKeeper
		 *
		 * @return  self
		 */ 
		public function setIdKeeper($idKeeper)
		{
				$this->idKeeper = $idKeeper;

				return $this;
		}

		/**
		 * Get the value of days
		 */ 
		public function getDays()
		{
				return $this->days;
		}

		/**
		 * Set the value of days
		 *
		 * @return  self
		 */ 
		public function setDays($days)
		{
				$this->days = $days;

				return $this;
		}
    }
    
?>