<?php
$response_array = array();
include_once('funciones.php');
$data = hacerDatosUrl($_SERVER['REQUEST_URI']);
if($data){
    $requeridos = array('equipo','dispositivo','id','temperatura','humedad','presion');
    $validar = validar_inputs($requeridos,$data);
    if( $validar ){
        $equipo = $data['equipo'];
        $dispositivo = $data['dispositivo'];
        $id = $data['id'];
        $temperatura = $data['temperatura'];
        $humedad = $data['humedad'];
        $presion = $data['presion'];
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
    }
    
    
    header('Content-type: application/json');
    echo '<script>console.log(JSON.parse(`'.json_encode($response_array).'`))</script>';
}