<?php

abstract class AbstractUserController extends AbstractController {

    public $logError;
    private Auth $auth;
    private $codeConnection;

    
    public function __construct() {
        $this->auth = new Auth();
        
    }

    protected function render(string $viewName, array $context = []): void
    {
        $this->codeConnection = $this->auth->getUserField('code');
            
        switch($this->codeConnection) {
            case 200:
                $vn = $this->auth->allow('utilisateur', $context['em']) === true ? 
                $viewName : 
                $this->auth->allow('utilisateur',$context['em']);
                parent::render($vn, $context);
            break;

            case 404:
                $this->logError = 'Adresse email ou mot de passe incorrect';
                session_destroy();
                parent::render("loginUser", [ 'logError' => $this->logError]);
            break;

            default:
                
                $viewName === "registerUser" ? parent::render("registerUser") : parent::render("loginUser");
               
            break;
        }
        
    }

}