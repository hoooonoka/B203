<?php
    // change information of basket
    include 'common.php';
    if(isset($_SESSION['email']))
    {
        $db=connect();
        $email=$_SESSION['email'];

        if (!$db)  {
            echo "An error occurred connecting to the database";
            exit;
        }
        $sql    =   "SELECT * FROM user_basket WHERE EMAIL='{$email}'";

        $stmt = oci_parse($db, $sql);
        if(!$stmt)  {
            echo "An error occurred in parsing the sql string.\n";
            exit;
        }
        oci_execute($stmt);
        // get the number of items in basket                       
        $i=0;
        while(oci_fetch_array($stmt)) {
            $i++;
        }
        oci_close($db);
    }
    else
    {
        $i='No ';
    }
    echo $i.'items in cart';// return information of basket
?>