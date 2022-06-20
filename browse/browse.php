<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH Blossoms - Browse</title>
   
    <link rel="stylesheet" type="text/css" href="Css/style.css"/>
    <link rel="stylesheet" type="text/css" href="Css/navfooter.css"/>
    <script src="https://kit.fontawesome.com/ee580cee9f.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="logo.png">
   
</head>
<body>

    <!-- here the icon -->
    <a href="#myTopnav" id="myBtn" title="Go to top">▲</a>
    <nav class="topnav" id="myTopnav">
            <img class="navlogo" src="../images/logo.png" alt="logo">
            <p style="font-size: 20px;font-family:serif; font-style: italic; margin-right: 20px;">Blossoms</p>
            <a href="../home/home.php" class="first-navigation-link">Home</a>
            <a href="../browse/browse.php" class = "active">Browse</a>
            <a  id ="last-navigation-link" href="../search/search.php">Search</a>
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
    $data = array();
    $sql = "SELECT BookID , Name, Image, AutherName, Genres ,Rating   FROM Book";
    $result = $conn->query($sql);
    $geners = array();
    if ($result->num_rows > 0) {
    // output data of each row
        $counter = -1;
        while($row = $result->fetch_assoc()) {
            if (! in_array($row['Genres'], $geners)){
                array_push($geners , $row['Genres']);
                array_push($data , array());
                $counter+=1;
            }
            array_push($data[$counter] , array($row['Name'] , $row['Image'] , $row['AutherName'] , $row['Genres'] , $row['Rating'] , $row['BookID']));
        }
    } 
    else {
        echo "0 results";
    }
    $conn->close();
  
?>

    
    <?php
    
    $counter = 0;
    foreach ($geners as $type){
        echo  '<div class="container-books">';
        echo '<h1 class="genre-title">'.$type.'</h1>
            <hr>
              <div class="inner-container-book">' ;
        foreach ($data[$counter] as $row) {

            $x ='
            <div class="book-card-container" id="book-conteiner">
                <img src="'.$row[1].'" class="book-card-image">
                <div class="book-card-slider">
                </div>
                <div class="book-card-slider-text">
                    <div class="book-card-content">
                        <p class="book-title">'.$row[0].'</p>
                        <p class="book-author">'.$row[2].'</p>
                        
                        <a class="add-to-read" href = ../book/book.php?id='.intval($row[5]).'> View book</a>
                        
                        <div class="card-content-footer">
                            <p class="footer book-genres">'.$row[3].'</p>
                            <p class="footer book-review">reviews : '.$row[4].'</p>
                        </div>
                    </div>
                </div>
            </div>
        ';
        echo $x;
        
        }
        echo '<hr>';
        echo '</div>';
        echo '</div>';
        $counter+=1;
    }
    
    
    ?>


   


    <!-- footer here -->
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
                <a href="mailto:mfawzii96@gmail.com" style="width: min-content; margin: 0; padding: 0;" target="_blank"><i class="fa-solid fa-envelope"></i></a>
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-whatsapp"></i>
                <i class="fa-brands fa-instagram"></i><br>
            </div>

        </div>
        <hr>
        <p class="copyrights">MH Blossoms © 2022 - All rights reserved.</p>
        <p class="copyrights">Made with ❤️ by Mariam and Hazem.</p>
    </footer>
    <script src = "scripts/navfooter.js" ></script>
    <script src="scripts/script.js" ></script>
    <script>
        
    </script>

</body>
</html>