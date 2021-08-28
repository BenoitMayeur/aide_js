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

    $articleManager = new $articleManager($connexion);

    $article = new Article($_POST);

    $articleManager->update($article);

    echo 'Article (' . $article->getId() . ') correctement mis à jour';
} catch (Exception $exc) {
    $erreur = 'Erreur : ' . $exc->getMessage();
    var_dump('Problème de mise à jour : ' . $erreur);
    die($erreur);
}
