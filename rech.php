<?php
  require_once('refactoring.php');
  $output='';
  if(isset($_POST['query'])){
    $search=$_POST['query'];
    $stmt=$conn->prepare("SELECT * FORM posts WHERE author=?");
    $stmt->execute($search);
  }else{
    $stmt=$conn->prepare("SELECT *FROM posts");
  }
  $stmt->execute();
  $result=$stmt->get_result();
  if(rowcount($result)>0){
    while($row=$result->fetch_assoc()){
        $output=
        "<div class="post">
              <img src="<?php echo 'images/' . $post['image']; ?>" alt="" class="slider-image">
              <div class="post-info">
                <h4><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h4>
                <i > <?php echo $post['author']; ?></i>
                &nbsp;
                <i > <?php echo date('d F, Y', strtotime($post['created_at'])); ?></i>
              </div>
            </div>";
    }
    echo $output;
  }
  else{
    echo "no data";
  }
