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
    $DATABASE = 'shop';
    $connexion = new PDO('mysql:host=localhost;dbname='.$DATABASE.';charset=utf8', $USER, $PASSWORD);
    
    $articleManager = new ArticleManager($connexion);

    $articles = $articleManager->readAll();

    echo json_encode($articles);
} catch (Exception $exc) {
    $erreur = 'Erreur : ' . $exc->getMessage();
    var_dump($erreur);
    die($erreur);
}
