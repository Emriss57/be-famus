<?php 


/**
 * @Route(path="/categorie/[i:id]-[a:categories]")
 */

 class subCategoriesController extends AbstractController {

    public function getViewFolderName(): string {
        return 'categories/';
    }

/**
	 * @param $context
	 * @Route(path="/[a:subCategories]", name="sub-category", method="GET")
	 */
	public function subCategoriesIndex($context): void
    {
        $entityManager = $context['em'];
        $parentId = (int)$context['params']['id'];
		$subCategoryName = htmlspecialchars(trim($context['params']['subCategories']));
		$subCategoryQuery = $entityManager->getRepository('Categories')->createQueryBuilder('sc')
				->where('sc.parent = :id')
				->andWhere('sc.name = :name')
				->setParameter('id', $parentId)
				->setParameter('name', $subCategoryName)
				->getQuery();

		$subCategory = $subCategoryQuery->execute();

		if(empty($subCategory)) {
			header('Location: /404');
			
		} else {
            $attributes = $entityManager->getRepository('Attributes')->findAll();
			$products[] = $entityManager->getRepository('Products')->findBy(['category' => $subCategory[0]->getId()]);
            $context['app']['attributes'] = $attributes;
			$context['app']['productDisplay'] = $products;
			$this->render('details', $context);
		}

    }



 }