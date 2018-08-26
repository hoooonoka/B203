<?php
// add clothes to order
session_start();
include 'common.php';
if(isset($_SESSION['email']))
{
    $username=$_SESSION['username'];
    $delivery=$_SESSION['delivery'];
    $db=connect();
	$email=$_SESSION['email'];	                        

	if (!$db)  {
	    echo "An error occurred connecting to the database";
	    exit;
	}
	// acquire all items information in user's basket 
	$sql    =   "SELECT * FROM user_basket WHERE EMAIL='{$email}'";
	$stmt = oci_parse($db, $sql);

	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n";
		exit;
	}
	oci_execute($stmt);
	// store acquired informaton in arrays
	$name=array();
	$price=array();
	$amount=array();
	$path=array();
	$discounts=array();
	$url=array();
	$num=0;;
	while(oci_fetch_array($stmt)) {
	    $name[$num]= oci_result($stmt,"NAME");
	    $price[$num]=oci_result($stmt,"PRICE");
	    $amount[$num]=oci_result($stmt,"AMOUNT");
	    $path[$num]=oci_result($stmt,"PATH");
	    $discounts[$num]=oci_result($stmt,"DISCOUNTS");
	    $url[$num]=oci_result($stmt,"URL");
	    $num++;
	}
	// get a new ID for order
	$sql    =   "SELECT * FROM user_order WHERE EMAIL='{$email}'";
	$stmt = oci_parse($db, $sql);
	$max=0;
	oci_execute($stmt);
	while(oci_fetch_array($stmt)) {
	    $temp=oci_result($stmt, "ID");
	    if($temp>$max)
	        $max=$temp;
	}
	$id=$max+1;
	
	// acquire all information of user
	$sql    =   "SELECT * FROM user_detail WHERE EMAIL='{$email}'";
	$stmt = oci_parse($db, $sql);
	oci_execute($stmt);
	while(oci_fetch_array($stmt)) {
	    $address=oci_result($stmt,"ADDRESS");
        $company=oci_result($stmt,"COMPANY");
        $city=oci_result($stmt,"CITY");
        $postcode=oci_result($stmt,"POSTCODE");
        $state=oci_result($stmt,"STATE");
        $country=oci_result($stmt,"COUNTRY");
        $telephone=oci_result($stmt,"TELEPHONE");
	}

	// delete items in user's basket
	$sql    =   "DELETE FROM user_basket WHERE EMAIL='{$email}'";
	$stmt = oci_parse($db, $sql);
	if(!$stmt)  {
		echo "An error occurred in parsing the sql string.\n";
		exit;
	}
	oci_execute($stmt);
	oci_commit($db);

	// iteratively insert item information in order table
	for($i=0;$i<$num;$i++)
	{
		$sql    =   "INSERT INTO user_order VALUES('{$id}','{$name[$i]}','{$url[$i]}','{$path[$i]}',{$amount[$i]},{$price[$i]},{$discounts[$i]},sysdate,'{$username}','{$address}','{$city}','{$state}','{$postcode}','{$country}','{$email}','{$delivery}')";
	    $stmt = oci_parse($db, $sql);
		if(!$stmt)  {
		    echo "An error occurred in parsing the sql string.\n";
		    exit;
		}
		oci_execute($stmt);
		oci_commit($db);
	}
	oci_close($db);
	echo '<script>window.location.href="customer-orders.php";</script>'; // jump back to customer-orders page
}
                                        
?>