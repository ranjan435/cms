<?php
    include_once 'database/db.php';
    include_once 'class/Post.php';
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
    $post = new Post($db);
    if (isset($_GET['id'])){
      $id = $_GET['id'];
      $result = $post->getPost($id);?>
      <main class="container">
        <article class="blog-post">
          <h1>Detailed Post</h1>
        <?php
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {?>
              <div class="post p-4 mb-3 bg-light rounded">
                <img src="/task2/image/<?php echo $row["image"]?>" class="mb-2" alt="<?php echo $row["name"];?>" width="50%">
                <h2 class="blog-post-title"><a href="post.php?id=<?php echo $row["id"]?>"><?php echo $row["title"]?></a></h2>
                <em class="blog-post-meta">Posted on <?php echo date("jS F ",strtotime($row["posted_on"])) . " by " . "<a href=\"#\">" . $user->getUser($row['posted_by'])->fetch_assoc()["firstname"] . "</a></em>";?>
                <br><br>
                <p><?php echo $row["content"]?></p>
              </div>
            <?php 
            }
          } 
          else {
            echo "0 results";
          }
        ?>
        </article>
      </main>
    <?php
    }
    else{
        header('Location: index.php');
        exit();
    }
?>

      
</body>
</html>