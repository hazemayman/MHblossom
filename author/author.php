<?php
session_start();

    $servername = "localhost";
    $username = "donzoma09";
    $password = "lambergeneko09";
    $dbname = "mhbooks";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_GET['id']) ){
        $sql = "Select * from Author where AuthorID=".$_GET['id'];   
        $result = mysqli_query($conn, $sql);
        $authorDetails = $result->fetch_assoc();
    
        $sql = "Select * from Book where AuthorID=".$authorDetails["AuthorID"];   
        $otherbooks = mysqli_query($conn, $sql);
    }else{
        header("location: ../home/home.php");
    }


    // echo print_r($authorDetails);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>MH Blossoms - Author</title>
        <link rel="icon" type="image/x-icon" href="images/logo.png">
        <link type="text/css" rel="stylesheet" href="Css/navfooter.css"> 
        <link type="text/css" rel="stylesheet" href="Css/author.css"> 
        <link type="text/css" rel="stylesheet" href="Css/bookCard.css"> 
        <script src="https://kit.fontawesome.com/ee580cee9f.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <button onclick="topFunction()" id="myBtn" title="Go to top">▲</button>
        <nav class="topnav" id="myTopnav">
            <img class="navlogo" src="images/logo.png" alt="logo">
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

            echo "
            <div class=\"first\">
            <div>
                <img class=\"author\" src=\"".$authorDetails['Image']."\" alt=\"Author\" />
            </div>
            <div class=\"info\">
                <h2 class=\"name\">".$authorDetails['Name']."</h2>
                <hr>
                <br>
                <p class=\"biography\">
                ".$authorDetails['Info']."
                </p>
                
            </div>
        </div>
            
            ";
        ?>  
       
        <div class="Others">
            <hr>
            <h2>Books by the author</h2>
            <div class = "others-container">
                <?php
                foreach ($otherbooks as $row){
                    echo '
                    <div class="book-card-container" id="book-conteiner">
                        <img src="'.$row["Image"].'" class="book-card-image">
                        <div class="book-card-slider">
                        </div>
                        <div class="book-card-slider-text">
                            <div class="book-card-content">
                                <p class="book-title">'.$row['Name'].'</p>
                                <p class="book-author">'.$row['AutherName'].'</p>
                                
                                <a class="add-to-read" href = ../book/book.php?id='.$row['BookID'].'> View book</a>
                                
                                <div class="card-content-footer">
                                    <p class="footer book-genres">'.$row['Genres'].'</p>
                                    <p class="footer book-review">reviews :'.$row['Rating'].' </p>
                                </div>
                            </div>
                        </div>
                    </div>
                ';  
                }

                ?>
            </div>
           
        </div>
            
        

        <footer>
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
        </footer>
    <script src="Scripts/home.js"></script>  
        
    </body>
</html>