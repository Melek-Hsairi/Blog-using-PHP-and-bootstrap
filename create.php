<?php require_once('refactoring.php'); ?>
<?php
session_start();
include('header.php') ?>
<?php include('validatePost.php'); ?>
<?php
$errors = array();
    if (isset($_POST['add-post'])) {
        $errors = validatePost($_POST);
    
        if (!empty($_FILES['image']['name'])) {
            $image_name = time() . '_' . $_FILES['image']['name'];
            $destination = "images/" . $image_name;
    
            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
    
            if ($result) {
               $_POST['image'] = $image_name;
            } else {
                array_push($errors, "Failed to upload image");
            }
        } else {
           array_push($errors, "Une image demandée");
        }
        if (count($errors) == 0) {
            unset($_POST['add-post']);
           
            $_POST['content'] = htmlentities($_POST['content']);
        
            $post_id = create($_SESSION['username'],$_POST['title'],$_POST['content'],$_POST['image'],$_POST['tag']);
            
            header("location: index.php"); 
            exit();    
        } else {
            $title = $_POST['title'];
            $author = $_SESSION['username'];
            $content = $_POST['content'];
            $tag = $_POST['tag'];
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>AI Enthusiast</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">
        <!-- Custom Styling -->
    <style> @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap');

*, *:after, *:before {
	box-sizing: border-box;
}

body {
	font-family: "DM Sans", sans-serif;
	line-height: 1.5;
	background-color: #f1f3fb;
	padding: 0 2rem;
}

img {
	max-width: 100%;
	display: block;
}


// iOS Reset 
input {
	appearance: none;
	border-radius: 0;
}

.card {
	margin: 2rem auto;
	display: flex;
	flex-direction: column;
	width: 100%;
	max-width: 425px;
    border-color:rgba(#999, .25);
	border-radius: 10px;
	box-shadow: 0 10px 20px 0 rgba(#999, .25);
	padding: .75rem;
}

.card-image {
	border-radius: 8px;
	overflow: hidden;
	padding-bottom: 65%;
	background-repeat: no-repeat;
	background-size: 150%;
	background-position: 0 5%;
	position: relative;
}

.card-heading {
	position: absolute;
	left: 10%;
	top: 15%;
	right: 10%;
	font-size: 1.75rem;
	font-weight: 700;
	color: #735400;
	line-height: 1.222;
	small {
		display: block;
		font-size: .75em;
		font-weight: 400;
		margin-top: .25em;
	}
}

.card-form {
	padding: 2rem 1rem 0;
}

.input {
	display: flex;
	flex-direction: column-reverse;
	position: relative;
	padding-top: 1.5rem;
	&+.input {
		margin-top: 1.5rem;
	}
}

.input-label {
	color: #8597a3;
	position: absolute;
	top: 1.5rem;
	transition: .25s ease;
}

.input-field {
	border: 0;
	z-index: 1;
	background-color: transparent;
	border-bottom: 2px solid #eee; 
	font: inherit;
	font-size: 1.125rem;
	padding: .25rem 0;
	&:focus, &:valid {
		outline: 0;
		border-bottom-color: #6658d3;
		&+.input-label {
			color: #6658d3;
			transform: translateY(-1.5rem);
		}
	}
}

.action {
	margin-top: 2rem;
}

.action-button {
	font: inherit;
	font-size: 1.25rem;
	padding: 1em;
	width: 100%;
	font-weight: 500;
	background-color: #6658d3;
	border-radius: 6px;
	color: #FFF;
	border: 0;
	&:focus {
		outline: 0;
	}
}

.card-info {
	padding: 1rem 1rem;
	text-align: center;
	font-size: .875rem;
	color: #8597a3;
	a {
		display: block;
		color: #6658d3;
		text-decoration: none;
	}
}




</style>



        <!-- end of custom styling -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>Create an <em>Article</em></h2>
                        <p>Don't hesitate to share your knowledge</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
	<!-- code here -->
	<div class="card">
	
    <form action="create.php" enctype="multipart/form-data" method="post">
                        <div class="input"> 
                            <input type="text" name="title"  class="text-input">
                            <label><h4>Title</h4></label>
                        </div>
                        <div class="input">
                            
                            <textarea cols="130", rows="10" name="content" id="body"></textarea>
                            <label><h4>Contenu</h4></label>
                        </div>
                        <div class="input">
                           
                            <input type="file" name="image"  class="text-input">
                            <label><h4>Image</h4> </label>
                        </div>
                        <br>
						<div>
                            <label><h4>TAGS</h4></label>
                            <input type="text" name="tag"  class="text-input">
                        </div>
                        
                        <div>
                            <button type="submit" name="add-post" class="btn btn-primary">Add Post</button>
                        </div>
                    </form>

		
	</div>
</div>
    <title>Document</title>
</head>
<body>
    
</body>
</html>