<?php

/**
 * @Route(path="/user")
 */
class UserController extends AbstractUserController {

	
	private Auth $auth;

	/**
	 * @param $context
	 * @Route(path="/", name="user", method="GET")
	 */
    public function index($context): void
    {
	    $this->render('index', $context);
    }

		/**
        * @param $context
        * @Route(path="/connect", name="/authentification/user", method="POST")
        */
        public function authentificationRequest($context) {
            $entityManager = $context['em'];
            $this->auth = new Auth();
            $email = htmlspecialchars($_POST['email']);
            $password = trim($_POST['passw']);
            
            $this->auth->login($email,$password,$entityManager);

            header('Location: /user/');
        }

		/**
        * @Route(path="/register", name="/register", method="GET")
        */
        public function registerUser() {
            $this->render('registerUser', []);
        
        }


        /**
        * @param $context 
        * @Route(path="/register/request", name="/register/request", method="POST")
        */
        public function reqisterRequest($context) {
            if(isset($_POST['lastname'],$_POST['firstname'],$_POST['birthDate'],$_POST['email'], $_POST['username'], $_POST['passw'],$_POST['confirmPassw'])) {
                    $lastname = htmlspecialchars(trim($_POST['lastname']));
                    $firstname = htmlspecialchars(trim($_POST['firstname']));
                    $birthDate = htmlspecialchars(trim($_POST['birthDate']));
                    $email = htmlspecialchars(trim($_POST['email']));
                    $username = htmlspecialchars(trim($_POST['username']));
                    $password = htmlspecialchars(trim($_POST['passw']));
                    $confirmPassw = htmlspecialchars($_POST['confirmPassw']);

                    if(preg_match('/\S*(?=\S{3,})(?=\S*[a-zA-Z])\S*$/', $lastname)
                    && preg_match('/\S*(?=\S{3,})(?=\S*[a-zA-Z])\S*$/', $firstname)
                    
                    && filter_var($email, FILTER_VALIDATE_EMAIL)
                    && preg_match('/\S*(?=\S{8,})(?=\S*[a-zA-Z])\S*$/', $username)
                    && preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password)) {
                    
                        $entityManager = $context['em'];
                        $checkUsername = $entityManager->getRepository('Users')->FindOneBy(['username' => $username]);
                        $checkEmail = $entityManager->getRepository('Users')->findOneBy(['email' => $email]);
                        

                        if(isset($checkUsername, $checkEmail) || $confirmPassw !== $password) {
                            print('<div class="message messageUndone">Erreur dans la saisie</div> lol');
                            
                        } else {
                            $role = $entityManager->getRepository('Roles')->findOneBy(['label' => 'utilisateur']);
                            $salt = [
                                'cost' => 12,
                            ];
                            $hash_password = password_hash($password,PASSWORD_BCRYPT,$salt);



                            $newUser = new Users();

                            $newBasket = new Basket();

                            $newUser->setLastname($lastname);
                            $newUser->setFirstname($firstname);
                            $newUser->setDateOfBirth($birthDate);
                            $newUser->setEmail($email);
                            $newUser->setUsername($username);
                            $newUser->setPassword($hash_password);
                            $newUser->setRole($role);
                            $newUser->setProfileImage('/images/profile/unknown/user-avatar.png');

                            $newBasket->setUser($newUser);
                            $entityManager->persist($newUser);
                            $entityManager->persist($newBasket);
                            $entityManager->flush();

                            print('<div class="message messageDone">Compte crée </div>');
                        }
                        
                    
                    } else {
                        print('<div class="message messageUndone">Erreur dans la saisie</div>');
                    }


            } else {
                print('<div class="message messageUndone">Veuillez remplir tous les champs !</div>');
            }
        
        }

		/**
        * @Route(path="/disconnect", name="/disconnect", method="POST")
        */
        public function disconnect() {
            session_destroy();
            header('Location: /user/');
        
        }



		public function getUserField(string $field){
			if(isset($_SESSION['connected'][$field])){
				return $_SESSION['connected'][$field];
			}else{
				return false;
			}
		}


}