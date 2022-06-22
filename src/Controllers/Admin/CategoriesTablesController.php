<?php



    /**
     * @Route(path="/admin-controls/tables", name="admin")
     */


    class CategoriesTablesController extends AbstractAdminController {


        public function getViewFolderName(): string {
            return "admin/tables";
        }


        /**
         * @param $context
         * @Route(path="/categories/", name="/categories", method="GET")
         */

         public function indexCategories($context) {
             $context['app']['it'] = 0;
            $this->render('categoriesTables', $context);
         }


          /**
         * @param $context
         * @Route(path="/categories/update/[i:id]/", name="/categories/update", method="GET")
         */
         public function updateCategories($context) {
            $entityManager = $context['em'];
            $categoryId = intval($context['params']['id']);
            
                                    
            $category = $entityManager->getRepository('Categories')->findOneBy(['id' => $categoryId]);
            $context['app']['updateCategory'] = $category;
            $this->render('categoriesUpdate', $context);
         }

        /**
         * @param $context
         * @Route(path="/categories/update/[i:id]/done", name="/categories/update/done", method="POST")
         */
        public function doneCategories($context) {
            $entityManager = $context['em'];
            $categoryId = intval($context['params']['id']);
            $category = $entityManager->getRepository('Categories')->findOneBy(['id' => $categoryId]);

            if(isset($_POST['name']) && trim($_POST['name']) !== '') {
                $categoryName = htmlspecialchars(trim($_POST['name']));

                $category->setName($categoryName);
                $entityManager->flush();

                print('<div class="message messageDone" ><p>Modification réussie</p></div>');
            } else {
                print('<div class="message messageUndone" ><p>Erreur dans la modification. Veuillez remplir tous les champs !</p></div>');
            }
        }


         /**
         * @param $context
         * @Route(path="/categories/delete/[i:id]/", name="/categories/delete", method="GET")
         */
        public function deleteCategories($context) {
            $context['app']['it'] = 0;
            var_dump($context['params']['id']);
            $categoryId = (int)$context['params']['id'];
            $entityManager = $context['em'];
            $category = $entityManager->getRepository('Categories')->findOneBy(['id' => $categoryId]);
            $entityManager->remove($category);
            $entityManager->flush();
            $this->render('categoriesTables', $context);
        }


         /**
         * @param $context
         * @Route(path="/sub-categories/", name="/sub-categories", method="GET")
         */

        public function indexSubCategories($context) {
            $entityManager = $context['em'];
            $context['app']['it'] = 0;
            $subCategoriesQuery = $entityManager->getRepository('Categories')->createQueryBuilder('c')
                ->where('c.parent IS NOT NULL')
                ->getQuery();

            $subCategories = $subCategoriesQuery->execute();
            //$subCategories = $entityManager->getRepository('Categories')->findBy(['parent' => !NULL]);
            $context['app']['subCategories'] = $subCategories;
            $this->render('subCategoriesTables', $context);
        }

         /**
         * @param $context
         * @Route(path="/sub-categories/update/[i:id]/", name="/sub-categories/update", method="GET")
         */
        public function updateSubCategories($context) {
            $entityManager = $context['em'];
            $subCategoryId = intval($context['params']['id']);
            $subCategory = $entityManager->getRepository('Categories')->findOneBy(['id' => $subCategoryId]);
            $context['app']['updateSubCategory'] = $subCategory;
            $this->render('subCategoriesUpdate', $context);
         }
         /**
         * @param $context
         * @Route(path="/sub-categories/update/[i:id]/done", name="/sub-categories/update/done", method="POST")
         */
        public function doneSubCategories($context) {
            $entityManager = $context['em'];
            $subCategoryId = intval($context['params']['id']);
            $subCategory = $entityManager->getRepository('Categories')->findOneBy(['id' => $subCategoryId]);

            if(isset($_POST['name']) && trim($_POST['name']) !== '') {
                $subCategoryName = htmlspecialchars(trim($_POST['name']));

                $subCategory->setName($subCategoryName);
                $entityManager->flush();

                print('<div class="message messageDone" ><p>Modification réussie</p></div>');
            } else {
                print('<div class="message messageUndone" ><p>Erreur dans la modification. Veuillez remplir tous les champs !</p></div>');
            }
        }


         /**
         * @param $context
         * @Route(path="/sub-categories/delete/[i:id]/", name="/sous-categories/delete", method="GET")
         */
        public function deleteSubCategories($context) {
            $context['app']['it'] = 0;
            var_dump($context['params']['id']);
            $categoryId = (int)$context['params']['id'];
            $entityManager = $context['em'];
            $category = $entityManager->getRepository('Categories')->findOneBy(['id' => $categoryId]);
            $entityManager->remove($category);
            $entityManager->flush();
            header('Location: /admin-controls/tables/sub-categories/');
        }

    }