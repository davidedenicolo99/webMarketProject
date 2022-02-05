<?php
    require_once("./login.php");
    require_once("bootstrap.php");

    if(isset($_POST["logout"])){
        unset($_SESSION["idautore"]);
        unset($_SESSION["username"]);
        unset($_SESSION["nome"]);
        unset($_SESSION["privilege"]);
        unset($_SESSION["password"]);
        header("location: index.php");
        
    }


?>