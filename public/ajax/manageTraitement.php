<?php
require_once(__DIR__ . '/../../src/Core/Database.php');
require_once(__DIR__ . '/../../src/Models/Categories.php');
require_once(__DIR__ . '/../../src/Models/Attributes.php');
require_once(__DIR__ . '/../../src/Models/AttrValues.php');
require_once(__DIR__ . '/../../src/Models/Photo.php');
require_once(__DIR__ . '/../../src/Models/Products.php');

$database = new Database();




/////////////////// searchMotor //////////////



if(isset($_POST['search'])) {
    $searchValue = htmlspecialchars(trim($_POST['search']));
    $entityManager = $database->getEntityManager();
    if(strlen($searchValue) >= 2) {
        
        $searchQuery = $entityManager->getRepository('Products')->createQueryBuilder('p')
                        ->where('p.name LIKE :productName')
                        ->setParameter('productName', '%'.$searchValue.'%')
                        ->getQuery();
    
        $resultArray =  $searchQuery->execute();
        $content = '';
        foreach ($resultArray as $result) {
           
                        
           foreach($result->getChildren()->getValues() as $productChild) {
            $content .= '<div class="searchProduct"><p>'.$result->getName().'</p>';
            foreach($productChild->getCaracteristics()->getValues() as $caracteristics) {
                
               if(preg_match('/^#[0-9a-fA-F]{6}/',$caracteristics->getContent())) {
                   $content .= '<p class="searchAttribute">
                   '.$caracteristics->getAttribute()->getName().' : <span class="tableColor" style="background-color:'.$caracteristics->getContent().'"></span>
                   </p>';
            } else {
                
                $content .= '<p class="searchAttribute">
                                '.$caracteristics->getAttribute()->getName().' : '.$caracteristics->getContent().'
                            </p>';
               }
            }
            $photos = $entityManager->getRepository('photo')->findBy(['product' => $productChild->getId()]);
            foreach($photos as $photo) {
                $content .= '<img src="'.$photo->getPath().'">';

            }
            $content .= '<div>
                            <p class="searchPrice">Prix :<span> '.$productChild->getPrice().'€</span></p>
                            <p>Stock : '.$productChild->getQuantity().'</p>
                        </div>';
            $content .= '</div>';
           }
           
        }

        if(empty($resultArray)) {
            print('<div>no product found</div>');
        } else {
            print($content);
        }
        
    } 
    
}

if(isset($_POST['category'])) {
    $categoryId = json_decode(htmlspecialchars($_POST['category']));
    if(preg_match('/^[0-9{1}]/', $categoryId)) {
        $subCategories = $database->getEntityManager()->getRepository('Categories')->findBy(array('parent' => $categoryId));
        $content = '';
        foreach($subCategories as $subCategory) {
    
            $content .= '<option value="'.$subCategory->getId().'">'.$subCategory->getName().'</option>';
            
        }
       print($content); 
    }
    
}


/////////////////// attributeForm ///////////////
if(isset($_POST['attributes'])) {
    $entityManager = $database->getEntityManager();
    $attributeId = (int)$_POST['attributes'];
    $attribute = $entityManager->getRepository('Attributes')->findOneBy(['id' => $attributeId]);
    $attributeType = $attribute->getType();
    print($attributeType);
}


/////////////////// productCreate /////////////////////////

