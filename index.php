<?php 
require_once("config/config.php");
$objSDb= new Database;
$objCommon 		= new Common;
$objAdminUser 	= new AdminUser;
$objValidate 	= new Validate;
$objCar 		= new Car;

require_once('rs_lang.eng.php');
//echo "dsghdfjkhg";
?>


<!DOCTYPE html>
<html>
<head>
    <title>Rent a Car Project</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
   

</head>
<body>
<?php if($objAdminUser->is_login == true){
	
	?>
	<?php include_once "includes/header.php"; ?>
    <div style="width:100%; height:10px;">&nbsp;</div>
    <?php  ?>
        <div class="block">
            <div class="block_main">
			<?php
			
       			include_once "includes/side_menu.php";
	            switch ($page) {
				  case "login":
                		include_once "includes/login.php";
 					break;
				  case "signup":
                		include_once "includes/signup.php";
					break;
				  case "home":
                		include_once "includes/home.php";
					break;
				  case "dealers":
                		include_once "includes/dealers.php";
					break;
				  case "cars":
                		include_once "includes/cars.php";
 					break;
				  case "users":
                		include_once "includes/users.php";
 					break;
				  case "ratings":
                		include_once "includes/ratings.php";
 					break;
				  case "payments":
                		include_once "includes/payments.php";
 					break;
				  case "bookings":
                		include_once "includes/bookings.php";
 					break;
				  case "track":
                		include_once "includes/track.php";
 					break;
				  case "aboutus":
                		include_once "includes/aboutus.php";
 					break;
				  case "contactus":
                		include_once "includes/contactus.php";
 					break;
				  case "services":
                		include_once "includes/services.php";
 					break;					
					case "new_dealer":
					include_once "includes/new_dealer.php";
					break;
					case "new_car":
					include_once "includes/new_car.php";
					break;
					case "car_detail":
					include_once "includes/car_detail.php";
					break;
					case "new_dealer_doc":
					include_once "includes/new_dealer_doc.php";
					break;
					case "car_docs":
					include_once "includes/car_docs.php";
					break;
					case "car_booking":
					include_once "includes/car_booking.php";
					break;
					case "add_payment":
					include_once "includes/add_payment.php";
					break;
					case "see_profile":
					include_once "includes/see_profile.php";
					break;
					case "edit_user":
					include_once "includes/edit_user.php";
					break;
					case "ride_complete":
					include_once "includes/ride_complete.php";
					break;
					
					case "payment":
					include_once "includes/payment.php";
					break;
					case "success":
					include_once "includes/success.php";
					break;

				  default:
                		include_once "includes/home.php";
				}
			?>
                <div style="clear:both;">&nbsp;</div> <!-- for clearance -->
            </div>
        </div>
    <?php include_once "includes/footer.php"; ?>
    <?php
}
else
{
	?>
	<link href="css/loginstyle.css" rel="stylesheet">
    <?php
	require_once("pages/login-form.php");
}
?>
</body>


</html>