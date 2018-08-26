<?php
// check if email used before registering
session_start();
include 'common.php';
$email=htmlentities($_POST['email']);
$db=connect();

if (!$db)  {
    echo "An error occurred connecting to the database";
    exit;
}
// get new email
$email=htmlentities($_POST['email']);

// check email exists
$sql	=	"SELECT * FROM user_info where email='{$email}'";


$stmt = oci_parse($db, $sql);

if(!$stmt)  {
    echo "An error occurred in parsing the sql string.\n";
    exit;
}
oci_execute($stmt);
$num=0;
while(oci_fetch_array($stmt))
{
    $num++;
}
// email exists
if($num>0)
echo 'fail';
else
echo 'success';

oci_close($db);
?>