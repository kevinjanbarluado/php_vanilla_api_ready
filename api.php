<?php
/*
* @Author: Kevin Jan Barluado
* @Date: 2022-04-02 15:26:36
* @Github: https://github.com/kevinjanbarluado2
*/
// Add headers for CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

// Include the class file
require_once 'ApiClass.php';

// Get the requested endpoint
$segments = explode('/', $_SERVER['REQUEST_URI']);
$endpoint = end($segments);
$request = $_SERVER['REQUEST_METHOD'];
$data = file_get_contents('php://input');

// Instantiate your class
$yourClass = new ApiClass();

// Call the appropriate method based on the request method and endpoint
switch ($request) {
    case 'GET':
        if (method_exists($yourClass, $endpoint)) {
            echo call_user_func(array($yourClass, $endpoint));
        } else {
            http_response_code(404);
            echo json_encode(array('message' => 'GET Action Not Found'));
        }
        break;
    case 'POST':
        if (method_exists($yourClass, $endpoint)) {
            echo call_user_func(array($yourClass, $endpoint), $data);
        } else {
            http_response_code(404);
            echo json_encode(array('message' => 'POST Action Not Found'));
        }
        break;
    case 'PUT':
        if (method_exists($yourClass, $endpoint)) {
            echo call_user_func(array($yourClass, $endpoint), $data);
        } else {
            http_response_code(404);
            echo json_encode(array('message' => 'PUT Action Not Found'));
        }
        break;
    case 'DELETE':
        if (method_exists($yourClass, $endpoint)) {
            echo call_user_func(array($yourClass, $endpoint));
        } else {
            http_response_code(404);
            echo json_encode(array('message' => 'DELETE Action Not Found'));
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(array('message' => 'Method Not Allowed'));
}
