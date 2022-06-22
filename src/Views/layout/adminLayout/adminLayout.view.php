<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Rubik+Beastly&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/manage.css?v=<?= time() ?>">
    <link rel="icon" href="/images/229f4daeff154a438d5841d26e09a95d.png">
    <title>Vêtements de luxe | <?= $match['name']; ?> | Be Famus</title>
</head>
<body id="bodyDark"> 
    <div class="container">
        <div class="container2">
            <header>
                <div class="headerContainer w90">
                    <div id="searchContainer" class="searchContainer">
                        <input id="searchInput" type="text" placeholder="Entrez votre recherche" name="search">
                        <button id="removeSearch">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <div id="searchOuput" class="searchOutput">
                            
                        </div>
                    </div>
                   
                    <button id="menuBtn2" class="headerBtn menuBtn">
                         <i class="bi bi-list"></i>
                    </button>
                    <button id="searchBtn" class="headerBtn">
                        <i class="bi bi-search"></i> 
                    </button>
                    <button id="mailBtn" class="headerBtn">
                        <i class="bi bi-envelope"></i>
                    </button>
                    <span id='userMenuDisplay' class="avatarContainer">
                        <img class="avatar" src="<?= $this->auth->getUserField('img') ?>" alt="">
                        <ul id="userMenu" class="displayLink userMenu">
                            <li>
                                <p><?= $this->auth->getUserField('lastname').' '.$this->auth->getUserField('firstname'); ?></p>
                            </li>
                            <li>
                                <a href="/admin-controls/profile">Gérer votre compte</a>
                            </li>
                            <li>
                                <form action="/admin-controls/disconnect" method="POST">
                                    <button class="disconnectBtn" type="submit">Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </span> 
                 </div>
            </header>
            <div class="sectionHead">
                <div class="w90">
                    <?php 
                    $uriArray = explode('/',$_SERVER['REQUEST_URI']); 
                    $breadcrumbs = array_filter(array_slice($uriArray,1,3,true));
                    
                    $last = array_pop($breadcrumbs);
                    $max = sizeof($breadcrumbs);
                    $contentBreadcrumbs = '';
                    for($i = 1; $i <= $max; $i++) { 
                        $breadcrumbs[$i] === 'admin-controls' ? $contentBreadcrumbs .= '<a class="breadcrumb" href="/'.$breadcrumbs[$i].'/">accueil</a>' :  $contentBreadcrumbs .= '<a class="breadcrumb" href="/admin-controls/'.$breadcrumbs[$i].'">'.$breadcrumbs[$i].'</a>';
                    } 
                    $last === 'admin-controls' ? $last = 'accueil' : null;
                    $contentBreadcrumbs .= '<a class="breadcrumb">'.$last.'</a>' ;
                    print($contentBreadcrumbs);
                    ?>
                </div>
            </div>
            <section class="mx-auto">
                <?= $content ?> 
            </section>
        </div>
        <nav id="nav">
                <button class="navMenu" id="menuBtn"><i class="bi bi-list"></i></button> 
                <h1 class="navTitle">Be FAMUS</h1>
                <hr>
                <div class="navSection w90">
                    <div class="homeContainer">
                        <a class="link homeIcon  <?= substr($_SERVER['REQUEST_URI'], 15) === '/' ? 'active' : null;  ?>" href="/admin-controls/">
                            <i class="bi bi-house-door-fill"></i>
                        </a>
                        <a class="link displayLink display  homeLink <?= substr($_SERVER['REQUEST_URI'], 15) === '/' ? 'active' : null  ?>" href="/admin-controls/">Home</a>
                    </div>
                </div>
                <h2 class="navTitle">GESTION</h2>
                <hr>
                <div class="navSection w90">
                    <div class="manageContainer">
                        <a class="link  <?= substr($_SERVER['REQUEST_URI'], 15) === '/tables' ? 'active' : null;  ?>" href="/admin-controls/tables">
                            <i class=" bi bi-table"></i>
                        </a>
                        <a class="link displayLink display <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 15),'/tables') === true ? 'active' : null; ?>" href="/admin-controls/tables">Tables</a>
                        <button class="manageBtn displayLink <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 15),'/tables') === true ? 'active' : null; ?>">
                            <i class="bi bi-caret-right"></i>
                        </button>
                        <div id="tablesContent" class="displayLink contentContainer ">
                            <a class="link <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 22),'/categories') === true ? 'active' : null;  ?>" href="/admin-controls/tables/categories/">Categories</a>
                            <a class="link <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 22),'/sub-categories') === true ? 'active' : null;  ?>" href="/admin-controls/tables/sub-categories/">Sous-categories</a>
                            <a class="link <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 22),'/attributes') === true ? 'active' : null;  ?>" class="" href="/admin-controls/tables/attributes/">Attributs</a>
                            <a class="link <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 22),'/products') === true ? 'active' : null;  ?>" href="/admin-controls/tables/products/">Produits</a>
                        </div>
                    </div>
                    
                    <div class="manageContainer">
                        <a class="link  <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 15),'/forms') === true ? 'active' : null;  ?>" href="/admin-controls/forms">
                            <i class="bi bi-textarea-resize"></i>
                        </a>
                        <a class="link displayLink display <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 15),'/forms') === true ? 'active' : null;  ?>" href="/admin-controls/forms">Forms</a>
                        <button class="manageBtn displayLink  <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 15),'/forms') === true ? 'active' : null; ?>">
                            <i class="bi bi-caret-right"></i>
                        </button>
                        <div id="formsContent" class="displayLink contentContainer">
                            <a class="link <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 21),'/categories') === true ? 'active' : null;  ?>" class="" href="/admin-controls/forms/categories/">Categories</a>
                            <a class="link <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 21),'/sub-categories') === true ? 'active' : null;  ?>" href="/admin-controls/forms/sub-categories/">Sous-categories</a>
                            <a class="link <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 21),'/attributes') === true ? 'active' : null;  ?>" class="" href="/admin-controls/forms/attributes/">Attributs</a>
                            <a class="link <?= str_starts_with(substr($_SERVER['REQUEST_URI'], 21),'/products') === true ? 'active' : null;  ?>" href="/admin-controls/forms/products/">Produits</a>
                        </div>
                    </div>
                </div>
        </nav>
    </div>
    <script src="/js/admin/manage.js"></script>
</body>
</html>