<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/entrega.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Entrega($db);

    $item->id = isset($_GET['id']) ? (int)$_GET['id'] : die();
    
    $item->getSingleEntrega();

    if($item->status != null){
        // create array
        $ent_arr = array(
            "id" =>  $item->id,
            "status" => $item->status,
            "ponto_coleta" => $item->ponto_coleta,
            "ponto_destino" => $item->ponto_destino,
            "cliente_id" => $item->cliente_id,
            "entregador_id" => $item->entregador_id,
            "created_at" => $item->created_at
        );
      
        http_response_code(200);
        echo json_encode($ent_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Entrega não encontrada.")
        );
    }
?>