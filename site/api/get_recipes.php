<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once 'db_conn.php';

$recipes = array();

$query =
"CALL GET_RECIPES();";
$stmt = $db_conn->prepare($query);
$stmt->execute();
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($recipes);
