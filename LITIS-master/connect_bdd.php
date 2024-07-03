<?php
// error_reporting (E_All); ini_set(“display_errors”, 1);
try { 
    $db= new PDO('mysql:host=localhost;dbname=litis','root','',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]); 
}
catch (Exception $e){ 
    die('Erreur: ' . $e->getMessage()); 
}
// echo "Connecté à la BDD";
?>