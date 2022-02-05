<link rel="stylesheet" href="./css/style.css">
<?php

    require_once("bootstrap.php");

    if(isset($_SESSION["username"]) && $_SESSION["privilege"] == 1){
        $templateParams["title"] = "Notifiche";
        $templateParams["nome"] = "gestione-notifiche.php";
        $templateParams["notifiche"] = $dbh->getNotifiche();

        
    }else{
        $templateParams["title"] = "Home";
    }
    $templateParams["categorie"] = $dbh->getCategories();
    require_once("template/base.php");


?>