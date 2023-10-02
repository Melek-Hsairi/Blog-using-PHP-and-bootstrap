<?php 
 session_start();
include('header.php');
require_once 'refactoring.php'; 
$post_id ="";
$tabAdmin=isAdmin();
if (isset($_GET['post_id'])) {
  $post_id = $_GET['post_id'];
  
}
$post = selectOne($post_id);
$comments = findAllComments($post_id);

if (isset($_GET['id_comment_delete'])) {
  $id_com =$_GET['id_comment_delete'];
  $comm = findComment($id_com );
  $tabAdmin=isAdmin();
  for($i=0;$i<count($tabAdmin);$i++){
  if(($comm['author'] == $_SESSION['username']) ||(in_array($_SESSION['username'],$tabAdmin[$i],$strict = false)==true)){
  deleteComment($id_com);
  header('Location:blog-details.php?post_id='.$post_id);
  exit();}
 
}}
if (isset($_POST['add-comment'])) {
  $author =$_SESSION['username'];
  $post_id = $_POST['id'] ;
  $comment = nl2br(htmlentities($_POST['comment']));
  
  saveComment($author,$post_id,$comment);
  header('Location:blog-details.php?post_id='.$_POST['id']);
  exit();
}

?>
<?php
require_once 'refactoring.php';?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>details</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

    </head>
    
    <body>
    

    
    
   <?php include_once 'header.php';?>

    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>detailed <em>blog post</em></h2>
                        <p>discover more with us</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** Blog Start ***** -->
  
    <section class="section" id="our-classes">
        <div class="container">
            <br>
            <br>
            <section class='tabs-content'>
              <article>
                <h4><?php echo $post['title']; ?></h4>
                
                <p><i class="fa fa-user"></i><?php echo $post['author']; ?> &nbsp;|&nbsp; <i class="fa fa-calendar"></i><?php echo $post['created_at']; ?>&nbsp;|&nbsp;<i class="fa fa-comments"></i><?php echo($comm=findComm($_GET['post_id'])) ;?></p></p>

                <div><img src="<?php echo 'images/' . $post['image']; ?>" alt=""></div>
               
                <br>
                <div class="post-content">
                 <?php echo html_entity_decode($post['content']); ?>
                </div>
              <div>
               <?php echo'<p><strong>tagged as</strong>:';
                $links = array();
                $parts = explode(',', $post['tag']);
                foreach ($parts as $tags){
                $links[] = "<a href='#'".$tags."'>"."#".$tags."</a>";}
                echo implode(", ", $links);
                echo '</p>';
                echo '<hr>';
              ?>
              </div>
               
              </article>
            </section>

            <br>
            <br>
            <br>
            <div class="comments">

          <?php 
  if($_SESSION!=null){?>
    <i <?php
    if (userLiked($post['post_id'])): ?>
    class="fa fa-thumbs-up like-btn"
   <?php else: ?>
    class="fa fa-thumbs-o-up like-btn"
   <?php endif ?>
   data-id="<?php echo $post['post_id'] ?>"></i>
  <span class="likes"><?php echo getLikes($post['post_id']); ?></span>

  &nbsp;&nbsp;&nbsp;&nbsp;

<!-- if user dislikes post, style button differently -->
<i 
<?php 
 if (userDisliked($post['post_id'])){?>
class="fa fa-thumbs-down dislike-btn"
<?php }else{ ?>
class="fa fa-thumbs-o-down dislike-btn"
<?php }?>
data-id="<?php echo $post['post_id'] ?>"></i>
<span class="dislikes"><?php echo getDislikes($post['post_id']); ?></span>
              <?php foreach ($comments as $comment): ?>
            <div class="comment">
              <h3 class="auteur">Ecrit par <?php echo $comment['author']; ?> : </h3>
              <p class="contenu" ><h6><?php echo $comment['comment']; ?></h6><br>
              <i class="fa fa-calendar"></i><?php echo date('d F, Y', strtotime($comment['created_at'])); ?></i>
            
                  
              <a class="sup" href="blog-details.php?post_id=<?php echo $post_id ?>&amp;id_comment_delete=<?php echo $comment['id']; ?>">Supprimer</a>
              
              </p>
              <br>
            </div>
          <?php endforeach;?>
         
        </div>
            <section class='tabs-content'>
                <div class="row">
                
                    <div class="col-md-4">
                        <h4>Leave a comment</h4>
                
                        <div class="container">
	<!-- code here -->
	<div class="card">
	
    <form action="blog-details.php"  method="post">
                         <input type="hidden" name="id" value="<?php echo $post_id ?>">
                        <div class="input">

                            <textarea cols="130", rows="10" name="comment" id="body"></textarea>
                            
                        </div>
                        <br>
                        
                        <div>
                            <button type="submit" name="add-comment" class="btn btn-primary">Add comment</button>
                        </div>
                    </form>

		
	</div>
</div>
    </section>
  <?php }?>

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
<style>
  .section  img {
width : 100%;
height : 50%;
}
</style>
<script>
  $(document).ready(function(){

// if the user clicks on the like button ...
$('.like-btn').on('click', function(){
  var post_id = $(this).data('id');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
  	action = 'like';
  } else if($clicked_btn.hasClass('fa-thumbs-up')){
  	action = 'unlike';
  }
  $.ajax({
  	url: 'index.php',
  	type: 'post',
  	data: {
  		'action': action,
  		'post_id': post_id
  	},
  	success: function(data){
  		res = JSON.parse(data);
  		if (action == "like") {
  			$clicked_btn.removeClass('fa-thumbs-o-up');
  			$clicked_btn.addClass('fa-thumbs-up');
  		} else if(action == "unlike") {
  			$clicked_btn.removeClass('fa-thumbs-up');
  			$clicked_btn.addClass('fa-thumbs-o-up');
  		}
  		// display the number of likes and dislikes
  		$clicked_btn.siblings('span.likes').text(res.likes);
  		$clicked_btn.siblings('span.dislikes').text(res.dislikes);

  		// change button styling of the other button if user is reacting the second time to post
  		$clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
  	}
  });		

});

// if the user clicks on the dislike button ...
$('.dislike-btn').on('click', function(){
  var post_id = $(this).data('id');
  $clicked_btn = $(this);
  if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
  	action = 'dislike';
  } else if($clicked_btn.hasClass('fa-thumbs-down')){
  	action = 'undislike';
  }
  $.ajax({
  	url: 'index.php',
  	type: 'post',
  	data: {
  		'action': action,
  		'post_id': post_id
  	},
  	success: function(data){
  		res = JSON.parse(data);
  		if (action == "dislike") {
  			$clicked_btn.removeClass('fa-thumbs-o-down');
  			$clicked_btn.addClass('fa-thumbs-down');
  		} else if(action == "undislike") {
  			$clicked_btn.removeClass('fa-thumbs-down');
  			$clicked_btn.addClass('fa-thumbs-o-down');
  		}
  		// display the number of likes and dislikes
  		$clicked_btn.siblings('span.likes').text(res.likes);
  		$clicked_btn.siblings('span.dislikes').text(res.dislikes);
  		
  		// change button styling of the other button if user is reacting the second time to post
  		$clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
  	}
  });	

});

});
</script>