<?php
session_start();
require_once("../Model/PassengerDAO.php");

// Inicializa a lista de passageiros se não estiver definida
if (!isset($_SESSION['passageiros'])) {
    $_SESSION['passageiros'] = array();
}

// Adiciona um passageiro à lista
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_passenger'])) {
    $nome = $_POST['passengerName'];
    $endereco = $_POST['passengerAddress'];
    
    // Adiciona o passageiro à lista
    $_SESSION['passageiros'][$nome] = $endereco;
}

// Variável para armazenar a menor rota
$menorRota = [];

if (isset($_SESSION['rota_calculada'])) {
    $menorRota = $_SESSION['rota_calculada'];
    unset($_SESSION['rota_calculada']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Passageiros</title>
</head>
<body>
    <h1>Cadastro de Passageiros</h1>
    <form method="post" action="index.php">
        <label for="passengerName">Nome do Passageiro:</label>
        <input type="text" id="passengerName" name="passengerName" required><br><br>
        <label for="passengerAddress">Endereço do Passageiro:</label>
        <input type="text" id="passengerAddress" name="passengerAddress" required><br><br>
        <input type="submit" name="add_passenger" value="Adicionar Passageiro">
    </form>

    <h2>Passageiros Adicionados</h2>
    <ul>
        <?php foreach ($_SESSION['passageiros'] as $nome => $endereco): ?>
            <li><?php echo "Nome: $nome, Endereço: $endereco"; ?></li>
        <?php endforeach; ?>
    </ul>

    <form method="post" action="calcular_rota.php">
        <input type="submit" name="calculate_route" value="Calcular Rota">
    </form>

    <?php if (!empty($menorRota)): ?>
        <h2>Menor Rota</h2>
        <ul>
            <?php foreach ($menorRota as $nome): ?>
                <li><?php echo $nome; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
