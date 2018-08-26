<?php
session_start();
// validation
$info='';
$error=false;
$type=htmlentities($_POST['type']);
$value=htmlentities($_POST['value']);
if($type=='name')	// name validation
{
		if (!preg_match("/^([A-Z]|[a-z]|[ ])+$/", $value))
		{
			$info='wrong name spelling: e.g. Lee';
			$error=true;
		}
}
else if($type=='number')	// number validation
{
		if (!preg_match("/^\d{16,16}$/", $value))
		{
			$info='16 digits required';
			$error=true;
		}
}
else if($type=='cvv')	// cvv validation
{
		if (!preg_match("/^\d{3,3}$/", $value))
		{
			$info='3 digits required';
			$error=true;
		}
}
else if($type=='month')	// expire month validation
{
		if (!preg_match("/^\d{1,2}$/", $value))
		{
			$info='1 or 2 digits number required';
			$error=true;
		}
		else
		{
			if ((int)$value>12)
			{
				$info='must equal or smaller than 12';
				$error=true;
			}
		}
}
else if($type=='year')	// expire year validation
{
		if (!preg_match("/^\d{4,4}$/", $value))
		{
			$info='4 digits number required: e.g. 2017';
			$error=true;
		}
		else
		{
			if ((int)$value<2017)
			{
				$info='must be not expired before 2017';
				$error=true;
			}
		}
}

if($error==true)
{
	echo $info;	// return error message
}
else
{
	echo 'success';	// return result
}



?>