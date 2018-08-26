<?php
session_start();
$real=$_SESSION['captcha'];
$cap=htmlentities($_POST['value']);
if($cap==$real)
echo 'success';
else
echo 'fail';


?>