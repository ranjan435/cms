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
    // session_start();
    if (isset($_POST['firstname'],$_POST['lastname'],$_POST['email'], $_POST['password1'],$_POST['password2'],$_POST['userType'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $userType = $_POST['userType'];
        if (empty($firstname) or empty($lastname) or empty($email) or empty($password1) or empty($password2)){
            $error = "Please input all fields";
        }

        elseif ($password1!=$password2){
            $error = "Password didn't match";
        }

        else{
            $output = $user->register($firstname, $lastname, $email, $password1, $userType);
            if($output){
                echo "User registered successfully";
                header('Location: login_form.php');
            }
            else{
                $error = "Error on registration";
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
            <label for="exampleInputFirstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="exampleInputFirstName" name="firstname">
        </div>
        <div class="mb-3">
            <label for="exampleInputLastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="exampleInputLastName" name="lastname">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputUserType" class="form-label">User Type</label>
            <select class="form-select" aria-label="Default select example" name="userType" id="exampleInputUserType">
                <option selected>Admin</option>
                <option value="member">Member</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password2">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>