<?php

require_once('AddressDAO.php');

class PassengerDAO{

    private $passengerID;
    public $passengerName;
    public $passengerAddress;
    public $latitude;
    public $longitude;

    public function __construct($passengerName, $passengerAddress, $latitude, $longitude){
        $this->passengerName = $passengerName;
        $this->passengerAddress = $passengerAddress;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    
}