<?php 


class Auth {

    private $roles;

    /**
     * Identification utilisateur
     **/
    public function login($email,$password, $em){
       
        $user = $em->getRepository('users')->findOneBy(['email' => $email]);
      
        if(empty($user)) {
            $_SESSION['connected'] = [
                'code' => 404,
            ];
        } else {
            $user_pass = $user->getPassword();
            $authentificationControl = password_verify($password,$user_pass);
            if($authentificationControl === true) {

                
                $_SESSION['connected'] = [
                    'uid' => $user->getId(),
                    'lastname' => $user->getLastname(),
                    'firstname' => $user->getFirstname(),
                    'code' => 200,
                    'role' => $user->getRole()->getSlug(),
                    'adresse' => $user->getAdress()->getValues(),
                    'img' => $user->getProfileImage(),
                ];
                 
            } else {
               $_SESSION['connected'] = [
                   'code' => 404,
               ];
            }  
        }

    }
    /**
     * Autorise un rang 
     **/
    public function allow($rang, $em){
        $rolesAll = $em->getRepository('roles')->findAll();
        
       
        foreach($rolesAll as $d){
            $this->roles[$d->getLabel()] =  $d->getSlug();
        }
   

        // print_r($roles);
        if($this->getUserField('role') === false){
            return false;
        }elseif($this->roles[$rang] !== $this->getUserField('role')){
                return 'forbidden';
            }else{
                return true;
            }
        
    }
    /**
     * Récupère une information utilisation
     **/
    public function getUserField(string $field){
        if(isset($_SESSION['connected'][$field])){
            return $_SESSION['connected'][$field];
        }else{
            return false;
        }
    }
    
   

   
    
}

