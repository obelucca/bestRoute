<?php 
    require_once('../Model/PassengerDAO.php');

    class PassengerController extends PassengerDAO{

        public function insertIntoDatabase($obj){
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
        $stmt->bind_param("ssdd", $this->getPassengerName(), $this->getPassengerAddress(), $this->getLatitude(), $this->getLongitude());

        // Executar a consulta
        if (!$stmt->execute()) {
            die("Falha ao executar a consulta: " . $stmt->error);
        }

        // Fechar a declaração e a conexão
        $stmt->close();
        $conexao->close();
    }

    public function deletePassenger($passengerID){

        $conexao = new mysqli("localhost", "root", "", "BestRoute");

        if($conexao->connect_error){
            die("Falha na conexão com o banco de daods: " . $conexao->connect_error);
        }

        $sql = "DELETE FROM passenger WHERE PassengerID = $passengerID";
        $stmt = $conexao->prepare($sql);

        if(!$stmt->execute()){
            die("Falha ao preparar a consultar SQL:" . $conexao->error);
        }

        $stmt->close();
        $conexao->close();
    }


}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $passengerName = $_POST['passengerName'];
    $passengerAddress = $_POST['passengerAddress'];

    $passengerController = new PassengerController($passengerName, $passengerAddress);

    $passengerController->insertIntoDatabase($passengerName, $passengerAddress);
}
