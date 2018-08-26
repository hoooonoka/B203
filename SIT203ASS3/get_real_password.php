<?php
/**
 * Created by PhpStorm.
 * User: zhouhuiwu
 * Date: 2017/8/29
 * Time: AM12:26
 */
include 'common.php';
session_start();
$db=connect();

if (!$db)  {
    echo "An error occurred connecting to the database";
    exit;
}

$email=htmlentities($_POST['email']);
$password=htmlentities($_POST['password']);
$salt = 'honoka';
$password=md5($salt.$password);



$sql	=	"SELECT * FROM user_info WHERE EMAIL='{$email}'";


$stmt = oci_parse($db, $sql);

if(!$stmt)  {
    echo "An error occurred in parsing the sql string.\n";
    exit;
}
oci_execute($stmt);


while(oci_fetch_array($stmt)) {

    $real_password= oci_result($stmt,"PASSWORD");
    $username=oci_result($stmt,"NAME");
    break;
}
if($password==$real_password)
{
    $_SESSION['username']=$username;
    $_SESSION['email']=$email;
    $_SESSION['password']=$password;
    $_SESSION['signin']=true;
    echo 'success';//true
}
else
    echo 'fail';//false
oci_close($db);
?>