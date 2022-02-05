<?php

    require_once("bootstrap.php");

    /**
     * In caso clicco Cancella notifiche allora ho 3 possibilita.
     * Sono admin e cancello TUTTE le notifiche.
     * 
     * Sono username ed elimino tutte e solo le MIE notifiche.
     * 
     * Sono username ed elimino solo una mia notifica.
     */

    if(isset($_GET["del"]) && $_GET["del"] == "del" && $_SESSION["privilege"] == 1){
        $dbh->deleteAllNotifiche($_SESSION["username"]);
    } else if (isset($_GET["del"]) && $_GET["del"] == "del"){
        $dbh->deleteNotifiche($_SESSION["username"]);
    } else if(isset($_POST['delete'])){
        $dbh->deleteNotificheById($_POST['delete']);
    }


    /**
     * Se sono admin vedo TUTTE le notifiche nel db.
     * 
     * Se sono un username normale vedo solo le MIE notifiche.
     */

    if(isset($_SESSION["username"]) && $_SESSION["privilege"] == 1){
        $parameters["title"] = "Notifiche - Admin";
        $parameters["nome"] = "gestione-notifiche.php";
        $parameters["soldout"] = $dbh->soldOut($_SESSION["username"]);
        $parameters["notifiche"] = $dbh->getNotifiche($_SESSION["username"]);
        
        
    }else if (isset($_SESSION["username"]) && $_SESSION["privilege"] != 1){
        $parameters["title"] = "Notifiche - Utente";
        $parameters["nome"] = "gestione-notifiche.php";  
        $parameters["notifiche"] = $dbh->getNotificheByUsername($_SESSION["username"]);
        
    }else{
        $parameters["title"] = "Home";
    }
    $parameters["categorie"] = $dbh->getCategories();
    require_once("template/base.php");


?>