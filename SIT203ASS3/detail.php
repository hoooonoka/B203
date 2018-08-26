<?php session_start();?>
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

<body onload="start()">
<!-- *** TOPBAR ***
_________________________________________________________ -->
<div id="top">
    <div class="container">
        <div class="col-md-6 offer" data-animate="fadeInDown">
            <a class="btn btn-success btn-sm" data-animate-hover="shake">Offer of the day</a>  <a>Get flat 35% off on orders over $500!</a>
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

                            <div class="form-group">
                                <input type="text" class="form-control" id="email-modal" placeholder="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password-modal" placeholder="password">
                                <p id="error_info" style="color:orangered; display: none;">email or password wrong !</p>
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary" onclick="check_password()"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>



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
                    <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs" id="cart_info_1"><?php echo $i;?> items in cart</span>
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
                                        <ul><!--update url, commented by wu, 17/7/2017-->
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
                                        <ul><!--update url, commented by wu, 17/7/2017-->
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
                                        <ul><!--update url, commented by wu, 17/7/2017-->
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
                                        <ul><!--update url, commented by wu, 17/7/2017-->
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
                                            <?php
                                            if(isset($_SESSION['signin']))
                                            {
                                                echo '<li><a href="logout.php">Logout</a>
                                                </li>
                                                <li><a href="customer-orders.php">Orders history</a>
                                                </li>
                                                <li><a href="customer-account.php">Customer account / change password</a>
                                                </li>';
                                            }
                                            else
                                            {
                                                echo '<li><a href="register.php">Register / login</a>
                                                </li>';
                                            }
                                            ?>
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
                <a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm" id="cart_info_2"><?php echo $i;?> items in cart</span></a>
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
                    <li id="link_gender"><a href="category-lady.php">Ladies</a>
                    </li>
                    <!--
                    <li><a href="#">Tops</a>
                    </li>
                    -->
                    <li id="product_name">White Blouse Armani</li>
                </ul>

            </div>

            <div class="col-md-3">
                <!-- *** MENUS AND FILTERS ***
