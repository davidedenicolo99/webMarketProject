<?php
require_once 'bootstrap.php';



if(!isUserLoggedIn() || !isset($_GET["action"]) || ($_GET["action"]!=1 && $_GET["action"]!=2 && $_GET["action"]!=3) || ($_GET["action"]!=1 && !isset($_GET["id"]))){
    header("location: login.php");
}

if($_GET["action"]!=1){

    $risultato = $dbh->getPostByIdAndAuthor($_GET["id"], $_SESSION["idautore"]);
    if(count($risultato)==0){
        $parameters["prodotto"] = null;
    }
    else{
        $parameters["prodotto"] = $risultato[0];
        $parameters["prodotto"]["categorie"] = explode(",", $parameters["prodotto"]["categorie"]);
    }
}
else{

    $parameters["prodotto"] = getEmptyArticle();
}




$parameters["titolo"] = "E-commerce - Gestisci prodotti";
$parameters["nome"] = "admin-form.php";
$parameters["categorie"] = $dbh->getCategories();


$parameters["azione"] = $_GET["action"];

require 'template/base.php';
?>