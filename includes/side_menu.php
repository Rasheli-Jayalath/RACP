<!-- Side Menue Start -->
<?php
	$page = $_REQUEST['page'];
?>
<div class="catblock">

    <div class="mini_portfolio_item_title">
    
        <div class="block_cattitle" align="left"><font color="#000000" style="font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin Panel</font>
        </div>
    </div>

<ul style="margin-left:0; padding-left:30px; ">
       <li style="min-height:10px; <?php if ($page == "home") { echo "background-color:#CECEFF;"; } ?> font-family:Verdana, Arial, helvetica, sans-serif; font-size:10px;  line-height:12px; "><a href="index.php?page=home">Home</a></li>
       
       <img src="images/horbar.png" width="100%" style="padding:0px;"/>
       <?php if ($objAdminUser->user_type==1)
	   {?>
       <li style="min-height:10px; <?php if ($page == "dealers") { echo "background-color:#CECEFF;"; } ?> font-family:Verdana, Arial, helvetica, sans-serif; font-size:10px;  line-height:12px; "><a href="index.php?page=dealers">Manage Dealers</a></li>
       
       <img src="images/horbar.png" width="100%" style="padding:0px;"/>
       <?php
	   }
	   ?>
       <?php if ($objAdminUser->user_type==1 || $objAdminUser->user_type==2)
	   {?>
       <li style="min-height:10px; <?php if ($page == "cars") { echo "background-color:#CECEFF;"; } ?> font-family:Verdana, Arial, helvetica, sans-serif; font-size:10px;  line-height:12px; "><a href="index.php?page=cars">Manage Cars</a></li>
       
       <img src="images/horbar.png" width="100%" style="padding:0px;"/>
       
       <li style="min-height:10px; <?php if ($page == "users") { echo "background-color:#CECEFF;"; } ?> font-family:Verdana, Arial, helvetica, sans-serif; font-size:10px;  line-height:12px; "><a href="index.php?page=users">Manage Users</a>
       
       <img src="images/horbar.png" width="100%" /></li>
       
       <li style="min-height:10px; <?php if ($page == "ratings") { echo "background-color:#CECEFF;"; } ?> font-family:Verdana, Arial, helvetica, sans-serif; font-size:10px;  line-height:12px; "><a href="index.php?page=ratings">Manage Ratings</a></li>
       
       <img src="images/horbar.png" width="100%" />
       
       <li style="min-height:10px; <?php if ($page == "payments") { echo "background-color:#CECEFF;"; } ?> font-family:Verdana, Arial, helvetica, sans-serif; font-size:10px;  line-height:12px; "><a href="index.php?page=payments">Manage Payments</a></li>
       
       <img src="images/horbar.png" width="100%" />
       
       <li style="min-height:10px; <?php if ($page == "bookings") { echo "background-color:#CECEFF;"; } ?> font-family:Verdana, Arial, helvetica, sans-serif; font-size:10px;  line-height:12px; "><a href="index.php?page=bookings">Manage Bookings</a></li>
       
       <img src="images/horbar.png" width="100%" />
       
       <li style="min-height:10px; <?php if ($page == "track") { echo "background-color:#CECEFF;"; } ?> font-family:Verdana, Arial, helvetica, sans-serif; font-size:10px;  line-height:12px; "><a href="index.php?page=track">Track Cars</a></li>
       
       <img src="images/horbar.png" width="100%" />
       <?php
	   }
	   ?>
         <?php if ($objAdminUser->user_type==3)
	   {?>
       <li style="min-height:10px; <?php if ($page == "cars") { echo "background-color:#CECEFF;"; } ?> font-family:Verdana, Arial, helvetica, sans-serif; font-size:10px;  line-height:12px; "><a href="index.php?page=cars">Search a Car</a></li>
       
       <img src="images/horbar.png" width="100%" />
       <li style="min-height:10px; <?php if ($page == "bookings") { echo "background-color:#CECEFF;"; } ?> font-family:Verdana, Arial, helvetica, sans-serif; font-size:10px;  line-height:12px; "><a href="index.php?page=bookings">See Bookings</a></li>
       
       <img src="images/horbar.png" width="100%" />
       
      
        <li style="min-height:10px; <?php if ($page == "see_profile") { echo "background-color:#CECEFF;"; } ?> font-family:Verdana, Arial, helvetica, sans-serif; font-size:10px;  line-height:12px; "><a href="index.php?page=see_profile">See Profile</a></li>
       
       <img src="images/horbar.png" width="100%" />
       <?php
	   }
	   ?>
       
       <li style="min-height:10px; font-family:Verdana, Arial, helvetica, sans-serif; font-size:10px;  line-height:12px; "><a href="logout.php">Logout</a></li></ul>
              
       </div>
<!-- Side Menue End -->
