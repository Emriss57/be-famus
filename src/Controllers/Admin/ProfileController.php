<?php

 /**
 * @Route(path="/admin-controls", name="admin") 
 */

 class ProfileController extends AbstractAdminController {


    public function getViewFolderName(): string {
        return 'admin';
    }


     /**
     * @param $context 
     * @Route(path="/profile", name="/profile", method="GET")
     */
    public function index($context) {
        $this->render('profile', $context);
    }


 }