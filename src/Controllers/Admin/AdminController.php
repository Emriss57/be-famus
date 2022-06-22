<?php 



    /**
    * 
    * @Route(path="/admin-controls", name="admin")
    */

   
    class AdminController extends AbstractAdminController  {

        private Auth $auth;

        /**
        * @param $context
        * @Route(path="/", name="/home", method="GET")
        */
        public function index($context) {
            $context['name'] = substr(get_class($this), 0, 0 - strlen("Controller"));
            $this->render('index',$context);
        }

        /**
        * @param $context
        * @Route(path="/connect", name="/authentification", method="POST")
        */
        public function authentificationRequest($context) {
            $entityManager = $context['em'];
            $this->auth = new Auth();
            $email = htmlspecialchars(trim($_POST['email']));
            $password = trim($_POST['passw']);
            
            $this->auth->login($email,$password,$entityManager);

            header('Location: /admin-controls/');
        }

        /**
        * @Route(path="/disconnect", name="/disconnect", method="POST")
        */
        public function disconnect() {
            session_destroy();
            header('Location: /admin-controls/');
        
        }

    }

?>