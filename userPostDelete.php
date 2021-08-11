<?php
    include_once 'database/db.php';
    include_once 'class/Post.php';

    $database = new Database();
    $db = $database->connectDB();
    $post = new Post($db);

    $result = $post->deletePost($_GET["postID"]);
    if($result){
        echo "successful";
        header('Location: index.php');
    }
    else{
        echo "failed";
        header('Location: index.php');
    }
?>