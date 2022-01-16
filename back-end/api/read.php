<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/entrega.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Entrega($db);

    $stmt = $items->getEntregas();
    $itemCount = $stmt->rowCount();


    // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $entregaArr = array();
        $entregaArr["body"] = array();
        $entregaArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "status" => $status,
                "ponto_coleta" => $ponto_coleta,
                "ponto_destino" => $ponto_destino,
                "cliente_id" => $cliente_id,
                "entregador_id" => $entregador_id,
                "created_at" => $created_at
            );

            array_push($entregaArr["body"], $e);
        }
        echo json_encode($entregaArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>