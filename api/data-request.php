<?php
require("../business/Cliente.php");
require("../business/TarjetaCredito.php");
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;

header('Access-Control-Allow-Origin: *');  
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$secret_key = "pruebaNuvu";
$jwt = null;

$authHeader = $_SERVER['HTTP_AUTHORIZATION'];

$arr = explode(" ", $authHeader);


$jwt = $arr[1];

if($jwt){

    try {
        
        $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

        echo json_encode(array(
            "message" => "Access granted:",
        ));
        switch($_SERVER['REQUEST_METHOD']){
            case 'GET':
                echo json_encode(consultarUser($_GET['id']));
            break;
            case 'POST':
            if(isset($_POST['nombre'])){
                echo json_encode(crearUser());
            }else {
                echo json_encode(actualizarUser($_GET['id']));
            }
            break;
            
        }

            
        


    }catch (Exception $e){
 
    http_response_code(401);

    echo json_encode(array(
        "message" => "Access denied.",
        "error" => $e->getMessage()
    ));
}

}

function consultarUser($id){
    $res = [];
    $user = new Cliente($id);
    $user -> select();
    $tarjeta = new TarjetaCredito("","","",$id);
    $tarjetas = $tarjeta -> selectAllByCliente();
    $res['message'] = 'Cliente consultado';
    $res['data']['nombre'] = $user -> getNombre();
    $res['data']['correo'] = $user -> getCorreo();
    $res['data']['nTarjeta'] = $tarjetas[0] -> getIdTarjetaCredito();
    $res['data']['cvc'] = $tarjetas[0] -> getCvc();
    $res['data']['fechaV'] = $tarjetas[0] -> getFechaVencimiento();
    return $res;
}
function crearUser(){
    $res = [];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $nTarjeta = $_POST['nTarjeta'];
    $cvc = $_POST['cvc'];
    $fechaV = $_POST['fechaV'];
    $user = new Cliente("",$nombre,$correo);
    $user -> insert();
    $lastUser = $user -> selectAll();
    $tarjeta = new TarjetaCredito($nTarjeta,$cvc,$fechaV,$lastUser[0] -> getIdCliente());
    $tarjeta -> insert();
    $res['message'] = 'Cliente Creado';
    return $res;
}
function actualizarUser($id){
    $res = [];
    $nombre = $_POST['nombreAct'];
    $correo = $_POST['correoAct'];
    $user = new Cliente($id,$nombre,$correo);
    $user -> update();
    $res['message'] = 'Cliente Actualizado';
    return $res;
}
?>