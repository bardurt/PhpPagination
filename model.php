<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Model{
    
    private $firstName;
    private $lastName;
    private $age;
    
    public function __construct($firstName, $lastName, $age){
        $this->firstName    = $firstName;
        $this->lastName     = $lastName;
        $this->age          = $age;
    }
    
    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getAge() {
        return $this->age;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setAge($age) {
        $this->age = $age;
    }


    
}