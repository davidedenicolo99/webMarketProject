
<?php
/**
 * Inizio la sessione.
 * Instanzio la classe che mi permette di gestire le funzioni nel db.
 */
session_start();
define("UPLOAD_DIR", "./upload/");
require_once("utils/functions.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "market", 3306);
?>