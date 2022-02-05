<?php

    require_once("bootstrap.php");
    

    /**
     * Qui viene gestita la richiesta di modifica delle credenziali utente.
     * Viene lanciata la funzione updateLoginUser con le credenziali ricevute via post.
     */
    if(isset($_POST["submit"]) && $_POST["submit"]=="Modifica"){
        
        $usernameNew = $_POST["username"];
        $usernameOld = $_SESSION["username"];
        $password = $_POST["password"];
        $nome = $_POST["nome"];
        
        
        $result = $dbh->updateLoginUser($usernameOld, $usernameNew, $password, $nome);
        if($result != 1){
            $_SESSION["username"] = $usernameOld;
            $_SESSION["password"] = $password;
            $_SESSION["nome"] = $nome;
        }else{
            $_SESSION["username"] = $usernameNew;
        }
    
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
       
    }
    
    header("location: index.php");  
?>