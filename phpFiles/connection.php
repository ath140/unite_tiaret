<?php 
try{
    $connecte = new PDO("mysql:host=localhost;dbname=unite_tiaret",'root','');
}catch(PDOException $e){
    $e->getMessage();
}
?>