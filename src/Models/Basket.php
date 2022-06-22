<?php 
    use Doctrine\ORM\Mapping as ORM;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Collections\Collection;

    /**
     * @ORM\Entity
     * @ORM\Table(name="basket")
     */
    class Basket {

         /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue
         */
        protected $id;


        /**
         * @ORM\OneToOne(targetEntity="Users")
         */
        private $user;

        /**
         * @ORM\OneToMany(targetEntity="BasketRow", mappedBy="basket")
         */
         private Collection $basket_row;


         public function __construct() {
             $this->basket_row = new arrayCollection();
         }

        public function getId(): int { 
            return $this->id;
        }

        public function getuser(): ?Users { 
            return $this->user;
        }
        
        public function setUser(?Users $user): void {
            $this->user = $user;
        }
        



        public function addBasketRow(BasketRow $basket_row): self {
        if (!$this->basket_row->contains($basket_row)) {
            $this->basket_row[] = $basket_row;
            $basket_row->setBasket($this);
        }
        return $this;
    }
    

    public function removeBasketRow(BasketRow $basket_row): self
    {
        if ($this->basket_row->contains($basket_row)) {
            $this->basket_row->removeElement($basket_row);

            if ($basket_row->getBasket() === $this) {
                $basket_row->setBasket(null);
            }
        }
        return $this;
    }

       
    }

?>