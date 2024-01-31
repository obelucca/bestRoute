<?php

 Class Passenger{

    public String $passengerName;
    public String $passengerAddress;

    public function __construct($passengerName, $passengerAddress){
        $this->passengerName = $passengerName;
        $this->passengerAddress = $passengerAddress;
    }
}

