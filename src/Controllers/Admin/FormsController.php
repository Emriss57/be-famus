<?php 


    /**
    * @Route(path="/admin-controls", name="admin")
    */
    class FormsController extends AbstractAdminController {

         /**
         *  @override
         */
        protected function getViewFolderName(): string
        {
            return "admin/forms";
        }

    /**
     * @param $context
    * @Route(path="/forms", name="/forms" , method="GET")
    */
        public function forms($context) {
            $context['name'] = substr(get_class($this), 0, 0 - strlen("Controller"));
            $this->render('forms', $context);
        }


   




    }





?>