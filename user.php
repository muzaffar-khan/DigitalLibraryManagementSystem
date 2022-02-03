<?php
$userloginid = $_SESSION["userid"] = $_GET['userlogid'];
// echo $_SESSION["userid"];
include("data_class.php");
$u = new data;
$u->setconnection();
$u->userdetail($userloginid);
$recordset = $u->userdetail($userloginid);
foreach ($recordset as $row) {

    $id = $row[0];
    $name = $row[1];
    $email = $row[2];
    $pass = $row[3];
    $type = $row[4];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>User</title>
    <link rel="stylesheet" href="./user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
</head>

<body>

    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#"><img src="./image/logo.ico" alt=""></a></div>
            <ul class="menu">
                <li><a href="#home" class="menu-btn">Home</a></li>
                <li><a href="#account" class="menu-btn">My Account</a></li>
                <li><a href="#reqbook" class="menu-btn">Request Book</a></li>
                <li><a href="#bookreport" class="menu-btn">Book Report</a></li>
                <li><a href="./index.php" class="menu-btn">Log-Out</a></li>
            </ul>
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
    <!-- Home -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-1">Welcome,</div>
                <div class="text-2"><?php echo $name ?></div>
                <a href="#account">My Account<br></a><br>
            </div>
        </div>
    </section>

    <!-- footer section start -->
    <footer>
        <span>Created By <a href="#">Group-04</a> | Rizvi College Of Engineering | <span class="far fa-copyright"> </span> 2022 All rights
            reserved.</span>
    </footer>

    <script src="./user.js"></script>
</body>

</html>
