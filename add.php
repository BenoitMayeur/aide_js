<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Récap fin jQuery</title>
        <link href="./css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="./css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="index.php">Liste articles</a></li>
                <li><a href="add.php">Ajouter article</a></li>
            </ul>
        </nav>
        <div class="container">
            <h1>Ajouter un article</h1>
            <form class="add_form" method="post">
                <div>
                    <label for="marque">Marque</label>
                    <input name="marque" type="text">
                </div>
                <div>
                    <label for="nom">Nom</label>
                    <input name="nom" type="text">
                </div>
                <div>
                    <label for="prix">Prix</label>
                    <input name="prix" type="number">
                </div>
                <div>
                    <input type="submit" class="add_article">
                </div>
            </form>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.js" type="text/javascript"></script>
    <script src="js/bootstrap.bundle.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
</html>
