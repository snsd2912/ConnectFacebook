<?php
    class User{
        public $id, $username, $position, $name, $email, $phonenumber;

        function __construct($user){
            $this->$id = $user->$id;
            $this->$username = $user->$username; 
            $this->$position = $user->$position; 
            $this->$name = $user->$name; 
            $this->$email = $user->$email; 
            $this->$phonenumber = $user->$phonenumber;
        }

        // function __construct($id, $username, $position, $name, $email, $phonenumber){
        //     $this->$id = $id;
        //     $this->$username = $username; 
        //     $this->$position = $position; 
        //     $this->$name = $name; 
        //     $this->$email = $email; 
        //     $this->$phonenumber = $phonenumber; 
        // }

        function setId($id){
            $this->$id = $id;
        }

        function getId(){
            return $this->$id;
        }


        function getUserName(){
            return $this->$username;
        }

        function getPosition(){
            return $this->$position;
        }

        function getName(){
            return $this->$name;
        }

        function getEmail(){
            return $this->$email;
        }

        function getPhoneNumber(){
            return $this->$phonenumber;
        }

        
    }
?>