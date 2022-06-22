<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;





/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;
    /**
     * @ORM\Column(type="string", unique=true)
     */
    private string $username;

    /**
     * @ORM\Column(type="string")
     */
    private string $firstname;

    /**
     * @ORM\Column(type="string")
     */
    private string $lastname;



    /**
     * @ORM\Column(type="string")
     */

    private string $date_birth;

    /**
     * @ORM\Column(type="string")
     */
    private string $profile_image;


    /**
     * @ORM\Column(type="string", unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
    * @ORM\ManyToOne(targetEntity="Roles")
    */
    private ?Roles $role;

        
    /**
     * @ORM\OneToMany(targetEntity="Adresses", mappedBy="user")
     **/
    private ?Collection $adresse;

    public function __construct() {
        $this->adresse = new ArrayCollection();
    }

  
    public function getId(): int { 
        return $this->id;
    }

    public function getUsername(): string { 
        return $this->username;
    }
    
    public function setUsername(string $username): void {
        $this->username = $username;
    }
    public function getLastname(): string { 
        return $this->lastname;
    }
    
    public function setLastname(string $lastname): void {
        $this->lastname = $lastname;
    }
    public function getFirstname(): string { 
        return $this->firstname;
    }
    
    public function setFirstname(string $firstname): void {
        $this->firstname = $firstname;
    }

    public function getDateOfBirth(): string { 
        return $this->date_birth;
    }
    
    public function setDateOfBirth(string $date_birth): void {
        $this->date_birth = $date_birth;
    }

    public function getProfileImage(): string { 
        return $this->profile_image;
    }
    
    public function setProfileImage(string $profile_image): void {
        $this->profile_image = $profile_image;
    }

    public function getPassword(): string { 
        return $this->password;
    }
    
    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getEmail(): string { 
        return $this->email;
    }
    
    public function setEmail(string $email): void {
        $this->email = $email;
    }
    public function getRole(): ?Roles {
        return $this->role;
    }

    public function setRole(?Roles $role): void {
        $this->role = $role;
    }

    public function getAdress(): ?Collection {
   
        return $this->adresse;
        
    }

    public function setAdress(?Adresses $adresse): void {

    }

}
?>