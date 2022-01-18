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
    
    $data = filter_input_array(INPUT_POST);
    
    $item->id = $data['id'];
    
    // employee values
    $item->status = $data['status'];
    $item->ponto_coleta = $data['ponto_coleta'];
    $item->ponto_destino = $data['ponto_destino'];
    $item->cliente_id = (int)$data['cliente_id'];
    if(isset($_POST['entregador_id']))
        $item->entregador_id = (int)$data['entregador_id'];
    $item->created_at = date('Y-m-d H:i:s');
    
    if($item->updateEntrega()){
        echo json_encode("Entrega atualizada com sucesso.");
    } else{
        echo json_encode("Entrega não foi atualizada.");
    }
?>