<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./user.css">
    <link rel="stylesheet" href="./admin.css">
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
                <li><a href="#addbook" class="menu-btn">Add Book</a></li>
                <li><a href="#bookreq" class="menu-btn">Book-Requests</a></li>
                <li><a href="#addstudent" class="menu-btn">Add Students</a></li>
                <li><a href="#studentreport" class="menu-btn">Student Report</a></li>
                <li><a href="#bookissue" class="menu-btn">Issue Book</a></li>
                <li><a href="#issuereport" class="menu-btn">Issue Report</a></li>
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
                <div class="text-2">Admin</div>
                <a href="#studentreport">Users<br></a><br>
            </div>
        </div>
    </section>

    <!-- Add Books -->
    <div class="addbook" id="addbook">
        <div class="max-width">
            <div class="add-book" style="<?php if (!empty($_REQUEST['viewid'])) {echo "display:none";} else {echo "";} ?>">
                <div class="text-1" align="center">ADD NEW BOOK</div>
                <form action="add_book.php" method="post" enctype="multipart/form-data">
                    <label style="color:teal;font-weight:500">Book Name:</label>&nbsp;<input type="text" name="bookname" />
                    </br>
                    <label >Detail:</label><input class="text-2" type="text" name="bookdetail" /></br>
                    <label>Autor:</label><input class="text-2" type="text" name="bookaudor" /></br>
                    <label>Publication</label><input class="text-2" type="text" name="bookpub" /></br>
                    <div class="branch">Branch:<select name="type">
                            <option value="student">Computer</option>
                            <option value="teacher">EXTC</option>
                            <option value="teacher">ECS</option>
                            <option value="teacher">Civil</option>
                            <option value="teacher">Mechanical</option>
                            <option value="teacher">AI&DS</option>
                        </select>
                    </div>
                    <label>Price:</label><input type="number" name="bookprice" /></br>
                    <label>Quantity:</label><input type="number" name="bookquantity" /></br>
                    <label>Book Photo</label><input type="file" name="bookphoto" /><br>
                    <button value="SUBMIT"> SUBMIT</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Book Request Approve-->
    <div class="bookreq" id="bookreq">
        <div class="max-width">
            <div class="book-req" style="overflow-x:auto;">
                <div class="text-1" align="center">Book Request</div><br>
                <?php
                $u = new data;
                $u->setconnection();
                $u->requestbookdata();
                $recordset = $u->requestbookdata();

                $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;padding: 8px;'>Person Name</th><th>person type</th><th>Book name</th><th>Days </th><th>Approve</th></tr>";
                foreach ($recordset as $row) {
                    $table .= "<tr>";
                    "<td>$row[0]</td>";
                    "<td>$row[1]</td>";
                    "<td>$row[2]</td>";

                    $table .= "<td>$row[3]</td>";
                    $table .= "<td>$row[4]</td>";
                    $table .= "<td>$row[5]</td>";
                    $table .= "<td>$row[6]</td>";
                    $table .= "<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approve</button></a></td>";
                    $table .= "</tr>";
                }
                $table .= "</table>";

                echo $table;
                ?>
            </div>
        </div>
    </div>

    <!-- Add Student -->
    <div class="addstudent" id="addstudent">
        <div class="max-width">
            <div class="add-student" style="overflow-x:auto;">
                <div class="text-1" align="center">ADD STUDENT</div><br>
                <form action="add_student.php" method="post" enctype="multipart/form-data">
                    <label>Name:</label><input type="text" name="addname" />
                    </br>
                    <label>Pasword:</label><input type="pasword" name="addpass" />
                    </br>
                    <label>Email:</label><input type="email" name="addemail" /></br>
                    <label for="type">Choose type:</label>
                    <select name="type">
                        <option value="student">student</option>
                        <option value="teacher">teacher</option>
                    </select><br>
                    <input type="submit" value="SUBMIT" />
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Student Report -->
    <div class="studentreport" id="studentreport">
        <div class="max-width">
            <div class="student-report" style="overflow-x:auto;">
            <div class="text-1" align="center">Student Report</div><br>
                <?php
                $u = new data;
                $u->setconnection();
                $u->userdata();
                $recordset = $u->userdata();

                $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'> Name</th><th>Email</th><th>Type</th></tr>";
                foreach ($recordset as $row) {
                    $table .= "<tr>";
                    "<td>$row[0]</td>";
                    $table .= "<td>$row[1]</td>";
                    $table .= "<td>$row[2]</td>";
                    $table .= "<td>$row[4]</td>";
                    $table .= "</tr>";
                }
                $table .= "</table>";

                echo $table;
                ?>
            </div>
        </div>
    </div>

    <!-- Issue Book -->
    <div class="bookissue" id="bookissue">
        <div class="max-width">
            <div class="issue-book" style="overflow-x:auto;">
            <div class="text-1" align="center">Issue Book</div><br>
                <form action="issuebook.php" method="post" enctype="multipart/form-data">
                    <label for="book">Choose Book:</label>
                    <select name="book">
                        <?php
                        $u = new data;
                        $u->setconnection();
                        $u->getbookissue();
                        $recordset = $u->getbookissue();
                        foreach ($recordset as $row) {

                            echo "<option value='" . $row[2] . "'>" . $row[2] . "</option>";
                        }
                        ?>
                    </select>

                    <label for="Select Student">:</label>
                    <select name="userselect">
                        <?php
                        $u = new data;
                        $u->setconnection();
                        $u->userdata();
                        $recordset = $u->userdata();
                        foreach ($recordset as $row) {
                            $id = $row[0];
                            echo "<option value='" . $row[1] . "'>" . $row[1] . "</option>";
                        }
                        ?>
                    </select>
                    <br>
                    Days<input type="number" name="days" />

                    <input type="submit" value="SUBMIT" />
                </form>
            </div>
        </div>
    </div>

    <!-- Issue Book Report -->
    <div class="isuuereport" id="issuereport">
        <div class="max-width">
            <div class="issue-rep" style="overflow-x:auto;">
                <div class="text-1" align="center">Isuued Books</div><br>
                <?php
                $u = new data;
                $u->setconnection();
                $u->issuereport();
                $recordset = $u->issuereport();

                $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

                foreach ($recordset as $row) {
                    $table .= "<tr>";
                    "<td>$row[0]</td>";
                    $table .= "<td>$row[2]</td>";
                    $table .= "<td>$row[3]</td>";
                    $table .= "<td>$row[6]</td>";
                    $table .= "<td>$row[7]</td>";
                    $table .= "<td>$row[8]</td>";
                    $table .= "<td>$row[4]</td>";
                    $table .= "</tr>";
                }
                $table .= "</table>";

                echo $table;
                ?>
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
