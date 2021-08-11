<?php
    include_once 'database/db.php';
    include_once 'class/Post.php';
    include_once 'class/User.php';

    $database = new Database();
    $db = $database->connectDB();

    $post = new Post($db);
    $images = $post->getPublishedPosts();
    $result = $post->getPublishedPosts();

    $user = new User($db);
    include('base/header.php');
?>
<title>My CMS</title>
</head>
<body>
<?php 
    include('base/navbar.php');
?>
<!-- CAROUSEL -->
<div class="slider">
  <div class="container">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <!-- <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 3"></button>
      </div> -->
      <div class="carousel-inner">
        <?php
          if ($images->num_rows > 0) {
            // output data of each row
            $i=0;
            while($row = $images->fetch_assoc()) { ?>
              <?php if(isset($row["image"])){?>
                <div class="carousel-item <?php if($i==0){echo 'active';}?>">
                  <img src="/task2/image/<?php echo $row["image"]?>" class="" alt="<?php echo $row["name"];?>">
                  <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $row["title"]?></h5>
                    <p>Posted on <?php echo date("jS F ",strtotime($row["posted_on"])) . " by " . $user->getUser($row['posted_by'])->fetch_assoc()["firstname"] . "</p>";?>
                  </div>
                </div>
            <?php 
            $i++;}}
          }
        ?>
        <!-- <div class="carousel-item active">
          <img src="/images/1.jpg" class="" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="/images/2.jpg" class="" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Some representative placeholder content for the second slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="../images/3.jpg" class="" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Some representative placeholder content for the third slide.</p>
          </div>
        </div> -->
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
</div>
</div>
      <main class="container">
        <article class="blog-post">
        <h1>All Posts</h1>
        <?php
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {?>
              <div class="post p-4 mb-3 bg-light rounded row post-list">
                <div class="col-sm-6">
                  <h2 class="blog-post-title"><a href="post.php?id=<?php echo $row["id"]?>"><?php echo $row["title"]?></a></h2>
                  <em class="blog-post-meta">Posted on <?php echo date("jS F ",strtotime($row["posted_on"])) . " by " . "<a href=\"#\">" . $user->getUser($row['posted_by'])->fetch_assoc()["firstname"] . "</a></em>";?>
                  <br><br>
                  <p><?php echo $row["content"]?></p>
                </div>
                <div class="col-sm-6">
                  <img src="/task2/image/<?php echo $row["image"]?>" class="mb-2" alt="<?php echo $row["name"];?>" width="30%">
                </div>
              </div>
            <?php 
            }
          } else {
            echo "0 results";
          }
        ?>
        </article>
      </main>
</body>
</html>