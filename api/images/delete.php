<?php 

//Headers
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

//Includes
include_once '../../config/Database.php';
include_once '../../utils/HTTPStatus.php';
include_once '../../models/Image.php';
include_once '../../utils/validate_param.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate an Image
$image = new Image($db);

//Verify params integrity & assign them to image object if valid
$image->id = validate_param($_GET['id']);

if($image->delete()){
  echo json_encode(array('success' => 'L\'image a bien été supprimée'));
}else{
  echo json_encode(array('error' => 'Une erreur est survenue'));
  HTTPStatus(500);
}

