<?php
function cleanData($data){
    return filter_var($data,FILTER_SANITIZE_STRING);
}
function hacerDatosUrl($url){
    $url = explode("/", $url);
    $url = $url = array_filter($url);
    $array_datos = array();
    for ($i=1; $i < count($url); $i++) {
        if($i % 2 != 0){
            $array_datos[cleanData($url[$i])] = cleanData($url[$i+1]);
        }
    }
    return $array_datos;
}
function validar_inputs($arr_requeridos,$arr){
    global $response_array;
    for ($i=0; $i < count($arr_requeridos); $i++) { 
        if (!in_array($arr_requeridos[$i], array_keys($arr))) {
            $response_array['status'] = 'error';
            $response_array['msg'] = "El parametro $arr_requeridos[$i] es requerido, para más informacion consulta url_provisional/conecta/error 201";
            return false;
        }
    }
    return true;
}