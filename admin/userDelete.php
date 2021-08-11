<?php
    include_once 'database/db.php';
    include_once 'class/User.php';

    $database = new Database();
    $db = $database->connectDB();
    $user = new User($db);

    $result = $user->deleteUser($_GET["userID"]);
    if($result){
        echo "successful";
        header('Location: dashboard.php');
    }
    else{
        echo "failed";
        header('Location: dashboard.php');
    }
?>