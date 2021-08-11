<?php
    include_once 'database/db.php';
    include_once 'class/User.php';

    $database = new Database();
    $db = $database->connectDB();
    $user = new User($db);
    include('base/header.php');
?>
<title>My CMS</title>
<script type="text/javascript" src="js/userPosts.js"></script>
</head>
<body>
<?php 
    include('base/navbar.php');
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
    }

    $userID = $_SESSION['user_id'];
    $firstname = "";
    $lastname = "";
    $email = "";
    $type = "";
    $password = "";
    $cvName = "";

    if(!empty($userID)){
        $result = $user->getUser($userID);
        if ($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
                $email = $row["email"];
                $type = $row["type"];
                $cvName = $row["cv"];
            }
        }
    }

    //UPDATE USER
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        if(isset($_FILES["uploadCV"]["name"])){
            $cvName = $_FILES["uploadCV"]["name"];
            $tempname = $_FILES["uploadCV"]["tmp_name"];
            $folder = "/var/www/example.com/html/task2/cv/".$cvName;
        }

        //CHECK FOR EMPTY INPUT FIELDS
        if(empty($firstname) or empty($lastname) or empty($email)){
            $error = "Please input all fields";
        }
        else{
            //UPDATE
            $result = $user->updateUser($userID, $firstname, $lastname, $email, $password, $type, $cvName);
            if($result){
                if(isset($cvName)){
                    if(move_uploaded_file($tempname, $folder)){
                        header('Location: profile.php');
                    }
                    else{
                        echo "Move cv to folder failed";
                    }
                }
                header('Location: profile.php');
            }
            else{
                echo "failed";
            }
        }
        
    }
?>
    <div class="container-fluid">
        <div class="row">
            <?php include('sidebar.php')?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">User Profile</h1>
                    <br>
                    
                </div>
                <div class="">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="userfirstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="userfirstname" name="firstname" value="<?php echo $firstname?>">
                        </div>
                        <div class="mb-3">
                            <label for="userlastname" class="form-label">Last Name</label><br>
                            <input type="text" class="form-control" id="userlastname" name="lastname" value="<?php echo $lastname?>">
                        </div>
                        <div class="mb-3">
                            <label for="useremail" class="form-label">Email</label><br>
                            <input type="text" class="form-control" id="useremail" name="email" value="<?php echo $email?>">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="userpassword" class="form-label">Password</label><br>
                            <input type="password" class="form-control" id="userpassword" name="password">
                        </div> -->
                        <!-- UPLOAD CV -->
                        <div class="mb-3">
                            <?php if($userID){?>
                                <a href="../cv/<?php echo $cvName;?>"><?php echo $cvName;?></a><br>
                                <input type="file" name="uploadCV" value="<?php echo $cvName;?>"/>
                            <?php }else{?>
                                <input type="file" name="uploadCV" value=""/>
                            <?php }?>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

</body>
</html>