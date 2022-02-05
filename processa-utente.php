<?php

    require_once("bootstrap.php");
    

    /**
     * Qui viene gestita la richiesta di modifica delle credenziali utente.
     * Viene lanciata la funzione updateLoginUser con le credenziali ricevute via post.
     */
    if(isset($_POST["submit"]) && $_POST["submit"]=="Modifica"){
        
        var_dump($_SESSION["username"]);
        $usernameNew = $_POST["username"];
        $usernameOld = $_SESSION["username"];
        $password = $_POST["password"];
        $nome = $_POST["nome"];
       
        /**
         * aggiorno l'username , pass e nome controllando che questi non esistano gia.
         */
        $result = $dbh->updateLoginUser($_SESSION["username"], $_POST["username"], $_POST["password"], $_POST["nome"]);
        if($result != 1){
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
            $_SESSION["nome"] = $_POST["nome"];
        }else{
            if( $_POST["username"] == $_SESSION["username"]){
                $dbh->updateOtherLoginUser($_SESSION["username"], $_POST["password"], $_POST["nome"]);
                $_SESSION["password"] = $_POST["password"];
                $_SESSION["nome"] = $_POST["nome"];
            }
        }
        
        header("location: index.php");  
    }

    if(isset($_POST["change"]) && $_POST["change"]=="Change"){
        
        $parameters["title"] = "E-commerce - Admin";
        $parameters["nome"] = "user-home.php";
        
        $parameters["login"] = $dbh->checkLogin($_SESSION["username"],$_SESSION["password"]);
        
        $parameters["categorie"] = $dbh->getCategories();
        require_once("template/base.php");
    }

    /**
     * Questo gestisce la richiesta post di logout.
     * Unsetto tutte le variabili che ho creato per la sessione compreso il carrello.
     */
    if(isset($_POST["logout"]) && $_POST["logout"] == "Logout"){
        unset($_SESSION["idautore"]);
        unset($_SESSION["username"]);
        unset($_SESSION["nome"]);
        unset($_SESSION["privilege"]);
        unset($_SESSION["password"]);
        unset($_SESSION["cart"]);
       
        header("location: index.php");  
    }

    
    
   
?>