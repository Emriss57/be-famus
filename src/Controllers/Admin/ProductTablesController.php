<?php
use Doctrine\ORM\Tools\Pagination\Paginator;
 /**
  * @Route(path="/admin-controls/tables", name="admin")
  */

  class ProductTablesController extends AbstractAdminController {

    public function getViewFolderName(): string {
        return 'admin/tables';
    }

    /**
     * @param $context
     * @Route(path="/products/", name="/products", method="GET")
     */

    public function indexProduct($context) {
        $context['app']['it'] = 0;
        $entityManager = $context['em'];
        $currentPage = isset($_GET['page']) ? (int)($_GET['page']) : 0;
        $totalByPage = 5;
        $firstResult = $currentPage === 0 ? $currentPage * $totalByPage : ($currentPage - 1) * $totalByPage ;
        $productQuery = $entityManager->getRepository('Products')->createQueryBuilder('u')
                            ->where('u.parent is NULL')
                            ->setFirstResult($firstResult)
                            ->setMaxResults($totalByPage)
                            ->getQuery();

        $paginator = new Paginator($productQuery, true);
        $context['app']['totalProduct'] = ceil(count($paginator) / $totalByPage);
       
        foreach ($paginator as $product) {
          $context['app']['products'][] = $product;
        
        }
    
       
        $this->render('productsTables', $context);
    }

    /**
     * @param $context
     * @Route(path="/products/update/[i:id]/", name="/products/update", method="GET")
     */
    public function updateProduct($context) {
      $entityManager = $context['em'];
      $productId = (int)$context['params']['id'];
      $context['attributes'] = $entityManager->getRepository('Attributes')->findAll();
      $context['date'] = date_format(date_timestamp_set(new Datetime(),time()), 'Y-m-d');
      $context['app']['productToUpdate'] = $entityManager->getRepository('Products')->findOneBy(['id' => $productId]);
      if($context['app']['productToUpdate']->getParent() === NULL) {
 
        $this->render('productsUpdateTables', $context);
      } elseif($context['app']['productToUpdate']->getParent() !== NULL) {
          $context['attributes'] = $entityManager->getRepository('Attributes')->findAll();
          $this->render('productsDeclineUpdateTables', $context);
      }
      
    }
    /**
     * @param $context
     * @Route(path="/products/update/[i:id]/done", name="/products/update/done", method="POST")
     */
    public function doneProduct($context) {
      $entityManager = $context['em'];
      $productId = (int)$context['params']['id'];
      $product = $entityManager->getRepository('Products')->findOneBy(['id' => $productId]);

      if($product->getParent() === NULL) {
        if(isset($_POST['subCategories'],$_POST['productName'],$_POST['description'])) {
          $subCategory = $entityManager->getRepository('Categories')->findOneBy(['id' => (int)$_POST['subCategories']]);
          $productName = htmlspecialchars(trim($_POST['productName']));
          $description = htmlspecialchars(trim($_POST['description']));
          $modifDate = htmlspecialchars(trim($_POST['createdDate']));

          $product->setCategory($subCategory);
          $product->setName($productName);
          $product->setDescription($description);
          $product->setCreateDate($modifDate);

          $entityManager->flush();
          header('location: /admin-controls/tables/products/update/'.$product->getId().'/');
        }
      } elseif($product->getParent() !== NULL && isset($_POST['price'])) {
        $attributes = $entityManager->getRepository('attributes')->findAll();
        $price = (float)$_POST['price'];
        foreach($attributes as $key => $attribute) {

          //var_dump($product->getCaracteristics()->remove($key));
          if(isset($_POST[strtr(utf8_decode(strtolower($attribute->getName())),utf8_decode('èéë'),'e') ])) {
            $product->removeCaracteristics($product->getCaracteristics()->get($key));
            $attributeValueId = (int)$_POST[strtr(utf8_decode(strtolower($attribute->getName())),utf8_decode('èéë'),'e')];
            $attrValue = $entityManager->getRepository('AttrValues')->findOneBy(['id' => $attributeValueId]);
            $product->addCaracteristics($attrValue);
            
          }
        }
        $product->setPrice($price);
        $entityManager->flush();
        header('location: /admin-controls/tables/products/update/'.$product->getId().'/');


      } else {
        print('<div class="message messageUndone">Une erreur c\'est produit dans la modification du produit</div>');
      }


    }

    /**
     * @param $context
     * @Route(path="/products/add/[i:id]/", name="/products/add", method="GET")
     */
    public function addNewDeclineProduct($context) {
      $context['app']['it'] = 0;
      $entityManager = $context['em'];
      $productId = (int)$context['params']['id'];
      $context['app']['productToAdd'] = $entityManager->getRepository('Products')->findOneBy(['id' => $productId]);

      if($context['app']['productToAdd'] !== null) {
        if($context['app']['productToAdd']->getParent() === NULL) {
          $context['attributes'] = $entityManager->getRepository('Attributes')->findAll();
          $context['date'] = date_format(date_timestamp_set(new Datetime(),time()), 'Y-m-d');
          $this->render('productsAddTables', $context);

        } else {
          header('location: /404');
        }
      } else {
        header('location: /404');
      }
    }

    /**
     * @param $context
     * @Route(path="/products/delete/[i:id]/", name="/products/delete", method="GET")
     */
    public function deleteProduct($context) {
      $entityManager = $context['em'];
      $productId = (int)$context['params']['id'];

      $product =  $entityManager->getRepository('Products')->findOneBy(['id' => $productId]);
      $entityManager->remove($product);
      $entityManager->flush();
      header('location: /admin-controls/tables/products/');
    }
  }