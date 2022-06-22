<?php

abstract class AbstractAdminController extends AbstractController {

    public $logError;
    private Auth $auth;
    private $codeConnection;

    
    public function __construct() {
        $this->auth = new Auth();
        
    }
  
    private function getAccess($context) {
        if($this->auth->allow('administrateur',$context['em']) !== true && !isset($_SESSION['connected'])) {
           return header('location: /admin-controls/');
        } else {
            return;
        }
    }

    protected function render(string $viewName, array $context = []): void
    {
        $this->codeConnection = $this->auth->getUserField('code');
            
        switch($this->codeConnection) {
            case 200:
                
                $vn = $this->auth->allow('administrateur', $context['em']) === true ? 
                $viewName : 
                $this->auth->allow('administrateur',$context['em']);

                parent::render($vn, $context);
            break;

            case 404:
                $this->logError = 'Adresse email ou mot de passe incorrect';
                session_destroy();
                parent::render("loginForm", [ 'logError' => $this->logError ]);
            break;

            default:
                
                parent::render("loginForm");
               
            break;
        }
        
    }

}