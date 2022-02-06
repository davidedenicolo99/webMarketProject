<?php
require_once 'bootstrap.php';

if(!isUserLoggedIn() || !isset($_POST["action"])){
    header("location: login.php");
}

/**
 * Questo gestisce la modifica dei prodotti, in base al numero della richiesta post avro una modifica
 * eliminazione o inserimento (non in questo ordine) di un prodotto.
 * Qua ci posso arrivare solo se sono ADMIN.
 */

if($_POST["action"]==1){
    //Inserisco
    $product_name = htmlspecialchars($_POST["product_name"]);
    $descformula = htmlspecialchars($_POST["descformula"]);
    $desccompletaformula = htmlspecialchars($_POST["desccompletaformula"]);
    $autore = $_SESSION["idautore"];
    $quantity = $_POST["quantity"];
    $price = $_POST["product_price"];
    $product_id = $_POST["product_id"];
    

    $categorie = $dbh->getCategories();
    $categorie_inserite = array();
    foreach($categorie as $categoria){
        if(isset($_POST["categoria_".$categoria["idcategoria"]])){
            array_push($categorie_inserite, $categoria["idcategoria"]);
        }
    }

    list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["product_image"]);
    if($result != 0){
        $product_image = $msg;
        $id = $dbh->insertArticle($product_name, $desccompletaformula, $descformula, $product_image, $autore, $quantity, $price);
        if($id!=false){
            foreach($categorie_inserite as $categoria){
                $ris = $dbh->insertCategoryOfArticle($id, $categoria);
            }
            $msg = "Inserimento completato correttamente!";
        }
        else{
            $msg = "Errore in inserimento!";
        }
        
    }
    header("location: login.php?formmsg=".$msg);
}
if($_POST["action"]==2){
    //modifico
    $product_name = htmlspecialchars($_POST["product_name"]);
    $descformula = htmlspecialchars($_POST["descformula"]);
    $desccompletaformula = htmlspecialchars($_POST["desccompletaformula"]);
    $autore = $_SESSION["idautore"];
    $quantity = $_POST["quantity"];
    $price = $_POST["product_price"];
    $product_id = $_POST["product_id"];

    if(isset($_FILES["product_image"]) && strlen($_FILES["product_image"]["name"])>0){
        list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["product_image"]);
        if($result == 0){
            header("location: login.php?formmsg=".$msg);
        }
        $product_image = $msg;

    }
    else{
        $product_image = $_POST["oldimg"];
    }

    $dbh->updateArticleOfAuthor($product_id, $product_name, $desccompletaformula, $descformula, $product_image, $autore, $quantity, $price);
    

    $categorie = $dbh->getCategories();
    $categorie_inserite = array();
    foreach($categorie as $categoria){
        if(isset($_POST["categoria_".$categoria["idcategoria"]])){
            array_push($categorie_inserite, $categoria["idcategoria"]);
        }
    }
    $categorievecchie = explode(",", $_POST["categorie"]);

    $categoriedaeliminare = array_diff($categorievecchie, $categorie_inserite);
    foreach($categoriedaeliminare as $categoria){
        $ris = $dbh->deleteCategoryOfArticle($product_id, $categoria);
    }
    $categoriedainserire = array_diff($categorie_inserite, $categorievecchie);
    foreach($categoriedainserire as $categoria){
        $ris = $dbh->insertCategoryOfArticle($product_id, $categoria);
    }

    $msg = "Modifica completata correttamente!";
    header("location: login.php?formmsg=".$msg);
}

if($_POST["action"]==3){
    //cancello
    
    $product_id = $_POST["product_id"];
    $autore =  $_SESSION["idautore"];
    $dbh->deleteCategoriesOfArticle($product_id);
    $dbh->deleteArticleOfAuthor($product_id, $autore);
    
    $msg = "Cancellazione completata correttamente!";
    header("location: login.php?formmsg=".$msg);
}

?>