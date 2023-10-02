<?php 
 session_start(); 
include('header.php');
require_once 'refactoring.php'; 
$id ="";
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  
}
$post = selectOne($id);
$comments = findAllComments($id);

if (isset($_GET['id_comment_delete'])) {
  $id_com =$_GET['id_comment_delete'];
  $comm = findComment($id_com );
  $admin=isAdmin();
  if(($comm['author']==$_SESSION['username']) ||(in_array($_SESSION['username'],$admin['username'],$strict = false)==true)){
  deleteComment($id_com);
  header('Location:single.php?id='.$id);
  exit();}
 
}
if (isset($_POST['add-comment'])) {
  $author =$_SESSION['username'];
  $id = $_POST['id'] ;
  $comment = nl2br(htmlentities($_POST['comment']));
  
  saveComment($author,$id,$comment);
  header('Location:single.php?id='.$_POST['id']);
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Custom Styling -->
  <link rel="stylesheet" href="css/style.css">

  <title>Article </title>
</head>

<body>




  <!-- Page Wrapper -->
  <div class="page-container">

    <!-- Content -->
    <div class="container">

      <!-- Main Content Wrapper -->
      <div class="">
        <div class="main-content single">
          <h1 class="post-title"><?php echo $post['title']; ?></h1>
          <div class="post-image">
              <img src="<?php echo 'images/' . $post['image']; ?>" alt="" >
          </div>
          <div class="post-content">
            <?php echo html_entity_decode($post['content']); ?>
          </div>
        </div>
        <h1>Les commentaires</h1>
        <div class="comments">
          <?php foreach ($comments as $comment): ?>
          
            <div class="comment">
              <h3 class="auteur">Ecrit par <?php echo $comment['author']; ?> : </h3>
              <p class="contenu" ><?php echo $comment['comment']; ?><br>
              <i class="far fa-calendar"> <?php echo date('d F, Y', strtotime($comment['created_at'])); ?></i>
              <?php if($comment['author']==$_SESSION['username']){ ?>
              <a class="sup" href="single.php?id=<?php echo $id ?>&amp;id_comment_delete=<?php echo $comment['id']; ?>">Supprimer</a><?php }?>
              </p>
              <br>
            </div>
          <?php endforeach; ?>
        </div>
        <br>
        <form action="single.php"  method="post">
          <input type="hidden" name="id" value="<?php echo $id ?>">
          
          <div>
            <label>Body:</label>
            <textarea name="comment" id="body" cols="130" rows="15"></textarea>
          </div><br>
          <div>
              <button type="submit" name="add-comment" class="btn btn-big">Commentez</button>
          </div>
        </form>
      </div>
    </div>
  </div>

 
</body>

</html>