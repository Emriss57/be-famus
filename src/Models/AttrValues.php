<?php 

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
    /**
    * @ORM\Entity
    * @ORM\Table(name="attr_values")
    */

    class AttrValues {
        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue
         */
        private $id;


        /**
         * @ORM\Column(type="string")
         */
        private $content;

        

        /**
         * @ORM\ManyToOne(targetEntity="Attributes", inversedBy="values")
         */
        private $attribute;

        /**
         * @ORM\ManyToMany(targetEntity="Products", mappedBy="caracteristics")
         */
        private $productCaracteristics;


        public function __construct() {
            $this->productCaracteristics = new ArrayCollection();
            
        }

        public function getId(): int {
            return $this->id;
        }

        public function getContent(): string {
            return $this->content;
        }

        public function setContent(string $content): void {
            $this->content = $content;
        }

       

        public function getAttribute(): ?Attributes {
            return $this->attribute;
        }

        public function setAttribute(?Attributes $attribute) {
            $this->attribute = $attribute;
        }

        public function getProductCaracteristics(): Collection   {
            return $productCaracteristics;
        }

        public function addProductCaracteristics(Products $productCaracteristics): self   {
            if(!$this->productCaracteristics->contains($productCaracteristics)) {
                $this->productCaracteristics->add($productCaracteristics);
            }
            $productCaracteristics->addCaracteristics($this);
        }
        public function removeProductCaracteristics(Products $productCaracteristics) {
        if (!$this->productCaracteristics->contains($productCaracteristics)) {
            return $this;
        }    
        $this->productCaracteristics->removeElement($productCaracteristics);
        $productCaracteristics->removeCaracteristics($this);
    }


        public function setProductCaracteristics(?Products $productCaracteristics) {
            $this->attribute = $attribute;
        }


    }
    

?>