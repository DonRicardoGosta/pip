<?php
include_once('connection.php');
$method = $_SERVER['REQUEST_METHOD'];



//POST metódusra létrehozunk a request bodyban kapott JSON objektum alapján egy detour rekordot
if ($method == 'POST') {
  $req_params = json_decode(file_get_contents('php://input'), true);


  if (!isset($req_params['parcel_number']) || !isset($req_params['type']) || !isset($req_params['delivery_day'])) {
    http_response_code(400); // rossz request
    exit;// ha rossz a request akkor ne menjen tovább
  }
  
  $query = "INSERT INTO detouravis (parcel_number, type, delivery_day, insert_date) VALUES ($1, $2, $3, now())";
  pg_prepare($db_connection, "valami", $query);
  $values = array($req_params['parcel_number'], $req_params['type'], $req_params['delivery_day']);
  $success = pg_execute($db_connection, "valami", $values);

  if ($success) {
    http_response_code(201); // Created successfully      ---- https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
  } else {
    http_response_code(500); // Internal Server Error
  }
  pg_close($db_connection);
  exit;
}






//PUT metódusra frissítjük egy már adatbázisban létező detour rekord értékeit
if ($method == 'PUT') {
  $req_params = json_decode(file_get_contents('php://input'), true);

  if (!isset($req_params['parcel_number']) || !isset($req_params['type']) || !isset($req_params['delivery_day'])) {
    http_response_code(400); // rossz request
    exit;// ha rossz a request akkor ne menjen tovább
  }

  $query = "UPDATE detouravis SET type=$1, delivery_day=$2 WHERE id = (SELECT id FROM detouravis WHERE parcel_number=$3 ORDER BY id DESC LIMIT 1) ";
  pg_prepare($db_connection, "valami", $query);
  $values = array($req_params['type'], $req_params['delivery_day'], $req_params['parcel_number']);
  $success = pg_execute($db_connection, "valami", $values);

  if ($success) {
    http_response_code(200); // OK
  } else {
    http_response_code(500); // Internal Server Error
  }
  pg_close($db_connection);
  exit;
}






//DELETE metódusra az URL-ben megadott parcelnumber paraméter szerinti összes adatbázis rekordot töröljük a detour táblából
if ($method == 'DELETE') {
$req_params = json_decode(file_get_contents('php://input'), true);
    
  if (!isset($req_params['parcel_number'])) {
    http_response_code(400); // rossz request
    exit;// ha rossz a request akkor ne menjen tovább
  }

  $query = "DELETE FROM detouravis  WHERE id = (SELECT id FROM detouravis WHERE parcel_number=$1 ORDER BY id DESC LIMIT 1)";
  pg_prepare($db_connection, "valami", $query);
  $values = array($req_params['parcel_number']);
  $success = pg_execute($db_connection, "valami", $values);

  if ($success) {
    http_response_code(200); // OK
  } else {
    http_response_code(500); // Internal Server Error
  }
  pg_close($db_connection);
  exit;
}






//GET metódusra az URL-ben megadott parcelnumber paraméter szerinti időrendben legutolsó detour rekordot adjuk vissza
if ($method == 'GET') {
    $req_params = json_decode(file_get_contents('php://input'), true);
  
  if (!isset($req_params['parcel_number'])) {
    http_response_code(400); // rossz request
    exit;// ha rossz a request akkor ne menjen tovább
  }

  $query = "SELECT * FROM detouravis WHERE parcel_number=$1 ORDER BY insert_date DESC LIMIT 1";
  $values = array($req_params['parcel_number']);

  $result = pg_prepare($db_connection, "get_detour", $query);
  $result = pg_execute($db_connection, "get_detour", $values);
  $data = pg_fetch_all($result);

  if ($data) {
    echo json_encode($data[0]);
  } else {
    http_response_code(404); // Not Found
  }
  pg_close($db_connection);
  exit;
}
?>


