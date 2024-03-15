<?php

require_once "authenticate.php";

require "config.php";


if($_SESSION['loggedin'] == false || !isset( $_SESSION['loggedin'] )){
    header('location: loginform.php');
} 

$sql = "SELECT * FROM userdata";
$result = $conn->query($sql);

$adminname = '';


if (isAdmin()) {

    $adminname = '<li><a href="#">' . ($_SESSION['username']) . '</a></li>';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registered Users Details</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="usertables.php">Admin Pannel</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>

        <!-- Navbar Search -->
        <!--
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>  -->
        <!-- Navbar-->
        <ul class="navbar-nav d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <!-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li> -->
                    <hr class="dropdown-divider" />
            </li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
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
                            <!-- Use flexbox utilities to align to the right -->
                            <div class="small text-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">Dashboard</li>
                                    <li class="breadcrumb-item active"><a href="usertables.php">User Table</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- Alert Messages -->

                    <?php
                    if (isset($_SESSION['UserCreatedStatus'])) {

                        ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['UserCreatedStatus']; ?>

                            <button style="float: right;" type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>

                        </div>
                        <?php
                        unset($_SESSION['UserCreatedStatus']);
                    } elseif (isset($_SESSION['UserDeletedStatus'])) {

                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['UserDeletedStatus']; ?>
                            <button style="float: right;" type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        <?php
                        unset($_SESSION['UserDeletedStatus']);
                    } elseif (isset($_SESSION['UserUpdatedStatus'])) {

                        ?>
                        <div class="alert alert-warning" role="alert">
                            <?php echo $_SESSION['UserUpdatedStatus']; ?>
                            <button style="float: right; " type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        <?php
                        unset($_SESSION['UserUpdatedStatus']);
                    }
                    ?>

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-table me-1"></i>
                            User Details
                            <div style="float: right;">
                                <a href="createuser.php" class="btn btn-success btn-sm">Add User</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="bg-info text-white">
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['username']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['Email']; ?>
                                                    </td>
                                                    <td>
                                                        <input id="passinput<?php echo $row['id']; ?>" type="password"
                                                            value="<?php echo $row['Password']; ?>" readonly="readonly"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <a href="UpdateUser.php?id=<?php echo $row['id']; ?>"
                                                            class="btn btn-info btn-sm">Update
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete
                                                        </a>
                                                        <button class="btn btn-outline-secondary btn-sm" type="button"
                                                            onclick="togglePassword('passinput<?php echo $row['id']; ?>')">
                                                            <i class="bi bi-eye-slash"></i> View Password
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No users found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
        function confirmDelete(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "delete.php?id=" + userId;

            }
        }
        function togglePassword(passinputId) {
            var x = document.getElementById(passinputId);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>