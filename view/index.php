<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BestRoute</title>
</head>
<body>
<form action="../DAO/PassengerController.php" method="post">
        <label for="passengerName">Nome do Passageiro:</label><br>
        <input type="text" id="passengerName" name="passengerName"><br>
        
        <label for="passengerAddress">Endereço do Passageiro:</label><br>
        <input type="text" id="passengerAddress" name="passengerAddress"><br>
        
        <button type="submit">Adicionar Passageiro</button>
        <p>
        <?php
            require_once('../DAO/PassengerController.php');

           $passengerController = new PassengerController();
           $passengers = $passengerController->getPassengers();
           
           // Exibir os passageiros na página
           foreach ($passengers as $passenger) {
               echo "ID: " . $passenger['PassengerID'] . "<br>";
               echo "Nome: " . $passenger['passengerName'] . "<br>";
               echo "Endereço: " . $passenger['address'] . "<br>";
               echo "<hr>";
           }

           
        ?>
        </p>
</body>
</html>

