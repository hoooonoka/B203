<?php
	// remove item from user's basket
	include 'common.php';
	session_start();
	$email=$_SESSION['email'];
	// get item name
	$name=htmlentities($_POST['name']);
	$db=connect();
	if (!$db)  {
		echo "An error occurred connecting to the database";
		exit;
	}
	// remove item from user's basket
	$sql	=	"DELETE FROM user_basket WHERE EMAIL='{$email}' AND NAME='{$name}'";
	$stmt = oci_parse($db, $sql);

	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n";
		exit;
	}
	oci_execute($stmt);

	oci_commit($db);
		
	// get number of items in basket
	$sql    =   "SELECT * FROM user_basket WHERE EMAIL='{$email}'";


    $stmt = oci_parse($db, $sql);

    if(!$stmt)  {
        echo "An error occurred in parsing the sql string.\n";
        exit;
    }
    oci_execute($stmt);
                                            
    $i=0;
    while(oci_fetch_array($stmt)) {
        $i++;
    }
    echo $i." items in cart";// return number of items
	oci_close($db);

?>