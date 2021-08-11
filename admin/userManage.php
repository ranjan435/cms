<?php
    include_once 'database/db.php';
    include_once 'class/User.php';
    include_once 'class/Post.php';

    $database = new Database();
    $db = $database->connectDB();
    $user = new User($db);
    include('base/header.php');
?>
<title>My CMS</title>
<script type="text/javascript" src="js/allUsers.js"></script>
</head>
<body>
<?php 
    include('base/navbar.php');
    $userID = "";
    if (isset($_GET['userID'])){
        $userID = $_GET['userID'];
        $result = $user->getUser($userID);
        $firstname = "";
        $lastname = "";
        $email = "";
        $type = "";
        $password = "";
        $cvName = "";
        if ($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
                $email = $row["email"];
                $type = $row["type"];
                // $password = $row["password"];
                $cvName = $row["cv"];
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $type = $_POST["type"];
        $password = $_POST["password"];
        if(isset($_FILES["uploadCV"]["name"])){
            $cvName = $_FILES["uploadCV"]["name"];
            $tempname = $_FILES["uploadCV"]["tmp_name"];
            $folder = "/var/www/example.com/html/task2/cv/".$cvName;
        }
        if(empty($userID)){
            //ADD
            $result = $user->addUser($firstname, $lastname, $email, $password, $type, $cvName);
            if($result){
                if(isset($cvName)){
                    if(move_uploaded_file($tempname, $folder)){
                        header('Location: allUsers.php');
                    }
                    else{
                        echo "Move cv to folder failed";
                    }
                }
                header('Location: allUsers.php');
            }
            else{
                echo "failed";
            }
        }
        else{
            //UPDATE
            $result = $user->updateUser($userID, $firstname, $lastname, $email, $password, $type, $cvName);
            if($result){
                if(isset($cvName)){
                    if(move_uploaded_file($tempname, $folder)){
                        header('Location: allUsers.php');
                    }
                    else{
                        echo "Move cv to folder failed";
                    }
                }
                header('Location: allUsers.php');
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
                    <h1 class="h2">Add/Edit</h1>
                    <br>
                    <!-- TABLE CONTENT -->
                    
                </div>
                <div class="">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="userInputFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="userInputFirstName" name="firstname" value="<?php echo $firstname?>">
                        </div>
                        <div class="mb-3">
                            <label for="userInputLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="userInputLastName" name="lastname" value="<?php echo $lastname?>">
                        </div>
                        <div class="mb-3">
                            <label for="userInputEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="userInputEmail" name="email" value="<?php echo $email?>">
                        </div>
                        <div class="mb-3">
                            <label for="userInputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="userInputPassword" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="userInputType" class="form-label">Type</label>
                            <select class="form-select" aria-label="Default select user" name="type" id="userInputType">
                                <option value="member"<?php if($type=="member") echo"selected";?>>Member</option>
                                <option value="admin" <?php if($type=="admin") echo"selected";?>>Admin</option>
                            </select>
                        </div>
                        <!-- UPLOAD CV -->
                        <div class="mb-3">
                            <?php if($_GET["userID"]){?>
                                <a href="../cv/<?php echo $cvName;?>"><?php echo $cvName;?></a><br>
                                <input type="file" name="uploadCV" value="<?php echo $cvName;?>"/>
                            <?php }else{?>
                                <input type="file" name="uploadCV" value=""/>
                            <?php }?>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </main>
        </div>
    </div>

</body>
</html>