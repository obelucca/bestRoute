<?php

require_once('AddressDAO.php');

class PassengerDAO{

    private $passengerID;
    private $passengerName;
    private $passengerAddress;
    private $latitude;
    private $longitude;

    public function __construct($passengerName, $passengerAddress){
        $this->passengerName = $passengerName;
        $this->passengerAddress = $passengerAddress;
        $this->convertAddressToLatLon();
    }

    public function getPassengerName(){
        return $this->passengerName;
    }

    public function setPassengerName($name){
        $this->passengerName = $name;
        return $this->getPassengerName();
    } 

    public function getPassengerAddress(){
        return $this->passengerAddress;
    }

    public function setPassengerAddress($address){
        $this->passengerAddress = $address;
        return $this->getPassengerAddress();
    }

    public function getLatitude(){
        return $this->latitude;
    }

    public function setLatitude($lat){
        $this->latitude = $lat;
        return $this->getLatitude();
    }

    public function getLongitude(){
        return $this->longitude;
    }

    public function setLongitude($long){
        $this->longitude = $long;
        return $this->getLongitude();
    }

    public function convertAddressToLatLon(){
        
            $pythonServerURL = "http://127.0.0.1:5000/geocode";
    
            $address = $this->getPassengerAddress();
    
            $pythonResponse =  file_get_contents("$pythonServerURL?address=".urlencode($address));
    
            $dadosLocalizacao = json_decode($pythonResponse, true);
    
            if($dadosLocalizacao && isset($dadosLocalizacao['latitude'], $dadosLocalizacao['longitude'])){
    
                $latitude =  $dadosLocalizacao['latitude'];
                $longitude = $dadosLocalizacao['longitude'];

                $this->setLatitude($latitude);
                $this->setLongitude($longitude);
            } else {
                echo "Não foi possivel obter informações da localização do servidor Python";
            }
        }
    
}
