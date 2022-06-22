<?php 

    /**
     * @Route(path="/admin-controls/tables", name="admin")
     */

    class AttributesTablesController extends AbstractAdminController {


        public function getViewFolderName(): string {

            return 'admin/tables';

        }

        /**
         * @param $context
         * @Route(path="/attributes/", name="/attributes", method="GET")
         */
        public function attributesIndex($context) {
            $context['app']['it'] = 0;
            $context['content'] = 'attributes';
            $entityManager = $context['em'];
            $attributes = $entityManager->getRepository('Attributes')->findAll();
            $context['app']['attributes'] = $attributes;
            $this->render('attributesTables', $context);
        }

        /**
         * @param $context
         * @Route(path="/attributes/update/[i:id]/", name="attributes/update", method="GET")
         */
        public function updateAttributes($context) {
            $context['content'] = 'attributes';
            $entityManager = $context['em'];
            $attributeId = $context['params'];

            $attribute = $entityManager->getRepository('Attributes')->findOneBy(['id' => $attributeId]);

            $context['app']['updateAttribute'] = $attribute;
            $this->render('attributesUpdate', $context);
        }

        /**
         * @param $context
         * @Route(path="/attributes/update/[i:id]/done", name="attributes/done", method="POST")
         */
        public function doneAttributes($context) {
            $context['content'] = 'attributes';
            if(isset($_POST['name']) && trim($_POST['name']) !== '') {
                $attributeName = htmlspecialchars($_POST['name']);
                $entityManager = $context['em'];
                $attributeId = $context['params'];
    
                $attribute = $entityManager->getRepository('Attributes')->findOneBy(['id' => $attributeId]);

                $attribute->setName($attributeName);

                $entityManager->flush();
                print('<div class="message messageDone" ><p>Modification réussie</p></div>');
            } else {
                print('<div class="message messageUndone" ><p>Erreur dans la modification. Veuillez remplir tous les champs !</p></div>');
            }
        }

        /**
         * @param $context
         * @Route(path="/values/", name="/values", method="GET")
         */
        public function valuesIndex($context) {
            $context['app']['it'] = 0;
            $context['content'] = 'values';
            $entityManager = $context['em'];
            $values = $entityManager->getRepository('AttrValues')->findBy([],['attribute' => 'ASC']);
            $context['app']['values'] = $values;
            $this->render('attributesTables', $context);
        }


        /**
         * @param $context
         * @Route(path="/values/update/[i:id]/", name="/values/update", method="GET")
         */

         public function updatesValue($context) {
            $entityManager = $context['em'];
            $valueId = $context['params'];
            $context['content'] = 'values';

            $value = $entityManager->getRepository('AttrValues')->findOneBy(['id' => $valueId]);
            $context['app']['updateValue'] = $value;
            $this->render('attributesUpdate', $context);
         }

         /**
          * @param $context
          * @Route(path="/values/update/[i:id]/done", name="/values/done", method="POST")
          */
          public function doneValues($context) {
              $context['content'] = 'values';
              if(isset($_POST['name']) && trim($_POST['name']) !== '') {

                $name = $_POST['name'];
                $valueId = $context['params'];
                $entityManager = $context['em'];

                $value = $entityManager->getRepository('AttrValues')->findOneBy(['id' => $valueId]);

                $value->setContent($name);
                $entityManager->flush();

                print('<div class="message messageDone" ><p>Modification réussie</p></div>');
              } else {
                print('<div class="message messageUndone" ><p>Erreur dans la modification. Veuillez remplir tous les champs !</p></div>');
              }
          }

    }