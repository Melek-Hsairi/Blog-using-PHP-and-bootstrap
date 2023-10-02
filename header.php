<header>
<?php 
     require_once 'refactoring.php';
     ?>  
  </header>
  <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">AI<em> Enthusiast</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="blog.php">Blog</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <?php if($_SESSION!=null){
                                $_POST['username']=$_SESSION["username"];?>
                              <li><a href="index.php"><?= $_SESSION["username"]?></a></li>
                              <?php  $tab=isAdmin();
                                    foreach($tab as $t){
                                            if(($t['username'] == $_POST['username'])){ 
                                            echo"<li><a href='adminPage.php'>dashbord</a></li>";
                                             echo"<li><a href='message.php'>messages</a></li>";
                                             echo"<li><a href='manageUtil.php'>users</a></li>";}
                                                                } ?>
                                                                <li><a href="logout.php">logout</a></li>
                                <?php }
                                  else{echo"<li><a href='login.php'>login</a></li>";}    ?>                          
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
</header>