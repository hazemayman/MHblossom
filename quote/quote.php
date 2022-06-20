<?php

    session_start();


    $servername = "localhost";
    $username = "test";
    $password = "test123";
    $dbname = "mhbooks";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $sql = "Select * from Book where BookID=".$_GET['id'];   
    $result = mysqli_query($conn, $sql);
    $bookDetails = $result->fetch_assoc();

    $sql = "Select * from Quote where BookID=".$bookDetails["BookID"];   
    $Quotes = mysqli_query($conn, $sql);


?>
<!DOCTYPE html>
<html>
    <head>
        <title>MH Blossoms - Quotes</title>
        <link rel="icon" type="image/x-icon" href="logo.png">
        <link type="text/css" rel="stylesheet" href="Css/navfooter.css">
        <link type="text/css" rel="stylesheet" href="Css/quotes.css">
        <script src="https://kit.fontawesome.com/ee580cee9f.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <button onclick="topFunction()" id="myBtn" title="Go to top">▲</button>
        <nav class="topnav" id="myTopnav">
            <img class="navlogo" src="../images/logo.png" alt="logo">
            <p  style="font-size: 20px;font-family:serif; font-style: italic; margin-right: 20px;">Blossoms</p>
            <a href="../home/home.php" class="first-navigation-link">Home</a>
            <a href="../browse/browse.php">Browse</a>
            <a  id= "last-navigation-link" href="../search/search.php">Search</a>
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

        <?php 
        echo '
        <div class="mainContent">
        <div class="header">
        <h1>'.$bookDetails['Name'].'</h1>
        </div>
        <div class="leftContainer">
            <!-- <div class="right">
                <div class="read">
                    <select name="dropdown">
                        <option>Read</option>
                        <option>Currently Reading</option>
                        <option>Want to Read</option>
                        <option>Add to Shelf</option>
                    </select><br>
                </div>
            </div> -->
            <a class="booking" href=../book/book.php?id="'.$bookDetails['BookID'].'" target="_blank"><img class="cover" src="'.$bookDetails['Image'].'" alt="'.$bookDetails['Name'].'" /></a>
            <a class="bookTitle" href="../book/book.php?id='.$bookDetails['BookID'].'" target="_blank" >'.$bookDetails['Name'].'</a>
            <span>by</span>
            <a class="bookAuthor" href="../author/author.php?id='.$bookDetails['AuthorID'].'" target="_blank">'.$bookDetails['AutherName'].'</a>
            <br>
            <p>'.$bookDetails['Reviews'].' ratings '.$bookDetails['Rating'].'</p>
            <br>
            <h4>'.$bookDetails['Name'].' Quotes</h4>
        </div>
    </div>  
        
        ';
        ?>
 


        <?php 
        
        foreach ($Quotes as $row){

            echo '
            <div class="quotes">
                <div class="info">
                    “'.$row['Info'].'”
                </div>
                <div>
                    ― <span id="author">'.$bookDetails['AutherName'].'</span>, <span id="book">'.$bookDetails['Name'].'</span>
                    <!--<div class="likes">
                        <a onclick="addLike()"><i class="fa-regular fa-thumbs-up"></i></a>
                        <p id="likes">2858 likes</p>
                    </div> -->
                </div>
                <hr class="hr-quotes">
            </div>
            
            ';
        }
        ?>

        
        <!-- <div class="pages">
            <span>  ← previous </span>
            <em class="currentPage">1</em>
            <a href="page2Q.html" target="_blank">2</a>
            <a href="page3Q.html" target="_blank">3</a>
            <span>...</span>
            <a href="page4Q.html" target="_blank">4</a>
            <span>next →</span>
        </div> -->
        <footer>
            <div class="row">
                <div class="col" style="text-align:center;"><img class="logo" src="../images/logo.png" alt="logo"><br><p  style="font-size: 20px;font-family:serif; font-style: italic; margin-right: 20px;">Blossoms</p></div>
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
        </footer>
    <script src="Scripts/home.js"></script>  
    </body>
</html>