<div class="panel panel-default sidebar-menu">
    <div class="panel-heading">
        <!--panel-heading-start-->
        <?php 
        $session_customer=$_SESSION['customer_email'];
        $get_cust="select * from customers where customer_email='$session_customer'";
        $run_cust=mysqli_query($con,$get_cust);
        $row_customers=mysqli_fetch_array($run_cust);
        $customer_name=$row_customers['customer_name'];
        if(!isset($_SESSION['customer_email'])){
        } else{
            echo "<h3 align='center' class='panel-title'>Name:$customer_name</h3>";
        }
        ?>

    </div>
    <!--panel-heading End-->
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li >
                <a href="my_account.php?my_order"><i class="fa fa-list"></i>My Order</a>
            </li>
          
            
            <li >
                <a href="my_account.php?edit_act">
                    <i class="fa fa-pencil"></i>Edit Account</a>
            </li>
            <li >
                <a href="my_account.php?change_pass">
                    <i class="fa fa-user"></i>Change Password</a>
            </li>

            <li >
                <a href="my_account.php?delete_ac">
                    <i class="fa fa-trash-o"></i>Delete Account</a>
            </li>
            <li >
                <a href="../logout.php">
                    <i class="fa fa-sign-out"></i>My Logout</a>
            </li>
        </ul>
    </div>
</div>