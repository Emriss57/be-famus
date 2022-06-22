<?php
    use Doctrine\ORM\Mapping as ORM;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Collections\Collection;

    /**
     * @ORM\Entity
     * @ORM\Table(name="categories")
     */
    class Categories
    {
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
     * @ORM\ManyToOne(targetEntity="Categories", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private ?Categories $parent = null;


    /**
     * @ORM\OneToMany(targetEntity="Categories", mappedBy="parent")
     */
    private ?Collection $children;

    
        
    public function __construct() {
        $this->children = new ArrayCollection();
        $this->product = new ArrayCollection();
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


        public function getParent(): ?Categories { 
            return $this->parent;
        }
        
        public function setParent(?Categories $parent): void {
            $this->parent = $parent;
        }

        public function getChildren(): Collection {
            return $this->children;
        }
    }
