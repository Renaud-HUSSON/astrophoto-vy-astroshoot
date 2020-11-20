<?php 

//Headers
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

//Includes
include_once '../../config/Database.php';
include_once '../../utils/HTTPStatus.php';
include_once '../../models/Category.php';
include_once '../../utils/validate_param.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate a new Category
$category = new Category($db);

//Verify params integrity
$category->id = validate_param($_POST['id']);
$category->titre = validate_param($_POST['titre']);
$category->nom = validate_param($_POST['nom']);
$category->image = validate_param($_POST['image']);

//Try to update the category
if($category->update()){
  echo json_encode(array('success' => 'La catégorie a bien été mise à jour !'));
}else{
  echo json_encode(array('error' => 'Une erreur est survenur'));
  HTTPStatus(500);
}