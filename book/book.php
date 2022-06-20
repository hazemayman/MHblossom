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
    $sql = "Select * from Book where BookID=".$_GET['id'];   
    $result = mysqli_query($conn, $sql);
    $bookDetails = $result->fetch_assoc();


    $sql = "Select * from Author where AuthorID=".$bookDetails["AuthorID"];    
    $result = mysqli_query($conn, $sql);
    $authorDetails = $result->fetch_assoc();

    $sql = "Select * from Book where AuthorID=".$authorDetails["AuthorID"];   
    $otherbooks = mysqli_query($conn, $sql);

    $sql = "Select * from Quote where BookID=".$bookDetails["BookID"];   
    $Quotes = mysqli_query($conn, $sql);
    


    if(isset($_SESSION['UserID'])){
        $sql = "Select * from UserBooks where BookID=".$bookDetails['BookID']." AND UserID=".$_SESSION['UserID']."";   
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result); 
        if($num == 0){
            $condition = true;
        }
    
    }
   

    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MH Blossoms - Book</title>
        <link rel="icon" type="image/x-icon" href="../images/logo.png">
        <link type="text/css" rel="stylesheet" href="Css/navfooter.css">  
        <link type="text/css" rel="stylesheet" href="Css/book.css">    
        <link type="text/css" rel="stylesheet" href="Css/bookCard.css">    
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
            <div class="leftContainer">
                <img class="cover" src="'.$bookDetails['Image'].'" alt="'.$bookDetails['Name'].'" />';

            
                if($condition == true){
                    $_SESSION['newBook'] = true;
                    echo '
                    <form class="add-top-list-form" method="post" action="../profile/profile.php">
                        <button name="BookID" value='.$bookDetails['BookID'].' class="add-top-list-button">Add To List</button>
                    </form>
                    ';
                }
        
        
        echo'
              
            </div>
            <div class="middleContainer">
                <h2 class="bookTitle">'.$bookDetails['Name'].'</h2>
                <h3>by <a class="bookAuthor" href="../author/author.php?id='.$authorDetails['AuthorID'].'" target="_blank">'.$bookDetails['AutherName'].'</a></h3>
                <br>
                <p>'.$bookDetails['Reviews'].' ratings, '.$bookDetails['Rating'].' average rating,</p>
                <br>
                <p class="summary">
                    '.$bookDetails['Info'].'
                </p>
                <hr>
                
                <div class="quotes">
                    <h3>Quotes from '.$bookDetails['Name'].'</h3>
                    <hr>';

            $counter = 0;
            foreach ($Quotes as $row) {
                if($counter == 3){
                    break;
                }

                echo '
                    <p>“'.$row['Info'].'”</p>
                    <hr>
                ';
                $counter+=1;
            }
            echo '
            </div>
                <a href=../quote/quote.php?id="'.$bookDetails['BookID'].'"><p id="more">More quotes...</p></a> 
            </div>
                ';
                   
              
        

            ?>
            <div class="rightContainer">
                <h2>Books by the author</h2>
                <div class="recommend">
                    <?php
                    $counter = 0;
                    foreach ($otherbooks as $row) {
                        if($counter == 3){
                            break;
                        }
                        echo '
                        <div class="book-card-container" id="book-conteiner">
                            <img src="'.$row['Image'].'" class="book-card-image">
                            <div class="book-card-slider">
                            </div>
                            <div class="book-card-slider-text">
                                <div class="book-card-content">               
                                    <a class="add-to-read" href="../book/book.php?id='.$row['BookID'].'"> View book</a>
                                </div>
                            </div>
                        </div>
                        ';


                        $counter+=1;
                    }
                    ?>
                   
                </div>
                <?php

                echo '
                <div class="genres">
                    <h3>Genres</h3>
                    <hr>
                    <p>'.$bookDetails['Genres'].'</p>    

                </div>
                ';
                ?>


                <?php
                echo "
                <div class='author'>
                    <h3>".$authorDetails["Name"]."</h3>
                    <hr>
                    <p>
                    ".$authorDetails['Info']."
                    </p>
                </div>
                ";
                ?>
                
            </div>
        </div>   

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