if(isset($_POST['generateProduct']) || isset($_POST['validProduct'])) {
    if(isset($_POST['subCategories'],$_POST['productName'], $_POST['price'], $_POST['description'])) {

    
        $entityManager = $database->getEntityManager();

        $subCategoryId = (int)$_POST['subCategories'];

        $subCategory = $entityManager->getRepository('Categories')->findOneBy(array('id' => $subCategoryId));
        $attributes = $entityManager->getRepository('Attributes')->findAll();
        $productName = htmlspecialchars(trim($_POST['productName']));
        $description = htmlspecialchars(trim($_POST['description']));
        $createdDate = htmlspecialchars(trim($_POST['createdDate']));
        $price = (float)$_POST['price'];
        $attributeCount = sizeof($attributes);
        $iterator = 0;
        
        $productChecker = '<table>';
        $productChecker .= '<tr class="tableHeader">
            <td>n° du produit</td>
            <td>Categorie du produit</td>
            <td>sous-categorie du produit</td>
            <td>Nom du produit</td>
            <td>Description</td>'
        ;

        $parentProduct = new Products();
        $parentProduct->setName($productName);
        $parentProduct->setDescription($description);
        $parentProduct->setCreateDate($createdDate);
        $parentProduct->setCategory($subCategory);

        if(isset($_POST['quantity'])) {
            $quantity = explode(',',$_POST['quantity']);
            $quantityArray = array_filter($quantity);

            if(sizeof($quantityArray) !== 0) {
                $entityManager->persist($parentProduct);
            } else {
                print('<div class="message messageUndone">Produit annulé stock non indiqué</div>');
                return;
            }
        
        }
        $arrays = [];
        foreach($attributes as $attribute) {
            $attributeName = strtr(utf8_decode(strtolower($attribute->getName())),utf8_decode('èéë'),'e'); 
            if(isset($_POST[$attributeName])) {
                $productChecker .= '<td>'.$attribute->getName().' du produit</td>';
                $arrays[] = $_POST[$attributeName];
            }
        }
        $attributeChooseCount = sizeof($arrays);
        if($attributeChooseCount === 0) {
            print('<div class="message messageUndone">Des ou un attribut(s) n\'ont pas été spécifié(s) !</div>');
            return;
        }
        $productChecker .= 
            '<td>Prix du produit</td>
            <td>Quantité</td>
            <td>Impact sur le prix</td>
            <td>Ajouter une photo</td>
            </tr>'
        ;

        $combinations = cartesian($arrays);
        
        foreach($combinations as $combination) {
        
            $declineProduct = new Products();
            $declineProduct->setReference(uniqid());
            $declineProduct->setParent($parentProduct);
        
            
           
            $iterator % 2 === 0 ? $productChecker .= '<tr class="firstColor">' : $productChecker .= '<tr class="secondColor">';
                $productChecker .= 
                    '<td>'.$iterator.'</td>
                    <td>'.$subCategory->getParent()->getName().'</td>
                    <td>'.$subCategory->getName().'</td>
                    <td>'.$productName.'</td>
                    <td>'.$description.'</td>'
                ;

            foreach($combination as $value) {
                $attrValue = $entityManager->getRepository('AttrValues')->findOneBy(['id' => $value]);
                $declineProduct->addCaracteristics($attrValue);
                preg_match('/^#[0-9a-fA-F]{6}/',$attrValue->getContent()) ? 
                $productChecker .= '<td><span style="background-color:'.$attrValue->getContent().'" class="tableColor"></span></td>'  : 
                $productChecker .= '<td>'.$attrValue->getContent().'';
                
            }
            $productChecker .=  
                    '<td>'.$price.'</td>
                    <td><input class="inputQuantity" name="quantity[]" type="number"></td>
                    <td><input class="inputPriceImpact" name="priceImpact[]" type="number"</td>
                    <td>
                        <input name="photo[]" class="inputPhoto" type="file" multiple>
                    </td>
                </tr>'
            ; 

            
            if(isset($_POST['validProduct'])) {
                
                
                if(isset($_POST['priceImpact'])) {
                    $priceImpact =  explode(',',$_POST['priceImpact']);

                    if($priceImpact[$iterator] !== '') {
                        $newPrice = $price + (float)$priceImpact[$iterator];
                        $declineProduct->setPrice($newPrice);
                    } else {
                        $declineProduct->setPrice($price);
                    }
                }  
                
                $quantity[$iterator] !== '' ? $declineProduct->setQuantity((int)$quantity[$iterator]) : '';
                $quantity[$iterator] !== '' ? $entityManager->persist($declineProduct) : '';

                if(isset($_FILES['photo'.$iterator])) {
                    $dossier = '/images/products/'; 
                    $extensions_valides = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
                    foreach($_FILES['photo'.$iterator]['name'] as $key => $name) {
                    
                        $ext_up = substr(strrchr($name,'.'),1);

                        if(in_array($ext_up,$extensions_valides)) {
                            $photoName = $name;
                            $path = $dossier.$photoName;
                            $resultat = move_uploaded_file($_FILES['photo'.$iterator]['tmp_name'][$key], '..'.$path);

                            if($resultat) {
                                $photo = new Photo();
                                $photo->setName($photoName);
                                $photo->setPath($path);
                                $photo->setProduct($declineProduct);
                                $entityManager->persist($photo);
                            }
                        }
                    }
                } else {
                                $dossier = '/images/products/no_image/'; 
                                $name = 'no_image.png';
                                $path = $dossier.$sname;
                                $photo = new Photo();
                                $photo->setName($name);
                                $photo->setPath($path);
                                $photo->setProduct($declineProduct);
                                $entityManager->persist($photo);
                }
                
                
            }
            $iterator++;
        }



        $productChecker .= '</table>';
        if(isset($_POST['validProduct'],$_POST['quantity']) && $_POST['quantity'] !== '') {
            $entityManager->flush();
            print('<div class="message messageDone">Produit enregistrer !</div>');
        
        } else {
            print($productChecker);
 
        }
    
    } else {
        print('<div class="message messageUndone">Veuillez remplir tous les champs !</div>');
  
    }
}


/////////////////// productToAdd /////////////////////////


