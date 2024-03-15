<?php
require_once "authenticate.php";
require "config.php";


session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header('location: loginform.php');
    exit;
}


if (!isAdmin()) {
    header('location: loginform.php');
    exit;
}

$adminname = '';
//$username = '';
//$email = '';

if (isAdmin()) {
    $adminname = '<li><a href="#">' . ($_SESSION['username']) . '</a></li>';
}

$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = "";

if (isset($_POST['submit'])) {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT id FROM userdata WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST['username']);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = " username is already taken";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                $username_err = "Something went wrong";
            }
            mysqli_stmt_close($stmt);
        }
    }


    if (empty(trim($_POST["email"]))) {
        $email_err = "Email cannot be blank";
    } else {
        $email = trim($_POST["email"]);
    }


    if (empty(trim($_POST['password']))) {
        $password_err = 'Password cannot be blank';
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = 'Password cannot be less than 5 characters';
    } else {
        $password = trim($_POST['password']);
    }


    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $confirm_password_err = "Passwords should match";
    }


    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)) {
        $sql = "INSERT INTO userdata (username, email, Password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
            $param_username = $username;
            $param_email = $email;
            $param_password = $password;

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['UserCreatedStatus'] = "User created successfully.";
                header("Location: usertables.php");
                exit();
            } else {
                $username_err = "Something went wrong... cannot redirect!";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}

/*
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $password_confirm = $_POST['ConfirmPassword'];

    if ($password !== $password_confirm) {
        $password_err = "Passwords do not match";
    } else {

        $sql = "INSERT INTO `userdata`(`username`, `Email`, `Password`) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            $_SESSION['UserCreatedStatus'] = "User created successfully.";
            header("Location: usertables.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}*/
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Create User</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Admin Pannel</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search- 
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form> -->
        <!-- Navbar-->
        <ul class="navbar-nav d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="small text-center sb-sidenav accordion sb-sidenav-dark"
                            style="background-color: #222; color: #fff; padding: 10px;">
                            <i class="fas fa-user-shield"></i>
                            <?php echo $adminname; ?>
                        </div>


                        <!--
                        <div class="sb-sidenav-menu-heading">Core</div>
                        
                        
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                         <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div> -->
                        <!--
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                               
                            </nav>
                        </div>
-->


                        <a class="nav-link" href="usertables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Admin Dashboard
                        </a>

                    </div>
                </div>

            </nav>

        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <div style="small text-center ">
                        <div class="d-flex justify-content-end mb-4">
                            
                            <div class="small text-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Dashboard</li>
                                    <li class="breadcrumb-item active"><a href="usertables.php">User Table</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <h3>Create User Account</h3>
                        <form action="" method="POST">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="inputEmail" type="text" placeholder="User Full Name"
                                    name="username" value="<?php echo htmlspecialchars($username); ?>" />
                                    <div class="text-danger">
                                <?php if (!empty($username_err))
                                    echo "<span class='error'>$username_err</span>"; ?>
                                    </div>
                                <label for="inputEmail">User Full Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="email" placeholder="example@.com"
                                    name="email" value="<?php echo htmlspecialchars($email); ?>" />
                                    <div class="text-danger">
                                <?php if (!empty($email_err))
                                    echo "<span class='error'>$email_err</span>"; ?>
                                    </div>
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputPassword" type="password" placeholder="Password"
                                    name="password" />
                                    <div class="text-danger">
                                <?php if (!empty($password_err))
                                    echo "<span class='error'>$password_err</span>"; ?>
                                    </div>
                                <label for="inputPassword">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="password" placeholder="Confirm Password"
                                    name="confirm_password" required>
                                <label for="ConfirmPassword">Confirm Password</label>

                            </div>
                            <div class="text-danger">
                                <?php echo isset($password_err) ? $password_err : ''; ?>
                            </div>




                            <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                <button class="btn btn-primary me-2" type="submit" name="submit">Create User</button>
                                <a href="usertables.php" class="btn btn-transparent">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>


            </main>
            <footer class="py-4 bg-secondary mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small text-light">

                        <div style="float: right;">

                            Copyright &copy; Your Website 2024

                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="assets/demo/chart-pie-demo.js"></script>
</body>

</html>