_________________________________________________________ -->
                <div class="panel panel-default sidebar-menu">

                    <div class="panel-heading">
                        <h3 class="panel-title">Categories</h3>
                    </div>

                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked category-menu">
                            <li id="man">
                                <a href="category-man.php">Men <span class="badge pull-right" id="num_man">13</span></a>
                                <ul><!--update url, commented by wu, 17/7/2017-->
                                    <li><a href="category-man.php?type=T-Shirts">T-shirts</a>
                                    </li>
                                    <li><a href="category-man.php?type=Shirts">Shirts</a>
                                    </li>
                                    <li><a href="category-man.php?type=Pants">Pants</a>
                                    </li>
                                    <li><a href="category-man.php?type=Accessories">Accessories</a>
                                    </li>
                                </ul>
                            </li>
                            <li id="lady">
                                <a href="category-lady.php">Ladies  <span class="badge pull-right" id="num_lady">15</span></a>
                                <ul><!--update url, commented by wu, 17/7/2017-->
                                    <li><a href="category-lady.php?type=T-Shirts">T-shirts</a>
                                    </li>
                                    <li><a href="category-lady.php?type=Shirts">Shirts</a>
                                    </li>
                                    <li><a href="category-lady.php?type=Pants">Pants</a>
                                    </li>
                                    <li><a href="category-lady.php?type=Accessories">Accessories</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- commented by Shang 04/07/2017
                            <li>
                                <a href="category.php">Kids  <span class="badge pull-right">11</span></a>
                                <ul>
                                    <li><a href="category.php">T-shirts</a>
                                    </li>
                                    <li><a href="category.php">Skirts</a>
                                    </li>
                                    <li><a href="category.php">Pants</a>
                                    </li>
                                    <li><a href="category.php">Accessories</a>
                                    </li>
                                </ul>
                            </li>
                            -->

                        </ul>

                    </div>
                </div>

                <div class="panel panel-default sidebar-menu">

                    <div class="panel-heading">
                        <h3 class="panel-title">Brands <a class="btn btn-xs btn-danger pull-right"><i class="fa fa-times-circle"></i> Clear</a></h3>
                    </div>

                    <div class="panel-body">

                        <form>
                            <div class="form-group"><!--add id for label and checkbox, commented by wu, 17/7/2017-->
                                <div class="checkbox">
                                    <label id="Armani_label">
                                        <input type="checkbox" id="armani" checked disabled>Armani (10)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label id="Versace_label">
                                        <input type="checkbox" id="versace" checked disabled>Versace (10)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label id="CarloBruni_label">
                                        <input type="checkbox" id="carlo_bruni" checked disabled>Carlo Bruni (2)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label id="JackHoney_label">
                                        <input type="checkbox" id="jack_honey" checked disabled>Jack Honey (2)
                                    </label>
                                </div>
                            </div>

                            <button class="btn btn-default btn-sm btn-primary" disabled><i class="fa fa-pencil"></i> Apply</button>

                        </form>

                    </div>
                </div>

                <!-- commented by Shang 04/07/2017
                <div class="panel panel-default sidebar-menu">

                    <div class="panel-heading">
                        <h3 class="panel-title">Colours <a class="btn btn-xs btn-danger pull-right" href="#"><i class="fa fa-times-circle"></i> Clear</a></h3>
                    </div>

                    <div class="panel-body">

                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> <span class="colour white"></span> White (14)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> <span class="colour blue"></span> Blue (10)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> <span class="colour green"></span> Green (20)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> <span class="colour yellow"></span> Yellow (13)
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> <span class="colour red"></span> Red (10)
                                    </label>
                                </div>
                            </div>

                            <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</button>

                        </form>

                    </div>
                </div>
                -->

                <!-- *** MENUS AND FILTERS END *** -->

                <div class="banner">
                    <a href="#">
                        <img src="img/banner.jpg" alt="sales 2014" class="img-responsive">
                    </a>
                </div>
            </div>

            <div class="col-md-9">

                <div class="row" id="productMain">
                    <div class="col-sm-6">
                        <div id="mainImage">
                            <img src="#" alt="" class="img-responsive" id="image" style="width:100%">
                        </div>

                        <div class="ribbon sale">
                            <div class="theribbon">SALE</div>
                            <div class="ribbon-background"></div>
                        </div>
                        <!-- /.ribbon -->

                        <div class="ribbon new">
                            <div class="theribbon">NEW</div>
                            <div class="ribbon-background"></div>
                        </div>
                        <!-- /.ribbon -->

                    </div>
                    <div class="col-sm-6">
                        <div class="box">
                            <h1 class="text-center" id="name"></h1><!--add an id, commented by wu, 17/7/2017-->
                            <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details, material & care and sizing</a>
                            </p>
                            <p class="price" id="price"></p><!--add an id, commented by wu, 17/7/2017-->
                            <?php
                            if(!isset($_SESSION['signin']))
                                echo '<div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                &times;
            </button>
            Please sign in to use shopping cart function.
        </div>';
                            ?>
                            <p class="text-center buttons">
                            <?php
                            if(isset($_SESSION['signin']))
                                echo '<a onclick="add_to_basket()" class="btn btn-primary" id="cart_link"><i class="fa fa-shopping-cart"></i> Add to cart</a>';
                            
                            ?>
                                
                                <!--
                                <a href="basket.php" class="btn btn-default"><i class="fa fa-heart"></i> Add to wishlist</a>
                                -->
                            </p>

                            
                        </div>

                        <!-- commented by Shang 04/07/2017
                        <div class="row" id="thumbs">
                            <div class="col-xs-4">
                                <a href="img/detailbig1.jpg" class="thumb">
                                    <img src="img/detailsquare.jpg" alt="" class="img-responsive">
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="img/detailbig2.jpg" class="thumb">
                                    <img src="img/detailsquare2.jpg" alt="" class="img-responsive">
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="img/detailbig3.jpg" class="thumb">
                                    <img src="img/detailsquare3.jpg" alt="" class="img-responsive">
                                </a>
                            </div>
                        </div>
                        -->
                    </div>

                </div>


                <div class="box" id="details">
                    <p>
                    <h4>Product details</h4>
                    <p id="detail"></p><!--add an id, commented by wu, 17/7/2017-->
                    <h4>Material & care</h4>
                    <ul>
                        <li id="material"></li><!--add an id, commented by wu, 17/7/2017-->
                        <li id="care"></li><!--add an id, commented by wu, 17/7/2017-->
                    </ul>
                    <h4>Size & Fit</h4>
                    <ul>
                        <li id="fit"></li><!--add an id, commented by wu, 17/7/2017-->
                        <li id="size"></li><!--add an id, commented by wu, 17/7/2017-->
                    </ul>

                    <blockquote>
                        <p><em id="info"></em>
                        </p><!--add an id, commented by wu, 17/7/2017-->
                    </blockquote>

                    <hr>
                    <div class="social">
                        <h4>Show it to your friends</h4>
                        <p>
                            <a class="facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                            <a class="gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                            <a class="twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                            <a class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                        </p>
                    </div>
                </div>



            </div>
            <!-- /.col-md-9 -->
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
                        <?php
                        if(isset($_SESSION['signin']))
                            echo '<li><a href="logout.php">Logout</a>
                            </li>';
                        else
                            echo '<li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                            </li>
                            <li><a href="register.php">Regiter</a>
                            </li>';
                        ?>
                    </ul>

                    <hr class="hidden-md hidden-lg hidden-sm">

                </div>
                <!-- /.col-md-3 -->

                <div class="col-md-3 col-sm-6">

                    <h4>Top categories</h4>

                    <h5>Men</h5>

                    <ul><!--update url, commented by wu, 17/7/2017-->
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
                    <ul><!--update url, commented by wu, 17/7/2017-->
                        <li><a href="category-lady.php?type=T-Shirts">T-shirts</a>
                        </li>
                        <li><a href="category-lady.php?type=Shirts">Shirts</a>
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
                        <a class="facebook" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                        <a class="twitter" data-animate-hover="shake"><i class="fa fa-twitter"></i></a>
                        <a class="instagram" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                        <a class="gplus" data-animate-hover="shake"><i class="fa fa-google-plus"></i></a>
                        <a class="email" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
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
<script src="js/ass1.js"></script>
<script type="text/javascript">
    function start()
    {
        var xmlDoc=getxml();
        var location=window.location.href;
        location=decodeURI(location);
        var str=location.split('=');
        var name=str[str.length-1];
        var x=xmlDoc.getElementsByTagName("item");
        var gender;
        var price;
        var brand;
        var type;
        var large;
        var detail;
        var material;
        var care;
        var size;
        var fit;
        var info;
        for(var i=0;i<x.length;i++)
        {
            if(xmlDoc.getElementsByTagName("name")[i].childNodes[0].nodeValue==name)
            {
                gender=xmlDoc.getElementsByTagName("gender")[i].childNodes[0].nodeValue;
                price=xmlDoc.getElementsByTagName("price")[i].childNodes[0].nodeValue;
                brand=xmlDoc.getElementsByTagName("brand")[i].childNodes[0].nodeValue;
                type=xmlDoc.getElementsByTagName("type")[i].childNodes[0].nodeValue;
                large=xmlDoc.getElementsByTagName("large")[i].childNodes[0].nodeValue;
                detail=xmlDoc.getElementsByTagName("detail")[i].childNodes[0].nodeValue;
                material=xmlDoc.getElementsByTagName("material")[i].childNodes[0].nodeValue;
                care=xmlDoc.getElementsByTagName("care")[i].childNodes[0].nodeValue;
                size=xmlDoc.getElementsByTagName("size")[i].childNodes[0].nodeValue;
                fit=xmlDoc.getElementsByTagName("fit")[i].childNodes[0].nodeValue;
                info=xmlDoc.getElementsByTagName("info")[i].childNodes[0].nodeValue;
                break;
            }
        }

        if(gender=='Men')
            document.getElementById('man').className='active';
        else
            document.getElementById('lady').className='active';

        var men=0;
        var ladies=0;
        var armani=0;
        var versace=0;
        var jackhoney=0;
        var carlobruni=0;
        for(var i=0;i<x.length;i++)
        {
            if(xmlDoc.getElementsByTagName("gender")[i].childNodes[0].nodeValue=='Men')
                men++;
            else
                ladies++;
            if(xmlDoc.getElementsByTagName('gender')[i].childNodes[0].nodeValue==gender)
            {
                if(xmlDoc.getElementsByTagName("brand")[i].childNodes[0].nodeValue=='Armani')
                    armani++;
                else if(xmlDoc.getElementsByTagName("brand")[i].childNodes[0].nodeValue=='Versace')
                    versace++;
                else if(xmlDoc.getElementsByTagName("brand")[i].childNodes[0].nodeValue=='Jack Honey')
                    jackhoney++;
                else if(xmlDoc.getElementsByTagName("brand")[i].childNodes[0].nodeValue=='Carlo Bruni')
                    carlobruni++;
            }
        }
        if(gender=='Men')
        {
            document.getElementById('link_gender').innerHTML="<a href='category-man.php'>Men</a>";

        }
        else
        {
            document.getElementById('link_gender').innerHTML="<a href='category-lady.php'>Ladies</a>";
        }
        document.getElementById('product_name').innerHTML=name;
        document.getElementById('num_man').innerHTML=men;
        document.getElementById('num_lady').innerHTML=ladies;

        document.getElementById('Armani_label').innerHTML="<input type='checkbox' name='brands' id='Armani' checked disabled>Armani ("+armani+")";
        document.getElementById('Versace_label').innerHTML="<input type='checkbox' name='brands' id='Versace' checked disabled>Versace ("+versace+")";
        document.getElementById('CarloBruni_label').innerHTML="<input type='checkbox' name='brands' id='CarloBruni' checked disabled>Carlo Bruni ("+carlobruni+")";
        document.getElementById('JackHoney_label').innerHTML="<input type='checkbox' name='brands' id='JackHoney' checked disabled>Jack Honey ("+jackhoney+")";

        document.getElementById('name').innerHTML=name;
        document.getElementById('price').innerHTML=price;
        document.getElementById('detail').innerHTML=detail;
        document.getElementById('material').innerHTML=material;
        document.getElementById('care').innerHTML=care;
        document.getElementById('size').innerHTML=size;
        document.getElementById('fit').innerHTML=fit;
        document.getElementById('info').innerHTML=info;
        var image_path='img/img/'+large;
        document.getElementById('image').src=image_path;

    }

    function add_to_basket()
    {
        var price=document.getElementById('price').innerHTML;
        price=price.substr(3);
        price=parseInt(price);
        var name=document.getElementById('name').innerHTML;
        var path=document.getElementById('image').src;
        var url='detail.php?name='+name;

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
                    if(xmlhttp.responseText!='')//success
                    {

                        document.getElementById('cart_info_1').innerHTML=xmlhttp.responseText;
                        document.getElementById('cart_info_2').innerHTML=xmlhttp.responseText;   
                        // document.getElementById('old_pass_error').innerHTML='';
                    }
                    // else
                        // document.getElementById('old_pass_error').innerHTML='wrong password, please type it again';
                }
            }
            xmlhttp.open( 'POST', 'add_to_basket.php', true );
            xmlhttp.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
            xmlhttp.send('name='+name+'&path='+path+'&url='+url+'&price='+price);
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
        function check_password()
        {
            var email=document.getElementById('email-modal').value;
            var password=document.getElementById('password-modal').value;
            var xmlhttp;
            if (email=="")
            {
                return;
            }
            if(password=='')
            {
                return;
            }
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
                        window.location.href='index.php';
                    }
                    else
                    {
                        document.getElementById('error_info').style.display='block';
                    }
                }
            }
            xmlhttp.open( 'POST', 'get_real_password.php', true );
            xmlhttp.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
            xmlhttp.send('email='+email+'&password='+password);
        }
</script>




</body>

</html>