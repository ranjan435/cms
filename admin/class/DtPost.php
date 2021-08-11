<?php
    class DtPost{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }
    
        public function getUserPosts(){
            //check if search is applied/filtered
            $search = isset($_REQUEST['search'])? $_REQUEST['search']:"";

            //Query from database
            $sql = "SELECT post.id, post.title, post.content, post.status, post.posted_on, post.posted_by, user.id AS user_id, user.firstname FROM post LEFT JOIN user ON post.posted_by = user.id WHERE (post.title LIKE '%$search%' OR post.content LIKE '%$search%') ORDER BY post.id";
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
                    $temp[5] = $row['firstname'];    
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