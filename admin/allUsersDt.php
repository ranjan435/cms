<?php
    include_once 'database/db.php';
    include_once 'class/DtUser.php';

    $database = new Database();
    $db = $database->connectDB();
    $dtpost = new DtUser($db);
    
    $dtpost->getAllUsers();
    
?>