<?php

/**
 * @Route(path="/categorie")
 */
class CategoriesController extends AbstractController {

	/**
	 * @param $context
	 * @Route(path="/[i:id]-[a:categories]", name="category", method="GET")
	 */
	public function categoriesIndex($context): void
    {
		$entityManager = $context['em'];

		
		$categoryId = intval($context['params']['id']);
		$categoryName = htmlspecialchars(trim($context['params']['categories']));
		$categoryQuery = $entityManager->getRepository('Categories')->createQueryBuilder('c')
				->where('c.id = :id')
				->andWhere('c.name = :name')
				->setParameter('id', $categoryId)
				->setParameter('name', $categoryName)
				->getQuery();

		$category = $categoryQuery->execute();

		if(empty($category)) {
			header('Location: /404');
			
		} else {

			foreach ($category[0]->getChildren()->getValues() as $subCategory) {
				$products[] = $entityManager->getRepository('Products')->findBy(['category' => $subCategory->getId()]);
			}

			$context['app']['productDisplay'] = $products ?? array();
			$attributes = $entityManager->getRepository('Attributes')->findAll();
			$context['app']['attributes'] = $attributes;
			$this->render('details', $context);
		}
    }

	
	

}