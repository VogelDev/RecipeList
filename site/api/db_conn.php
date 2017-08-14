<?php

 $db_host = "localhost";
 $db_name = "vue_recipes";
 $db_user = "vue_recipes";
 $db_pass = "mShAHu2N3nv8";

 try{

  $db_conn = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
  $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e){
  echo $e->getMessage();
 }
?>
