<?php
    include_once 'database/db.php';
    include_once 'class/User.php';
    include_once 'class/Post.php';

    $database = new Database();
    $db = $database->connectDB();
    $post = new Post($db);
    $user = new User($db);
    include('base/header.php');
?>
<title>My CMS</title>
<script type="text/javascript" src="js/userPosts.js"></script>
</head>
<body>
<?php 
    include('base/navbar.php');
    $postID = "";
    if (isset($_GET['postID'])){
        $postID = $_GET['postID'];
        $result = $post->getPost($postID);
        $title = "";
        $content = "";
        $status = "";
        $posted_by = 0;
        $imageName = "";
        if ($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $title = $row["title"];
                $content = $row["content"];
                $status = $row["status"];
                $posted_by = $row["posted_by"];
                $imageName = $row["image"];
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $title = $_POST["postTitle"];
        $content = $_POST["postContent"];
        $status = $_POST["postStatus"];
        $posted_by = $_POST["postedBy"];
        $imageName = $_FILES["uploadImage"]["name"];
        if(isset($imageName)){
            $tempname = $_FILES["uploadImage"]["tmp_name"];
            $folder = "/var/www/example.com/html/task2/image/".$imageName;
        }
        
        if(empty($postID)){
            //ADD
            $result = $post->addPost($title, $content, $status, $posted_by, $imageName);
            if($result){
                if(move_uploaded_file($tempname, $folder)){
                    header('Location: allPosts.php');
                }
                else{
                    echo "Move image to folder failed";
                }
            }
            else{
                echo "failed";
            }
        }
        else{
            //UPDATE
            $result = $post->updatePost($postID, $title, $content, $status, $posted_by, $imageName);
            if($result){
                if(isset($imageName)){
                    if(move_uploaded_file($tempname, $folder)){
                        header('Location: allPosts.php');
                    }
                    else{
                        echo "Move image to folder failed";
                    }
                }
                header('Location: allPosts.php');
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
                            <label for="postInputTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="postInputTitle" name="postTitle" value="<?php echo $title?>">
                        </div>
                        <div class="mb-3">
                            <label for="postInputContent" class="form-label">Content</label><br>
                            <textarea id="postInputContent" name="postContent" rows="4" cols="120" class="form-control"><?php echo $content?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="postInputStatus" class="form-label">Post Status</label>
                            <select class="form-select" aria-label="Default select example" name="postStatus" id="postInputStatus">
                                <option value="pending" <?php if($status=="pending") echo"selected";?>>Pending</option>
                                <option value="published" <?php if($status=="published") echo"selected";?>>Published</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="postInputPostedBy" class="form-label">Posted By</label>
                            <select class="form-select" aria-label="Default select example" name="postedBy" id="postInputpostedBy">
                                <?php 
                                    $result = $user->getAllUsers();
                                    while($row = $result->fetch_assoc()){
                                        $name = $row['firstname'];
                                        $id = $row['id'];?>
                                        <option value=<?php echo $id?> name="postedBy" <?php if($id==$posted_by) echo "selected";?>><?php echo $name ."</option>";
                                    }?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <?php if($_GET["postID"]){?>
                                <img src="../image/<?php echo $imageName;?>" alt="<?php echo $imageName;?>" width="50%"><br>
                                <input type="file" name="uploadImage" value=""/>
                            <?php }else{?>
                                <input type="file" name="uploadImage" value=""/>
                            <?php } ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

</body>
</html>