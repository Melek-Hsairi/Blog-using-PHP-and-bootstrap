<?php
require_once 'refactoring.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<nav class="navbar bg-light">
  <div class="container-fluid">
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" id='search-art' placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
      <div id="searchresult"></div>
    </form>
  </div>
</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script type="text/javascript">
      $(document).ready(function(){
        $('search-art').keyup(function(){
          var article = $(this).val(); //afficher la valeur dans la barre
          if(article != ""){
            $.ajax({
              url: 'rech.php',
              metod:'post',
              data:{query:article},
              success:function(response){
                $("#searchresult").html(data);
              }
            });
               
                }else{
                  $("searchresult").css("display","none");
                }
             
           });
        });
    </script>
</body>
</html>