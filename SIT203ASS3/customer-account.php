<?php session_start();
if(!isset($_SESSION['signin']))
    echo '<script>window.location.href="index.php";</script>';
?>
<?php
                                        if(isset($_SESSION['email']))
                                        {
                                            $dbuser = "wuzho";  /* your deakin login */
                                            $dbpass = "Uq1Ti4Fa4Ka3";  /* your deakin password */
                                            $dbname = "SSID";
                                            $db = oci_connect($dbuser, $dbpass, $dbname);
                                            $email=$_SESSION['email'];

                                            if (!$db)  {
                                                echo "An error occurred connecting to the database";
                                                exit;
                                            }
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
                                            oci_close($db);
                                        }
                                        else{
                                            $i='No ';
                                        }
                    ?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju Your Fashion Shop">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Obaju : Your Fashion Shop
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



</head>

<body onload="begin()">
    <!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Offer of the day</a>  <a href="#">Get flat 35% off on orders over $500!</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    <?php
                if(isset($_SESSION['signin']))
                {
                    echo '<li><a href="customer-account.php">'.$_SESSION['username'].'</a>
                    </li>
                    <li><a href="logout.php">Logout</a>
                    </li>';
                }
                else
                {
                    echo '<li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                    </li>
                    <li><a href="register.php">Register</a>
                    </li>';
                }
                ?>
                    <li><a href="contact.php">Contact</a>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="customer-orders.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email-modal" placeholder="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password-modal" placeholder="password">
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="register.php"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                    <img src="img/logo.png" alt="Obaju logo" class="hidden-xs">
                    <img src="img/logo-small.png" alt="Obaju logo" class="visible-xs"><span class="sr-only">Obaju - go to homepage</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                    <a class="btn btn-default navbar-toggle" href="basket.php">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs"><?php echo $i;?> items in cart</span>
                    </a>
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="index.php">Home</a>
                    </li>
														
					<li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Men <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-6"> <!-- col-sm-3 is changed to col-sm-6 by Shang-->
                                            <h5>Clothing</h5>
                                            <ul>
                                                <li><a href="category-man.php?type=T-Shirts">T-shirts</a>
                                                </li>
                                                <li><a href="category-man.php?type=Shirts">Shirts</a>
                                                </li>
                                                <li><a href="category-man.php?type=Pants">Pants</a>
                                                </li>
                                                <!--
                                                <li><a href="category-man.php">Accessories</a>
                                                </li>
                                                -->
                                            </ul>
                                        </div>
                                        <!--<div class="col-sm-3">
                                            <h5>Shoes</h5>
                                            <ul>
                                                <li><a href="category.php">Trainers</a>
                                                </li>
                                                <li><a href="category.php">Sandals</a>
                                                </li>
                                                <li><a href="category.php">Hiking shoes</a>
                                                </li>
                                                <li><a href="category.php">Casual</a>
                                                </li>
                                            </ul>
                                        </div> commented by Shang 03/07/2017-->
                                        <div class="col-sm-6"> <!-- col-sm-3 is changed to col-sm-6 by Shang-->
                                            <h5>Accessories</h5>
                                            <ul>
                                                <li><a href="category-man.php?type=Bags">Bags</a>
                                                </li>
                                                <li><a href="category-man.php?type=Belts">Belts</a>
                                                </li>
                                                <!--
                                                <li><a href="category.php">Hiking shoes</a>
                                                </li>
                                                <li><a href="category.php">Casual</a>
                                                </li>
                                                <li><a href="category.php">Hiking shoes</a>
                                                </li>
                                                <li><a href="category.php">Casual</a>
                                                </li>
                                                -->
                                            </ul>
                                        </div>
                                        <!--<div class="col-sm-3">
                                            <h5>Featured</h5>
                                            <ul>
                                                <li><a href="category.php">Trainers</a>
                                                </li>
                                                <li><a href="category.php">Sandals</a>
                                                </li>
                                                <li><a href="category.php">Hiking shoes</a>
                                                </li>
                                            </ul>
                                            <h5>Looks and trends</h5>
                                            <ul>
                                                <li><a href="category.php">Trainers</a>
                                                </li>
                                                <li><a href="category.php">Sandals</a>
                                                </li>
                                                <li><a href="category.php">Hiking shoes</a>
                                                </li>
                                            </ul>
                                        </div> commented by shang 03/07/2017-->
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Ladies <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-6"> <!-- col-sm-3 is changed to col-sm-6 by Shang-->
                                            <h5>Clothing</h5>
                                            <ul>
                                                <li><a href="category-lady.php?type=T-Shirts">T-shirts</a>
                                                </li>
                                                <li><a href="category-lady.php?type=Shirts">Shirts</a>
                                                </li>
                                                <li><a href="category-lady.php?type=Pants">Pants</a>
                                                </li>
                                                <!--
                                                <li><a href="category-lady.php">Accessories</a>
                                                </li>
                                                -->
                                            </ul>
                                        </div>
                                        <!-- <div class="col-sm-3">
                                            <h5>Shoes</h5>
                                            <ul>
                                                <li><a href="category.php">Trainers</a>
                                                </li>
                                                <li><a href="category.php">Sandals</a>
                                                </li>
                                                <li><a href="category.php">Hiking shoes</a>
                                                </li>
                                                <li><a href="category.php">Casual</a>
                                                </li>
                                            </ul>
                                        </div>  commented by Shang 03/07/2017-->
                                        <div class="col-sm-6"> <!-- col-sm-3 is changed to col-sm-6 by Shang-->
                                            <h5>Accessories</h5>
                                            <ul>
                                                <li><a href="category-lady.php?type=Bags">Bags</a>
                                                </li>
                                                <li><a href="category-lady.php?type=Belts">Belts</a>
                                                </li>
                                                <!--
                                                <li><a href="category.php">Hiking shoes</a>
                                                </li>
                                                <li><a href="category.php">Casual</a>
                                                </li>
                                                <li><a href="category.php">Hiking shoes</a>
                                                </li>
                                                <li><a href="category.php">Casual</a>
                                                </li>
                                                -->
                                            </ul>
                                            <!--<h5>Looks and trends</h5>
                                            <ul>
                                                <li><a href="category.php">Trainers</a>
                                                </li>
                                                <li><a href="category.php">Sandals</a>
                                                </li>
                                                <li><a href="category.php">Hiking shoes</a>
                                                </li>
                                            </ul> commented by Shang 03/07/2017-->
                                        </div>
                                        <!--<div class="col-sm-3">
                                            <div class="banner">
                                                <a href="#">
                                                    <img src="img/banner.jpg" class="img img-responsive" alt="">
                                                </a>
                                            </div>
                                            <div class="banner">
                                                <a href="#">
                                                    <img src="img/banner2.jpg" class="img img-responsive" alt="">
                                                </a>
                                            </div>
                                        </div> commented by Shang 03/07/2017-->
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Site <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h5>Shop</h5>
                                            <ul>
                                                <li><a href="index.php">Homepage</a>
                                                </li>
                                                <li><a href="category-man.php">Category - men</a>
                                                </li>
												<li><a href="category-lady.php">Category - ladies</a>
                                                </li>                                                 
                                                <!--
												<li><a href="category.php">Category - sidebar left</a>
                                                </li>
												<li><a href="category-full.php">Category - full width</a>
                                                </li> 
                                                <li><a href="detail.php">Product detail</a>
                                                </li> 
												-->
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>User</h5>
                                            <ul>
                                                <li><a href="customer-orders.php">Orders history</a>
                                                </li>
                                                <li><a href="customer-account.php">Customer account / change password</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Order process</h5>
                                            <ul>
                                                <li><a href="basket.php">Shopping cart</a>
                                                </li>
												<!--
                                                <li><a href="checkout1.php">Checkout - step 1</a>
                                                </li>
                                                <li><a href="checkout2.php">Checkout - step 2</a>
                                                </li>
                                                <li><a href="checkout3.php">Checkout - step 3</a>
                                                </li>
                                                <li><a href="checkout4.php">Checkout - step 4</a>
                                                </li>
												commented by Shang 03/07/2017-->
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Information</h5>
                                            <ul>                                                
                                                <li><a href="aboutus.php">About us</a>
                                                </li>
												<li><a href="terms.php">Terms and conditions</a>
                                                </li>
												<li><a href="faq.php">FAQ</a>
                                                </li>                                                                                                
                                                <li><a href="contact.php">Contact</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">

                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm"><?php echo $i;?> items in cart</span></a>
                </div>
                <!--/.nav-collapse -->

                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>

            <div class="collapse clearfix" id="search">

                <div class="navbar-form" role="search" style="margin-bottom: 5px; margin-top: 5px;">

                    <div class="input-group">
                        <input type="text" class="form-control" id="search_text" onkeyup="search(this.value)">

                        <span class="input-group-btn">

			            <button class="btn btn-primary" onclick="jump_to_result()"><i class="fa fa-search"></i></button>

		                </span>

                    </div>
                    <div class="dropdown"><div class="dropdown-toggle" data-toggle="dropdown">
                    </div>
                    <ul class="dropdown-menu" id='suggestion_list'>
                            
                    </ul>
                </div>



            </div>
            <!--/.nav-collapse -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>My account</li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Customer section</h3>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="customer-orders.php"><i class="fa fa-list"></i> My orders</a>
                                </li>
								<!--
                                <li>
                                    <a href="customer-wishlist.php"><i class="fa fa-heart"></i> My wishlist</a>
                                </li>
								-->
                                <li class="active">
                                    <a href="customer-account.php"><i class="fa fa-user"></i> My account</a>
                                </li>
                                <li>
                                    <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

                <div class="col-md-9">
                    <div class="box">
                        <h1>My account</h1>
                        <p class="lead">Change your personal details or your password here.</p>
                        <p class="text-muted">* field is compulsory.</p>

                        <h3>Change password</h3>

                        <form action="change_password.php" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_old">Old password *</label>
                                        <input type="password" class="form-control" id="password_old" name="old_password" onchange="check_old_password()">
                                        <p id="old_pass_error" style="color: red"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_1">New password *</label>
                                        <input type="password" class="form-control" id="password_1" name="new_password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_2">Retype new password *</label>
                                        <input type="password" class="form-control" id="password_2" onchange="check_password_same()">
                                        <p id="pass_error" style="color: red"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="col-sm-12 text-center">
                                <button disabled type="submit" class="btn btn-primary" id='change_pass'><i class="fa fa-save"></i> Save new password</button>
                            </div>
                        </form>

                        <hr>

                        <?php
                        if(isset($_SESSION['email']))
                        {
                        	$dbuser = "wuzho";  /* your deakin login */
	                        $dbpass = "Uq1Ti4Fa4Ka3";  /* your deakin password */
	                        $dbname = "SSID";
	                        $db = oci_connect($dbuser, $dbpass, $dbname);
	                        $email=$_SESSION['email'];

	                        if (!$db)  {
	                            echo "An error occurred connecting to the database";
	                            exit;
	                        }
	                        $sql    =   "SELECT * FROM user_detail WHERE EMAIL='{$email}'";


	                        $stmt = oci_parse($db, $sql);

	                        if(!$stmt)  {
	                            echo "An error occurred in parsing the sql string.\n";
	                            exit;
	                        }
	                        oci_execute($stmt);

	                        $have_edited=false;
	                        while(oci_fetch_array($stmt)) {
	                            $have_edited=true;
	                            $firstname= oci_result($stmt,"FIRSTNAME");
	                            $lastname=oci_result($stmt,"LASTNAME");
	                            $address=oci_result($stmt,"ADDRESS");
	                            $company=oci_result($stmt,"COMPANY");
	                            $city=oci_result($stmt,"CITY");
	                            $postcode=oci_result($stmt,"POSTCODE");
	                            $state=oci_result($stmt,"STATE");
	                            $country=oci_result($stmt,"COUNTRY");
	                            $telephone=oci_result($stmt,"TELEPHONE");
	                            break;
	                        }
	                        oci_close($db);
                        }
                        


                        ?>

                        
                        <h3>Personal details</h3>
                        <form method='post' action='change_detail.php'>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname">Firstname *</label>
                                        <?php
                                        if($have_edited==true)
                                            echo '<input type="text" class="form-control" id="firstname" value="'.$firstname.'" name="firstname" onchange="informationValidation(this.id,this.value)">';
                                        else
                                            echo '<input type="text" class="form-control" id="firstname" name="firstname" onchange="informationValidation(this.id,this.value)">';
                                        ?>
                                        <p id='firstname_error' style='color: red'>&nbsp&nbsp&nbsp</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lastname">Lastname *</label>
                                        <?php
                                        if($have_edited==true)
                                            echo '<input type="text" class="form-control" id="lastname" value="'.$lastname.'" name="lastname" onchange="informationValidation(this.id,this.value)">';
                                        else
                                            echo '<input type="text" class="form-control" id="lastname" name="lastname" onchange="informationValidation(this.id,this.value)">';
                                        ?>
                                        <p id='lastname_error' style='color: red'>&nbsp&nbsp&nbsp</p>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="address">Address *</label>
                                        <?php
                                            if($have_edited==true)
                                                echo '<input type="text" class="form-control" id="address" value="'.$address.'" name="address" onchange="informationValidation(this.id,this.value)">';
                                            else
                                                echo '<input type="text" class="form-control" id="address" name="address" onchange="informationValidation(this.id,this.value)">';
                                        ?>
                                        <p id='address_error' style='color: red'>&nbsp&nbsp&nbsp</p>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="company">Company</label>
                                        <?php
                                        if($have_edited==true)
                                            echo '<input type="text" class="form-control" id="company" value="'.$company.'" name="company">';
                                        else
                                            echo '<input type="text" class="form-control" id="company" name="company">';
                                        ?>
                                        <p id='company_error' style='color: red'>&nbsp&nbsp&nbsp</p>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label for="city">City *</label>
                                        <?php
                                        if($have_edited==true)
                                            echo '<input type="text" class="form-control" id="city" value="'.$city.'" name="city" onchange="informationValidation(this.id,this.value)">';
                                        else
                                            echo '<input type="text" class="form-control" id="city" name="city" onchange="informationValidation(this.id,this.value)">';
                                        ?>
                                        <p id='city_error' style='color: red'>&nbsp&nbsp&nbsp</p>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label for="postcode">Postcode *</label>
                                        <?php
                                        if($have_edited==true)
                                            echo '<input type="text" class="form-control" id="postcode" value="'.$postcode.'" name="postcode" onchange="informationValidation(this.id,this.value)">';
                                        else
                                            echo '<input type="text" class="form-control" id="postcode" name="postcode" onchange="informationValidation(this.id,this.value)">';
                                        ?>
                                        <p id='postcode_error' style='color: red'>&nbsp&nbsp&nbsp</p>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label for="state">State *</label>
                                        <?php
                                        echo '<select class="form-control" id="state" name="state" onchange="informationValidation(this.id,this.value)">';
                                        if($state=='Victoria')
                                        echo '<option value="Victoria" selected="selected">Victoria</option>';
                                        else
                                        echo '<option value="Victoria">Victoria</option>';
                                        if($state=='New South Wales')
                                        echo '<option value="New South Wales" selected="selected">New South Wales</option>';
                                        else
                                        echo '<option value="New South Wales">New South Wales</option>';
                                        if($state=='Queensland')
                                        echo '<option value="Queensland" selected="selected">Queensland</option>';
                                        else
                                        echo '<option value="Queensland">Queensland</option>';
                                        if($state=='Tasmania')
                                        echo '<option value="Tasmania" selected="selected">Tasmania</option>';
                                        else
                                        echo '<option value="Tasmania">Tasmania</option>';
                                        if($state=='Western Austarlia')
                                        echo '<option value="Western Austarlia" selected="selected">Western Austarlia</option>';
                                        else
                                        echo '<option value="Western Austarlia">Western Austarlia</option>';
                                        if($state=='South Austarlia')
                                        echo '<option value="South Austarlia" selected="selected">South Austarlia</option>';
                                        else
                                        echo '<option value="South Austarlia">South Austarlia</option>';
                                        if($state=='Northern Territory')
                                        echo '<option value="Northern Territory" selected="selected">Northern Territory</option>';
                                        else
                                        echo '<option value="Northern Territory">Northern Territory</option>';
                                        echo '</select>';
                                        ?>
                                        <p id='state_error' style='color: red'>&nbsp&nbsp&nbsp</p>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label for="country">Country *</label>
                                        <?php
                                        echo '<select class="form-control" id="country" name="country" onchange="informationValidation(this.id,this.value)">';
                                        if($country=='Austarlia')
                                        echo '<option value="Austarlia" selected="selected">Austarlia</option>';
                                        else
                                        echo '<option value="Austarlia">Austarlia</option>';
                                        echo '</select>';
                                        ?>
                                        <p id='country_error' style='color: red'>&nbsp&nbsp&nbsp</p>
                                        
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Telephone *</label>
                                        <?php
                                        if($have_edited==true)
                                            echo '<input type="text" class="form-control" id="phone" value="'.$telephone.'" name="telephone" onchange="informationValidation(this.id,this.value)">';
                                        else
                                            echo '<input type="text" class="form-control" id="phone" name="telephone" onchange="informationValidation(this.id,this.value)">';
                                        ?>
                                        <p id='phone_error' style='color: red'>&nbsp&nbsp&nbsp</p>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <?php
                                        echo '<input type="text" class="form-control" id="email" value="'.$_SESSION['email'].'" name="email" onchange="informationValidation(this.id,this.value)">';
                                        
                                        ?>
                                        <p id='email_error' style='color: red'>&nbsp&nbsp&nbsp</p>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary" disabled id="save_button"><i class="fa fa-save"></i> Save changes</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


        <!-- *** FOOTER ***
 _________________________________________________________ -->
        <div id="footer" data-animate="fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4>Information</h4>

                        <ul>
                            <li><a href="aboutus.php">About us</a>
                            </li>
                            <li><a href="terms.php">Terms and conditions</a>
                            </li>
                            <li><a href="faq.php">FAQ</a>
                            </li>
                            <li><a href="contact.php">Contact us</a>
                            </li>
                        </ul>

                        <hr>

                        <h4>User section</h4>

                        <ul>
                            <li><a href="logout.php">Logout</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg hidden-sm">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Top categories</h4>

                        <h5>Men</h5>

                        <ul>
                            <li><a href="category-man.php?type=T-Shirts">T-shirts</a>
                            </li>
                            <li><a href="category-man.php?type=Shirts">Shirts</a>
                            </li>
                            <li><a href="category-man.php?type=Pants">Pants</a>
                            </li>
                            <li><a href="category-man.php?type=Accessories">Accessories</a>
                            </li>
                        </ul>

                        <h5>Ladies</h5>
                        <ul>
                            <li><a href="category-lady.php?type=T-Shirts">T-shirts</a>
                            </li>
                            <li><a href="category-lady.php?type=Shirts">Skirts</a>
                            </li>
                            <li><a href="category-lady.php?type=Pants">Pants</a>
                            </li>
                            <li><a href="category-lady.php?type=Accessories">Accessories</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6">

                        <h4>Where to find us</h4>

                        <p><strong>Obaju Ltd.</strong>
                            <br>500 Main Street
                            <br>Geelong
                            <br>Victoria 3200
                            <br>
                            <strong>Australia</strong>
                        </p>

                        <a href="contact.php">Go to contact page</a>

                        <hr class="hidden-md hidden-lg">

                    </div>
                    <!-- /.col-md-3 -->



                    <div class="col-md-3 col-sm-6">

                        
                        <h4>Stay in touch</h4>

                        <p class="social">
                            <a href="#" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter external" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="gplus external" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
                        </p>


                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    <p class="pull-left">© 2017 Obaju Ltd.</p>

                </div>
                <div class="col-md-6">
                    <p class="pull-right">Template by <a href="https://bootstrapious.com/e-commerce-templates">Bootstrapious.com</a>
                        <!-- Not removing these links is part of the license conditions of the template. Thanks for understanding :) If you want to use the template without the attribution links, you can do so after supporting further themes development at https://bootstrapious.com/donate  -->
                    </p>
                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->



    </div>
    <!-- /#all -->


    

    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
 <script type="text/javascript">
        function check_password_same()
        {
            var password1=document.getElementById('password_1').value;
            var password2=document.getElementById('password_2').value;
            if(password1==password2)
            {
                if(document.getElementById('password_old').value!=''&&document.getElementById('old_pass_error').innerHTML=='')
                {
                    document.getElementById('pass_error').innerHTML='';
                    document.getElementById('change_pass').disabled=false;
                }
                
            }
            else
            {
                document.getElementById('pass_error').innerHTML='2 new passwords are different, please type again';
                document.getElementById('change_pass').disabled=true;
            }
        }
        function check_old_password()
        {
            var old_password=document.getElementById('password_old').value;
            var xmlhttp;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    if(xmlhttp.responseText=='success')//success
                    {
                        document.getElementById('old_pass_error').innerHTML='';
                        if(document.getElementById('password_1').value!=''&&document.getElementById('password_1').value==document.getElementById('password_2').value)
                        document.getElementById('change_pass').disabled=false;
                    }
                    else
                        document.getElementById('old_pass_error').innerHTML='wrong password, please type it again';
                }
            }
            xmlhttp.open( 'POST', 'return_real_pass.php', true );
            xmlhttp.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
            xmlhttp.send('oldpassword='+old_password);
            
        }
    </script>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>
    <script>
        function validation()
        {
            if(document.getElementById('firstname_error').innerHTML!='&nbsp;&nbsp;&nbsp;'||document.getElementById('firstname').value=='')
            {
                return false;
            }
            if(document.getElementById('lastname_error').innerHTML!='&nbsp;&nbsp;&nbsp;'||document.getElementById('lastname').value=='')
            {
                return false;
            }
            if(document.getElementById('email_error').innerHTML!='&nbsp;&nbsp;&nbsp;'||document.getElementById('email').value=='')
            {
                return false;
            }
            if(document.getElementById('address_error').innerHTML!='&nbsp;&nbsp;&nbsp;'||document.getElementById('address').value=='')
            {
                return false;
            }
            if(document.getElementById('state_error').innerHTML!='&nbsp;&nbsp;&nbsp;'||document.getElementById('state').value=='')
            {
                return false;
            }
            if(document.getElementById('city_error').innerHTML!='&nbsp;&nbsp;&nbsp;'||document.getElementById('city').value=='')
            {
                return false;
            }
            if(document.getElementById('postcode_error').innerHTML!='&nbsp;&nbsp;&nbsp;'||document.getElementById('postcode').value=='')
            {
                return false;
            }
            if(document.getElementById('phone_error').innerHTML!='&nbsp;&nbsp;&nbsp;'||document.getElementById('phone').value=='')
            {
                return false;
            }
            if(document.getElementById('country_error').innerHTML!='&nbsp;&nbsp;&nbsp;'||document.getElementById('country').value=='')
            {
                return false;
            }
            return true;
        }

        function begin()
        {
            if(validation()==true)
            document.getElementById('save_button').disabled=false;
            else
            document.getElementById('save_button').disabled=true;
        }

        function informationValidation(type,value)
        {
            var xmlhttp;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    if(xmlhttp.responseText=='success')//success
                    {
                        document.getElementById(type+'_error').innerHTML='&nbsp&nbsp&nbsp';
                        if(validation()==true)
                        document.getElementById('save_button').disabled=false;
                        else
                        document.getElementById('save_button').disabled=true;
                        
                    }
                    else
                    {
                        document.getElementById(type+'_error').innerHTML=xmlhttp.responseText;
                        document.getElementById('save_button').disabled=true;
                        
                    }
                    // else
                        // document.getElementById('old_pass_error').innerHTML='wrong password, please type it again';                    }
                }
                
            }
            xmlhttp.open( 'POST', 'information_validation.php', true );
            xmlhttp.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
            xmlhttp.send('value='+value+'&type='+type);  
        }

        function jump_to_result()
        {
            var search=document.getElementById('search_text').value;
            var url='search-reault.php?keyword='+search;
            window.location.href=url;
        }



        function search(value)
        {
            var xmlhttp;
            var autowidth=document.getElementById('search_text').offsetWidth;
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        if(xmlhttp.responseText!='')//success
                        {
                            document.getElementById('suggestion_list').innerHTML=xmlhttp.responseText;
                            $(".dropdown-toggle").dropdown('toggle');
                            document.getElementById('search_text').focus();
                            // document.getElementById('suggestion_list').style.display='block';

                        }
                        // else
                        // {
                        //     if(xmlhttp.responseText=='')
                        //     {
                        //         document.getElementById('suggestion_list').innerHTML='<li style="padding-left: 5px; padding-right:5px; width:'+autowidth+'px">no result</li>';
                        //         show_suggestion();
                        //         document.getElementById('search_text').focus();
                        //         // document.getElementById('suggestion_list').style.display='block';


                        //     }
                        //     else if(xmlhttp.responseText=='null')
                        //     {
                        //         document.getElementById('suggestion_list').innerHTML='';
                        //         // document.getElementById('suggestion_list').style.display='none';
                        //         document.getElementById('search_text').focus();
                        //     }
                        // }
                    }
                }
                xmlhttp.open( 'POST', 'get_suggestion.php', true );
                xmlhttp.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
                xmlhttp.send('suggestion='+value+'&width='+autowidth);
        }

		
    </script>
    

</body>

</html>
