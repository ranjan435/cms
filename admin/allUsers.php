<?php
    include_once 'database/db.php';
    include_once 'class/User.php';

    $database = new Database();
    $db = $database->connectDB();
    $users = new User($db);
    include('base/header.php');
?>
<title>My CMS</title>
<script type="text/javascript" src="js/allUsers.js"></script>
</head>
<body>
<?php 
    include('base/navbar.php');
?>
    <div class="container-fluid">
        <div class="row">
            <?php include('sidebar.php')?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">All Users</h1>
                    <div class="ms-auto">
                        <h2 class="text-right"><a href="userManage.php">Create User</a></h2>
                    </div>  
                    <br>
                </div>
                <div class="search-div">
                    Search:
                    <input id="search" type="search">
                </div>  
                                   
                 <!-- TABLE CONTENT -->

                <div id="allUsers" class="">
                        <table id="tableAllUsers" class="display" style="">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Posts</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Posts</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
            </main>
        </div>
    </div>

</body>
</html>