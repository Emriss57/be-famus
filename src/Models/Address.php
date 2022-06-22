<?php 

use Doctrine\ORM\Mapping as ORM;
    /**
     * @ORM\Entity
     * @ORM\Table(name="adresses")
     */

    class Adresses {

         /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue
         */
        private int $id;


        /**
         * @ORM\Column(type="string", nullable=true)
         */
        private string $line1;

        /**
         * @ORM\Column(type="string",length=255, nullable=true)
         */
        private string $line2;

        /**
         * @ORM\Column(type="string", length=255, nullable=true)
         */
        private string $line3;


        /**
         * @ORM\Column(type="string")
         */
        private string $postal_code;


        /**
         * @ORM\Column(type="string")
         */
        private string $city;


        /**
        * @ORM\ManyToOne(targetEntity="Users", inversedBy="adresse")
        */
        private ?Users $user;

        public function getId(): int { 
            return $this->id;
        }

        public function getLine(int $int): string { 
            switch($int) {
                case 1: 
                    $this->line1 != null ?  $this->line1 : $this->line1 = 'empty';
                    return $this->line1;
                break;
                case 2: 
                    $this->line2 != null ?  $this->line2 : $this->line2 = 'empty';
                    return $this->line2;
                break;
                case 3: 
                    $this->line3 != null ?  $this->line3 : $this->line3 = 'empty';
                    return $this->line3;
                break;
            }
        }
        public function setLine(string $line, int $int): void {
            switch($int) {
                case 1:
                    $this->line1 = $line;
                break;

                case 2:
                    $this->line2 = $line;
                break;

                case 3:
                    $this->line3 = $line;
                break;

            }
        }
        
        public function getPostalCode(): string { 
            return $this->postal_code;
        }
        
        public function setPostalCode(string $postal_code): void {
            $this->postal_code = $postal_code;
        }

        public function getCity(): string { 
            return $this->city;
        }
        
        public function setCity(string $city): void {
            $this->city = $city;
        }

        public function getUser(): ?Users {
          
            return $this->user;
        }

        public function setUser(?Users $user): void {
            $this->user = $user;
           
        }








    }

?>