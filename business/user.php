<?php
    //User class
    class Users {
        //Properties
        public $id;
        public $name;
        public $email;
        public $password;
        
        
        //Constructor
        public function __construct($name = null, $email = null, $password = null) {
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        }
        
    }
    ?>