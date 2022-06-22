<?php 
    use Doctrine\ORM\Mapping as ORM;


    /**
     * @ORM\Entity
     * @ORM\Table(name="roles")
     */
    class Roles {

         /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue
         */
        protected $id;


        /**
         * @ORM\Column(type="string")
         */
        private $label;


        /**
         * @ORM\Column(type="string")
         */
        private $slug;

        /**
         * @ORM\Column(type="integer")
         */
        private $rank;

        

        public function getId(): int { 
            return $this->id;
        }

        public function getLabel(): string { 
            return $this->label;
        }
        public function setLabel(string $label): void {
            $this->label = $label;
        }
        
        public function getSlug(): string { 
            return $this->slug;
        }
        
        public function setSlug(string $slug): void {
            $this->slug = $slug;
        }

        public function getRank(): int { 
            return $this->rank;
        }
        
        public function setRank(int $rank): void {
            $this->rank = $rank;
        }
        
    

       
    }

?>
