<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Products
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private string $reference;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private string $name;


    /**
     * @ORM\column(type="string", length="255", nullable=true)
     */
    private string $description;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private string $created_date;
  
    /**
     * @ORM\Column(type="integer",length=11, nullable=true)
     */
    private int $quantity;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private float $price;
      /**
      * @ORM\ManyToMany(targetEntity="AttrValues", inversedBy="caracteristics")
      */
      private Collection $caracteristics;

    /**
     * @ORM\OneToMany(targetEntity="Products", mappedBy="parent", cascade={"remove"})
     */
      private Collection $children;

    /**
     * @ORM\ManyToOne(targetEntity="Products", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private ?Products $parent = null;


    /**
     * @ORM\ManyToOne(targetEntity="Categories", inversedBy="products")
     * 
     */
    private ?Categories $category;

    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="product", cascade={"remove"})
     * 
     */
    private Collection $photos;


    
    
    public function __construct() {
      $this->children = new ArrayCollection();
      $this->caracteristics = new ArrayCollection();
      $this->photo = new ArrayCollection();
    }
    public function getId(): int {
      return $this->id;
    }
    public function getReference(): string {
      return $this->reference;
    }
    public function setReference(string $reference): void {
      $this->reference = $reference;
    }
    public function getName(): string {
      return $this->name;
    }
    public function setName(string $name): void {
      $this->name = $name;
    }
    public function getDescription(): string {
      return $this->description;
    }
    public function setDescription(string $description): void {
      $this->description = $description;
    }
    public function getCreateDate(): string {
      return $this->created_date;
    }
    public function setCreateDate(string $created_date): void {
      $this->created_date = $created_date;
    }
    public function getQuantity(): int {
        return $this->quantity;
    }
    public function setQuantity(int $quantity): void {
      $this->quantity = $quantity;
    }
    public function getPrice(): float {
      return $this->price;
  }
  public function setPrice(float $price): void {
    $this->price = $price;
  }
   
    public function getChildren(): Collection {
      return $this->children;
    }
    public function getCaracteristics(): Collection {
      return $this->caracteristics;
    }
    public function addCaracteristics(AttrValues $caracteristics): self {
      if(!$this->caracteristics->contains($caracteristics)) {
        $this->caracteristics[] = $caracteristics;
      }
      return $this;
    }
    public function removeCaracteristics(AttrValues $caracteristics) {
        if (!$this->caracteristics->contains($caracteristics)) {
            return $this;
        }    
        $this->caracteristics->removeElement($caracteristics);
        $caracteristics->removeProductCaracteristics($this);
    }

    public function getParent(): ?Products {
      return $this->parent;
    }
    public function setParent(?Products $parent): void {
      $this->parent = $parent;
    }

    public function getCategory(): ?Categories {
      return $this->category;
    }
    public function setCategory(?Categories $category): void {
      $this->category = $category;
    }


    public function getPhoto(): ?Collection {
      return $this->photos;
    }
    
}