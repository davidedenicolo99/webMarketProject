<?php

    require_once("bootstrap.php");


    if(isset($_POST["submit"]) && $_POST["submit"]=="Modifica"){
        //modifico
        
        $usernameNew = $_POST["username"];
        $usernameOld = $_SESSION["username"];
        $password = $_POST["password"];
        $nome = $_POST["nome"];


    
        $dbh->updateLoginUser($usernameOld, $usernameNew, $password, $nome);
        

        $_SESSION["username"] = $usernameNew;
        $_SESSION["password"] = $password;
       
        header("location: login.php");

    }
    if($_POST["logout"] == "Logout"){
        unset($_SESSION["idautore"]);
        unset($_SESSION["username"]);
        unset($_SESSION["nome"]);
        unset($_SESSION["privilege"]);
        unset($_SESSION["password"]);
        header("location: index.php");    
    }
    

?>