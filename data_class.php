<?php include("db.php");

class data extends db
{
    // User Login
    function userLogin($t1, $t2)
    {
        $q = "SELECT * FROM userdata where email='$t1' and pass='$t2'";
        $recordSet = $this->connection->query($q);
        $result = $recordSet->rowCount();
        if ($result > 0) {
            foreach ($recordSet->fetchAll() as $row) {
                $logid = $row['id'];
                header("location: user.php?userlogid");
            }
        } else {
            header("location: index.php?msg=Invalid Credentials");
        }
    }

    // Admin Login
    function adminLogin($t1, $t2)
    {

        $q = "SELECT * FROM admin where email='$t1' and pass='$t2'";
        $recordSet = $this->connection->query($q);
        $result = $recordSet->rowCount();
        if ($result > 0) {
            foreach ($recordSet->fetchAll() as $row) {
                $logid = $row['id'];
                header("location: admin.php?logid=$logid");
            }
        } else {
            header("location: index.php?msg=Invalid Credentials");
        }
    }

    // User Detail
    function userdetail($id)
    {
        $q = "SELECT * FROM userdata where id ='$id'";
        $data = $this->connection->query($q);
        return $data;
    }

    // Book Request
    function getissuebook($userloginid)
    {

        $newfine = "";
        $issuereturn = "";

        $q = "SELECT * FROM issuebook where userid='$userloginid'";
        $recordSetss = $this->connection->query($q);


        foreach ($recordSetss->fetchAll() as $row) {
            $issuereturn = $row['issuereturn'];
            $fine = $row['fine'];
            $newfine = $fine;
        }


        $getdate = date("d/m/Y");
        if ($issuereturn < $getdate) {
            $q = "UPDATE issuebook SET fine='$newfine' where userid='$userloginid'";

            if ($this->connection->exec($q)) {
                $q = "SELECT * FROM issuebook where userid='$userloginid' ";
                $data = $this->connection->query($q);
                return $data;
            } else {
                $q = "SELECT * FROM issuebook where userid='$userloginid' ";
                $data = $this->connection->query($q);
                return $data;
            }
        } else {
            $q = "SELECT * FROM issuebook where userid='$userloginid'";
            $data = $this->connection->query($q);
            return $data;
        }
    }

    function getbook()
    {
        $q = "SELECT * FROM book ";
        $data = $this->connection->query($q);
        return $data;
    }
    function getbookissue()
    {
        $q = "SELECT * FROM book where bookava !=0 ";
        $data = $this->connection->query($q);
        return $data;
    }

    function userdata()
    {
        $q = "SELECT * FROM userdata ";
        $data = $this->connection->query($q);
        return $data;
    }

    function getbookdetail($id)
    {
        $q = "SELECT * FROM book where id ='$id'";
        $data = $this->connection->query($q);
        return $data;
    }

    function requestbook($userid, $bookid)
    {

        $q = "SELECT * FROM book where id='$bookid'";
        $recordSetss = $this->connection->query($q);

        $q = "SELECT * FROM userdata where id='$userid'";
        $recordSet = $this->connection->query($q);

        foreach ($recordSet->fetchAll() as $row) {
            $username = $row['name'];
            $usertype = $row['type'];
        }

        foreach ($recordSetss->fetchAll() as $row) {
            $bookname = $row['bookname'];
        }

        if ($usertype == "student") {
            $days = 7;
        }
        if ($usertype == "teacher") {
            $days = 21;
        }


        $q = "INSERT INTO requestbook (id,userid,bookid,username,usertype,bookname,issuedays)VALUES('','$userid', '$bookid', '$username', '$usertype', '$bookname', '$days')";

        if ($this->connection->exec($q)) {
            header("Location:user.php?userlogid=$userid");
        } else {
            header("Location:user.php?msg=fail");
        }
    }

    function requestbookdata()
    {
        $q = "SELECT * FROM requestbook ";
        $data = $this->connection->query($q);
        return $data;
    }

    // Admin
    function admindetail($id)
    {
        $q = "SELECT * FROM admin where id ='$id'";
        $data = $this->connection->query($q);
        return $data;
    }

    // Add Book
    function addbook($bookpic, $bookname, $bookdetail, $bookaudor, $bookpub, $branch, $bookprice, $bookquantity)
    {
        $this->$bookpic = $bookpic;
        $this->bookname = $bookname;
        $this->bookdetail = $bookdetail;
        $this->bookaudor = $bookaudor;
        $this->bookpub = $bookpub;
        $this->branch = $branch;
        $this->bookprice = $bookprice;
        $this->bookquantity = $bookquantity;

        $q = "INSERT INTO book (id,bookpic,bookname, bookdetail, bookaudor, bookpub, branch, bookprice,bookquantity,bookava,bookrent)VALUES('','$bookpic', '$bookname', '$bookdetail', '$bookaudor', '$bookpub', '$branch', '$bookprice', '$bookquantity','$bookquantity',0)";

        if ($this->connection->exec($q)) {
            header("Location:admin.php?msg=done");
        } else {
            header("Location:admin.php?msg=fail");
        }
    }

