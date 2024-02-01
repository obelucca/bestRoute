<?php 

$pythonServerURL = "http://127.0.0.1:5000/geocode";

$address = "Av. Cristiano Machado, 11833 - Vila Cloris, Belo Horizonte - MG, 31744-007";

$pythonResponse =  file_get_contents("$pythonServerURL?address=".urlencode($address));

$dadosLocalizacao = json_decode($pythonResponse, true);

if($dadosLocalizacao && isset($dadosLocalizacao['latitude'], $dadosLocalizacao['longitude'])){

    $latitude =  $dadosLocalizacao['latitude'];
    $longitude = $dadosLocalizacao['longitude'];

    echo "Latitude: $latitude, Longitude $longitude";
} else {
    echo "Não foi possivel obter informações da localização do servidor Python";
}

