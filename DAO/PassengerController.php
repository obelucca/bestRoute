<?php 
    require_once('../Model/PassengerDAO.php');

    class PassengerController extends PassengerDAO{

        public function insertIntoDatabase(){
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

        $passengerName  = $this->getPassengerName();
        $passengerAddress = $this->getPassengerAddress();
        $passengerLatitude = $this->getLatitude();
        $passengerLongitude = $this->getLongitude();


        // Vincular os parâmetros à consulta
        $stmt->bind_param("ssdd", $passengerName, $passengerAddress, $passengerLatitude, $passengerLongitude);

        // Executar a consulta
        if (!$stmt->execute()) {
            die("Falha ao executar a consulta: " . $stmt->error);
        }

        // Fechar a declaração e a conexão
        $stmt->close();
        $conexao->close();

        header( 'Location: ../view/index.php');
        exit;

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

    public function getPassengers() {
        // Conectar ao banco de dados
        $conexao = new mysqli("localhost", "root", "", "BestRoute");
    
        // Verificar a conexão
        if ($conexao->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
        }
    
        // Consulta SQL para selecionar todos os passageiros
        $sql = "SELECT * FROM passenger";
    
        // Preparar e executar a consulta
        $result = $conexao->query($sql);
    
        // Verificar se a consulta retornou resultados
        if ($result->num_rows > 0) {
            // Array para armazenar os passageiros
            $passengers = array();
    
            // Loop através dos resultados e armazenar em um array
            while ($row = $result->fetch_assoc()) {
                $passengers[] = $row;
            }
    
            // Fechar a conexão e retornar os passageiros
            $conexao->close();
            return $passengers;
        } else {
            // Se não houver passageiros cadastrados, retornar um array vazio
            $conexao->close();
            return array();
        }
    }
    

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $passengerName = $_POST['passengerName'];
    $passengerAddress = $_POST['passengerAddress'];

    $passengerController = new PassengerController($passengerName, $passengerAddress);

    $passengerController->insertIntoDatabase();
}
