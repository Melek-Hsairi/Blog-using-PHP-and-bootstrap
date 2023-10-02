<?php
function getPDO(){
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'mblog';

$conn =new PDO('mysql:host='.$host.';dbname='.$db_name, $user,$pass,[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    return $conn;
}
function signup($name,$password,$email){
    $pdo=getPDO();
    $query = $pdo->prepare('INSERT INTO users(username,password,email) VALUES(:name,:password,:email)');
    $query->execute(compact('name','password','email'));
    
}
function signin($password,$email){
    $pdo=getPDO();
    $statement = $pdo->prepare("SELECT * FROM users WHERE password =? AND email = ?");   
    $statement->execute([$password,$email]);  
    $count = $statement->rowCount(); 
    return $count; 
}
function getName($email,$password){
    $pdo=getPDO();
    $statement = $pdo->prepare("SELECT username FROM users WHERE email = ? AND password =?");   
    $statement->execute([$email,$password]);  
    $name=$statement->fetch();
    return $name; 
}
function afficheUtil(){
    $pdo=getPDO();
    $statement = $pdo->prepare("SELECT * FROM users ");   
    $statement->execute();  
    $users = $statement->fetchAll();
    return $users; 

}
function getUser($id){
    $pdo=getPDO();
    $statement = $pdo->prepare("SELECT * FROM users WHERE id = ?");   
    $statement->execute([$id]);  
    $user = $statement->fetchAll();
    return $user; 
}
function getUserId($username){
    $pdo=getPDO();
    $statement = $pdo->prepare("SELECT id FROM users WHERE username=:username ");   
    $statement->execute(['username'=> $username]);  
    $user = $statement->fetchAll();
    return $user; 
}
function deleteUser($id){
    $pdo =getPDO();
    $query = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $query->execute(['id'=> $id]); 
}

function setAdmin($id){
    $pdo =getPDO();
    $query=$pdo->prepare('UPDATE users SET admin=1 WHERE id=:id');
    $query->execute(['id'=> $id]); 
}
function setUser($id){
    $pdo =getPDO();
    $query=$pdo->prepare('UPDATE users SET admin=0 WHERE id=:id');
    $query->execute(['id'=> $id]); 
}
function isAdmin(){
    $pdo=getPDO();
    $query = $pdo->prepare('SELECT username,email,image FROM users WHERE admin=1');
    $query->execute(); 
    $tabADMIN =$query->fetchAll(PDO::FETCH_ASSOC);
    return $tabADMIN;
}

function create($author,$title,$content,$image,$tag){
    $pdo =getPDO();
    $query = $pdo->prepare('INSERT INTO posts(author,title,content,image,tag,created_at) VALUES(:author,:title,:content,:image,:tag,NOW())');
    $query->execute(compact('author','title','content','image','tag'));
    $id = $query->insert_id;
    return $id;
}

function selectAll($page,$perPage){
    $perPage = $perPage;
    $page =  $page;
    $pdo =getPDO();
    $resultats = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT '.($perPage *($page-1)).','. $perPage ); /*l'affichage se fait de plus recent 
                                                                                                                           vers le plus ancien*/
    $posts = $resultats->fetchAll();
    return $posts;
} 
function pagination(){
    $pdo =getPDO();
    $query = $pdo->query("SELECT COUNT(*) as nbr_articles FROM posts");
        $nombres= $query->fetch();
    return $nombres['nbr_articles'];
    
}
function selectOne($id){
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT * FROM posts WHERE post_id = :post_id');
    $query->execute(['post_id' => $id]);

    $post = $query->fetch();
    return $post;
}

function findAllComments($post_id){
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT * FROM comments WHERE post_id = :post_id');
    $query->execute(['post_id' => $post_id]);

    $comments = $query->fetchAll();
    return $comments;
}

function findComment($id){
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
    $query->execute(['id'=> $id]); 
    $comment =$query->fetch();
    return $comment;
}
function findComm($post_id){
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT count(*) FROM comments WHERE post_id = :post_id');
    $query->execute(['post_id'=> $post_id]); 
    $nb= $query->fetchColumn();
    return $nb;
}

function deletePost($id){
    $pdo =getPDO();
    $query = $pdo->prepare('DELETE FROM posts WHERE id = :id');
    $query->execute(['id'=> $id]); 
}
function updatePost($id,$author,$title,$content,$image,$tag){
    $pdo =getPDO();
    $query = $pdo->prepare('UPDATE posts SET author = :author, title = :title,content = :content,image = :image,tag = :tag WHERE id =:id'); 
    $query->execute(compact('author','title','content','image','tag','id'));
    $id = $query->insert_id;
    return $id;
}


function deleteComment($id){
    $pdo =getPDO();
    $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
    $query->execute(['id'=> $id]); 
}

function saveComment($author,$post_id,$comment){
    $pdo =getPDO();
    $query = $pdo->prepare('INSERT INTO comments(post_id,author,comment,created_at) VALUES(:post_id,:author,:comment,NOW())');
    $query->execute(compact('post_id','author','comment'));
    return $query;
}
function getAllMessage(){
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT * FROM message');
    $query->execute();
    $messages = $query->fetchAll();
    return $messages;
}
function saveMessage($sender_name,$sender_email,$receiver_email,$content){
    $pdo =getPDO();
    $query = $pdo->prepare('INSERT INTO message(sender_name,sender_email,receiver_email,content) VALUES(:sender_name,:sender_email,:receiver_email,:content)');
    $query->execute(compact('sender_name','sender_email','receiver_email','content'));
    return $query;
}
function saveAction(){
$pdo =getPDO();
if (isset($_POST['action'])) {
    $post_id = $_POST['post_id'];
    $action = $_POST['action'];
    switch ($action) {
        case 'like':
           $sql="INSERT INTO rating (id, post_id, action) 
                  VALUES ($user_id, $post_id, 'like') 
                  ON DUPLICATE KEY UPDATE action='like'";
           break;
        case 'dislike':
            $sql="INSERT INTO rating (id, post_id, action) 
                 VALUES ($user_id, $post_id, 'dislike') 
                  ON DUPLICATE KEY UPDATE action='dislike'";
           break;
        case 'unlike':
            $sql="DELETE FROM rating WHERE id=$user_id AND post_id=$post_id";
            break;
        case 'undislike':
              $sql="DELETE FROM rating WHERE id=$user_id AND post_id=$post_id";
        break;
        default:
            break;
    }
  
    // execute query to effect changes in the database ...
    $sql->execute();
    echo getRating($post_id);
    exit(0);
  }
}
  
  // Get total number of likes for a particular post
  function getLikes($post_id)
  {
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT count(*) FROM rating WHERE post_id = :post_id');
    $query->execute(['post_id'=> $post_id]); 
    $nb= $query->fetchColumn();
    return $nb;
  }
  
  // Get total number of dislikes for a particular post
  function getDislikes($post_id)
  {
    $pdo =getPDO();
    $query = $pdo->prepare('SELECT count(*) FROM rating WHERE post_id = :post_id');
    $query->execute(['post_id'=> $post_id]); 
    $nb= $query->fetchColumn();
    return $nb;
  }
  
  
  // Check if user already likes post or not
  function userLiked($post_id)
  {
    $pdo =getPDO();
    $sql =$pdo->prepare( "SELECT * FROM rating WHERE 
              post_id=? AND action='like'");
    $sql->execute([$post_id]);
    $count = $sql->rowCount();
    if ($count> 0) {
        return true;
    }else{
        return false;
    }
  }
  
  // Check if user already dislikes post or not
  function userDisliked($post_id)
  {
    $pdo =getPDO();
    $sql =$pdo->prepare( "SELECT * FROM rating WHERE 
              post_id=? AND action='dislike'");
    $sql->execute([$post_id]);
    $count = $sql->rowCount();
    if ($count> 0) {
        return true;
    }else{
        return false;
    }
  }

  
?>