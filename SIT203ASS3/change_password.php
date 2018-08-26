<?php
// change password
include 'common.php';
session_start();
// get new password
$password=htmlentities($_POST['new_password']);
$salt = 'honoka';
$password=md5($salt.$password);

$email=$_SESSION['email'];
$db=connect();

if (!$db)  {
    echo "An error occurred connecting to the database";
    exit;
}
// update password in database
$sql    =   "UPDATE user_info SET PASSWORD='{$password}' WHERE EMAIL='{$email}'";
$stmt = oci_parse($db, $sql);
if(!$stmt)  {
    echo "An error occurred in parsing the sql string.\n";
    exit;
}
oci_execute($stmt);

oci_commit($db);
oci_close($db);
// go back to index page
echo '<script>window.location.href="index.php"</script>';
?>