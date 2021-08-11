<?php
    include_once 'database/db.php';
    include_once 'class/User.php';

    $database = new Database();
    $db = $database->connectDB();
    $user = new User($db);
    include('base/header.php');
?>
<title>My CMS</title>
</head>
<body>
<?php 
    include('base/navbar.php');
    session_start();
    if(isset($_SESSION['logged_in'])){
        echo "Successfully logged in and saved in session";
        header('Location: index.php');
    }
    else{
        if (isset($_POST['email'], $_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email) or empty($password)){
                $error = "Please input all fields";
            }
            else{
                $output = $user->checkLogin($email,$password);
                if($output){
                    echo "logged in";
                    header('Location: index.php');
                }
                else{
                    $error = "Error logging in";
                }
            }
        }
    }
?>

<div class="container">
    <?php if($error !=""){
        ?><small style="color:#aa0000;"><?php echo $error;?></small><?php
    }?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>