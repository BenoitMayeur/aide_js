<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Récap fin jQuery</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="index.php">Liste articles</a></li>
                <li><a href="add.php">Ajouter article</a></li>
            </ul>
        </nav>
        <div class="container">
            <h1>Articles</h1>
            <table id="articles" class="table table-striped">        
            </table>
            <h1>Commande</h1>
            <table id="commande" class="table table-striped">  
                <thead> 
                    <tr>
                        <th>Marque</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th class="quantite" colspan="3">Quantité</th>
                        <th>Sous-total</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>                    
                        <td class="text-uppercase text-right" colspan="6">Total</td>
                        <td class="total">0</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.js" type="text/javascript"></script>
    <script src="js/bootstrap.bundle.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
</html>
