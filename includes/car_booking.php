<?php

$objDb		= new Database;
$objBooking		= new Booking;

$mode	= "I";
if(isset($_REQUEST["car_id"]))
{
	$car_id=$_REQUEST["car_id"];
}
if(isset($objAdminUser->user_cd))
{
	$user_cd=$objAdminUser->user_cd;
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$flag 		= true;
	$b_id = trim($_POST['b_id']);
	$user_cd=$user_cd;
	$car_id =trim($_POST['car_id']);
	$detail =trim($_POST['detail']);
	$returnDate=date('Y-m-d',strtotime($_POST['returnDate']));
	$bookingDate=date('Y-m-d',strtotime($_POST['bookingDate']));
	$posting_date=date('Y-m-d',strtotime($_POST['posting_date']));
	$b_status 		= trim($_POST['b_status']);
	$driver_status 		= trim($_POST['driver_status']);
	$mode 		= trim($_POST['mode']);
	
	
	
	if(empty($detail)){
		$flag 	= false;
		$objCommon->setMessage("Provide Detail",'Error');
	}
	if(empty($bookingDate)){
		$flag 	= false;
		$objCommon->setMessage("Provide Booking Date",'Error');
	}
	
	if(empty($returnDate)){
		$flag 	= false;
		$objCommon->setMessage("Return Date is a Required field",'Error');
	}
	
	if($flag != false){
		$b_id = ($mode == "U") ? $_POST['b_id'] : 
		$objBooking->genCode("tbl_booking", "b_id");
		
		$objBooking->resetProperty();
		$objBooking->setProperty("b_id", $b_id);
		$objBooking->setProperty("car_id", $car_id);
		$objBooking->setProperty("user_cd", $user_cd);
		$objBooking->setProperty("returnDate", $returnDate);
		$objBooking->setProperty("detail", $detail);
		$objBooking->setProperty("account_detail", $account_detail);
		$objBooking->setProperty("bookingDate", $bookingDate);
		$objBooking->setProperty("posting_date", $posting_date);
		$objBooking->setProperty("b_status", $b_status);
		$objBooking->setProperty("driver_status", $driver_status);

		if($objBooking->actBooking($_POST['mode'])){
			
			$objCommon->setMessage('Booking added successfully!', 'Info');
				
				redirect('./?page=bookings');
			
				

		}
	}
	extract($_POST);
}
else{
if(isset($_GET['b_id']) && !empty($_GET['b_id']))
	{	
	 $b_id = $_GET['b_id'];
	if(isset($b_id) && !empty($b_id)){
		$objBooking->setProperty("b_id", $b_id);
		$objBooking->lstBookings();
		$data = $objBooking->dbFetchArray(1);
		$mode	= "U";
		extract($data);

	}
	}
	
}
?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"> 
 <script type="text/javascript" src="../datepickercode/jquery-ui.js"></script>
 <script>
  $(function() {
    $( "#bookingDate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	
  });
   $(function() {
    $( "#returnDate" ).datepicker({ dateFormat:'yy-mm-dd'}).val();
	
  });
  $(function() {
    $( "#posting_date" ).datepicker({ dateFormat:'yy-mm-dd'}).val();
	
  });
  
  </script>
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Add New Booking</label>
        					</div>
                        </div>
								<?php
                                
								echo "<h1>New Booking's Detail</h1>";
								?>
                               <h3 style=" color:#F00; text-align:center"> <?php echo $objCommon->displayMessage();?></h3>
                               <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a  href="index.php?page=bookings" class="button" >Back</a></div>
                              <form name="frmProfile" id="frmProfile" action="" method="post" onSubmit="return frmValidate(this);">
        <input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
        <input type="hidden" name="car_id" id="car_id" value="<?php echo $car_id;?>" />
         <input type="hidden" name="b_id" id="b_id" value="<?php echo $b_id;?>" />
         
        <div class="row" >

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small;">
                      <label  class="sr-only semibold"><?php echo "Driver Status";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                         <input type="radio" id="driver_status" name="driver_status" value="1" checked="checked"/>
			 With Driver 
			<input type="radio" 
			 id="driver_status" name="driver_status" value="0" <?php echo ($driver_status=='0') ? 'checked="checked"' : "";?>/>
			 Without Driver
                       </div>   

                       <div class="col-md-3">
                        </div>
<br/>
            </div>
            <div class="row" >

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Detail";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Detail..." style="font-size: small;" name="detail" id="detail" 
                        value="<?php echo $detail;?>">
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Booking Date";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Booking Date..." style="font-size: small;" name="bookingDate" id=
			"bookingDate" value="<?php echo $bookingDate;?>">
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Return Date";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Return Date..." style="font-size: small;" name="returnDate" 
                        id="returnDate" value="<?php echo $returnDate;?>" >
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold">Posting Date:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small; ">
                <input class="form-control" type="text" placeholder="Posting Date..." style="font-size: small;" name="posting_date" id="posting_date" 
                value="<?php echo $posting_date;?>">
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        <?php 
         if($objAdminUser->user_type==1)
		{
			?>
        <div class="row" style="margin-top: 20px;" >

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php 
			echo "Status";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
            <input type="radio" id="b_status" name="b_status" value="Y"  <?php echo ($b_status=='Y') ? 'checked="checked"' : "";?>/>
			 Approved 
			<input type="radio" 
			 id="b_status" name="b_status" value="N" checked="checked"/>
			 Pending
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        <?php
		}
		?>
       <!-- Update Button -->
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3">
            </div>

            <div class="col-md-4 regular" style="font-size: small;text-align: left;">
                <input type="submit" class="btn btn-warning mb-2" style="font-size: 13px;" value="<?php echo ($mode == "U") ? " Update " : " Save ";?>" />
                <input type="button" class="btn btn-danger mb-2" style="font-size: 13px;" value="Cancel" onClick="document.location='?page=cars';">
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        </form>     
				﻿</div> <!-- for AJAX -->
			</div>
