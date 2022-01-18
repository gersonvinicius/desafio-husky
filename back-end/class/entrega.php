<?php
    class Entrega{

        // Connection
        private $conn;

        // Table
        private $db_table = "Entrega";

        // Columns
        public $id;
        public $status;
        public $ponto_coleta;
        public $ponto_destino;
        public $cliente_id;
        public $entregador_id;
        public $created_at;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getEntregas(){
            $sqlQuery = "SELECT id, status, ponto_coleta, ponto_destino, cliente_id, entregador_id, created_at FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createEntrega(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        status = :status, 
                        ponto_coleta = :ponto_coleta, 
                        ponto_destino = :ponto_destino, 
                        cliente_id = :cliente_id,
                        entregador_id = :entregador_id,
                        created_at = :created_at";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->ponto_coleta=htmlspecialchars(strip_tags($this->ponto_coleta));
            $this->ponto_destino=htmlspecialchars(strip_tags($this->ponto_destino));
            $this->cliente_id=htmlspecialchars(strip_tags($this->cliente_id));
            $this->entregador_id=htmlspecialchars(strip_tags($this->entregador_id));
            $this->created_at=htmlspecialchars(strip_tags($this->created_at));
        
            // bind data
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":ponto_coleta", $this->ponto_coleta);
            $stmt->bindParam(":ponto_destino", $this->ponto_destino);
            $stmt->bindParam(":cliente_id", $this->cliente_id);
            $stmt->bindValue(':entregador_id', $this->entregador_id = null, PDO::PARAM_INT);
            $stmt->bindParam(":created_at", $this->created_at);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleEntrega(){
            $sqlQuery = "SELECT
                        id, 
                        status, 
                        ponto_coleta, 
                        ponto_destino, 
                        cliente_id, 
                        entregador_id,
                        created_at
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);
            // $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->status = $dataRow['status'];
            $this->ponto_coleta = $dataRow['ponto_coleta'];
            $this->ponto_destino = $dataRow['ponto_destino'];
            $this->cliente_id = $dataRow['cliente_id'];
            $this->entregador_id = $dataRow['entregador_id'];
            $this->created_at = $dataRow['created_at'];
        }        

        // UPDATE
        public function updateEntrega(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        status = :status, 
                        ponto_coleta = :ponto_coleta, 
                        ponto_destino = :ponto_destino, 
                        cliente_id = :cliente_id, 
                        entregador_id = :entregador_id, 
                        created_at = :created_at
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->ponto_coleta=htmlspecialchars(strip_tags($this->ponto_coleta));
            $this->ponto_destino=htmlspecialchars(strip_tags($this->ponto_destino));
            $this->cliente_id=htmlspecialchars(strip_tags($this->cliente_id));
            $this->entregador_id=htmlspecialchars(strip_tags($this->entregador_id));
            $this->created_at=htmlspecialchars(strip_tags($this->created_at));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":ponto_coleta", $this->ponto_coleta);
            $stmt->bindParam(":ponto_destino", $this->ponto_destino);
            $stmt->bindParam(":cliente_id", $this->cliente_id);
            $stmt->bindParam(":entregador_id", $this->entregador_id);
            $stmt->bindParam(":created_at", $this->created_at);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteEntrega(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>