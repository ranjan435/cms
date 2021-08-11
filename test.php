<?php 
    $servername = "localhost";
    $username = "name";
    $password = "password";
    $dbname = "cms";
    $email = "name@name.com";
    $pass = md5("password");

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //Check connection
    if ($conn->connect_error){
        die("Connection failed:" . $conn->connect_error);
    }

    $sqlQuery = "SELECT post.id, post.title, post.content, post.status, user.firstname FROM post LEFT JOIN user ON post.posted_by = user.id";
    $rs = $conn->query($sqlQuery);
    // var_dump($rs->fetch_all());
    // echo json_decode($rs);
    // echo "num of rows:" . $rs->num_rows;
        // $stmt->bind_param("ss",$email, $pass);
        // $stmt->execute();
        // $result = $stmt->get_result();
        // if($result->num_rows>0){
        //     echo "logged in";
        //     // $user = $result->fetch_assoc();
        //     // $_SESSION["user_id"] = $user['id'];
        //     // $_SESSION["user_type"] = $user['type'];
        //     // $_SESSION["user_name"] = $user['firstname'];
        //     // $_SESSION["logged_in"] = true;
        //     // return 1;
        // }
        // else{
        //     echo "sorry";
        // }

        while($row = $rs->fetch_assoc()){
            print_r($row);
            print_r($row["firstname"]);
            // print_r($row["firstname"]);
        }
    // $string = "SELECT post.id, post.title, post.content, post.status, user.firstname FROM post LEFT JOIN user ON post.posted_by = user.id";
    // $replacement = 'post.image, ';

    // echo substr_replace($string, $replacement, 7, 0); // I am very happy today.
?>