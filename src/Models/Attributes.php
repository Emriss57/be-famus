<?php 
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="attributes")
*/
class Attributes {

      /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue
         */
        private $id;


        /**
         * @ORM\Column(type="string")
         */
        private $name;

        /**
         * @ORM\Column(type="string")
         */
        private $type;
        
        /**
         * @ORM\OneToMany(targetEntity="AttrValues", mappedBy="attribute")
         */
        private Collection $values;

        public function __construct() {
            $this->values = new ArrayCollection();
        }


        public function getId(): int {
            return $this->id;
        }

        public function getName(): string {
            return $this->name;
        }

        public function setName(string $name): void {
            $this->name = $name;
        }  
        public function getType(): string {
            return $this->type;
        }

        public function setType(string $type): void {
            $this->type = $type;
        }

        public function getValuesAttribute(): Collection {
            return $this->values;
        }

}

?>