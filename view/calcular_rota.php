<?php
session_start();
require_once("../Model/PassengerDAO.php");
require_once("../Model/Grafo.php");


if (!isset($_SESSION['passageiros']) || empty($_SESSION['passageiros'])) {
    die("Nenhum passageiro adicionado.");
}

$coordenadasPassageiros = array();

foreach ($_SESSION['passageiros'] as $nome => $endereco) {
    $passenger = new PassengerDAO($nome, $endereco);
    $coordenadasPassageiros[$nome] = array(
        'latitude' => $passenger->getLatitude(),
        'longitude' => $passenger->getLongitude()
    );
}

$grafo = new Grafo();
$menorRota = $grafo->calcularMenorRota($coordenadasPassageiros);

echo "<h1>Menor Rota</h1>";
echo "<ul>";
foreach ($menorRota as $nome) {
    echo "<li>$nome</li>";
}
echo "</ul>";


