<!DOCTYPE html>
<html>
    <head>
        <title>MH Blossoms</title>
        <link rel="icon" type="image/x-icon" href="images/logo.png">
        <link type="text/css" rel="stylesheet" href="navfooter.css">

        <!-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> -->
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
        <link type="text/css" rel="stylesheet" href="home.css">
        <script src="https://kit.fontawesome.com/ee580cee9f.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <button onclick="topFunction()" id="myBtn" title="Go to top">▲</button>
        <nav class="topnav" id="myTopnav">
            <img class="navlogo" src="images/logo.png" alt="logo">
            <p  style="font-size: 20px;font-family:serif; font-style: italic; margin-right: 20px;">Blossoms</p>
            <a href="#home" class="active first-navigation-link">Home</a>
            <a href="#news">News</a>
            <a href="#contact">Contact</a>
            <a href="#about" id="last-navigation-link">About</a>
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
        
        <div class="container">
            <div class="left">
                <h3 style="font-family: serif; font-size: 22px">Deciding what to read next?</h3>
                <p style="font-size: 18px">You’re in the right place. Tell us what titles or genres you’ve enjoyed in the past, and we’ll give you surprisingly insightful recommendations.</p>
                <div style="margin-top: 30px;">
                    <h3 style="font-family: serif; font-size: 22px">Search and browse books</h3>
                    <div class="search-container">
                        <input class="search-text" type="text">
                        <button class="search-button">Search</button>
                    </div>
                </div>
                <div class="table">
                    <table>
                        <tr>
                            <td><a href="">Art</a></td>
                            <td><a href="">Young Adult</a></td>
                            <td><a href="">Mystery</a></td>
                            <td><a href="">Self Help</a></td>
                        </tr>
                        <tr>
                            <td><a href="">Fantasy</a></td>
                            <td><a href="">Non-fiction</a></td>
                            <td><a href="">Science</a></td>
                            <td><a href="">Thriller</a></td>
                        </tr>
                        <tr>
                            <td><a href="">Drama</a></td>
                            <td><a href="">Science Fiction</a></td>
                            <td><a href="">Comics</a></td>
                            <td><a href="">Classic</a></td>
                        </tr>
                        <tr>
                            <td><a href="">Romance</a></td>
                            <td><a href="">Horror</a></td>
                            <td><a href="">History</a></td>
                            <td><a href="">Fiction</a></td>
                        </tr>
                    </table>
                    <img src="images/books.jpg" alt="books">
                </div>
            </div>
            <div class="right">
                <h3 style="font-family: serif; font-size: 22px">Stay Updated</h3>
                <p style="font-size: 18px">Stay up to date with all new books and interviews!</p>
                <div class="news">
                    <h3 style="font-family: serif; font-size: 22px; margin-bottom: 10px;" >News and Interviews</h3>
                    <a href="https://www.goodreads.com/book/popular_by_date" target="_blank"style="font-family: sans-serif; margin-left: -20px;"><b>Most popular books published in 2022</b></a>
                    <img src="images/popular.jpg" alt="Popular Books" />
                </div>
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
        <script src="home.js"></script>
    </body>
</html>