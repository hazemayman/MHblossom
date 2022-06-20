<?php 
session_start();
$condition = false;
if(! isset($_SESSION['Active'])){
    header("location: ../home/home.php");
}   
if($_SERVER["REQUEST_METHOD"] == "POST") {
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


    $sql = "Select * from Book, UserBooks WHERE UserBooks.UserID=".$_SESSION['UserID']." AND UserBooks.BookID=".$_POST['BookID']."";
        
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); 

    if($num == 0){
        $sql = "INSERT INTO UserBooks (BookID, 
        UserID) VALUES (".$_POST['BookID'].", 
        ".$_SESSION['UserID'].")";
    
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            $condition = true;
        }
    }
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>


        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH Blossoms - Profile</title>
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
    <link rel="stylesheet" type="text/css" href="Css/style.css"/>
    <link rel="stylesheet" type="text/css" href="Css/navfooter.css"/>
    <script src="https://kit.fontawesome.com/ee580cee9f.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- here the icon -->
    <a href="#myTopnav" id="myBtn" title="Go to top">▲</a>
    <nav class="topnav" id="myTopnav">
            <img class="navlogo" src="./images/logo.png" alt="logo">
            <p style="font-size: 20px;font-family:serif; font-style: italic; margin-right: 20px;">Blossoms</p>
            <a href="../home/home.php" class="first-navigation-link">Home</a>
            <a href="../browse/browse.php">Browse</a>
            <a  id= "last-navigation-link" href="#contact">Search</a>
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
                        <a class = "link-icon-profile" href = "#"><i class="fa-solid fa-user"></i></a>
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
    if($condition) {
            echo ' <div class="alert alert-success 
            alert-dismissible fade show" role="alert">
    
            <strong>Success!</strong> New book added to your shelf
            <button type="button" class="close"
                data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">×</span> 
            </button> 
            </div> '; 
         }
        ?>
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



    $sql = "Select * from Book, UserBooks WHERE UserBooks.UserID=".$_SESSION['UserID']." AND UserBooks.BookID=Book.BookID";
    $otherbooks = mysqli_query($conn, $sql);
    $conn->close();
  
?>


<hr>
<h1 class="header-personal-shelf">Personal Shelf</h1>
    <div class="personal-shelf">

        <?php
        
        foreach ($otherbooks as $row) {

                $x ='
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
            echo $x;
            
            }

        
        ?>
   </div>
   <hr>
   <br>


    <script src = "scripts/navfooter.js" ></script>
    <script src="scripts/script.js" ></script>
<!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="scripts/main.js"></script>
    <script src = "scripts/navfooter.js" ></script>
    <script src="https://kit.fontawesome.com/ee580cee9f.js" crossorigin="anonymous"></script>
</body>
</html>