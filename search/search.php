<?php
    session_start();
    $servername = "localhost";
    $username = "test";
    $password = "test123";
    $dbname = "mhbooks";
    $condition = false;
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $type = 'Book';
    $result = array();
    if(isset($_GET['type'])){
        if($_GET['type'] == 'Author'){
            $type = "Author";
        }
    }
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        if(isset($_GET['searchResult'])){
            if($_GET['searchResult'] == ""){
                $result = array();
            }else{
                    
                if(isset($_GET['type']) && $_GET['type'] == 'Author'){
                    $sql = "Select * from Author WHERE Name LIKE '%".$_GET['searchResult']."%'";
                    $result = mysqli_query($conn, $sql);
                }else{
                    $sql = "Select * from Book WHERE Name LIKE '%".$_GET['searchResult']."%'";
                    $result = mysqli_query($conn, $sql);
                }
            }
          


          
            
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>MH Blossoms - Search</title>
        <link rel="icon" type="image/x-icon" href="../images/logo.png">
        <link type="text/css" rel="stylesheet" href="Css/navfooter.css">
        <link type="text/css" rel="stylesheet" href="Css/search.css">
        <link type="text/css" rel="stylesheet" href="Css/bookCard.css">
        <script src="https://kit.fontawesome.com/ee580cee9f.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <button onclick="topFunction()" id="myBtn" title="Go to top">▲</button>
        <nav class="topnav" id="myTopnav">
            <img class="navlogo" src="../images/logo.png" alt="logo">
            <p  style="font-size: 20px;font-family:serif; font-style: italic; margin-right: 20px;">Blossoms</p>
            <a href="../home/home.php" class=" first-navigation-link">Home</a>
            <a href="../browse/browse.php">Browse</a>
            <a id= "last-navigation-link" href="../search/search.php" class ="active">Search</a>

          <div class="search-container">
                <form action="../search/search.php" method="get">
                    <input class="search-text" type="text" name="searchResult">
                    <button class="search-button">Search</button>
                </form>
          </div>
          <?php 
            if(isset($_SESSION['Active'])){
                echo '<div class="logged-icon-container">
                    <p class="logged-username">Username: '.$_SESSION['UserName'].'</p>
                    <span class="logged-in-icon">
                        <a class = "link-icon-profile" href = "../profile/profile.php"><i class="fa-solid fa-user"></i></a>
                    </span>
                    <form action = "../home/home.php" method = "post" class="logout-form">
                        <button class="logout_main"">Logout</button>
                    </form>
                </div>';
            }else{
                echo '
                
                <form action = "../Login/login.php" method = "get">
                <button class="login_main" >Login</button>
              </form>
              <form action = "../signup/signup.php" method = "get">
              <button class="signup_main"">Sign Up</button>
              </form>
                ';

            }
          ?>
    
          <a class="icon">
            <i class="fa fa-bars"></i>
          </a>
          
        </nav>
        <div class="search">
            <h2>Search</h2>
            <div class="search-container2">
                <form action="../search/search.php" method="get">
                    <input class="search-text" type="text" name="searchResult">
                    <button class="search-button">Search</button>
                    <?php 
                        if($type == "Book"){
                            echo '
                                <input type="radio"  name="type" value="Book" checked>
                                <label for="vehicle1">Book</label>
                                <input type="radio"  name="type" value="Author">
                                <label for="vehicle2">Author</label>
                            ';
                        }else{
                            echo '
                                <input type="radio"  name="type" value="Book" >
                                <label for="vehicle1">Book</label>
                                <input type="radio"  name="type" value="Author" checked>
                                <label for="vehicle2">Author</label>
                            ';
                        }
                    ?>
                 
                </form>
              
            </div>
        </div>
        <hr>
        <?php
            if($type == "Book"){
                echo '  <h2 class="title-found">Books</h2>';
            }else{
                echo '  <h2 class="title-found">Author</h2>';
            }
        ?>
      
        <div class="books-found-container">
            <?php
                if($type == "Book"){
                    foreach($result as $row){
                        echo '
                        <div class="book-card-container" id="book-conteiner">
                            <img src="'.$row['Image'].'" class="book-card-image">
                            <div class="book-card-slider">
                            </div>
                            <div class="book-card-slider-text">
                                <div class="book-card-content">
                                    <p class="book-title">'.$row["Name"].'</p>
                                    <p class="book-author">'.$row["AutherName"].'</p>
                                    
                                    <a class="add-to-read" href = ../book/book.php?id='.intval($row['BookID']).'> View book</a>
                                    
                                    <div class="card-content-footer">
                                        <p class="footer book-genres">'.$row['Genres'].'</p>
                                        <p class="footer book-review">reviews : '.$row['Rating'].'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                }else{
                    foreach($result as $row){
                        echo '
                        <div class="book-card-container" id="book-conteiner">
                            <img src="'.$row['Image'].'" class="book-card-image">
                            <div class="book-card-slider">
                            </div>
                            <div class="book-card-slider-text">
                                <div class="book-card-content" style = "padding-top: 4rem">
                                    <p class="book-title">'.$row["Name"].'</p>
                                    
                                    <a class="add-to-read" href = ../author/author.php?id='.intval($row['AuthorID']).' style="width: 7rem"> View Author</a>
                                    
                                </div>
                            </div>
                        </div>
                        ';
                    }

                }
              
            ?>
        </div>


        <!-- <div class="pages">
            <span>  ← previous </span>
            <em class="currentPage">1</em>
            <a href="page2B.html" target="_blank">2</a>
            <a href="page3B.html" target="_blank">3</a>
            <span>...</span>
            <a href="page4B.html" target="_blank">4</a>
            <span>next →</span>
        </div> -->
        <!-- <footer>
            <div class="row">
                <div class="col" style="text-align:center;"><img class="logo" src="images/logo.png" alt="logo"><br><p  style="font-size: 20px;font-family:serif; font-style: italic; margin-right: 20px;">Blossoms</p></div>
                <div class="col">
                    <h3>Company<div class="underline"></div></h3>
                    <p class="footerText"><a href="">About Us</a></p>
                    <p class="footerText"><a href="">Careers</a></p>
                    <p class="footerText"><a href="">Terms</a></p>
                    <p class="footerText"><a href="">Privacy</a></p>
                    <p class="footerText"><a href="">Help</a></p>
                </div>
                <div class="col">
                    <h3>Work With Us<div class="underline"></div></h3>
                    <p class="footerText"><a href="">Authors</a></p>
                    <p class="footerText"><a href="">Advertise</a></p>
                </div>
                <div class="col">
                    <h3>Connect<div class="underline"></div></h3>
                    <a href="mailto:mfawzii96@gmail.com" target="_blank" style="padding:0px"><i class="fa-solid fa-envelope"></i></a>
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-whatsapp"></i>
                    <i class="fa-brands fa-instagram"></i><br>
                </div>

            </div>
            <hr>
            <p class="copyrights">MH Blossoms © 2022 - All rights reserved.</p>
            <p class="copyrights">Made with ❤️ by Mariam and Hazem.</p>
        </footer> -->
    <script src="Scripts/home.js"></script>  
    </body>
</html>