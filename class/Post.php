<?php
    class Post{
        private $conn;
        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllPosts(){
            $sqlQuery = "SELECT * FROM post";
            $result = $this->conn->query($sqlQuery);
            // $result = $result->fetch_assoc();
            return $result;
        }

        public function getPublishedPosts(){
            $sqlQuery = "SELECT * FROM post WHERE status='published' ORDER BY id DESC";
            $result = $this->conn->query($sqlQuery);
            return $result;
        }

        public function getUserPosts($user_id){
            $sqlQuery = "SELECT * FROM post WHERE posted_by=$user_id";
            $result = $this->conn->query($sqlQuery);
            return $result;
        }

        public function getPost($post_id){
            $sqlQuery = "SELECT * From post where id=$post_id";
            $result = $this->conn->query($sqlQuery);
            return $result;
        }

        public function addPost($post_title, $post_content, $post_status="pending", $posted_by, $image=""){
            $sqlQuery = "INSERT INTO post (title,content,status,posted_by,image) VALUES ('$post_title','$post_content','$post_status','$posted_by','$image')";
            $result = $this->conn->query($sqlQuery);
            if ($result === TRUE) {
                return true;
            } 
            else {
                return false;
            }
        }

        public function updatePost($post_id, $post_title, $post_content, $post_status="pending", $posted_by, $image=""){
            if($image!=""){
               $sqlQuery = "UPDATE post SET title='$post_title',content='$post_content',status='$post_status',posted_by='$posted_by',image='$image' WHERE id='$post_id'";
            }
            else{
                $sqlQuery = "UPDATE post SET title='$post_title',content='$post_content',status='$post_status',posted_by='$posted_by' WHERE id='$post_id'";
            }
            $result = $this->conn->query($sqlQuery);
            if ($result === TRUE) {
                return true;
            } 
            else {
                return false;
            }
        }

        public function deletePost($post_id){
            $sqlQuery = "DELETE FROM post WHERE id='$post_id'";
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