<?php 

/**
 * @Route(path="/admin-controls/forms", name="admin/forms")
 */


class AttributesFormsController extends AbstractAdminController {

    public function getViewFolderName(): string {
        return 'admin/forms';
    }
    
    /**
     * @param $context
     * @Route(path="/attributes/", name="/forms/attributes" , method="GET")
     */
    public function attributes($context) {
        $context['name'] = substr(get_class($this), 0, 0 - strlen("Controller"));
        $entityManager = $context['em'];
        $context['content'] = 'attributes';
        $context['attributes'] = $entityManager->getRepository('attributes')->findAll();
        $this->render('attributeForms', $context);
    }


    /**
    * @param $context
    * @Route(path="/attributes/insert", name="attribute_insert" , method="POST")
    */
   public function createAttribute($context) {
       $entityManager = $context['em'];


          $attributeName = htmlspecialchars(trim($_POST['name']));
          $valueType = htmlspecialchars(trim($_POST['type']));
          if(preg_match('/^[A-Z{1}][a-z]/', $attributeName)  && preg_match('/^[a-z]/', $valueType)) {
              $attribute = new Attributes();
    
          $attribute->setName($attributeName);
          $attribute->setType($valueType);
          $entityManager->persist($attribute);
          $entityManager->flush();
            print('<div class="message messageDone" ><p>Saisie réussie</p></div>');
          } else {
            print('<div class="message messageUndone" ><p>Erreur dans la saisie</p></div>');
          }
     

   }

   /**
    * @param $context
    * @Route(path="/values/", name="/forms/values" , method="GET")
    */
    public function values($context) {
        
        $context['content'] = 'values';
        $entityManager = $context['em'];
        $context['attributes'] = $entityManager->getRepository('attributes')->findAll();
        $this->render('attributeForms', $context);
    }




     /**
    * @param $context
    * @Route(path="/values/insert", name="values_insert" , method="POST")
    */
   public function createValues($context) {

    $entityManager = $context['em'];
    if(isset($_POST['attribute'],$_POST['content'])) {
                
        $attributedId = (int)trim($_POST['attribute']);
        $valueName = htmlspecialchars(trim($_POST['content']));
        
        $attribute = $entityManager->getRepository('Attributes')->findOneBy(['id' => $attributedId]);
            if($valueName != '') {
                $valueAttribute = new AttrValues();

            $valueAttribute->setContent($valueName);
            
            $valueAttribute->setAttribute($attribute);
            $entityManager->persist($valueAttribute);
            $entityManager->flush();
                print('<div class="message messageDone" ><p>Saisie réussie</p></div>');
            } else {
                print('<div class="message messageUndone" ><p>Erreur dans la saisie</p></div>');
            }
    } else {
        print('<div class="message messageUndone" ><p>Veuillez remplir tout les champs !</p></div>');
    }
}




   


}