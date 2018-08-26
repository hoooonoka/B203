<?php
session_start();
include 'common.php';
$email=$_SESSION['email'];
$name=$_GET['name'];
$price=$_GET['price'];
$price=substr($price, 3);
$path=$_GET['path'];
$path='img/img/'.$path;
$url='detail.php?name='.$name;
echo $path;
echo $url;
echo $price;
echo $name;
$db=connect();

if (!$db)  {
    echo "An error occurred connecting to the database";
    exit;
}

$sql	=	"SELECT * FROM user_basket where email='{$email}' and name='{$name}'";


$stmt = oci_parse($db, $sql);

if(!$stmt)  {
    echo "An error occurred in parsing the sql string.\n";
    exit;
}
oci_execute($stmt);
$num=-1;
while(oci_fetch_array($stmt)) {

    $num= oci_result($stmt,"AMOUNT");
}
if($num==-1)
{
	$sql	=	"INSERT INTO user_basket values('{$name}','{$price}',1,'{$path}',0,'{$url}','{$email}')";


	$stmt = oci_parse($db, $sql);

	if(!$stmt)  {
	    echo "An error occurred in parsing the sql string.\n";
	    exit;
	}
	oci_execute($stmt);
	echo 'honoka';
	oci_commit($db);
}
else
{
	$num++;
	$sql	=	"UPDATE user_basket SET AMOUNT='{$num}' WHERE NAME='{$name}' AND EMAIL='{$email}'";


	$stmt = oci_parse($db, $sql);

	if(!$stmt)  {
	    echo "An error occurred in parsing the sql string.\n";
	    exit;
	}
	oci_execute($stmt);
	echo 'honoka';
	oci_commit($db);
}


oci_close($db);
?>