<?php  
 session_start(); 
 require_once 'refactoring.php';  
 try  
 {  
      
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["email"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
               $count=signin($_POST["password"],$_POST['email']);
                if($count > 0)  
                {  
                     $name=getName($_POST["email"],$_POST['password']);
                     $_SESSION["username"] =$name['username']  ;
                     header("location:index.php"); }

                else  
                {  
                     $message = '<label>Wrong Data</label>';  
                }  
           }  
        }
        if(isset($_POST["signup"])){
            if(!empty($_POST["username"]) || !empty($_POST["password"]) || !empty($_POST["email"])){
                 signup($_POST['username'],$_POST['password'],$_POST["email"]);
                 $_SESSION["username"] = $_POST["username"];  
                 header("location:index.php");
           }
           else{ $message = '<label>All fields are required</label>'; }

    }

 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 } 
  
 ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      
    <title>Login</title>
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container" id="sign-up">
    <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>     
		<form method='post'>
			<h1>Create Account</h1>
            <input type="text" name="email" placeholder="email" />
			<input type="text" name="username" placeholder="Name" />
			<input type="password" name="password" placeholder="Password" />
			<button type="submit" name="signup">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
    <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
		<form method="post" >
			<h1>Sign in</h1>
               <input class="input-field" type="text" placeholder="email" name="email"  value="<?php if (isset($_COOKIE['email']))
                 {echo ($_COOKIE['email']); }?>"/>
          <input class="input-field" type="password" placeholder="password" name="password" value="<?php if (isset($_COOKIE['password']))
               {echo ($_COOKIE['password']); }?>"/>
           
          
            <input style="margin-top :20px ; display: inline-block;" type="checkbox" value="remember-me" name="remember" checked />remember me<p class="checkbox" style="margin-top :20px ; display: inline-block;"></p>
			<button type="submit" name="login">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
<script>
    const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>

    
</body>
<?php
if(!empty($_POST["remember"])) {
     setcookie ("email",$_POST["email"]);
	setcookie ("password",$_POST["password"]);
     
	
} else {
     setcookie("email","");
	setcookie("password","");
    
	
}?>

</html>
