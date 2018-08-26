<?php
    include 'common.php';
    session_start();
    $db=connect();
    $email=$_SESSION['email'];
    // get new user information
    $firstname=htmlentities($_POST['firstname']);
    $lastname=htmlentities($_POST['lastname']);
    $address=htmlentities($_POST['address']);
    $company=htmlentities($_POST['company']);
    $city=htmlentities($_POST['city']);
    $postcode=htmlentities($_POST['postcode']);
    $state=htmlentities($_POST['state']);
    $country=htmlentities($_POST['country']);
    $telephone=htmlentities($_POST['telephone']);
    $new_email=htmlentities($_POST['email']);
    if (!$db)  {
        echo "An error occurred connecting to the database";
        exit;
    }
    // delete user information for table user_detail
    $sql="DELETE FROM user_detail WHERE EMAIL='{$email}'";
    $stmt = oci_parse($db, $sql);

    if(!$stmt)  {
       echo "An error occurred in parsing the sql string.\n";
        exit;
    }
    oci_execute($stmt);
    oci_commit($db);
    // insert user information into user_detail table: replace the deleted one
    $sql    =   "INSERT INTO user_detail values('{$firstname}','{$lastname}','{$address}','{$company}','{$city}','{$postcode}','{$state}','{$country}','{$telephone}','{$new_email}') ";

    $stmt = oci_parse($db, $sql);

    if(!$stmt)  {
       echo "An error occurred in parsing the sql string.\n";
        exit;
    }
    oci_execute($stmt);

    oci_commit($db);
    //  update user email in table user_info
    $sql="UPDATE user_info SET EMAIL='{$new_email}' WHERE EMAIL='{$email}'";
    $stmt = oci_parse($db, $sql);

    if(!$stmt)  {
       echo "An error occurred in parsing the sql string.\n";
        exit;
    }
    oci_execute($stmt);

    oci_commit($db);

    // update user email in table user_basket
    $sql="UPDATE user_basket SET EMAIL='{$new_email}' WHERE EMAIL='{$email}'";
    $stmt = oci_parse($db, $sql);

    if(!$stmt)  {
       echo "An error occurred in parsing the sql string.\n";
        exit;
    }
    oci_execute($stmt);

    oci_commit($db);

    // update user email in table user_order
    $sql="UPDATE user_order SET EMAIL='{$new_email}' WHERE EMAIL='{$email}'";
    $stmt = oci_parse($db, $sql);

    if(!$stmt)  {
       echo "An error occurred in parsing the sql string.\n";
        exit;
    }
    oci_execute($stmt);

    oci_commit($db);
    oci_close($db);
    $_SESSION['email']=$new_email;
    echo '<script>window.location.href="index.php"</script>'; // go back to index page
?>