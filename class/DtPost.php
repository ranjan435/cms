<?php
    session_start();
    
    class DtPost{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }
        public function getUserPosts(){
            //Query from database
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM post WHERE posted_by=$user_id";
            $result = $this->conn->query($sql);

            //output data of each row
            $data = array();
            $total = $result->num_rows;
            if ($total>0){
                while($row = $result->fetch_assoc()){
                    $temp = array();
                    $temp[0] = $row['id'];
                    $temp[1] = $row['title'];
                    $temp[2] = $row['content'];  
                    $temp[3] = $row['status'];  
                    $temp[4] = $row['posted_on'];               
                    $data[] = $temp;
                }
            }

            $test = array(
                "draw"      => isset($_REQUEST['draw'])? intval($_REQUEST['draw']):0,
                "recordsTotal" => sizeof($total),
                "recordsFiltered" => sizeof($total),
                "data" => $data
            );
            echo json_encode($test);
        }

    }    
?>