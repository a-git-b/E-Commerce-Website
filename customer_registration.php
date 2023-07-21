<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>

<head>
    <title>E Commerce Store </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"
        integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div id="top">
        <!--Top Bar Start-->
        <div class="container">
            <!--container Start-->
            <div class="col-md-6 offer">
                <!--col-md-6 offer-->
                <a href="#" class="btn btn-success btn-sm">
                    <?php
                if(!isset($_SESSION['customer_email'])){
                    echo "Welcome Guest";
                }else{
                    echo "Welcome: ".$_SESSION['customer_email']."";
                }
                ?>
                </a>
                <a href="#">Shopping Cart Total Price:INR <?php totalPrice();?>, Total Items <?php item();?></a>
            </div>
            <!--col-md-6 offer-->
            <div class="col-md-6">
                <ul class="menu">
                    <li>
                        <a href="customer_registration.php"> Register</a>
                    </li>
                    <li>
                        <?php
                    if(!isset($_SESSION['customer_email'])){
                        echo "<a href='checkout.php'>My Account</a>";
                    } else{
                        echo "<a href='customer/my_account.php?my_order'>My Account</a>";
                    }
                    ?>
                    </li>
                    <li>
                        <a href="cart.php"> Go to Cart</a>
                    </li>
                    <li>
                        <?php
                    if(!isset($_SESSION['customer_email'])){
                        echo "<a href='checkout.php'>Login</a>";
                    }else{
                        echo "<a href='logout.php'>Logout</a>";
                    }
                    ?>
                    </li>
                </ul>
            </div>
            <!--container End-->
        </div>
        <!--Top Bar End-->
        <div class="navbar navbar-default" id="navbar">
            <!--navbar default start-->
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand home" href="index.php">
                        <img src="images/4.jpg" alt="online shopping" class="hidden-xs" width="115" height="100">
                    </a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only"> Toggle Navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only"></span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="navigation">
                    <!--navbar collapse system start-->
                    <div class="padding-nav">
                        <!--padding-nav-start-->
                        <ul class="nav navbar-nav navbar-left">
                            <li class="active">
                                <a href="index.php"> Home</a>
                            </li>
                            <li>
                                <a href="shop.php"> Shop</a>
                            </li>
                            <li>
                                <?php
                    if(!isset($_SESSION['customer_email'])){
                        echo "<a href='checkout.php'>My Account</a>";
                    } else{
                        echo "<a href='customer/my_account.php?my_order'>My Account</a>";
                    }
                    ?>
                            </li>
                            <li>
                                <a href="cart.php"> Shopping Cart</a>
                            </li>
                            <li>
                                <a href="contactus.php"> Contact us</a>
                            </li>
                        </ul>
                    </div>
                    <!--padding-nav-end-->
                    <a href="cart.php" class="btn btn-primary navbar-btn right">
                        <i class="fa fa-shopping cart"></i>
                        <span><?php item();?> items in cart</span>
                    </a>
                    <div class="navbar-collapse collapse-right">
                        <button class="btn navbar-btn btn-primary" type="button" data toggle="collapse"
                            data-target="#search">
                            <span class="sr-only"> Toggle Search</span>
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <!--navbar collapse collapse right end-->
                    <div class="collapse clearfix" id="search">
                        <form class="navbar-form" method="get" action="result.php">
                            <div class="input-group">
                                <input type="text" name="user_query" placeholder="Search" class="form-control"
                                    required="">
                                <span class="Input-group-btn">
                                    <button type="submit" value="Search" name="search" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <div class="container">
                <!--container start-->
                <div class="col-md-12">
                    <!--col-md-12 start-->
                    <ul class="breadcrumb">
                        <li><a href="home.php">Home</a></li>
                        <li>
                            Registration
                        </li>
                    </ul>
                </div>
                <!--col-md-12 end-->
                <div class="col-md-3">
                    <!--col-md-3 Start-->
                    <?php
            include("includes/sidebar.php");
            ?>
                </div>
                <!--col-md-3 End-->
                <div class="col-md-9">
                    <!--col-md-9 start-->
                    <div class="box">
                        <!--box start-->
                        <div class="box-header">
                            <!--box-header start-->
                            <center>
                                <h2>Customer Registration</h2>
                            </center>
                        </div>
                        <!--box-header end-->
                        <form action="customer_registration.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" name="c_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Customer Email</label>
                                <input type="email" name="c_email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Customer Password</label>
                                <input type="password" name="c_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" name="c_number" pattern="[6-9]\d{9}" title="Enter valid phone number"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="c_city" class="form-control" value="Bulandshahr" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="c_address" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    <i class="fa fa-user-md"></i>Register
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--box end-->
                </div>
                <!--col-md-9 end-->
            </div>
            <!--container end-->
        </div>
        <!--content end-->
        <!--FOOTER START-->
        <?php
    include("includes/footer.php");
    ?>
        <!--FOOTER END-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>
<?php
if(isset($_POST['submit'])){
    $c_name=$_POST['c_name'];
    $c_email=$_POST['c_email'];
    $c_password=$_POST['c_password'];
    $c_contact=$_POST['c_number'];
    $c_city=$_POST['c_city'];
    $c_address=$_POST['c_address'];
    $c_ip=getUserIP();
    $insert_customer="insert into customers(customer_name,customer_email,customer_pass,customer_contact,customer_city,customer_address,customer_ip)values('$c_name','$c_email','$c_password','$c_contact','$c_city','$c_address','$c_ip')";
    $run_customer=mysqli_query($con,$insert_customer);
    $sel_cart="select * from cart where ip_add='$c_ip'";
    $run_cart=mysqli_query($con,$sel_cart);
    $check_cart=mysqli_num_rows($run_cart);
    if($check_cart>0){
        $_SESSION['customer_email']=$c_email;
        echo "<script>alert('You have been registered successfully')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }else{
        $_SESSION['customer_email']=$c_email;
        echo "<script>alert('You have been registered successfully')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}
?>