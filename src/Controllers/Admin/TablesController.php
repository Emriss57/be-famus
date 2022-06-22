<?php 
  /**
    * 
    * @Route(path="/admin-controls", name="admin")
    */

    class TablesController extends AbstractAdminController {

        /**
         *  @override
         */
        protected function getViewFolderName(): string
        {
            return "admin/tables";
        }

         /**
        * @param $context
        * @Route(path="/tables", name="/table", method="GET")
        */
        public function table($context) {
            $context['name'] = substr(get_class($this), 0, 0 - strlen("Controller"));
            $this->render('tables', $context);
        }

    }



?>