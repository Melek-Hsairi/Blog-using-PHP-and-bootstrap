<?php  
 session_start();  
 include("header.php");
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script > $(document).ready(function() {
  $('#search-query').keyup(function() {
    // Get the search query
    var query = $(this).val();

    // Send the search query to the PHP script using Ajax
    $.ajax({
      url: 'search.php',
      type: 'POST',
      data: { query: query },
      success: function(response) {
        // Update the search results
        $('#search-results').html(response);
      }
    });
  });
});
</script>

    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    
    <!-- ***** Header Area End ***** -->

    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>Read our <em>Blog</em></h2>
                      
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** Blog Start ***** -->
    <?php foreach ($posts as $post): ?>
    <div class="post">
     <section class="section" id="our-classes">
        <div class="container">
            <br>
            <br>
            <div class="row">
                <div class="col-lg-8">
                    <section class='tabs-content'>
                    <article>
                      <img src="<?php echo 'images/' . $post['image']; ?>" alt="" class="">
                        <p><i class="fa fa-user"></i><?php echo $post['author']?><h4><a href="#"><?php echo $post['title']; ?></a></h4> &nbsp;|&nbsp; <i class="fa fa-calendar"></i> <?php echo $post['created_at']?> 
                        <button type="button" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ed563b" class="bi bi-heart" viewBox="0 0 16 16">
                         <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"></path>
                        </svg>
                       </button> </p> 
                        <p> <?php echo substr($post['content'] , 0 , 500)  ?> </p>
                        <i><?php echo'<p>tagged as:';
                             $links = array();
                             $parts = explode(',', $post['tag']);
                             foreach ($parts as $tags){
                             $links[] = "<a href='#".$tags."'>"."#".$tags."</a>";}
                             echo implode(", ", $links);
                             echo '</p>';
                             echo '<hr>';?>
                        </i>
                        <div class="main-button">
                            <a href="blog-details.php?post_id=<?php echo $post['post_id']; ?>">Continue Reading</a>
                        </div>
                     </article>
                      <br>

                    </section>
                  </div>
            </div>
        </div>  
      </div>
      <?php endforeach; ?>                      
    <!-- ***** Blog End ***** -->
    
  <nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php for ($i=1; $i <= $pages ; $i++) { ?>
    <li class="page-item"> <a class="page-link" href="blog.php?page=<?= $i ?>"><?= $i ?></a></li>
    <?php }
      ?>
  </ul>
</nav>
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