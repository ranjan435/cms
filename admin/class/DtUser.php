<?php
    class DtUser{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }
    
        public function getAllUsers(){
            //check if search is applied/filtered
            $search = isset($_REQUEST['search'])? $_REQUEST['search']:"";

            //Query from database
            $sql = "SELECT user.id, user.firstname, user.lastname, user.email, user.type FROM user WHERE (user.firstname LIKE '%$search%' OR user.lastname LIKE '%$search%' OR user.email LIKE '%$search%')";
            $result = $this->conn->query($sql);

            //output data of each row
            $data = array();
            $total = $result->num_rows;
            if ($total>0){
                while($row = $result->fetch_assoc()){
                    $temp = array();
                    $temp[0] = $row['id'];
                    $temp[1] = $row['firstname'];
                    $temp[2] = $row['lastname'];  
                    $temp[3] = $row['email'];
                    $temp[4] = $row['type'];   
                    
                    //count number of posts of the user
                    $id = $temp[0];
                    $user = "SELECT * FROM post WHERE posted_by = $id";
                    $res = $this->conn->query($user);
                    $count = $res->num_rows;
                    $temp[5] = $count;
                    //risky step avoid in future;
                    
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

        public function getUserPostCount($id){
            $user = "SELECT * FROM post WHERE posted_by = $id";
            $res = $this->conn->query($user);
            $count = $res->row_count;
            die($id);
            return $count;
        }

    }    
?>