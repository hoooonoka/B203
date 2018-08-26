<?php
// check if password is correct
include 'common.php';
session_start();
$email=$_SESSION['email'];
$salt = 'honoka';

// get password
$password=htmlentities($_POST['oldpassword']);
$password=md5($salt.$password);
$db=connect();

if (!$db)  {
    echo "An error occurred connecting to the database";
    exit;
}
// check if password is correct
$sql    =   "SELECT * FROM user_info WHERE EMAIL='{$email}' and PASSWORD='{$password}'";
$stmt = oci_parse($db, $sql);
if(!$stmt)  {
    echo "An error occurred in parsing the sql string.\n";
    exit;
}
oci_execute($stmt);
while(oci_fetch_array($stmt)) {

    echo 'success';
    break;
}
?>