if(isset($_POST['generateProductToAdd']) || isset($_POST['validProductToAdd'])) {
    $iterator = 0;
    $entityManager = $database->getEntityManager();
    $productId = (int)$_POST['productId'];
    $price = (float)$_POST['price'];

    $productToAdd = $entityManager->getRepository('Products')->findOneBy(['id' =>$productId]);
    $attributes = $entityManager->getRepository('Attributes')->findAll();
   
    $productChecker = '<table>';
        $productChecker .= '<tr class="tableHeader">
            <td>Id</td>
            <td>Référence du produit</td>';


    $arrays = array();
    foreach($attributes as $attribute) {
        $attributeName = strtr(utf8_decode(strtolower($attribute->getName())),utf8_decode('èéë'),'e'); 
        if(isset($_POST[$attributeName])) {
            $productChecker .= '<td>'.$attribute->getName().' du produit</td>';
            $arrays[] = $_POST[$attributeName];
        }
    }
    $attributeChooseCount = sizeof($arrays);
    if($attributeChooseCount === 0) {
        print('<div class="message messageUndone">Des ou un attribut(s) n\'ont pas été spécifié(s) !</div>');
        return;
    } 
    $productChecker .= 
            '<td>Prix du produit</td>
            <td>Quantité</td>
            <td>Impact sur le prix</td>
            <td>Ajouter une photo</td>
            </tr>'
    ;

    $combinations = cartesian($arrays);
        
    foreach($combinations as $combination) {
        
        $declineProduct = new Products();
        $declineProduct->setReference(uniqid());
        $declineProduct->setParent($productToAdd);

        $iterator % 2 === 0 ? $productChecker .= '<tr class="firstColor">' : $productChecker .= '<tr class="secondColor">';
        $productChecker .= 
                '<td>'.$iterator.'</td>
                <td>'.$declineProduct->getReference().'</td>'
        ;

        foreach($combination as $value) {
            $attrValue = $entityManager->getRepository('AttrValues')->findOneBy(['id' => $value]);
            $declineProduct->addCaracteristics($attrValue);
            preg_match('/^#[0-9a-fA-F]{6}/',$attrValue->getContent()) ? $productChecker .= '<td>' : $productChecker .= '<td>'.$attrValue->getContent().'';
            preg_match('/^#[0-9a-fA-F]{6}/',$attrValue->getContent()) ? $productChecker .=  '<span style="background-color:'.$attrValue->getContent().'" class="tableColor"></span>' : '';
            $productChecker .=   '</td>';    
        }


        $productChecker .=  
                '<td>'.$price.'</td>
                <td><input class="inputQuantity" name="quantity[]" type="number"></td>
                <td><input class="inputPriceImpact" name="priceImpact[]" type="number"</td>
                <td>
                    <input name="photo[]" class="inputPhoto" type="file" multiple>
                </td>
            </tr>'
        ;
        if(isset($_POST['quantity'])) {
            $quantity = explode(',',$_POST['quantity']);
            $quantityArray = array_filter($quantity);
    
            if(sizeof($quantityArray) !== 0) {
                
            } else {
                print('<div class="message messageUndone">Produit annulé stock non indiqué</div>');
                return;
            }
        
        }

        if(isset($_POST['validProductToAdd'])) {
                
                
            if(isset($_POST['priceImpact'])) {
                $priceImpact =  explode(',',$_POST['priceImpact']);

                if($priceImpact[$iterator] !== '') {
                    $newPrice = $price + (float)$priceImpact[$iterator];
                    $declineProduct->setPrice($newPrice);
                } else {
                    $declineProduct->setPrice($price);
                }
            }  
        
            $quantity[$iterator] !== '' ? $declineProduct->setQuantity((int)$quantity[$iterator]) : '';
            $quantity[$iterator] !== ''  ? $entityManager->persist($declineProduct) : '';

            if(isset($_FILES['photo'.$iterator])) {
                $dossier = '/images/products/'; 
                $extensions_valides = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
                foreach($_FILES['photo'.$iterator]['name'] as $key => $name) {
            
                    $ext_up = substr(strrchr($name,'.'),1);

                    if(in_array($ext_up,$extensions_valides)) {
                        $photoName = $name;
                        $path = $dossier.$photoName;
                        $resultat = move_uploaded_file($_FILES['photo'.$iterator]['tmp_name'][$key], '..'.$path);

                        if($resultat) {
                            $photo = new Photo();
                            $photo->setName($photoName);
                            $photo->setPath($path);
                            $photo->setProduct($declineProduct);
                            $entityManager->persist($photo);
                        }
                    }
                }
            } elseif($quantity[$iterator] !== '') {
                $dossier = '/images/products/no_image/'; 
                $name = 'no_image.png';
                $path = $dossier.$sname;
                $photo = new Photo();
                $photo->setName($name);
                $photo->setPath($path);
                $photo->setProduct($declineProduct);
                $entityManager->persist($photo);
            }
        }
            $iterator++;
    }
        
    $productChecker .= '</table>';
    if(isset($_POST['validProductToAdd'],$_POST['quantity']) && $_POST['quantity'] !== '') {
        $entityManager->flush();
        print('<div class="message messageDone">Produit enregistrer !</div>');
    
    } else {
        print($productChecker);

    }
       
}




function cartesian($input) {

        $result = [[]];
        
        foreach ($input as $key => $values) {
            $append = [];
            
            foreach($result as $product) { 
                
                foreach($values as $item) {
                   
                    $product[$key] = $item; 
                    
                    $append[] = $product;
                }
            }
            $result = $append;
        }
       return $result;
}