<?php
require("../business/Administrator.php");
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

date_default_timezone_set("America/Bogota");
$email = '';
$password = '';
$email = $email = $_POST['email'];;
$password = $_POST['password'];
$administrator = new Administrator();
if($administrator -> logIn($email, $password)){
    $secret_key = "pruebaNuvu";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + 10; //not before in seconds
        $token = array(
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
 
            "data" => array(
                "id" => $administrator -> getIdAdministrator(),
                "email" => $administrator -> getEmail()
        ));

        http_response_code(200);

        $jwt = JWT::encode($token, $secret_key);
        echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt,
                "email" => $email,
            ));
    }
    else{

        http_response_code(401);
        $administrator = new Administrator();
        $administrator ->select();
        echo json_encode(array("correo" => $administrator -> getEmail(), "id" => $administrator -> getIdAdministrator()));
        echo json_encode(array("message" => "Login failed.", "password" => $password));
    }
