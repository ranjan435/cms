<?php 
    class User{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }

        public function checkLogin($email,$password){
            $pass = md5($password);
            $sqlQuery = "SELECT * FROM user WHERE email='$email' AND password='$pass'";
            $rs = $this->conn;
            $result = $rs->query($sqlQuery);
            $row = $result->num_rows;
            if($result->num_rows>0){
                session_start();
                $user = $result->fetch_assoc();
                $_SESSION["user_id"] = $user['id'];
                $_SESSION["user_type"] = $user['type'];
                $_SESSION["user_name"] = $user['firstname'];
                $_SESSION["logged_in"] = true;
                return 1;
            }
            else{
                return 0;
            }
        }

        public function register($firstname, $lastname, $email, $password, $userType="member"){
            $pass = md5($password);
            $sqlQuery = "INSERT INTO user (firstname,lastname,email,password,type) VALUES ('$firstname','$lastname','$email','$pass','$userType')";
            $rs = $this->conn;
            $result = $rs->query($sqlQuery);
            if($result==TRUE){
                return 1;
            }
            else{
                return 0;
            }
        }

        public function getUser($user_id){
            $sqlQuery = "SELECT * From user where id=$user_id";
            $result = $this->conn->query($sqlQuery);
            return $result;
        }

        public function updateUser($user_id, $firstname, $lastname, $email, $password="", $type="member", $cv=""){
            if($password!=""){
                $pass = md5($password);
                $sqlQuery = "UPDATE user SET firstname='$firstname',lastname='$lastname',email='$email',password='$pass',type='$type' WHERE id='$user_id'";
            }
            else{
                $sqlQuery = "UPDATE user SET firstname='$firstname',lastname='$lastname',email='$email',type='$type' WHERE id='$user_id'";
            }
            if($cv!=""){
                $append = "cv='$cv', ";
                $sqlQuery = substr_replace($sqlQuery, $append, 16, 0); // I am very happy today.
            }
            $result = $this->conn->query($sqlQuery);
            if ($result === TRUE) {
                return true;
            } 
            else {
                return false;
            }
        }
    }
?>