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

<body>
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
                        <li>Checkout - Payment method</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="checkout4.php">
                            <h1>Checkout - Payment method</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="checkout1.php"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <li><a href="checkout2.php"><i class="fa fa-truck"></i><br>Delivery Method</a>
                                </li>
                                <li class="active"><a href="#"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                                <li class="disabled"><a href="checkout4.php"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>
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


                                            $all=0;
                                            for($j=0;$j<$i;$j++)
                                            {
                                                $total[$j]=$number[$j]*($price[$j]-$discounts[$j]);
                                            $all+=$total[$j];
                                            }

                                        $temp=$all*1.1;
                                        $deli=$_POST['delivery'];
                                        if($deli=='delivery1')
                                        {
                                            $_SESSION['delivery']='POST';
                                            if($temp>=500)
                                                $delivery_cost=0;
                                            else
                                                $delivery_cost=10;
                                        }
                                        else if($deli=='delivery2')
                                        {
                                            $_SESSION['delivery']='EXPRESS';
                                            if($temp>=500)
                                                $delivery_cost=0;
                                            else
                                                $delivery_cost=15;
                                        }
                                        else
                                        {
                                            $_SESSION['delivery']='INTERNATIONAL';
                                            $delivery_cost=40;
                                        }
                                    }
                                        ?>
                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="box payment-method" onclick='cash()'>

                                            <h4>Cash on delivery</h4>

                                            <p>You pay when you get it.</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="payment" value="payment1" onclick='cash()' id='by_cash'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="box payment-method" onclick='card()'>

                                            <h4>Payment gateway</h4>

                                            <p>VISA and Mastercard only.</p>
                                            								
																																	
											<!--the following is added by Shang -->									                        
											
											
											<ul class="list-unstyled list-inline">
												<li class="list-inline-item"><img src="img/visa.svg" alt="visa" width="50"></li>
												<li class="list-inline-item"><img src="img/mastercard.svg" alt="mastercard" width="50"></li>
											</ul>
											<div class="row">
											  <div class="col-sm-10 form-group">
												<input type="text" name="cardname" placeholder="Name On Card"  class="form-control" id="name" onchange="cardValidation(this.id,this.value)">
                                                <p id='name_error' style="color: red"></p>
											  </div>
											  <div class="col-sm-10 form-group">
												<input type="text" name="cardnumber" placeholder="Card Number" maxlength="16"  class="form-control" id="number" onchange="cardValidation(this.id,this.value)">
                                                <p id='number_error' style="color: red"></p>
											  </div>
											  <div class="col-sm-4 form-group">
												<input type="text" name="expirymonth" placeholder="Expiry Month"  class="form-control" id="month" onchange="cardValidation(this.id,this.value)">
                                                <p id='month_error' style="color: red"></p>
											  </div>
											  <div class="col-sm-4 form-group">
												<input type="text" name="expiryyear" placeholder="Expiry Year"  class="form-control" id="year" onchange="cardValidation(this.id,this.value)">
                                                <p id='year_error' style="color: red"></p>
											  </div>
											  <div class="col-sm-4 form-group">
												<input type="text" name="cvv" placeholder="CVV" maxlength="3"  class="form-control" id="cvv" onchange="cardValidation(this.id,this.value)">
                                                <p id='cvv_error' style="color: red"></p>
											  </div>
											  
											</div>
											<!-- by shang payment end -->
											
											<div class="box-footer text-center">

                                                <input type="radio" name="payment" value="payment2" onclick='card()'>
                                            </div>
											
                                        </div>
                                    </div>

                                    <!-- commented by Shang 
									<div class="col-sm-6">
                                        <div class="box payment-method">

                                            <h4>Cash on delivery</h4>

                                            <p>You pay when you get it.</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="payment" value="payment3">
                                            </div>
                                        </div>
                                    </div>
									 end by shang -->
									
                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.content -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="basket.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Shipping method</a>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary" id='continue' disabled>Continue to Order review<i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">

                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Order summary</h3>
                        </div>
                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Order subtotal</td>
                                        <th>$<?php echo $all;?></th>
                                    </tr>
                                    <tr>
                                        <td>Shipping and handling</td>
                                        <th>$<?php echo $delivery_cost;?></th>
                                    </tr>
                                    <tr>
                                        <td>GST 10%</td>
                                        <th>$<?php $gst=$all/10;echo $gst;?></th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th>$<?php $final=$gst+$all+$delivery_cost; echo $final;?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <!-- /.col-md-3 -->

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
            if(document.getElementById('name_error').innerHTML!=''||document.getElementById('name').value=='')
            {
                return false;
            }
            if(document.getElementById('number_error').innerHTML!=''||document.getElementById('number').value=='')
            {
                return false;
            }
            if(document.getElementById('month_error').innerHTML!=''||document.getElementById('month').value=='')
            {
                return false;
            }
            if(document.getElementById('year_error').innerHTML!=''||document.getElementById('year').value=='')
            {
                return false;
            }
            if(document.getElementById('cvv_error').innerHTML!=''||document.getElementById('cvv').value=='')
            {
                return false;
            }
            
            return true;
        }
    
        function cardValidation(type,value)
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
                        document.getElementById(type+'_error').innerHTML='';
                        if(validation()==true)
                        document.getElementById('continue').disabled=false;
                        else
                        document.getElementById('continue').disabled=true;
                        
                    }
                    else
                    {
                        document.getElementById(type+'_error').innerHTML=xmlhttp.responseText;
                        document.getElementById('continue').disabled=true;
                        
                    }
                    // else
                        // document.getElementById('old_pass_error').innerHTML='wrong password, please type it again';                    }
                }
                
            }
            xmlhttp.open( 'POST', 'card_validation.php', true );
            xmlhttp.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
            xmlhttp.send('value='+value+'&type='+type);  
        }
        
        function card()
        {
            
                if(validation())
                    document.getElementById('continue').disabled=false;
                else
                    document.getElementById('continue').disabled=true;
                
        }
        
        function cash()
        {
            document.getElementById('continue').disabled=false;
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