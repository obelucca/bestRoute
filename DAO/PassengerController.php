<?php 
    require_once('../Model/PassengerDAO.php');

    class PassengerController{

       public $passengerName = 'cleber';
       public $passengerAddress = 'rua treze';
       public $latitude = '12345678945';
       public $longitude = '12345678954';
        
        public function insertIntoDatabase() {
        // Conectar ao banco de dados (ajuste conforme suas configurações)
        $conexao = new mysqli("localhost", "root", "", "BestRoute");
        
        // Verificar a conexão
        if ($conexao->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
        }

        // Preparar a consulta SQL de inserção
        $sql = "INSERT INTO passenger (passengerName, address, latitude, longitude) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);

        // Verificar se a preparação da consulta foi bem-sucedida
        if (!$stmt) {
            die("Falha ao preparar a consulta SQL: " . $conexao->error);
        }

        // Vincular os parâmetros à consulta
        $stmt->bind_param("ssdd", $this->passengerName, $this->passengerAddress, $this->latitude, $this->longitude);

        // Executar a consulta
        if (!$stmt->execute()) {
            die("Falha ao executar a consulta: " . $stmt->error);
        }

        // Fechar a declaração e a conexão
        $stmt->close();
        $conexao->close();
    }
}

$object = new PassengerController();
$object->insertIntoDatabase();