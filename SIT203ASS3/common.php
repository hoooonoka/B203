<?php
// check if an item in array
function existinarray($item_list,$item)
{
	for($i=0;$i<count($item_list);$i++)
	{
		if($item==$item_list[$i])
			return true;
	}
	return false;
}

// connect to database
function connect()
{
	$dbuser = "wuzho";  /* your deakin login */
	$dbpass = "Uq1Ti4Fa4Ka3";  /* your deakin password */
	$dbname = "SSID";
	$db = oci_connect($dbuser, $dbpass, $dbname);
	return $db;
}

// check if string A contains string B
function containString($str,$target)
{
	$str=strtolower($str);
	$target=strtolower($target);
	if($str=='')
		return false;
  	$tmpArr = explode($str,$target);
  	if(count($tmpArr)>1)
  		return true;
  	else 
  		return false;
}
?>