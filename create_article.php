<?php

// Autoload.
function loadClass($classname) {
    require $classname . '.php';
}

spl_autoload_register('loadClass');

try {
    // String de connexion à adapter selon votre environnement
    $USER = 'root';
    $PASSWORD = '';
    $connexion = new PDO('mysql:host=localhost;dbname=shop;charset=utf8', $USER, $PASSWORD);

    $articleManager = new ArticleManager($connexion);

    $article = new Article($_POST);

    $articleManager->create($article);

    echo 'Article a été créé';
} catch (Exception $exc) {
    $erreur = 'Erreur : ' . $exc->getMessage();
    var_dump('Problème de création : ' . $erreur);
    die($erreur);
}

?>