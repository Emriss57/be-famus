<nav>
    <ul class="navigation">
        <?php 
            foreach($context['app']['subCategories']($context['params']['id']) as $subCategory) {
        ?>

        <li>
            <a class="linkStyleDisabled linkNavigation <?= isset($context['params']['subCategories']) && $context['params']['subCategories'] == strtolower(str_replace('-', '',$subCategory->getName())) ? 'activeNavigation' : '' ?>" href="/categorie/<?= $this->ctx['params']['id'].'-'.$this->ctx['params']['categories'].'/'.strtolower(str_replace('-', '',$subCategory->getName())); ?>">
                <?= $subCategory->getName(); ?>
            </a>
        </li>

        <?php 
            }
        ?>
        <!--- <li class="navInput">
            <form action="#" method="GET">
                <input type="text" placeholder="search">
                <button class="border-0 bg-transparent">
                    <i class="bi bi-search"></i> 
                </button>
            </form>
            
        </li> --->
    </ul>
</nav>       



    <div class="sectionHead">
                <div class="w90">
                    <?php 
                    $uriArray = explode('/',$_SERVER['REQUEST_URI']); 
                    $breadcrumbs = array_filter(array_slice($uriArray,1,3,true));
                    
                    $last = array_pop($breadcrumbs);
                    $max = sizeof($breadcrumbs);
                    $contentBreadcrumbs = '';
                    for($i = 1; $i <= $max; $i++) { 
                        $breadcrumbs[$i] === 'categorie' ? $contentBreadcrumbs .= '<a class="breadcrumb" href="/">accueil</a>' :  $contentBreadcrumbs .= '<a class="breadcrumb" href="/categorie/'.$breadcrumbs[$i].'">'.preg_replace("/^[0-9]-/","",$breadcrumbs[$i]).'</a>';
                    } 
                    strpos($last, '?') ? $last = substr($last, 0, strpos($last, '?')) : '';
                    $contentBreadcrumbs .= '<span class="breadcrumb">'.preg_replace("/^[0-9]-/","",$last).'</span>' ;
                    print($contentBreadcrumbs);
                    ?>
                </div>
            </div>


<section>


    <div class="searchMotor">
        <form id="searchForm" action="#" method="GET">
        <hr>
        <?php if(!isset($context['params']['subCategories'])) { ?>
            <p>Catégorie : <?= $context['params']['categories'] ?></p>
            <i class="bi bi-plus-circle iSearch"></i>
            <div class="w90 searchMotorSection">
            <?php 
            foreach($this->ctx['app']['subCategories']($this->ctx['params']['id']) as $subCategory) {
            ?>

                <div>
                    <input name="subCategory[]" ONCHANGE="submit()" id="<?= 'subCategory'.$subCategory->getId() ?>" type="checkbox" value="<?= $subCategory->getId() ?>">
                    <label for="<?= 'subCategory'.$subCategory->getId() ?>"><?= $subCategory->getName() ?></label>
                </div>


        <?php 
            }
            ?>
            </div>   
            <?php
        }
        ?>   
         
        <?php 
        foreach($this->ctx['app']['attributes'] as $attribute) {
        ?>
            <p><?= $attribute->getName() ?></p>  
            <i class="bi bi-plus-circle iSearch"></i>
            <div class="w90 searchMotorSection">
            <?php 
            foreach($attribute->getValuesAttribute()->getValues() as $value) {
            ?>
           
           <div <?= preg_match('/^#[0-9a-fA-F]{6}/',$value->getContent()) ? 'style="background-color:'.$value->getContent().'"'.'class="tableColor"' : '' ?> >
                <input ONCHANGE="submit()" name="<?= strtr(utf8_decode(strtolower($attribute->getName())),utf8_decode('èéë'),'e') ?>[]" class="<?= preg_match('/^#[0-9a-fA-F]{6}/',$value->getContent()) ? 'inputColor check' : 'check' ?>" id="<?= $attribute->getName().$value->getId() ?>" type="checkbox" value="<?= $value->getId()?>">
                <label for="<?= $attribute->getName().$value->getId()?>"><?= preg_match('/^#[0-9a-fA-F]{6}/',$value->getContent()) ? '' : $value->getContent() ?></label>
            </div>
            <?php } ?>
            </div>
        <?php } ?>
        </form>
    </div>

    <div class="productDisplay">
                
                <?php 
                
                foreach ($context['app']['productDisplay'] as $products) {
                        foreach($products as $product) {?>
                        
                        <div class="productCard">
                        <a href="<?= '/categorie/'.strtolower($context['params']['id'].'-'.$context['params']['categories'].'/'.$product->getCategory()->getName().'/product/'.$product->getId()) ?>">
                    
                        <img class="productImgDisplay" src="<?= $product->getChildren()->first()->getPhoto()->current()->getPath()  ?>" alt="">
                        <p><?= $product->getName() ?></p>
                        
                        <p><span class="priceDisplay"><?= $product->getChildren()->first()->getPrice() ?></span></p>
                        
                        <?php foreach($product->getChildren()->getValues() as $declinedProduct) {
                             
                            $content = '';
                                foreach($declinedProduct->getCaracteristics()->getValues() as $attributeValues)
                                    if(preg_match('/^#[0-9a-fA-F]{6}/',$attributeValues->getContent())) {
                                        $content .= '<div style="background-color:'.$attributeValues->getContent().'"></div>';
                                    }
                            
                           
                            } 
                            echo $content;
                        ?>
                        </a>
                    </div>
                    
                <?php }
                    }
                ?>
    </div>



</section>