<?php
    include_once 'database/db.php';
    include_once 'class/User.php';
    include_once 'class/Post.php';

    $database = new Database();
    $db = $database->connectDB();
    $users = new User($db);
    $posts = new Post($db);
    include('base/header.php');
?>
<title>My CMS</title>
</head>
<body>
<?php 
    include('base/navbar.php');
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
    }

    elseif($_SESSION["user_type"]=='admin'){
        $resultUsers = $users->getAllUsers();
        $resultPosts = $posts->getAllPosts();
?>
    <div class="container-fluid">
        <div class="row">
            <?php include('sidebar.php')?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>
                <div class="row row-cols-1 row-cols-md-6 text-center">
                    <div class="col-sm-6">
                        <div class="card h-100"> 
                            <div class="card-body">
                                <h5 class="card-title">Posts</h5>
                                <h1 class="card-text"><?php echo $resultPosts->num_rows;?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Users</h5>
                                <h1 class="card-text"><?php echo $resultUsers->num_rows;?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
<?php } 
    else{
        header('Location: notfound.php');
    }
?>
</body>
</html>