<?php

require_once('../config/database.php');

class Rota {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    private function calcularDistancia($lat1, $lon1, $lat2, $lon2) {
        $raioTerra = 6371; 

        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Diferença de latitudes e longitudes
        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;

        // FÓRMULA DE HAVERSINE
        $a = sin($dLat/2) * sin($dLat/2) + cos($lat1) * cos($lat2) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distancia = $raioTerra * $c;

        return $distancia;
    }

    // Função para calcular a menor rota entre os pontos usando o algoritmo de Dijkstra
    public function calcularMenorRota($pontoPartida, $pontoChegada) {
        // Consulta ao banco de dados para obter os dados dos pontos
        $query = "SELECT * FROM pontos";
        $result = $this->db->query($query);

        $pontos = array();
        while ($row = $result->fetch_assoc()) {
            $pontos[$row['id']] = array('latitude' => $row['latitude'], 'longitude' => $row['longitude']);
        }

        // Matriz de adjacência para armazenar as distâncias entre os pontos
        $distancias = array();

        // Calcular as distâncias entre todos os pares de pontos
        foreach ($pontos as $id1 => $ponto1) {
            foreach ($pontos as $id2 => $ponto2) {
                $distancias[$id1][$id2] = $this->calcularDistancia($ponto1['latitude'], $ponto1['longitude'], $ponto2['latitude'], $ponto2['longitude']);
            }
        }

        // Algoritmo de Dijkstra para encontrar a menor rota
        $distanciasMinimas = array();
        $verticesVisitados = array();
        $anterior = array();

        foreach ($pontos as $id => $ponto) {
            $distanciasMinimas[$id] = INF;
            $anterior[$id] = null;
        }

        $distanciasMinimas[$pontoPartida] = 0;

        while (!empty($verticesVisitados)) {
            $verticeAtual = null;
            foreach ($verticesVisitados as $vertice) {
                if ($verticeAtual === null || $distanciasMinimas[$vertice] < $distanciasMinimas[$verticeAtual]) {
                    $verticeAtual = $vertice;
                }
            }

            if ($verticeAtual === $pontoChegada || $distanciasMinimas[$verticeAtual] === INF) {
                break;
            }

            foreach ($pontos as $id => $ponto) {
                if (isset($distancias[$verticeAtual][$id])) {
                    $novaDistancia = $distanciasMinimas[$verticeAtual] + $distancias[$verticeAtual][$id];
                    if ($novaDistancia < $distanciasMinimas[$id]) {
                        $distanciasMinimas[$id] = $novaDistancia;
                        $anterior[$id] = $verticeAtual;
                    }
                }
            }

            unset($verticesVisitados[array_search($verticeAtual, $verticesVisitados)]);
        }

        // Reconstruir a rota a partir dos predecessores
        $caminho = array();
        $verticeAtual = $pontoChegada;
        while ($verticeAtual !== null) {
            array_unshift($caminho, $verticeAtual);
            $verticeAtual = $anterior[$verticeAtual];
        }

        return $caminho;
    }
}

// Configurações do banco de dados
$db_host = 'seu_host';
$db_usuario = 'seu_usuario';
$db_senha = 'sua_senha';
$db_nome = 'seu_banco_de_dados';

// Conectar ao banco de dados
$db = new Database($db_host, $db_usuario, $db_senha, $db_nome);

// Inicializar a classe Rota
$rota = new Rota($db);

// Definir o ponto de partida e chegada (ids dos pontos no banco de dados)
$pontoPartida = 1; // Id do ponto de partida
$pontoChegada = 5; // Id do ponto de chegada

// Calcular a menor rota
$menorRota = $rota->calcularMenorRota($pontoPartida, $pontoChegada);

// Imprimir a menor rota
echo "Menor rota: " . implode(" -> ", $menorRota);
?>
