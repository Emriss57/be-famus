<?php

/**
 * @Route(path="/categorie/[i:id]-[a:categories]/[a:subCategories]/product")
 */
class ProductsController extends AbstractController {

	/**
	 * @param $context
	 * @Route(path="/[i:productId]", name="product", method="GET")
	 */
	public function productDetails($context): void
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
			$productId = intval($context['params']['productId']);
			$productQuery = $entityManager->getRepository('Products')->createQueryBuilder('p')
				->where('p.category = :id')
				->andWhere('p.id = :productId')
				->setParameter('id', $subCategory[0]->getId())
				->setParameter('productId', $productId)
				->getQuery();

			$product = $productQuery->execute();
			if(empty($product)) {
				header('Location: /404');

			} else {

		

				$productDisplay = array();
				foreach($product[0]->getChildren()->getValues() as $declineProduct){
					foreach($declineProduct->getCaracteristics()->getValues() as $values) {
						if(isset($_GET[strtolower($values->getAttribute()->getName())])) {
							if ((int)$_GET[strtolower($values->getAttribute()->getName())] === $values->getId()) {
							array_push($productDisplay,$declineProduct);
							}
						} else {
							
							
							

						}
					}

				}
			
				array_push($productDisplay,$product[0]->getChildren()->first());
				$context['app']['productParent'] = $product[0];
				$context['app']['productDisplay'] = $productDisplay;
				$context['app']['attributes'] = $entityManager->getRepository('Attributes')->findAll();
				$this->render('index', $context);
			}

			
		}

    }

}