    // Approve Issue Book
    function issuebookapprove($book, $userselect, $days, $getdate, $returnDate, $redid)
    {
        $this->$book = $book;
        $this->$userselect = $userselect;
        $this->$days = $days;
        $this->$getdate = $getdate;
        $this->$returnDate = $returnDate;


        $q = "SELECT * FROM book where bookname='$book'";
        $recordSetss = $this->connection->query($q);

        $q = "SELECT * FROM userdata where name='$userselect'";
        $recordSet = $this->connection->query($q);
        $result = $recordSet->rowCount();

        if ($result > 0) {

            foreach ($recordSet->fetchAll() as $row) {
                $issueid = $row['id'];
                $issuetype = $row['type'];
            }
            foreach ($recordSetss->fetchAll() as $row) {
                $bookid = $row['id'];
                $bookname = $row['bookname'];

                $newbookava = $row['bookava'] - 1;
                $newbookrent = $row['bookrent'] + 1;
            }


            $q = "UPDATE book SET bookava='$newbookava', bookrent='$newbookrent' where id='$bookid'";
            if ($this->connection->exec($q)) {

                $q = "INSERT INTO issuebook (userid,issuename,issuebook,issuetype,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$book','$issuetype','$days','$getdate','$returnDate','0')";

                if ($this->connection->exec($q)) {

                    $q = "DELETE from requestbook where id='$redid'";
                    $this->connection->exec($q);
                    header("Location:admin.php?msg=done");
                } else {
                    header("Location:admin.php?msg=fail");
                }
            } else {
                header("Location:admin.php?msg=fail");
            }
        } else {
            header("location: index.php?msg=Invalid Credentials");
        }
    }
    // Issue Book
    function issuebook($book, $userselect, $days, $getdate, $returnDate)
    {
        $this->$book = $book;
        $this->$userselect = $userselect;
        $this->$days = $days;
        $this->$getdate = $getdate;
        $this->$returnDate = $returnDate;


        $q = "SELECT * FROM book where bookname='$book'";
        $recordSetss = $this->connection->query($q);

        $q = "SELECT * FROM userdata where name='$userselect'";
        $recordSet = $this->connection->query($q);
        $result = $recordSet->rowCount();

        if ($result > 0) {

            foreach ($recordSet->fetchAll() as $row) {
                $issueid = $row['id'];
                $issuetype = $row['type'];
            }
            foreach ($recordSetss->fetchAll() as $row) {
                $bookid = $row['id'];
                $bookname = $row['bookname'];

                $newbookava = $row['bookava'] - 1;
                $newbookrent = $row['bookrent'] + 1;
            }


            $q = "UPDATE book SET bookava='$newbookava', bookrent='$newbookrent' where id='$bookid'";
            if ($this->connection->exec($q)) {

                $q = "INSERT INTO issuebook (userid,issuename,issuebook,issuetype,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$book','$issuetype','$days','$getdate','$returnDate','0')";

                if ($this->connection->exec($q)) {
                    header("Location:admin.php?msg=done");
                } else {
                    header("Location:admin.php?msg=fail");
                }
            } else {
                header("Location:admin.php?msg=fail");
            }
        } else {
            header("location: index.php?msg=Invalid Credentials");
        }
    }
    // Issue Report
    function issuereport()
    {
        $q = "SELECT * FROM issuebook ";
        $data = $this->connection->query($q);
        return $data;
    }

    // Return Book
    function returnbook($id)
    {
        $fine = "";
        $bookava = "";
        $issuebook = "";
        $bookrentel = "";

        $q = "SELECT * FROM issuebook where id='$id'";
        $recordSet = $this->connection->query($q);

        foreach ($recordSet->fetchAll() as $row) {
            $userid = $row['userid'];
            $issuebook = $row['issuebook'];
            $fine = $row['fine'];
        }
        if ($fine == 0) {

            $q = "SELECT * FROM book where bookname='$issuebook'";
            $recordSet = $this->connection->query($q);

            foreach ($recordSet->fetchAll() as $row) {
                $bookava = $row['bookava'] + 1;
                $bookrentel = $row['bookrent'] - 1;
            }
            $q = "UPDATE book SET bookava='$bookava', bookrent='$bookrentel' where bookname='$issuebook'";
            $this->connection->exec($q);

            $q = "DELETE from issuebook where id=$id and issuebook='$issuebook' and fine='0' ";
            if ($this->connection->exec($q)) {

                header("Location:user.php?userlogid=$userid");
            }
        }
    }

    // Add New User
    function addnewuser($name, $pasword, $email, $type)
    {
        $this->name = $name;
        $this->pasword = $pasword;
        $this->email = $email;
        $this->type = $type;


        $q = "INSERT INTO userdata(id, name, email, pass,type)VALUES('','$name','$email','$pasword','$type')";

        if ($this->connection->exec($q)) {
            header("Location:admin.php?msg=New Add done");
        } else {
            header("Location:admin.php?msg=Register Fail");
        }
    }

    // Delete User
    function delteuserdata($id)
    {
        $q = "DELETE from userdata where id='$id'";
        if ($this->connection->exec($q)) {


            header("Location:admin.php?msg=done");
        } else {
            header("Location:admin.php?msg=fail");
        }
    }

    function deletebook($id)
    {
        $q = "DELETE from book where id='$id'";
        if ($this->connection->exec($q)) {


            header("Location:admin.php?msg=done");
        } else {
            header("Location:admin.php?msg=fail");
        }
    }
}
