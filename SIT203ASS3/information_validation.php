<?php
session_start();
// validation
$info='';
$error=false;
$type=htmlentities($_POST['type']);
$value=htmlentities($_POST['value']);
if($type=='email')
{
		if (!preg_match("/^([A-Za-z]|\d)+[@]([A-Za-z]|\d)+([.]([A-Za-z]+))+$/", $value))
		{
			$info='email wrong structure';
			$error=true;
		}
		else
		{
			$dbuser = "wuzho";  /* your deakin login */
			$dbpass = "Uq1Ti4Fa4Ka3";  /* your deakin password */
			$dbname = "SSID";
			$db = oci_connect($dbuser, $dbpass, $dbname);

			if (!$db)  {
			    echo "An error occurred connecting to the database";
			    exit;
			}

			$sql	=	"SELECT * FROM user_info where EMAIL='{$value}'";


			$stmt = oci_parse($db, $sql);

			if(!$stmt)  {
			    echo "An error occurred in parsing the sql string.\n";
			    exit;
			}
			oci_execute($stmt);

			while(oci_fetch_array($stmt))
			{
				if($_SESSION['email']==oci_result($stmt,"EMAIL"))
					break;
				$info='email used by others';
				$error=true;
			}

			

			oci_close($db);
		}
}
else if($type=='firstname')
{
		if (!preg_match("/^[A-Z]+[a-z]+$/", $value))
		{
			$info='firstname wrong spelling: e.g. Jack';
			$error=true;
		}
}
else if($type=='lastname')
{
		if (!preg_match("/^[A-Z]+[a-z]+$/", $value))
		{
			$info='lastname wrong spelling: e.g. Lee';
			$error=true;
		}
}
else if($type=='address')
{
		if (!preg_match("/^\d+ ([A-Za-z]|[ ])+$/", $value))
		{
			$info='address wrong structure: e.g. 25 Meldan St';
			$error=true;
		}
}
else if($type=='state')
{
		if (!preg_match("/^(([A-Za-z]+)| )+$/", $value))
		{
			$info='state wrong structure: e.g. Victoria';
			$error=true;
		}
}
else if($type=='country')
{
		if (!preg_match("/^(([A-Za-z]+)| )+$/", $value))
		{
			$info='country wrong structure: e.g. Australia';
			$error=true;
		}	
}
else if($type=='city')
{
		if (!preg_match("/^(([A-Za-z]+)| )+$/", $value))
		{
			$info='city wrong structure: e.g. Melbourne';
			$error=true;
		}
}
else if($type=='postcode')
{
	  if (!preg_match("/^\d{4}$/", $value))
		{
			$info='4 digits required: e.g. 3125';
			$error=true;
		}
}
else if($type=='phone')
{
		if (!preg_match("/^([+]{0,1}\d{1,2} ){0,1}\d{9,10}$/", $value))
		{
			$info='9 or 10 digits required: e.g. 451170810';
			$error=true;
		}	
}



if($error==true)
{
	echo $info;
}
else
{
	echo 'success';
}



?>