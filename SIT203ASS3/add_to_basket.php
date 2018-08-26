<?php
// add item in basket
// work in 2 types:
//      for added item: increase amount
//      for not added item: add item
session_start();
include 'common.php';
$email=$_SESSION['email'];
$name=htmlentities($_POST['name']);
$price=htmlentities($_POST['price']);
$path=htmlentities($_POST['path']);
$url=htmlentities($_POST['url']);
$db=connect();

if (!$db)  {
    echo "An error occurred connecting to the database";
    exit;
}
// get information of all items in basket
$sql	=	"SELECT * FROM user_basket where email='{$email}' and name='{$name}'";


$stmt = oci_parse($db, $sql);

if(!$stmt)  {
    echo "An error occurred in parsing the sql string.\n";
    exit;
}
oci_execute($stmt);
// get current amount of item
$num=-1;
while(oci_fetch_array($stmt)) {

    $num= oci_result($stmt,"AMOUNT");
}
if($num==-1)
{
    // not added
    // add item in basket
	$sql	=	"INSERT INTO user_basket values('{$price}',1,'{$path}',0,'{$url}','{$email}','{$name}')";


	$stmt = oci_parse($db, $sql);

	if(!$stmt)  {
	    echo "An error occurred in parsing the sql string.\n";
	    exit;
	}
	oci_execute($stmt);
	oci_commit($db);

    // get number of items in cart
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
    echo $i.' items in cart';

}
else
{
    // added already
	$num++;
	$sql	=	"UPDATE user_basket SET AMOUNT='{$num}' WHERE NAME='{$name}' AND EMAIL='{$email}'";


	$stmt = oci_parse($db, $sql);

	if(!$stmt)  {
	    echo "An error occurred in parsing the sql string.\n";
	    exit;
	}
	oci_execute($stmt);
	oci_commit($db);

    // get number of items in cart
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
    echo $i.' items in cart';
}
oci_close($db);
?>