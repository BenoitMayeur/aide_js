$(function(){

    $dataFromDB = [];
    $itemsToOrder = [];
    $error_message_displayed = "Veuillez recharger la page. Si l'erreur persiste, contactez l'administrateur";
    $error_404_message = '404 : Page non-trouvée';
    $listHeaders = ["Marque", "Nom", "Prix"];

    /**
     * Function to receive the list of articles
     * if successful: the list is transfered to fillInGlobalTable() to display the data on the page
     * if error 404: text is displayed on the page
     * if other error 404: text is displayed on the page
     */

    function getListArticles(){
        $data_php = {};

        $.ajax({
            type: 'GET',
            url: 'read_all_articles.php',
            data: {
            },
            dataType: 'json',
            statusCode: {
                404: () => {
                showError($error_404_message);
                console.log($error_404_message);
            }
            },
            success: (result) => {
                $dataFromDB = result;
                fillInGlobalTable('articles', result);
                console.log($dataFromDB);
            },
            error: (data, status, error) => {
                showError($error_message_displayed);
                console.error(data);
                console.error(error, status);
            },
            timeout: 2000
        });
    }

    /**
     * Function to add an article DOES NOT WORK
     * @param newArticle: array ["marque"=> "XXX", "nom"=> "XXX", "prix"=> "XXX"] 
     */

    function addNewArticle($newArticle){

        console.log($newArticle["marque"]);
        console.log($newArticle["nom"]);
        console.log($newArticle["prix"]);

        $.ajax({
            method: "POST",
            url: 'create_article.php',
            data: {
                marque: $newArticle["marque"],
                nom: $newArticle["nom"],
                prix: $newArticle["prix"]
            },

            statusCode: {
                404: () => {
                    showError($error_404_message);
                    console.log('404 : Page non-trouvée');
                }
            },
            success: (result) => {
                console.log('Article ajouté');
                console.log(result);
                $(location).attr('href', 'http://localhost/scriptsclients/jquery/ex_recap_fin_jquery/index.php')
            },
            error: (data, status, error) => {
                showError($error_message_displayed);
                console.error(data);
                console.error(error);
                console.error(status);
            },
            timeout: 10000
        });
    }
    /**
     * Function used to disaply an error on the "add article" page
     * @param message 
     */

    function showError($message) {
        $('.add_form').insertAfter(`<p class='error'>${$message}</p>`);
        $('.error').css('color', 'red');
    }

    /**
     * Function to fill in the global table of articles on the "list articles" page 
     * Give css to the table
     * @param idTargetedTable: id of the table
     * @param rawData: data that should be displayed
     */

    function fillInGlobalTable($idTargetedTable, $rawData){

        $(`#${$idTargetedTable}`).append(`<thead><tr></tr></thead>`);

        for(let head of $listHeaders){
            $(`#${$idTargetedTable} thead tr`).append(`<th>${head}</th>`);
        }

        $(`#${$idTargetedTable}`).append(`<tbody></tbody>`);

        for(let item of $rawData){
            $(`#${$idTargetedTable} tbody`).append(`<tr>
                        <td>${item.marque}</td>
                        <td>${item.nom}</td>
                        <td>${item.prix}</td>
                        <td>
                            <button data-id=${item.id}>ajouter</button>
                        </td>
                    </tr>`);
        }

        $(`#${$idTargetedTable} tbody tr:odd`).css("background-color", "#F4F4F8");
        $(`#${$idTargetedTable} tbody tr:even`).css("background-color", "#EFF1F1");
        $(`#${$idTargetedTable} button`).css({"background-color": "blue", 
                                              "color": "white", 
                                              "border-radius": "5px",
                                              "padding": "0.5rem"});

    }

    /**
     * Function to fill in the table of orders on the "list articles" page 
     * Give css to the table
     * @param idTargetedTable: id of the table
     * @param rawData: data that should be displayed
     */

    function fillInOrderTable($idTargetedTable, $rawData){

        $(`#${$idTargetedTable} tbody tr`).remove();

        $sumSubprices = 0;

        for(let item of $rawData){

            $subprice = item.prix * item.quantity;
            $sumSubprices = $sumSubprices + $subprice;

            $(`#${$idTargetedTable} tbody`).append(`<tr>
                        <td class="brand_td">${item.marque}</td>
                        <td class="name_td">${item.nom}</td>
                        <td class="price_td">${item.prix}</td>
                        <td><button data-id=${item.id} data-operation="plus">+</button></td>
                        <td><button data-id=${item.id} data-operation="minus">-</button></td>
                        <td class="quantity_td">${item.quantity}</td>
                        <td>
                            ${$subprice}
                        </td>
                    </tr>`);
        }
        $(`#${$idTargetedTable} .brand_td`).css("width", "250px");
        $(`#${$idTargetedTable} .name_td`).css("width", "250px");
        $(`#${$idTargetedTable} .price_td`).css("width", "150px");
        $(`#${$idTargetedTable} .quantity_td`).css("width", "50px");
        $(`#${$idTargetedTable} tfoot .total`).text($sumSubprices);
    }

    /**
     * Function that updates by one (+ or -) the quantity of one article in an array
     * @param arrayItems: list of articles 
     * @param id: id of the articles which the quantity should be updated
     * @param operation: say if 1 should be added ("plus") or if 1 should be withdrawn ("minus")
     */

    function changeQuantityItem($arrayItems, $id, $operation){
        if($operation === "plus"){
            for(let item of $arrayItems){
                if(item.id == $id){
                    item["quantity"] = item["quantity"] + 1;
                }
            }
        }else{

            for(let item of $arrayItems){
                if(item.id == $id && item["quantity"] > 0){
                    item["quantity"] = item["quantity"] - 1;
                }  
                if(item.id == $id && item["quantity"] == 0){
                    $arrayItems = $arrayItems.filter(item => item.quantity >0);
                }   
            }
        }
        fillInOrderTable("commande", $arrayItems);
        return $arrayItems;
    }

    ////////////////////////////////////////////////////////////////////////////////    ////////////////////////////////////////////////////////////////////////////////
    // Code for the "list of articles" page

    if($(`#articles`).length){
        getListArticles();
    }

    // Detect the click on the "Ajouter" button in the table with the list of articles
    $(document).on("click", '#articles button', function(){
        $button_id = $(this).attr('data-id');

        if(!$itemsToOrder.some(item => item.id == $button_id)){

            for(let item of $dataFromDB){
                if(item.id == $button_id){
                    $itemToAdd = item;
                    $itemToAdd["quantity"] = 1;
                }
            }

            $itemsToOrder.push($itemToAdd);

            fillInOrderTable("commande", $itemsToOrder);
        }  
    })

    // Detect the click on a "+"" or "-"" button in the table with the list of orders
    $(document).on("click", '#commande button', function(){
        $button_id = $(this).attr('data-id');
        $button_operation = $(this).attr('data-operation');

        $itemsToOrder = changeQuantityItem($itemsToOrder, $button_id, $button_operation);
    })

    ////////////////////////////////////////////////////////////////////////////////    ////////////////////////////////////////////////////////////////////////////////
    // Code for the "add an article" page

    $('.add_form').submit(function(e){

        console.log('it works');
        $futureArticle = [];
        $futureArticle["marque"] = $(`.add_form [name='marque']`).val();
        $futureArticle["nom"] = $(`.add_form [name='nom']`).val();
        $futureArticle["prix"] = $(`.add_form [name='prix']`).val();
        console.log('$futureArticle', $futureArticle);
        addNewArticle($futureArticle);
        e.preventDefault();
    })



    
});