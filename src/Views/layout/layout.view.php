<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site de vente de vêtements pour femme, homme et enfants, plus de 200 nouveautées tous les jours">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Rubik+Beastly&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css?v=<?= time() ?>">
    <link rel="icon" href="/images/229f4daeff154a438d5841d26e09a95d.png">
    <title>Vêtements de luxe | <?= $match['name']; ?> | Be Famus</title>
</head>
<body id="bodyDark"> 

    <?php strpos($match['name'],$this->manageSystem) === false ? require_once('../src/Views/_bases/header.view.php') : null ?> 
        <?= $content ?>      
    <?php strpos($match['name'],$this->manageSystem) === false ? require_once('../src/Views/_bases/footer.view.php') : null ?>
</body>

</html>