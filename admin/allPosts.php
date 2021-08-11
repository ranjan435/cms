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
?>
    <div class="container-fluid">
        <div class="row">
            <?php include('sidebar.php')?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">All Posts</h1>
                    <div class="ms-auto">
                        <h2 class="text-right"><a href="postManage.php">Create Post</a></h2>
                    </div>  
                    <br>
                </div>
                <div class="search-div">
                    Search:
                    <input id="search-val" type="search">
                </div>    
                                   
                <!-- TABLE CONTENT -->

                <div id="allPosts" class="">
                        <table id="tableAllPosts" class="display" style="">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Status</th>
                                    <th>Posted on</th>
                                    <th>Posted by</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th>First name</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Registration Date</th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
            </main>
        </div>
    </div>

</body>
</html>