<?php
$db=mysqli_connect("localhost","root","","e-comm");
/*  for getting user ip start*/
function getUserIP(){
    switch(true){
        case (!empty($_SERVER['HTTP_X_REAL_IP'])):
            return $_SERVER['HTTP_X_REAL_IP'];
        case(!empty($_SERVER['HTTP_CLIENT_IP'])):
            return $_SERVER['HTTP_CLIENT_IP'];
        case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        default :
        return $_SERVER['REMOTE_ADDR'];            
    }
}
function addCart()
{
    global $db;
    if(isset($_GET['add_cart'])){
        $ip_add=getUserIP();
        $p_id=$_GET['add_cart'];
        $product_qty=$_POST['product_qty'];
        $product_size=$_POST['product_size'];
        $check_product="select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        $run_check=mysqli_query($db,$check_product);
        if(mysqli_num_rows($run_check)>0){
            
            echo "<script>window.open('cart.php?pro_id=$p_id','_self')</script>";
        }
        else{
            $query="insert into cart(p_id,ip_add,qty,size) values('$p_id','$ip_add','$product_qty','$product_size')";
            $run_query=mysqli_query($db,$query);
            echo "<script>window.open('cart.php?pro_id=$p_id','_self')</script>";
        }
    }
}
/*item count start*/
function item(){
  global $db;
  $ip_add=getUserIP();
  $get_items="select * from cart where ip_add='$ip_add'";
  $run_item=mysqli_query($db,$get_items);
  $count=mysqli_num_rows($run_item);
  echo $count;
}
/*item count end*/
function totalPrice(){
    global $db;
    $ip_add=getUserIP();
    $total=0;
    $select_cart="select * from cart where ip_add='$ip_add'";
    $run_cart=mysqli_query($db,$select_cart);
    while($record=mysqli_fetch_array($run_cart)){
        $pro_id=$record['p_id'];
        $pro_qty=$record['qty'];
        $get_price="select * from products where product_id='$pro_id'";
        $run_price=mysqli_query($db,$get_price);
        while($row=mysqli_fetch_array($run_price)){
            $sub_total=$row['product_price']*$pro_qty;
            $total+=$sub_total;
        }
    }
    echo $total;
}
function getPro(){
    global $db;
    $get_product="select * from products order by 1 DESC LIMIT 0,21";
    $run_products=mysqli_query($db,$get_product);
    while($row_product=mysqli_fetch_array($run_products)){
        $pro_id=$row_product['product_id'];
        $pro_title=$row_product['product_title'];
        $pro_price=$row_product['product_price'];
        $pro_img1=$row_product['product_img1'];
        echo "<div class= 'col-md-3 col-sm-6'>
        <div class='product'>
        <a href='details.php?pro_id=$pro_id'>
        <img src='admin_area/product_images/$pro_img1' width='258' height='400'>
        </a>
        <div class='text'>
        <a href='details.php?pro_id=$pro_id'><h3>$pro_title</h3></a>
        <p class='price'>Rs $pro_price </p>
        <p class='buttons'>
        <center>
        <a href='details.php?pro_id=$pro_id' class='btn btn-default' > View Details</a>";
         $check_product="select * from cart where  p_id='$pro_id'";
        $run_check=mysqli_query($db,$check_product);
        if(mysqli_num_rows($run_check)>0){
            echo"<a href='cart.php?pro_id=$pro_id' class='btn btn-primary'><i class='fa fa-shopping-cart'></i>
                         Go To Cart</a>";
        }
        else{
        echo" <a href='details.php?pro_id=$pro_id' class='btn btn-primary'><i class='fa fa-shopping-cart'></i>
                        Add To Cart</a>";}
        echo"<center>
        </p>
        </div>
        </div>
        </div>
         ";
    }
}
/*Product Categories */
function getPCats(){
    global $db;
    $get_p_cats="select * from product_categories";
    $run_p_cats=mysqli_query($db,$get_p_cats);
    while($row_p_cat=mysqli_fetch_array($run_p_cats)){
    $p_cat_id=$row_p_cat['p_cat_id'];
    $p_cat_title=$row_p_cat['p_cat_title'];
    echo "<li><a href='shop.php?p_cat=$p_cat_id'>$p_cat_title</a></li>";
    }
}
/*Categories */
function getCat(){
    global $db;
    $get_cat="select * from categories";
    $run_cat=mysqli_query($db,$get_cat);
    while($row_cat=mysqli_fetch_array($run_cat)){
        $cat_id=$row_cat['cat_id'];
        $cat_title=$row_cat['cat_title'];
        echo "<li><a href='shop.php?cat_id=$cat_id'>$cat_title </a></li>";
    }
}
/* GET Product Categories product */
function getPcatPro(){
    global $db;
    if(isset($_GET['p_cat'])){
        $p_cat_id=$_GET['p_cat'];
        $get_p_cat="select * from product_categories where p_cat_id='$p_cat_id'";
        $run_p_cat=mysqli_query($db,$get_p_cat);
        $row_p_cat=mysqli_fetch_array($run_p_cat);
        $p_cat_title=$row_p_cat['p_cat_title'];
        $p_cat_desc=$row_p_cat['p_cat_desc'];
        $get_products="select * from products where p_cat_id='$p_cat_id' ";
        $run_products=mysqli_query($db,$get_products);
        $count=mysqli_num_rows($run_products);
        if($count==0){
            echo "<div class='box'>
            <h1>No Product Found In This Product Category</h1>
            </div>
            
            ";
        }
        else{
            echo "
            <div class='box'>
            <h1>$p_cat_title</h1>
            <p>$p_cat_desc</p>
            </div>
            
            ";
        }
        while($row_products=mysqli_fetch_array($run_products)){
            $pro_id=$row_products['product_id'];
            $pro_title=$row_products['product_title'];
            $pro_price=$row_products['product_price'];
            $pro_img1=$row_products['product_img1'];
            echo "
            <div class='col-md-4 col-sm-6 center-responsive'>
            <div class='product'>
            <a href='details.php?pro_id=$pro_id'>
            <img src='admin_area/product_images/$pro_img1' width='263' height='300'>
            </a>
            <div class='text'>
            <a href='details.php?pro_id=$pro_id'><h3>$pro_title</h3></a>
            <p class='price'>Rs $pro_price</p>
            <p class='buttons'>
            <a href='details.php?pro_id=$pro_id' class='btn btn-default'>View Details</a>";
             $check_product="select * from cart where  p_id='$pro_id'";
        $run_check=mysqli_query($db,$check_product);
        if(mysqli_num_rows($run_check)>0){
            echo"<a href='cart.php?pro_id=$pro_id' class='btn btn-primary'><i class='fa fa-shopping-cart'></i>
                         Go To Cart</a>";
        }
        else{
        echo" <a href='details.php?pro_id=$pro_id' class='btn btn-primary'><i class='fa fa-shopping-cart'></i>
                        Add To Cart</a>";}
            echo"</p>
            </div>
            </div>
            </div>
            
            ";
        }
    }
}
/* GET Categories */
function getCatPro(){
    global $db;
    if(isset($_GET['cat_id'])){
        $cat_id=$_GET['cat_id'];
        $get_cat="select * from categories where cat_id='$cat_id'";
        $run_cats=mysqli_query($db,$get_cat);
        $row_cat=mysqli_fetch_array($run_cats);
        $cat_title=$row_cat['cat_title'];
        $cat_desc=$row_cat['cat_desc'];
        $get_products="select * from products where cat_id=$cat_id";
        $run_products=mysqli_query($db,$get_products);
        $count=mysqli_num_rows($run_products);
       if($count==0){
        echo "<div class='box'>
        <h1>No Product Found In This Category</h1>
        </div>
        ";
    }
       else{
        echo "
        <div class='box'>
        <h1>$cat_title</h1>
        <p>$cat_desc</p>
        </div>
        ";
    }
    while($row_products=mysqli_fetch_array($run_products)){
        $pro_id=$row_products['product_id'];
        $pro_title=$row_products['product_title'];
        $pro_price=$row_products['product_price'];
        $pro_img1=$row_products['product_img1'];
        echo "
        <div class='col-md-4 col-sm-6 center-responsive'>
        <div class='product'>
        <a href='details.php?pro_id=$pro_id'>
        <img src='admin_area/product_images/$pro_img1' width='263' height='300'>
        </a>
        <div class='text'>
        <a href='details.php?pro_id=$pro_id'><h3>$pro_title</h3></a>
        <p class='price'>Rs $pro_price</p>
        <p class='buttons'>
        <a href='details.php?pro_id=$pro_id' class='btn btn-default'>View Details</a>";
         $check_product="select * from cart where  p_id='$pro_id'";
        $run_check=mysqli_query($db,$check_product);
        if(mysqli_num_rows($run_check)>0){
            echo"<a href='cart.php?pro_id=$pro_id' class='btn btn-primary'><i class='fa fa-shopping-cart'></i>
                         Go To Cart</a>";
        }
        else{
        echo" <a href='details.php?pro_id=$pro_id' class='btn btn-primary'><i class='fa fa-shopping-cart'></i>
                        Add To Cart</a>";}
        echo "</p>
        </div>
        </div>
        </div>
        
        ";
    }
}
}
?>