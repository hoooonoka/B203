<?php
// check if email used by others
include 'common.php';
session_start();
$email=htmlentities($_POST['email']);
$last_email=$_SESSION['email'];
// email is used by user himself
if($email==$last_email)
	echo 'honoka';
else
{
	$db=connect();
	if (!$db)  {
	    echo "An error occurred connecting to the database";
	    exit;
	}

	$sql	=	"SELECT * FROM user_info where email='{$email}'";
	$stmt = oci_parse($db, $sql);
	if(!$stmt)  {
	    echo "An error occurred in parsing the sql string.\n";
	    exit;
	}
	oci_execute($stmt);
	$num=count(oci_fetch_array($stmt));
	echo $num;
	oci_close($db);
}

?>