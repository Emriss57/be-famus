<?php 

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="basket_row")
 */
class BasketRow {

     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;


   
    /**
     * @ORM\OneToOne(targetEntity="Products")
     */
    private ?Products $product;

    /**
     * @ORM\ManyToOne(targetEntity="Basket", inversedBy="basket_row")
     */
    private ?Basket $basket;
     /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

   public function getId() {
    return $this->id;
   }

   public function getProduct(): ?Products {
    return $this->products;
   }

   public function setProduct(?Products $product) : void {
       $this->products = $product;
   }

   public function getBasket(): Basket {
       return $this->basket;
   }

   public function setBasket(?Basket $basket): void  {
       $this->basket = $basket;
   }

   public function getQuantity(): int  {
    return $this->quantity;
    }
   public function setQuantity(int $quantity): void  {
       $this->quantity = $quantity;
   }
}

?>