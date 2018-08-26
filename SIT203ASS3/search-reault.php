
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju Your Fashion Shop">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Search in Obaju
    </title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>

    <link rel="shortcut icon" href="favicon.png">

    <style type="text/css">
    	p {margin-bottom: 0px;}
    </style>

</head>
<body>
<?php
include 'information.class.php';
include 'common.php';
$keyword=$_GET['keyword'];
$keyword=strtolower($keyword);
$xml = simplexml_load_file('product_details.xml');
$length=count($xml->item);
// get all clothes information
$info=array();
for($i=0;$i<$length;$i++)
{
  	$new_info=new information;

    $new_info->set_name($xml->item[$i]->name);
    $new_info->set_brand($xml->item[$i]->brand);
    $new_info->set_gender($xml->item[$i]->catagory->gender);
    $new_info->set_type($xml->item[$i]->catagory->type);
    $new_info->set_price($xml->item[$i]->price);
    $new_info->set_picture($xml->item[$i]->picture->small);
    $info[$i]=$new_info;
}

$brand_collection=array('armani','versace','carlo bruni','jack honey');
$type_collecction=array('t-shirts','shirts','pants','accessories');
$gender_collection=array('men','lady');
$key_word=explode(" ",$keyword);
$key_word_length=count($key_word);

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
$searched=array();
$full_name_searched=false;
for($i=0;$i<$length;$i++)
{
	$searched[$i]=false;
	$name_lower=strtolower($info[$i]->get_name());
	if(strstr($name_lower,$keyword))
	{
		$result[]=$info[$i];
		$searched[$i]=true;
		$full_name_searched=true;
		continue;
	}
}

for($i=0;$i<$length;$i++)
{
	if($searched[$i]==true)
		continue;
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


?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" >
    <div class="container-fluid" >
    <div class="col-xs-3 col-sm-4 col-lg-4">
     <div class="navbar-header navbar-right" >

                <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    <img src="img/logo.png" alt="Obaju logo" class="hidden-xs">
                    <img src="img/logo-small.png" alt="Obaju logo" class="visible-xs"><span class="sr-only">Obaju - go to homepage</span>
                </a>
                
            </div>
            </div>
            <div class="col-xs-9 col-sm-8 col-lg-8" >
    
    </div>
    </div>
</nav>

<nav class="navbar navbar-default" role="navigation" >
    <div class="container-fluid" >
    <div class="col-xs-3 col-sm-4 col-lg-4">
     <div class="navbar-header navbar-right" >

                <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    <img src="img/logo.png" alt="Obaju logo" class="hidden-xs">
                    <img src="img/logo-small.png" alt="Obaju logo" class="visible-xs"><span class="sr-only">Obaju - go to homepage</span>
                </a>
                
            </div>
            </div>
            <div class="col-xs-9 col-sm-8 col-lg-8" >
    
    </div>
    </div>
</nav>


        <?php
        	for($i=0;$i<count($result);$i++)
        	{
        		$url='detail.php?name='.$result[$i]->get_name();
        		if($full_name_searched==true)
        		{
        			if($i==0)
        			echo '<div class="panel panel-default" style="width: 40%; margin-left: 30%"><div class="panel-body"><h5 style="text-align:center">matched products: 1</h5></div></div><div class="panel panel-default" style="width: 40%; margin-left: 30%"><div class="panel-body">';
        			else if($i==1)
        			echo '<div class="panel panel-default" style="width: 40%; margin-left: 30%"><div class="panel-body"><h5 style="text-align:center">other relevant products</h5></div></div><div class="panel panel-default" style="width: 40%; margin-left: 30%"><div class="panel-body">';
        			else
        			echo '<div class="panel panel-default" style="width: 40%; margin-left: 30%"><div class="panel-body">';


        		}
        		else
        			echo '<div class="panel panel-default" style="width: 40%; margin-left: 30%"><div class="panel-body">';
    			$path='img/img/'.$result[$i]->get_picture();
    			echo '<div class="row"><div class="col-xs-4 col-sm-4 col-lg-4"><a href="'.$url.'"><img src="'.$path.'" style="width: 100px; height: 100px;"></a></div>';
        		echo '<div class="col-xs-8 col-sm-8 col-lg-8"><h4><a href="'.$url.'">'.$result[$i]->get_name();
        		echo '</a></h4><p>Gender: '.$result[$i]->get_gender().'</p>';
        		echo '<p>Brand: '.$result[$i]->get_brand().'</p>';
        		echo '<p>Type: '.$result[$i]->get_type().'</p>';
        		echo '<p>Price: '.$result[$i]->get_price().'</p>';
        		echo '</div></div></div></div>';
        	}
        ?>


    

	<script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>
    <script type="text/javascript">
    	
    </script>
</body>
</html>