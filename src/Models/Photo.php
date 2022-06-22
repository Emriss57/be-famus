<?php

use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity
* @ORM\Table(name="photo")
*/

class Photo {

        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue
         */
        private int $id;





        /**
         * @ORM\Column(type="string")
         */
        private string $name;




        /**
         * @ORM\Column(type="string")
         */
        private string $path;

        /**
         * @ORM\ManyToOne(targetEntity="Products", inversedBy="photos")
         */
        private ?Products $product;

        public function getId(): int {
            return $this->id;
        }

        public function getName(): string {
            return $this->name;
        }
        public function setName(string $name): void {
            $this->name = $name;
        }

        public function getPath(): string {
            return $this->path;
        }
        public function setPath(string $path): void {
            $this->path = $path;
        }
        public function getProduct(): ?Products {
          return $this->product;
        } 
            
        public function setProduct(?Products $product): self{
            $this->product = $product;
       
             return $this;
           }


}