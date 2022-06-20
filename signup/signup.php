
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
    
    $showAlert = false; 
    $showError = false; 
    $exists=false;

    if(isset($_SESSION['Active'])){
        header("location: ../home/home.php");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
          
        
        $username = $_POST["username"]; 
        $password = $_POST["pass"]; 
        $email = $_POST["email"];
    
        $sql = "Select * from User where UserName='$username'"; 
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result); 
        // This sql query is use to check if
        // the username is already present 
        // or not in our Database
        if($num == 0) {
            $sql = "Select * from User where Email='$email'"; 
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result); 
            if($num == 0){
                $sql = "INSERT INTO User ( username, 
                password,Email) VALUES ('$username', 
                '$password' , '$email')";
    
                $result = mysqli_query($conn, $sql);
        
                if ($result) {
                    $showAlert = true; 
                    session_start();
                    $_SESSION['Signup']="true";
                    header("location: ../Login/login.php");
                    
                }
            }else{
                $exists="Email Already registered"; 
            }
            // Password Hashing is used here. 
           
         
        }else{
            $exists="Username not available"; 
        }// end if 

        
    }//end if   
        
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
        <link rel="icon" type="image/x-icon" href="logo.png">


    <!--===============================================================================================-->
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
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Css/util.css">
        <link rel="stylesheet" type="text/css" href="Css/main.css">
    <!--===============================================================================================-->

        <link rel="stylesheet" type="text/css" href="Css/navfooter.css"/>
    </head>
    <body>
        <a href="#myTopnav" id="myBtn" title="Go to top">▲</a>
        <nav class="topnav" id="myTopnav">
                <img class="navlogo" src="./images/logo.png" alt="logo">
                <p  style="font-size: 20px;font-family:serif; font-style: italic; margin-right: 20px;">Blossoms</p>
                <a href="../home/home.php" class="first-navigation-link">Home</a>
                <a href="../browse/browse.php">Browse</a>
                <a  id= "last-navigation-link" href="#contact">Search</a>
              <div class="search-container">
                <input class="search-text" type="text">
                <button class="search-button">Search</button>
              </div>
              <form action = "../Login/login.php" method = "get">
                <button class="login_main" >Login</button>
              </form>
              <form action = "../signup/signup.php" method = "get">
              <button class="signup_main"">Sign Up</button>
              </form>
        
              <a class="icon">
                <i class="fa fa-bars"></i>
              </a>     
        </nav>
        <?php 
        if($exists) {
            echo ' <div class="alert alert-danger 
                alert-dismissible fade show" role="alert">
        
            <strong>Error!</strong> '. $exists.'
            <button type="button" class="close" 
                data-dismiss="alert" aria-label="Close"> 
                <span aria-hidden="true">×</span> 
            </button>
           </div> '; 
         }
        ?>
        <div class="login-container">
            <div class="limiter">
                <div class="wrap-login100">
                    
                        <form class="login100-form validate-form" action="./signup.php" method="post">
                            <span class="login100-form-logo">
                                <i class="fa-regular fa-user"></i>
                            </span>
        
                            <span class="login100-form-title p-b-34 p-t-27">
                                SIGN UP
                            </span>
        
                            <div class="wrap-input100 validate-input" data-validate="Enter username">
                                <input class="input100" type="email" name="email" placeholder="Email">
                                <span class="focus-input100" data-placeholder="&#xf191;"></span>
                            </div>

                            <div class="wrap-input100 validate-input" data-validate = "Enter username">
                                <input class="input100" type="text" name="username" placeholder="Username">
                                <span class="focus-input100" data-placeholder="&#xf207;"></span>
                            </div>
        
                            <div class="wrap-input100 validate-input" data-validate="Enter password">
                                <input class="input100" type="password" name="pass" placeholder="Password">
                                <span class="focus-input100" data-placeholder="&#xf191;"></span>
                            </div>

    
        
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn">
                                    Sign Up
                                </button>
                            </div>
                            <div class="account-required-container">
                                <p class="account-required">Have an account? </p>
                                <a href="../Login/login.php" class="link-singup">SIGN IN</a>
                            </div>
                           
                        </form>
                    </div>
                </div>

        </div>
        
    
        <div id="dropDownSelect1"></div>

            <!-- footer here
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
                        <a href="mailto:mfawzii96@gmail.com" style="width: min-content; margin: 0; padding: 0;" target="_blank"><i class="fa-solid fa-envelope"></i></a>
                        <i class="fa-brands fa-facebook"></i>
                        <i class="fa-brands fa-whatsapp"></i>
                        <i class="fa-brands fa-instagram"></i><br>
                    </div>
        
                </div>
                <hr>
                <p class="copyrights">MH Blossoms © 2022 - All rights reserved.</p>
                <p class="copyrights">Made with ❤️ by Mariam and Hazem.</p>
            </footer> -->

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