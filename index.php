<?php    
  //login_success.php  
  session_start();  
  include('header.php');
 require_once 'refactoring.php';
  $page =1;
  $perPage =3;
  $total = pagination();
  $pages = ceil($total / $perPage);
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
    
  }
    $posts = selectAll($page,$perPage);    
 ?>  



<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>AI Enthusiast</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

    
    
    <body>
    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>This a blog for people who loves to share articles about the Artificial intelligence field</h6>
                <h2><em>Done by</em> Mohamed Melek Hsairi & Fatma Naifar</h2>
                <div class="main-button">
                    <a href="contact.php">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Blog Start ***** -->
    <section class="section" id="our-classes">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Recent <em>Blog posts</em></h2>
                        <img src="assets/images/line-dec.png" alt="">
                        <p>Latest posts that have been shared on our blog</p>
                    </div>
                </div>
            </div>
            <div class="row" id="tabs">
              <div class="col-lg-4">
              <?php $post=selectAll($page,$perPage);?>
                <ul>
                  <li><a href='#tabs-1'> <?php echo $post[0]['title']?> </a></li>
                  <li><a href='#tabs-2'> <?php echo $post[1]['title']?></a></li>
                  <li><a href='#tabs-3'> <?php echo $post[2]['title']?></a></li>
                  <div class="main-rounded-button"><a href="blog.php">Read More</a></div>
                </ul>
              </div>
              <div class="col-lg-8">
                <section class='tabs-content'>
                  <article id='tabs-1'>
                    <img src="<?php echo 'images/' . $post[0]['image']; ?>" alt="">
                    <h4><?php echo $post[0]['title']?></h4>
                    <p><i class="fa fa-user"></i><?php echo $post[0]['author']?> &nbsp;|&nbsp; <i class="fa fa-calendar"></i><?php echo $post[0]['created_at']?>
                    <i><?php echo'<p>tagged as:';
                       $links = array();
                        $parts = explode(',', $post[0]['tag']);
                        foreach ($parts as $tags){
                       $links[] = "<a href='#".$tags."'>"."#".$tags."</a>";}
                       echo implode(", ", $links);
                       echo '</p>';
                       echo '<hr>';?></i>
                    <p> <?php echo substr($post[0]['content'] , 0 , 500)  ?> </p>
                    <div class="main-button">
                        <a href="blog-details.php?post_id=<?php echo $post[0]['post_id']; ?>">Continue Reading</a>
                    </div>
                  </article>
                  <article id='tabs-2'>
                  <img src="<?php echo 'images/' . $post[1]['image']; ?>" alt="">
                    <h4><?php echo $posts[1]['title'] ?></h4>

                    <p><i class="fa fa-user"></i><?php echo $post[1]['author']?> &nbsp;|&nbsp; <i class="fa fa-calendar"></i><?php echo $post[1]['created_at']?> </p>
                    <i><?php echo'<p>tagged as:';
                       $links = array();
                        $parts = explode(',', $post[1]['tag']);
                        foreach ($parts as $tags){
                       $links[] = "<a href='#".$tags."'>"."#".$tags."</a>";}
                       echo implode(", ", $links);
                       echo '</p>';
                       echo '<hr>';?></i>
                    <p> <?php echo substr($post[1]['content'] , 0 , 500)  ?> </p>
                    <div class="main-button">
                    <a href="blog-details.php?post_id=<?php echo $post[1]['post_id']; ?>">Continue Reading</a>
                    </div>
                  </article>
                  <article id='tabs-3'>
                  <img src="<?php echo 'images/' . $post[2]['image']; ?>" alt="">
                    <h4><?php echo $posts[2]['title'] ?></h4>

                    <p><i class="fa fa-user"></i><?php echo $post[1]['author']?> &nbsp;|&nbsp; <i class="fa fa-calendar"></i> <<?php echo $post[2]['created_at']?></p>
                    <i><?php echo'<p>tagged as:';
                       $links = array();
                        $parts = explode(',', $post[2]['tag']);
                        foreach ($parts as $tags){
                       $links[] = "<a href='#".$tags."'>"."#".$tags."</a>";}
                       echo implode(", ", $links);
                       echo '</p>';
                       echo '<hr>';?></i>
                    <p> <?php echo substr($post[1]['content'] , 0 , 500)  ?> </p>
                    <div class="main-button">
                    <a href="blog-details.php?post_id=<?php echo $post[2]['post_id']; ?>">Continue Reading</a>
                    </div>
                  </article>
                </section>
              </div>
            </div>
        </div>
    </section>
    <!-- ***** Blog End ***** -->

    <section class="section section-bg" id="schedule" style="background-image: url(assets/images/about-fullscreen-1-1920x700.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading dark-bg">
                        <h2>Read <em>About Us</em></h2>
                        <img src="assets/images/line-dec.png" alt="">
                        <p>We are computer science engineering students who love the field of Artificial intelligence . We wanted to share our passion with people like us. We wanted to make a website where we could share multiple articles.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-content text-center">
                        <p>AI Enthusiast is the place to be if you like artificial intelligence. This is a website that will give you various articles about recent technologies absolutely for free. You also can share what you would love to share with us.</p>

                        <p>Our goal was to make a website that could have us all , people who are interested in artificial intelligence. Don't Hesitate to subscribe !</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Done by Mohamed Melek Hsairi and Fatma Naifar
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/mixitup.js"></script> 
    <script src="assets/js/accordions.js"></script>
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

  </body>
</html>
  