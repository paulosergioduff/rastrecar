<?php
include_once("config.php");

$deviceid = $_REQUEST['deviceid'];
$id_cliente_login = $_GET['id'];



// NOTE: Only fetches the first 300 devices.
//       Will need to add looping with offset to get all devices.
function getDevices(){ 



  $app_id = "3abaea79-1774-4b00-b465-7ec421533144";
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/players?app_id=" . $app_id); 
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 
                                             'Authorization: Basic YmI0ZTNmNmEtZjIzOS00MjBiLWFkOGItMDQ0NTU4ODI0OWI1'
											 )); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  $response = curl_exec($ch); 
  curl_close($ch); 
  return $response; 
}

$response = getDevices(); 
$return["allresponses"] = $response; 
$return = json_encode( $return); 





?>
<?php

//$obj = json_decode($response);
//$itens = $obj->players;


//foreach($itens as $registro):
  //  echo 'Modelo: ' . $registro->device_model . ' - id_push: ' . $registro->id . ' - ID Cliente: ' . $registro->external_user_id . '<br>';
//endforeach;













?>