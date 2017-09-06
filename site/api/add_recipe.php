<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$request = file_get_contents('php://input');

require_once 'cors.php';

require_once 'db_conn.php';

$recipe = json_decode($request)->body;
$recipe = json_decode($recipe);

$category = $recipe->category;
$origin = $recipe->origin;
$title = $recipe->title;
$cook_time = $recipe->cookTime;
$oven_temp = $recipe->ovenTemp;


$date = date('Y-m-d H:i:s');

$query = "CALL ADD_RECIPE(:category,:origin,:title,:cook_time,:oven_temp,:created);";

$stmt = $db_conn->prepare($query);
$stmt->bindParam(':category', $category, PDO::PARAM_STR);
$stmt->bindParam(':origin', $origin, PDO::PARAM_STR);
$stmt->bindParam(':title', $title, PDO::PARAM_STR);
$stmt->bindParam(':cook_time', $cook_time, PDO::PARAM_STR);
$stmt->bindParam(':oven_temp', $oven_temp, PDO::PARAM_STR);
$stmt->bindParam(':created', $date, PDO::PARAM_STR);

$stmt->execute();

$query = "SELECT id FROM recipes WHERE category = :category AND created = :created";
$stmt = $db_conn->prepare($query);
$stmt->bindParam(':category', $category, PDO::PARAM_STR);
$stmt->bindParam(':created', $date, PDO::PARAM_STR);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
$id = $result["id"];

$ingredients = $recipe->ingredients;
$query = '';
foreach ($ingredients as $key => $object) {
  $query = "INSERT INTO
            ingredients (quantity,measure,name,recipe, pos)
            VALUES (:quantity,:measure,:name,:recipe, :pos);";

  $stmt = $db_conn->prepare($query);
  $stmt->bindParam(':quantity', $object->quantity, PDO::PARAM_STR);
  $stmt->bindParam(':measure', $object->measure, PDO::PARAM_STR);
  $stmt->bindParam(':name', $object->name, PDO::PARAM_STR);
  $stmt->bindParam(':recipe', $id, PDO::PARAM_INT);
  $stmt->bindParam(':pos', $object->pos, PDO::PARAM_INT);

  $stmt->execute();
}

$directions = $recipe->directions;
$query = '';
foreach ($directions as $key => $object) {
  $query = "INSERT INTO
            directions (description,recipe, pos)
            VALUES (:description,:recipe, :pos);";

  $stmt = $db_conn->prepare($query);
  $stmt->bindParam(':description', $object->description, PDO::PARAM_STR);
  $stmt->bindParam(':recipe', $id, PDO::PARAM_INT);
  $stmt->bindParam(':pos', $object->pos, PDO::PARAM_INT);

  $stmt->execute();
}

?>
