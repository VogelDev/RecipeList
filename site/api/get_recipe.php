<?php

require_once 'db_conn.php';

$recipeID = $_GET["recipe"];
$results = array();

$recipe = '';

$query =
"SELECT * FROM recipes WHERE id = :id;";

$stmt = $db_conn->prepare($query);
$stmt->bindParam(':id', $recipeID, PDO::PARAM_STR);

$stmt->execute();
$recipe = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

$query =
"SELECT * FROM directions WHERE recipe = :id;";

$stmt = $db_conn->prepare($query);
$stmt->bindParam(':id', $recipeID, PDO::PARAM_STR);

$stmt->execute();
$recipe['directions'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query =
"SELECT * FROM ingredients WHERE recipe = :id;";

$stmt = $db_conn->prepare($query);
$stmt->bindParam(':id', $recipeID, PDO::PARAM_STR);

$stmt->execute();
$recipe['ingredients'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($recipe);
