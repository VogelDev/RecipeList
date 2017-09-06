<?php
require_once 'cors.php';
 $db_host = "localhost";
 $db_name = "vue_recipes";
 $db_user = "vue_recipes";
 $db_pass = "rR2k3FaYhnJ9VM2f";

 try{

  $db_conn = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
  $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e){
  echo $e->getMessage();
 }
?>
