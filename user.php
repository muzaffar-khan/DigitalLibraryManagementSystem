<?php
$userloginid = $_SESSION["userid"] = $_GET['userlogid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Digital Library</title>
    <link rel="stylesheet" href="./user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
</head>

<body>
    <?php
    include("data_class.php");
    ?>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#"><img src="./image/logo.ico" alt=""></a></div>
            <ul class="menu">
                <li><a href="#home" class="menu-btn">Home</a></li>
                <li><a href="#account" class="menu-btn">My Account</a></li>
                <li><a href="#bookreq" class="menu-btn">Request Book</a></li>
                <li><a href="#bookrep" class="menu-btn">Book Report</a></li>
                <li><a href="#ebooks" class="menu-btn">eBooks</a></li>
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
                <?php
                $u = new data;
                $u->setconnection();
                $u->userdetail($userloginid);
                $recordset = $u->userdetail($userloginid);
                foreach ($recordset as $row) {
                    $name = $row[1];
                } ?>
                <div class="text-1">Welcome,</div>
                <div class="text-2"><?php echo $name ?></div>
                <a href="#account">My Account<br></a><br>
            </div>
        </div>
    </section>

    <!-- My Account -->
    <div class="account" id="account">
        <div class="max-width">
            <div class="user-account" style="overflow-x:auto;">
                <?php
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
                } ?>
                <table>
                    <div class="text-1" align="center">My Account</div><br>
                    <tr>
                        <td>
                            <div class="text-2" align="left">Name:</div>
                        </td>
                        <td>
                            <div class="text-2" align="left"><?php echo $name ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="text-2" align="left">Email:</div>
                        </td>
                        <td>
                            <div class="text-2" align="left"><?php echo $email ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="text-2" align="left">Account Type:</div>
                        </td>
                        <td>
                            <div class="text-2" align="left"><?php echo $type ?></div>
                        </td>
                    </tr>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Request Book -->
    <div class="bookreq" id="bookreq">
        <div class="max-width">
            <div class="requestbook" style="overflow-x:auto;">
                <div class="text-1" align="center">Request Book</div><br>
                <?php
                $u = new data;
                $u->setconnection();
                $u->getbookissue();
                $recordset = $u->getbookissue();

                $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr>
            <th>Book Name</th><th>Book Author</th><th>Semester</th><th>Branch</th></th><th>Request Book</th></tr>";

                foreach ($recordset as $row) {
                    $table .= "<tr>";
                    "<td>$row[0]</td>";
                    // $table .= "<td><img src='uploads/$row[1]' width='100px' height='100px' style='border:1px solid #333333;'></td>";
                    $table .= "<td>$row[2]</td>";
                    $table .= "<td>$row[4]</td>";
                    $table .= "<td>$row[3]</td>";
                    $table .= "<td>$row[6]</td>";
                    // $table .= "<td>$row[7]</td>";
                    $table .= "<td><a href='requestbook.php?bookid=$row[0]&userid=$userloginid'><button type='button' class='btn btn-primary'>Request Book</button></a></td>";

                    $table .= "</tr>";
                    // $table.=$row[0];
                }
                $table .= "</table>";

                echo $table;


                ?>

            </div>
        </div>
    </div>

    <!-- Book Report -->
    <div class="bookrep" id="bookrep">
        <div class="max-width">
            <div class="bookreport" style="overflow-x:auto;">
                <div class="text-1" align="center">Issued Books</div><br>
                <?php
                $userloginid = $_SESSION["userid"] = $_GET['userlogid'];
                $u = new data;
                $u->setconnection();
                $u->getissuebook($userloginid);
                $recordset = $u->getissuebook($userloginid);

                $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd; padding: 8px;'>Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Return</th></tr>";

                foreach ($recordset as $row) {
                    $table .= "<tr>";
                    "<td>$row[0]</td>";
                    $table .= "<td>$row[2]</td>";
                    $table .= "<td>$row[3]</td>";
                    $table .= "<td>$row[6]</td>";
                    $table .= "<td>$row[7]</td>";
                    $table .= "<td>$row[8]</td>";
                    $table .= "<td><a href='user.php?returnid=$row[0]&userlogid=$userloginid'><button type='button' class='btn btn-primary'>Return</button></a></td>";
                    $table .= "</tr>";
                    // $table.=$row[0];
                }
                $table .= "</table>";

                echo $table;
                ?>
            </div>
        </div>
    </div>

    <!-- Return Book -->
    <div class="returnbook">
        <div id="return" class="return" style="<?php if (!empty($_REQUEST['returnid'])) {
                                                    $returnid = $_REQUEST['returnid'];
                                                } else {
                                                    echo "display:none";
                                                } ?>">

            <?php

            $u = new data;
            $u->setconnection();
            $u->returnbook($returnid);
            $recordset = $u->returnbook($returnid);
            ?>

        </div>
    </div>

    <!-- Ebooks -->
    <div class="ebooks" id="ebooks">
        <div class="max-width">
            <div class="ebooks" style="overflow-x:auto;">
                <table id="tabledata">
                    <tr class="headtable">
                        <th scope="col">Subjects</th>
                        <th scope="col">Semester 3</th>
                        <th scope="col">Semester 4</th>
                    </tr>
                    <tr>
                        <th class="left" scope="row">Engineering Mathematics</th>
                        <td><a href="https://drive.google.com/drive/folders/1-yV4i9MJE2JXhgF2JeL5SdVgxX5KjSTC?usp=sharing" target=”_blank”>View</a></td>
                        <td><a href="https://drive.google.com/file/d/1jOWGufGz2IT0pf4-U8ZQ3o6G01IPanBq/view" target=”_blank”>View</a></td>
                    </tr>
                    <tr>
                        <th class="left" scope="row">DSGT</th>
                        <td><a href="https://drive.google.com/drive/folders/1_r7fBIuRL8qnWzAWZXYqQNV4yVmebLDh?usp=sharing" target=”_blank” >View</a></td>
                        <td>NULL</td>
                    </tr>
                    <tr>
                        <th class="left" scope="row">Data Structures</th>
                        <td><a href="https://drive.google.com/drive/folders/1vWgB0p9HpOrIxI3VXaQ15DZ-px6UKc6U?usp=sharing" target=”_blank”>View</a></td>
                        <td>NULL</td>
                    </tr>
                    <tr>
                        <th class="left" scope="row">Computer Graphics</th>
                        <td><a href="https://drive.google.com/drive/folders/1CQC-leZfaCk6MCtPtec8raTsbjdRyjXw?usp=sharing" target=”_blank”>View</a></td>
                        <td>NULL</td>
                    </tr>
                    <tr>
                        <th class="left" scope="row">DLCOA</th>
                        <td><a href="https://drive.google.com/drive/folders/1PvLG06zjoZD3U_IGxxPWgl3vgl2HUq5-?usp=sharing" target=”_blank”>View</a></td>
                        <td>NULL</td>
                    </tr>
                    <tr>
                        <th class="left" scope="row">Analysis Of Algorithms</th>
                        <td>NULL</td>
                        <td><a href="https://drive.google.com/file/d/1Sv0Q1c7K2q9XOEAUl1lThC8yeSy4o6Oz/view" target=”_blank”>View</a></td>
                    </tr>
                    <tr>
                        <th class="left" scope="row">DBMS</th>
                        <td>NULL</td>
                        <td><a href="https://drive.google.com/file/d/18ZL_da-gycOdIF6frwvjoFNQEQqNVchD/view" target=”_blank”>View</a></td>
                    </tr>
                    <tr>
                        <th class="left" scope="row">Operating System</th>
                        <td>NULL</td>
                        <td><a href="https://drive.google.com/file/d/10KCJwF2e-9PpflaYScDmJfddswRbXnEo/view" target=”_blank”>View</a></td>
                    </tr>
                    <tr>
                        <th class="left" scope="row">MicroProcessors</th>
                        <td>NULL</td>
                        <td><a href="https://drive.google.com/file/d/1JEVyjC66oPAgmtK2nlf7hJTqoFPgPi5w/view" target=”_blank”>View</a></td>
                    </tr>
                    <tr>
                        <th class="left" scope="row">Programming Language</th>
                        <td><a href="https://drive.google.com/drive/folders/1aFpTT7EpWu_1oXjgoDSinhCQT2rIZP7r?usp=sharing" target=”_blank”>JAVA</a></td>
                        <td><a href="#" target=”_blank”>PYTHON</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!-- footer section start -->
    <footer>
        <span>Created By <a href="#">Group-04</a> | Rizvi College Of Engineering | <span class="far fa-copyright"> </span> 2022 All rights
            reserved.</span>
    </footer>

    <script src="./user.js"></script>
</body>

</html>
