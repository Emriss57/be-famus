<?php 



/**
 * @Route(path="/admin-controls", name="admin/forms")
 */


 class CategoriesFormsController extends AbstractAdminController {

    /**
     * @override
     */
    protected function getViewFolderName(): string {
        return "admin/forms";
    }

    /**
     * @param $context
     * @Route(path="/forms/categories/" , name="forms/categories", method="GET")
     */
    public function index($context) {
        $context['name'] = substr(get_class($this), 0, 0 - strlen("Controller"));
        $this->render('categoryForms', $context);
    }

    /**
     * @param $context
     * @Route(path="/forms/categories/insert", name="categories_insert" , method="POST")
     */
    public function createCategorie($context) {
        $entityManager = $context['em'];
        $categoryName = htmlspecialchars(trim($_POST['name']));
        if(preg_match('/^[A-Z{1}][a-z]/', $categoryName)) {
            $categories = new Categories();
            $categories->setName($categoryName);
            $entityManager->persist($categories);
            $entityManager->flush();
            print('<div class="message messageDone" ><p>Saisie réussie</p></div>');
        } else {
            print('<div class="message messageUndone" ><p>Erreur dans la saisie</p></div>');
        }
    }
    
     /**
     * @param $context
     * @Route(path="/forms/sub-categories/", name="/forms/sub-categories" , method="GET")
     */
    public function subCategorie($context) {
        $context['name'] = substr(get_class($this), 0, 0 - strlen("Controller"));
        $this->render('subCategoryForms', $context);
    }


     /**
     * @param $context
     * @Route(path="/forms/sub-categories/insert", name="sub-categories_insert" , method="POST")
     */
    public function createSubCategorie($context) {
        $entityManager = $context['em'];
        $categoryId = intval($_POST['categories']);
        $category = $entityManager->getRepository('Categories')->findOneBy(['id' => $categoryId]);
        $subCategoryName = htmlspecialchars(trim($_POST['name']));
        if(preg_match('/^[A-Z{1}][-a-z]/', $subCategoryName)) {
            $subCategories = new Categories();

        $subCategories->setName($subCategoryName);
        $subCategories->setParent($category);
        $entityManager->persist($subCategories);
        $entityManager->flush();
            print('<div class="message messageDone" ><p>Saisie réussie</p></div>');
        } else {
            print('<div class="message messageUndone" ><p>Erreur dans la saisie</p></div>');
        }
    }


 }