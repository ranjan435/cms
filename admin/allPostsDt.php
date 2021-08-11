<?php
    include_once 'database/db.php';
    include_once 'class/DtPost.php';

    $database = new Database();
    $db = $database->connectDB();
    $dtpost = new DtPost($db);
    
    $dtpost->getUserPosts();
    
?>