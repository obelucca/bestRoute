<?php
class Grafo {
    private function calcularDistancia($lat1, $lon1, $lat2, $lon2) {
        $raioTerra = 6371;

        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;

        $a = sin($dLat / 2) * sin($dLat / 2) + cos($lat1) * cos($lat2) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distancia = $raioTerra * $c;

        return $distancia;
    }

    public function calcularMenorRota($coordenadas) {
        $pontos = array_keys($coordenadas);
        $numPontos = count($pontos);
        
        $distancias = array();
        foreach ($pontos as $i => $ponto1) {
            foreach ($pontos as $j => $ponto2) {
                if ($i != $j) {
                    $distancias[$i][$j] = $this->calcularDistancia(
                        $coordenadas[$ponto1]['latitude'], $coordenadas[$ponto1]['longitude'],
                        $coordenadas[$ponto2]['latitude'], $coordenadas[$ponto2]['longitude']
                    );
                } else {
                    $distancias[$i][$j] = INF;
                }
            }
        }

        $rota = [];
        $visitados = array_fill(0, $numPontos, false);
        $visitados[0] = true;
        $rota[] = $pontos[0];
        $atual = 0;

        for ($i = 1; $i < $numPontos; $i++) {
            $menorDistancia = INF;
            $proximo = -1;
            for ($j = 0; $j < $numPontos; $j++) {
                if (!$visitados[$j] && $distancias[$atual][$j] < $menorDistancia) {
                    $menorDistancia = $distancias[$atual][$j];
                    $proximo = $j;
                }
            }
            $visitados[$proximo] = true;
            $rota[] = $pontos[$proximo];
            $atual = $proximo;
        }

        return $rota;
    }
}

