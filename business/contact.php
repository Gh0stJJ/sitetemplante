<?php
    class Contacts
    {
        //Properties
        public $id;
        public $user_id;
        public $name;
        public $phone_number;
        public $country_id;
        public $city;
        
        //Constructor
        public function __construct($name = null, $user_id = null, $phone_number = null, $country_id = null, $city = null) {
            $this->name = $name;
            $this->user_id = $user_id;
            $this->phone_number = $phone_number;
            $this->country_id = $country_id;
            $this->city = $city;
        }
        
    }
?>