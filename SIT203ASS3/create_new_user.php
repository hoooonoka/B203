<?php
// create a new user
session_start();
include 'common.php';
// get all data posted
$name=htmlentities($_POST['name']);
$password=htmlentities($_POST['password']);
$salt = 'honoka';
$password=md5($salt.$password);
$email=htmlentities($_POST['email']);
$db=connect();

if (!$db)  {
    echo "An error occurred connecting to the database";
    exit;
}
// insert information in database: create a new user
$sql	=	"INSERT INTO user_info values('{$name}','{$email}','{$password}')";


$stmt = oci_parse($db, $sql);

if(!$stmt)  {
    echo "An error occurred in parsing the sql string.\n";
    exit;
}
oci_execute($stmt);
oci_commit($db);
oci_close($db);

echo '<script>window.location.href="index.php"</script>';// jump back to index page if success

?>