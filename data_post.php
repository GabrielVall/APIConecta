<?php
$response_array = array();
include_once('funciones.php');
if( 0 == 0 ){
    $equipo = $_POST['equipo'];
    $dispositivo = $_POST['dispositivo'];
    $id = $_POST['id'];
    $temperatura = $_POST['temperatura'];
    $humedad = $_POST['humedad'];
    $presion = $_POST['presion'];
    include_once("conect.php");
    $sql = new SQLConexion();
    $row = $sql->updateData("
    INSERT INTO datos_sensor (equipo,temperatura,humedad,presion,fecha_hora) 
    VALUES ('$equipo', $temperatura, $humedad, $presion, CURRENT_TIMESTAMP);
    ");
    if($row){
        $response_array['status'] = 'success';
        $response_array['msg'] = "Registro agregado correctamente";
    }else{
        $response_array['status'] = 'error';
        $response_array['msg'] = "Comunicación establecida, pero falló al agregar los datos, por favor verifica la integridad de estos. Error 401";
    }
}else{
    $response_array['status'] = 'error';
    $response_array['msg'] = "Datos incompletos en POST, Error 402";
}
    
    
    header('Content-type: application/json');
    echo json_encode($response_array);