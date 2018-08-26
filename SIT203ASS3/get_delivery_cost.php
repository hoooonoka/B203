<?php
// calculate delivery cost
session_start();
include 'common.php';
if(isset($_SESSION['email']))
{

    $db=connect();
    $email=$_SESSION['email'];

    if (!$db)  {
        echo "An error occurred connecting to the database";
        exit;
    }
    // get all items information from user's basket
    $sql    =   "SELECT * FROM user_basket WHERE EMAIL='{$email}'";


    $stmt = oci_parse($db, $sql);

    if(!$stmt)  {
        echo "An error occurred in parsing the sql string.\n";
        exit;
    }
    oci_execute($stmt);
    // stored all items information in arrays
    $name=array();
    $price=array();
    $number=array();
    $path=array();
    $discounts=array();
    $url=array();
    $total=array();
    $i=0;
    while(oci_fetch_array($stmt)) {
                                                
        $name[$i]=oci_result($stmt,"NAME");
        $price[$i]=oci_result($stmt,"PRICE");
        $number[$i]=oci_result($stmt,"AMOUNT");
        $path[$i]=oci_result($stmt,"PATH");
        $discounts[$i]=oci_result($stmt,"DISCOUNTS");
        $url[$i]=oci_result($stmt, "URL");
        $i++;     
    }
    oci_close($db);
    // calculate total cost with gst(10%)
    $all=0;
    for($j=0;$j<$i;$j++)
    {
        $total[$j]=$number[$j]*($price[$j]-$discounts[$j]);
        $all+=$total[$j];
    }
    $temp=$all*1.1;
    // add delivery cost
    $deli=$_POST['delivery'];
    if($deli=='delivery1')
    {
        $_SESSION['delivery']='POST';// AU POST
        if($temp>=500)
            $delivery_cost=0;
        else
            $delivery_cost=10;
    }
    else if($deli=='delivery2')
    {
        $_SESSION['delivery']='EXPRESS';// AU EXPRESS
        if($temp>=500)
            $delivery_cost=0;
        else
            $delivery_cost=15;
    }
    else
    {
        $_SESSION['delivery']='INTERNATIONAL';// INTER EXPRESS
        $delivery_cost=40;
    }
    $final=$temp+$delivery_cost;
    // store delivery cost
    $_SESSION['delivery_cost']=$delivery_cost;
    // return message contains delivery cost and total cost
    echo $delivery_cost.' '.$final;
}
?>