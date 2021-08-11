<?php
    class Database{
        private $servername = 'localhost';
        private $user = 'name';
        private $password = 'password';
        private $database = 'cms';

        public function connectDB(){
            // Create connection
            $conn = new mysqli($this->servername, $this->user, $this->password, $this->database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            else{
                return $conn;
            }
        }
    }
?>