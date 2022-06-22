<?php

$objDb		= new Database;
$objPayment		= new Payment;
$objBooking		= new Booking;
$objCar 		= new Car;
$mode	= "I";
$total_amount=0;
if(isset($_REQUEST["b_id"]))
{
	$b_id=$_REQUEST["b_id"];
		if(isset($b_id) && !empty($b_id)){
		$objBooking->setProperty("b_id", $b_id);
		$objBooking->lstBookings();
		$bdata = $objBooking->dbFetchArray(1);
		$car_id=$bdata["car_id"];
		$driver_status=$bdata["driver_status"];
		$bookingDate=$bdata["bookingDate"];
		$returnDate=$bdata["returnDate"];
		$Diff= abs(strtotime($returnDate) - strtotime($bookingDate));
	    $numberDays= ceil($Diff/86400);
		}
}
		if(isset($car_id) && !empty($car_id)){
		$objCar->setProperty("car_id", $car_id);
		$objCar->lstCar();
		$car_data = $objCar->dbFetchArray(1);
		$car_name=$car_data['car_name'];
		$car_model=$car_data['car_model'];
		$car_plateno=$car_data['car_plateno'];
		$car_price_perday=$car_data['car_price_perday'];
		$car_price_without_driver=$car_data['car_price_without_driver'];
		if($driver_status==0)
		{
			$total_amount=$car_price_without_driver*$numberDays;
		}
		else
		{
			$total_amount=$car_price_perday*$numberDays;
		}
}
if(isset($objAdminUser->user_cd))
{
	$user_cd=$objAdminUser->user_cd;
	$u_sql = "select * from mis_tbl_users where user_cd=$user_cd";
    $u_result = $objDb->dbQuery($u_sql);
	$u_data = $objDb->dbFetchArray(1);
	$name= $u_data['first_name'];
	$email= $u_data['email'];
	$address= $u_data['address'];
	
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$flag 		= true;
	$b_id = trim($_POST['b_id']);
	$user_cd=$user_cd;
	$car_id =trim($_POST['car_id']);
	$detail =trim($_POST['detail']);
	$payment_method=trim($_POST['payment_method']);
	$total_amount=trim($_POST['total_amount']);
	$payment_date=date('Y-m-d',strtotime($_POST['payment_date']));
	$payment_status = trim($_POST['payment_status']);
	$mode 		= trim($_POST['mode']);
	$pmtflag 		= trim($_POST['pmtflag']);
	
	
	
	
	if(empty($payment_date)){
		$flag 	= false;
		$objCommon->setMessage("Provide Payment Date",'Error');
	}
	
	if(empty($payment_method)){
		$flag 	= false;
		$objCommon->setMessage("Payment Method is a Required field",'Error');
	}
	
	if($flag != false){
		$p_id = ($mode == "U") ? $_POST['p_id'] : 
		$objPayment->genCode("tbl_payment", "p_id");
		
		$objPayment->resetProperty();
		$objPayment->setProperty("b_id", $b_id);
		$objPayment->setProperty("p_id", $p_id);
		$objPayment->setProperty("user_cd", $user_cd);
		$objPayment->setProperty("payment_method", $payment_method);
		$objPayment->setProperty("detail", $detail);
		$objPayment->setProperty("account_detail", $account_detail);
		$objPayment->setProperty("total_amount", $total_amount);
		$objPayment->setProperty("payment_date", $payment_date);
		$objPayment->setProperty("payment_status", $payment_status);

		if($objPayment->actPayment($_POST['mode'])){
			$sql_b="update tbl_booking set b_status='Y' where b_id=".$b_id;
			 $objDb->dbQuery($sql_b);
			 
			 	$sql_b1="update tbl_payment set payment_status='Paid' where b_id=".$b_id;
			 $objDb->dbQuery($sql_b1);
			 
			$objCommon->setMessage('Payment added successfully!', 'Info');
				
				redirect('./?page=success&flag='.$pmtflag);
			
				

		}
	}
	extract($_POST);
}
else{
if(isset($_GET['b_id']) && !empty($_GET['b_id']))
	{	
	 $b_id = $_GET['b_id'];
	if(isset($b_id) && !empty($b_id)){
		$objPayment->setProperty("b_id", $b_id);
		//$objPayment->lstPayments();
		//$data = $objPayment->dbFetchArray(1);
		//$mode	= "U";
		//extract($data);

	}
	}
	
}
?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"> 
 <script type="text/javascript" src="../datepickercode/jquery-ui.js"></script>
 <script>
  $(function() {
    $( "#total_amount" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	
  });
   $(function() {
    $( "#payment_method" ).datepicker({ dateFormat:'yy-mm-dd'}).val();
	
  });
  $(function() {
    $( "#payment_date" ).datepicker({ dateFormat:'yy-mm-dd'}).val();
	
  });
  
  </script>
  <?php
$order_id = "AM-".$user_id."-"."1234567890";
$amount = $grandtotal;
$quantity = $noofbooks;
$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
//$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
$merchant_email = 'racp@gmail.com';
//$merchant_email = 'naveed7174-facilitator@gmail.com';
$shoppingurl = "http://www.racp.com";
$firstname = $name;
$currency = "PKR";
$itemname = "CARP Payment";
$notify_url = "http://".$_SERVER['HTTP_HOST'].'/paypal-ipn-php/Ipn.php';
$success_return = "http://".$_SERVER['HTTP_HOST'].'/paypal-ipn-php/Success.php';
$cancel_return = "http://".$_SERVER['HTTP_HOST'].'/paypal-ipn-php';
$session_id = session_id();
?>
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Add New Payment</label>
        					</div>
                        </div>
								<?php
                                
								echo "<h1>New Payment's Detail</h1>";
								?>
                               <h3 style=" color:#F00; text-align:center"> <?php echo $objCommon->displayMessage();?></h3>
                               <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a  href="index.php?page=bookings" class="button" >Back</a></div>
                              <form name="myform" action="" method="post" target="_blank">
<input type="hidden" name="business" value="<?php echo $merchant_email;?>" />
<input type="hidden" name="notify_url" value="<?php echo $notify_url;?>" />
<input type="hidden" name="cancel_return" value="<?php echo $cancel_return;?>" />
<input type="hidden" name="return" value="<?php echo $success_return;?>" />
<input type="hidden" name="pmtflag" id="pmtflag" value="1" />
<input type="hidden" name="rm" value="2" />
<input type="hidden" name="lc" value="" />
<input type="hidden" name="page_style" value="paypal" />
<input type="hidden" name="charset" value="utf-8" />
<input type="hidden" name="item_name" value="<?php echo $order_id;?>">
<input type="hidden" value="_xclick" name="cmd"/>
<input type="hidden" name="amount" value="<?php echo $amount;?>" />
<input type="hidden" name="shopping_url" value="<?php echo $shoppingurl;?>">
<input type="hidden" name="name" value="<?php echo $name;?>">
<input type="hidden" name="item_name_1" value="<?php echo $b_id;?>">
<input type="hidden" name="amount_1" value="<?php echo $total_amount;?>">
<input type="hidden" name="image_url" value="http://www.google.com/googlelogo.jpg">
<!--<input type="submit" value="Paypal" id="paypall_button"/>-->
<?php /*?><input type="image" src="images/paypal.png" alt="Submit Form" />
<?php */?>
<!--=============================================================-->
<?php
echo $message; 
?><br />
        <input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
        <input type="hidden" name="car_id" id="car_id" value="<?php echo $car_id;?>" />
         <input type="hidden" name="b_id" id="b_id" value="<?php echo $b_id;?>" />
         	
            <div class="row" >

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Car Detail";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <?php echo $car_name."&nbsp;&nbsp;".$car_model."&nbsp;&nbsp;".$car_plateno."&nbsp;";?>
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row" style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Name";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                       <input class="form-control" type="text" placeholder="Name ..." style="font-size: small;" name="name" 
                        id="name" value="<?php echo $name;?>" > 
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row" style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Email";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        
                        <input class="form-control" type="text" placeholder="Email ..." style="font-size: small;" name="email" 
                        id="email" value="<?php echo $email;?>" >
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row" style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Address";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                       <input class="form-control" type="text" placeholder="Address ..." style="font-size: small;" name="address" 
                        id="address" value="<?php echo $address;?>" > 
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Payment Amount";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Total Amount..." style="font-size: small;" name="total_amount" 
                        id="total_amount" value="<?php echo $total_amount;?>" >
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Payment Date";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Payment Date..." style="font-size: small;" name="payment_date" 
                        id="payment_date" value="<?php echo $payment_date;?>">
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            
        
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php 
			echo "Payment Method";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
            <?php /*?><input type="radio" id="payment_method" name="payment_method" value="card" checked="checked"/>
			 Debit/Credit Card (VISA) 
			<input type="radio" 
			 id="payment_method" name="payment_method" value="bank" <?php echo ($payment_method=='bank') ? 'checked="checked"' : "";?>/>
			 Bank Transfer<?php */?>
             <select name="payment_method" id="payment_method" >
    <option value="0">Select Payment Method</option>
    <option value="1"<?php if ($optpmt == '1') { echo 'selected="selected"';} ?>>VISA</option>
    <option value="2"<?php if ($optpmt == '2') { echo 'selected="selected"';} ?>>MASTER</option>

    </select>
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php 
			echo "Credit Card Number";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
            <input type="text" name="cnumber" id="cnumber" <?php if ($pmtflag == '0') {echo 'disabled="disabled"';} ?> value="<?php echo $x_card_num; ?>" maxlength="16" />
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php 
			echo "Expiry Date";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
           <select name="cedate" <?php if ($pmtflag == '0') {echo 'disabled="disabled"';} ?> id="cedate">
    <option value="00">Month</option>
    <option value="01" <?php if ($x_exp_date_mm == '01') { echo 'selected="selected"';} ?>>01</option>
    <option value="02" <?php if ($x_exp_date_mm == '02') { echo 'selected="selected"';} ?>>02</option>
    <option value="03" <?php if ($x_exp_date_mm == '03') { echo 'selected="selected"';} ?>>03</option>
    <option value="04" <?php if ($x_exp_date_mm == '04') { echo 'selected="selected"';} ?>>04</option>
    <option value="05" <?php if ($x_exp_date_mm == '05') { echo 'selected="selected"';} ?>>05</option>        
    <option value="06" <?php if ($x_exp_date_mm == '06') { echo 'selected="selected"';} ?>>06</option>
    <option value="07" <?php if ($x_exp_date_mm == '07') { echo 'selected="selected"';} ?>>07</option>    
    <option value="08" <?php if ($x_exp_date_mm == '08') { echo 'selected="selected"';} ?>>08</option>    
    <option value="09" <?php if ($x_exp_date_mm == '09') { echo 'selected="selected"';} ?>>09</option>    
    <option value="10" <?php if ($x_exp_date_mm == '10') { echo 'selected="selected"';} ?>>10</option>    
    <option value="11" <?php if ($x_exp_date_mm == '11') { echo 'selected="selected"';} ?>>11</option>    
    <option value="12" <?php if ($x_exp_date_mm == '12') { echo 'selected="selected"';} ?>>12</option>    
    </select>
 - 
    <select name="cedate2" <?php if ($pmtflag == '0') {echo 'disabled="disabled"';} ?> id="cedate2">
    <option value="00">Year</option>
    <option value="12" <?php if ($x_exp_date_yy == 12) { echo 'selected="selected"';} ?>>2012</option>
    <option value="13" <?php if ($x_exp_date_yy == 13) { echo 'selected="selected"';} ?>>2013</option>
    <option value="14" <?php if ($x_exp_date_yy == 14) { echo 'selected="selected"';} ?>>2014</option>
    <option value="15" <?php if ($x_exp_date_yy == 15) { echo 'selected="selected"';} ?>>2015</option>
    <option value="16" <?php if ($x_exp_date_yy == 16) { echo 'selected="selected"';} ?>>2016</option>        
    <option value="17" <?php if ($x_exp_date_yy == 17) { echo 'selected="selected"';} ?>>2017</option>
    <option value="18" <?php if ($x_exp_date_yy == 18) { echo 'selected="selected"';} ?>>2018</option>    
    <option value="19" <?php if ($x_exp_date_yy == 19) { echo 'selected="selected"';} ?>>2019</option>    
    <option value="20" <?php if ($x_exp_date_yy == 20) { echo 'selected="selected"';} ?>>2020</option>    
    <option value="21" <?php if ($x_exp_date_yy == 21) { echo 'selected="selected"';} ?>>2021</option>    
    <option value="22" <?php if ($x_exp_date_yy == 22) { echo 'selected="selected"';} ?>>2022</option>    
    <option value="23" <?php if ($x_exp_date_yy == 23) { echo 'selected="selected"';} ?>>2023</option>    
    </select>
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        
               
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php 
			echo "CVV";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
          <input type="text" name="ccode" <?php if ($pmtflag == '0') {echo 'disabled="disabled"';} ?> id="ccode" value="<?php echo $x_card_code; ?>" maxlength="4" size="4" /><a href="cvv.html" onClick="return popitup('cvv.html')"> What is CVV ?</a>
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        
       <!-- Update Button -->
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3">
            </div>

            <div class="col-md-4 regular" style="font-size: small;text-align: left;">
                <input type="submit" class="btn btn-warning mb-2" style="font-size: 13px;" value="<?php echo ($mode == "U") ? " Update " : " Proceed ";?>" />
                <input type="button" class="btn btn-danger mb-2" style="font-size: 13px;" value="Cancel" onClick="document.location='?page=cars';">
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        </form>     
				﻿</div> <!-- for AJAX -->
			</div>
