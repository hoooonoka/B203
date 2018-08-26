<?php
/**
 * Created by PhpStorm.
 * User: zhouhuiwu
 * Date: 2017/8/30
 * Time: PM2:23
 */
include 'information.class.php';
include 'common.php';
session_start();
$suggestion=htmlentities($_POST['suggestion']);
$width=htmlentities($_POST['width']);
$suggestion=strtolower($suggestion);
$xml = simplexml_load_file('product_details.xml');
$length=count($xml->item);
// get all clothes information
// store in array
$info=array();
for($i=0;$i<$length;$i++)
{
  	$new_info=new information;
    $new_info->set_name($xml->item[$i]->name);
    $new_info->set_brand($xml->item[$i]->brand);
    $new_info->set_gender($xml->item[$i]->catagory->gender);
    $new_info->set_type($xml->item[$i]->catagory->type);
    $info[$i]=$new_info;
}
// collection of keywords: later compare with searched keyword
$brand_collection=array('armani','versace','carlo bruni','jack honey');
$type_collecction=array('t-shirts','shirts','pants','accessories');
$gender_collection=array('men','lady');
$key_word=explode(" ",$suggestion);
$key_word_length=count($key_word);
// get brand, gender and type information from searched keyword
$brand=null;
$gender=null;
$type=null;
for($i=0;$i<$key_word_length;$i++)
{
	if($key_word[$i]=='man')
		$key_word[$i]='men';
	if($key_word[$i]=='ladies'||$key_word[$i]=='woman'||$key_word[$i]=='women')
		$key_word[$i]='lady';
	if(existinarray($brand_collection,$key_word[$i]))
	{
		$brand=$key_word[$i];
		continue;
	}
	if(existinarray($type_collecction,$key_word[$i]))
	{
		$type=$key_word[$i];
		continue;
	}
	if(existinarray($gender_collection,$key_word[$i]))
	{
		$gender=$key_word[$i];
		continue;
	}
}
// generate result list
$result=array();
for($i=0;$i<$length;$i++)
{
	if($gender!=null)
	{
		if(strtolower($info[$i]->get_gender())!=$gender)
			continue;
	}
	if($type!=null)
	{
		if(strtolower($info[$i]->get_type())!=$type)
			continue;
	}
	if($brand!=null)
	{
		if(strtolower($info[$i]->get_brand())!=$brand)
			continue;

	}
	$result[]=$info[$i];

}
// generate the HTML code
$str='';
if($gender==null&&$type==null&&$brand==null)
{
	for($i=0;$i<$length;$i++)
	{
		
		if(containString($suggestion,$info[$i]->get_name())!=false)
			$str=$str.'<li style="padding-left: 5px; padding-right: 5px; width: '.$width.'">'.$info[$i]->get_name().'</li>';
	}
}
else
{
	for($i=0;$i<count($result);$i++)
	$str=$str.'<li style="width:'.$width.'px; padding-left: 5px; padding-right: 5px;">'.$result[$i]->get_name().'</li>';
}


echo $str;// return HTML code and displayed in the webpage

  
?>