<?php
	// change item amount in basket
	session_start();
	include 'common.php';
	$email=$_SESSION['email'];
	// get item name and number
	$name=htmlentities($_POST['name']);
	$number=htmlentities($_POST['number']);
	$db=connect();

	if (!$db)  {
	    echo "An error occurred connecting to the database";
	    exit;
	}
	// update item number in database
	$sql	=	"UPDATE user_basket SET AMOUNT='{$number}' WHERE EMAIL='{$email}' AND NAME='{$name}'";

	$stmt = oci_parse($db, $sql);

	if(!$stmt)  {
	    echo "An error occurred in parsing the sql string.\n";
	    exit;
	}
	oci_execute($stmt);
	oci_commit($db);
	echo $sql;
	oci_close($db);
?>