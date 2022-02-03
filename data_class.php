<?php include("db.php");

class data extends db {
    // User Login
    function userLogin($t1, $t2) {
        $q="SELECT * FROM userdata where email='$t1' and pass='$t2'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();
        if ($result > 0) {
            foreach($recordSet->fetchAll() as $row) {
                $logid = $row['id'];
                header("location: user.php?userlogid=$logid");
            }
        }
        else {
            header("location: index.php?msg=Invalid Credentials");
        }
    }
    
}
