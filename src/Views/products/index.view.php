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
<?php if(isset($context['params']['subCategories'])) {?>

<div class="sectionHead">
            <div class="w90">
                <?php 
                $uriArray = explode('/',$_SERVER['REQUEST_URI']); 
                $breadcrumbs = array_filter(array_slice($uriArray,1,3,true));
                
                $last = array_pop($breadcrumbs);
                $max = sizeof($breadcrumbs);
                $contentBreadcrumbs = '';
                for($i = 1; $i <= $max; $i++) { 
                    $breadcrumbs[$i] === 'categorie' ? $contentBreadcrumbs .= '<a class="breadcrumb" href="/">Home</a>' :  $contentBreadcrumbs .= '<a class="breadcrumb" href="/categorie/'.$breadcrumbs[$i].'">'.preg_replace("/^[0-9]-/","",$breadcrumbs[$i]).'</a>';
                } 
                strpos($last, '?') ? $last = substr($last, 0, strpos($last, '?')) : '';
                $contentBreadcrumbs .= '<span class="breadcrumb">'.$last.'</span>' ;
                print($contentBreadcrumbs);
                ?>
            </div>
        </div>
<?php } ?>

<section>
    <div class="productImgContainer">
        <?php foreach ($context['app']['productDisplay'][0]->getPhoto()->getValues() as $key => $photo) { ?>
            <?php if($key === 0) { ?>
        
            <img id="firstDisplay" class="firstDisplay" src="<?= $photo->getPath() ?>" alt="">
            <div>
            <?php } ?>
   
            <img class="secondDisplay" src="<?= $photo->getPath() ?>" alt=""></a>

        <?php } ?>
        </div>
    </div>
        <div class="productDetailsContainer">
            <h1><?= $context['app']['productParent']->getName() ?></h1>
            <p>Référence : <?= $context['app']['productDisplay'][0]->getReference() ?></p>
            <p class="priceDisplay"> <?= $context['app']['productDisplay'][0]->getPrice() ?>€</p>
            <?php foreach($context['app']['attributes'] as $attribute) { ?>
                <h2 class='detailsTitle'><?= $attribute->getName() ?></h2>
                <div>
                <?php 
                $result = array();
                foreach($context['app']['productParent']->getChildren()->getValues()  as $productDecline) { ?>
                    <?php foreach($productDecline->getCaracteristics()->getValues() as $key => $values) { ?>
                        <?php if($values->getAttribute()->getId() === $attribute->getId()) { 
                            $result[$values->getId()] = $values->getContent(); 
                            }
                        ?>
                    <?php } ?>
                <?php 
                    } 
                    $result = array_unique($result, SORT_REGULAR);
                    foreach($result as $key => $results) {  
                ?>
                    <a href="?<?= strtolower($attribute->getName()).'='.$key ?>" class="<?= strtr(utf8_decode(strtolower($attribute->getName())),utf8_decode('èéë'),'e')?> detailsContent"><?= preg_match('/^#[0-9a-fA-F]{6}/',$results) ? '<span style="background-color:'.$results.'"'.'class="tableColor">' : $results ?></a>
                    <?php } ?>
                </div>
            <?php } ?>
            <form id="basketForm">
                <div class="quantityContainer">
                 
                </div>
                <button class="basketBtn">Ajouter au panier</button>
            </form>
        </div>



        </section>

        <script src="/js/basketAjax.js"></script>