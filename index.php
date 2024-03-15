<?php
require "config.php";
require_once "authenticate.php";

session_start();

if($_SESSION['loggedin'] == false || !isset( $_SESSION['loggedin'] )){
    header('location: loginform.php');
} 

$loginLink = '';
$usernameDisplay = '';

if (isLoggedIn()) {
    
    if (isAdmin()) {
        header("location: usertables.php");
        exit;
    } else {
        
        $loginLink = '<li><a href="logout.php">Logout</a></li>';
        $usernameDisplay = '<li><a href="#">' . $_SESSION['username'] . '</a></li>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Style CSS -->
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Font Awesome CDN -->
    <!-- Bootstrap Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Links -->
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <!-- index js-->


</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <nav>
            <input type="checkbox" id="show-search">
            <input type="checkbox" id="show-menu">
            <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>

            <div class="content">
                <div class="logo"><img src="./assets/img/logo.png" alt=""></div>
                <ul class="links">

                    <li><a href="index.php">Home</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="order.php">Order</a></li>
                    <?php
                     echo $loginLink;
                    echo $usernameDisplay;
                    
                    ?>
                </ul>

            </div>

            <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>

            <form action="#" class="search-box">
                <input type="text" placeholder="Search...">
                <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>

            </form>


        </nav>

    </div>


    <!-- NavbarEnd -->

    <!-- Home Section Start -->
    <section class="home">
        <div class="home-content" data-aos="zoom-in-down">
            <h3>Enjoy Your <span>Coffee</span></h3>
            <h3>Before Your Activity</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Autem earum, quae optio voluptate quam
                excepturi sapiente facilis? Corporis, facilis obcaecati!</p>

            <button id="btn"><a href="#order">ORDER NOW</a><i class="fa-solid fa-arrow-right"></i></button>
        </div>
        <div class="img" data-aos="zoom-in-left">
            <img src="./assets/img/bg.png" alt="">
        </div>
    </section>
    <!-- Home Section End -->


    <!-- Top Card Start -->
    <section class="top-card" id="about">
        <h3>Why We Are Defferent?</h3>
        <p>We don't just make your coffee, we make your day!</p>
        <div class="row">
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <img src="./assets/img/coffee-beans 1.png" alt="">
                    <h2>Supreme Coffee</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi ducimus libero harum repellat
                        provident sapiente amet consectetur aperiam eos magnam.</p>
                </div>
            </div>
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <img src="./assets/img/badge 1.png" alt="">
                    <h2>High Quality</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi ducimus libero harum repellat
                        provident sapiente amet consectetur aperiam eos magnam.</p>
                </div>
            </div>
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <img src="./assets/img/coffee-cup 1.png" alt="">
                    <h2>Extraordinary</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi ducimus libero harum repellat
                        provident sapiente amet consectetur aperiam eos magnam.</p>
                </div>
            </div>
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <img src="./assets/img/best-price 1.png" alt="">
                    <h2>Affordable Prices</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi ducimus libero harum repellat
                        provident sapiente amet consectetur aperiam eos magnam.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Top Card End -->

    <!-- Menu Section Start -->
    <section class="menu" id="menu">
        <h4>Our Menu</h4>
        <div class="row">
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <img src="./assets/img/m1.png" alt="">
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Coffee <span>$20.5</span></h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, odit.</p>
                    <h6><button id="btn1">Shop Now</button> <button id="btn2">Add Cart</button></h6>
                </div>
            </div>
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <img src="./assets/img/m2.png" alt="">
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Coffee <span>$20.5</span></h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, odit.</p>
                    <h6><button id="btn1">Shop Now</button> <button id="btn2">Add Cart</button></h6>
                </div>
            </div>
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <img src="./assets/img/m3.png" alt="">
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Coffee <span>$20.5</span></h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, odit.</p>
                    <h6><button id="btn1">Shop Now</button> <button id="btn2">Add Cart</button></h6>
                </div>
            </div>
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <img src="./assets/img/m4.png" alt="">
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Coffee <span>$20.5</span></h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, odit.</p>
                    <h6><button id="btn1">Shop Now</button> <button id="btn2">Add Cart</button></h6>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 30px;" data-aos="fade-up" data-aos-duration="1500">
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <img src="./assets/img/m5.png" alt="">
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Coffee <span>$20.5</span></h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, odit.</p>
                    <h6><button id="btn1">Shop Now</button> <button id="btn2">Add Cart</button></h6>
                </div>
            </div>
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <img src="./assets/img/m6.png" alt="">
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Coffee <span>$20.5</span></h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, odit.</p>
                    <h6><button id="btn1">Shop Now</button> <button id="btn2">Add Cart</button></h6>
                </div>
            </div>
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <img src="./assets/img/m7.png" alt="">
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Coffee <span>$20.5</span></h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, odit.</p>
                    <h6><button id="btn1">Shop Now</button> <button id="btn2">Add Cart</button></h6>
                </div>
            </div>
            <div class="col-md-3 py-3 py-md-0">
                <div class="card">
                    <img src="./assets/img/m8.png" alt="">
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h3>Coffee <span>$20.5</span></h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, odit.</p>
                    <h6><button id="btn1">Shop Now</button> <button id="btn2">Add Cart</button></h6>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Section End -->

    <!--Order Section Start-->
    <section>
        <div class="order" id="order">
            <h3>Order Now</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, reiciendis vitae est quibusdam voluptatem
                veritatis eaque quo pariatur libero. Cum.</p>
            <button id="btn"><a href="#menu">ORDER NOW</a><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </section>
    <!-- Order Section End -->

    <footer id="footer">
        <div class="footer-content">
            <div class="logo"><img src="./assets/img/logo.png" alt=""></div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, reiciendis vitae est quibusdam voluptatem
                veritatis eaque quo pariatur libero. Cum.
                <br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, exercitationem!
            </p>
            <div class="social-links">
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin"></i>
                <i class="fa-brands fa-pinterest"></i>
            </div>
        </div>
    </footer>


    <script src="./js/index.js"></script>

</body>

</html>