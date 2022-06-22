<?php 


/**
 * @Route(path="/admin-controls/forms", name="admin/forms")
 */

 class ProductFormsController extends AbstractAdminController {


    protected function getViewFolderName(): string {
        return 'admin/forms';
    }


    /**
     * @param $context
     * @Route(path="/products/", name="/products", method="GET")
     */

     public function product($context){
         $entityManager = $context['em'];
         $attribute = $entityManager->getRepository('Attributes')->findAll();
         $context['attributes'] = $attribute;
         $currentDate = date_format(date_timestamp_set(new Datetime(),time()), 'Y-m-d');
         $context['date'] = $currentDate;
     
         $this->render('productForms', $context);
     }
 }

