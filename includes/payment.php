<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<?php

$objDb		= new Database;
$objDealer		= new Dealer;
$objDealerD		= new Dealer;
if($_GET['mode'] == 'delete'){
	$objDealerD->setProperty('cc_id', $_GET['cc_id']);
	 	
	$objDealerD->actDealer('D');
	
	$objCommon->setMessage('Dealer deleted successfully!', 'Info');
	
		
	redirect('./?page=dealers');
}
		//$objDealer->setProperty("cc_id", $cc_id);
		$objDealer->lstDealers();
		
	
?> <link href="../css/table-styling.css" rel="stylesheet">
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Online Payment</label>
        					</div>
                        </div>
								<?php
                               
								echo "<h1>Online Payment</h1>";
								?>
                                  <h3 style=" color:#F00; text-align:center"> <?php echo $objCommon->displayMessage();?></h3>
                               
                               </a></div>
                              
                               
            <table width="100%" border="0px" cellpadding="0px" cellspacing="0px" align="center" 
         style="padding-left:20px; padding-right:20px; margin-top:0px; vertical-align:top;">
<tr>
<td width="48%" style="vertical-align:top;">
<form action="payment.php" name="opmt" id="opmt" method="post">
<table width="100%" border="0px" cellpadding="0px" cellspacing="2px" align="center" >
<tr>
<td colspan="2" style="vertical-align:top;" align="left">
<h3 style=" font-family:Arial, Helvetica, sans-serif; font-size: 18px; color:#0000CC" ><span>Online Payments</span></h3>
<!--=============================================================-->
<?php
$order_id = "AM-".$user_id."-"."1234567890";
$amount = $grandtotal;
$quantity = $noofbooks;
$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
//$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
$merchant_email = 'info@ebooksweb.net';
//$merchant_email = 'naveed7174-facilitator@gmail.com';
$shoppingurl = "http://www.phillybook.com";
$firstname = $firstname;
$lastname = $lastname;
$state = $billing_state;
$country = $billing_country;
$currency = "USD";
$itemname = "BookBuyerHub Payment";
$notify_url = "http://".$_SERVER['HTTP_HOST'].'/paypal-ipn-php/Ipn.php';
$success_return = "http://".$_SERVER['HTTP_HOST'].'/paypal-ipn-php/Success.php';
$cancel_return = "http://".$_SERVER['HTTP_HOST'].'/paypal-ipn-php';
$session_id = session_id();
?>

<form name="myform" action="<?php echo $paypal_url;?>" method="post" target="_blank">
<input type="hidden" name="business" value="<?php echo $merchant_email;?>" />
<input type="hidden" name="notify_url" value="<?php echo $notify_url;?>" />
<input type="hidden" name="cancel_return" value="<?php echo $cancel_return;?>" />
<input type="hidden" name="return" value="<?php echo $success_return;?>" />
<input type="hidden" name="rm" value="2" />
<input type="hidden" name="lc" value="" />
<input type="hidden" name="no_shipping" value="1" />
<input type="hidden" name="no_note" value="1" />
<input type="hidden" name="currency_code" value="<?php echo $currency;?>" />
<input type="hidden" name="page_style" value="paypal" />
<input type="hidden" name="charset" value="utf-8" />
<input type="hidden" name="item_name" value="<?php echo $order_id;?>">
<input type="hidden" value="_xclick" name="cmd"/>
<input type="hidden" name="amount" value="<?php echo $amount;?>" />

<input type="hidden" name="shopping_url" value="<?php echo $shoppingurl;?>">
<input type="hidden" name="first_name" value="<?php echo $firstname;?>">
<input type="hidden" name="last_name" value="<?php echo $lastname;?>">
<input type="hidden" name="state" value="<?php echo $state;?>">
<input type="hidden" name="country" value="<?php echo $country;?>">

<input type="hidden" name="item_name_1" value="<?php echo $order_id;?>">
<input type="hidden" name="amount_1" value="<?php echo $amount;?>">
<input type="hidden" name="quantity_1" value="<?php echo $quantity;?>">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="custom" value="<?php echo $session_id;?>">
<input type="hidden" name="image_url" value="http://www.google.com/googlelogo.jpg">
<!--<input type="submit" value="Paypal" id="paypall_button"/>-->
<input type="image" src="images/paypal.png" alt="Submit Form" />
</form>
<!--=============================================================-->
<?php
echo $message; 
?><br />
</td>
</tr>


    <tr><td width="29%" style="font-size:12px;"><Label>Payment Method: </Label></td>
    <td width="71%">
    <div>
    <select name="optpmt" id="optpmt" >
    <option value="0">Select Payment Method</option>
    <option value="1"<?php if ($optpmt == '1') { echo 'selected="selected"';} ?>>VISA</option>
    <option value="2"<?php if ($optpmt == '2') { echo 'selected="selected"';} ?>>MASTER</option>
	<option value="5"<?php if ($optpmt == '5') { echo 'selected="selected"';} ?>>AMERICAN EXPRESS</option>
    <option value="6"<?php if ($optpmt == '6') { echo 'selected="selected"';} ?>>DISCOVER</option>
 <!--   <option value="3">PAYPAL</option>-->
    <?php if ($adminflag==1) { 
    ?>
	<option value="4"<?php if ($optpmt == '4') { echo 'selected="selected"';} ?>>WIRE</option>
 	<?php
    }
	?>
    </select>
     </div>
    
    </td></tr>
<tr><td style="font-size:12px;"><Label>Credit Card Number: </Label></td><td><input type="text" name="cnumber" id="cnumber" <?php if ($pmtflag == '0') {echo 'disabled="disabled"';} ?> value="<?php echo $x_card_num; ?>" maxlength="16" /></td></tr>

<tr><td style="font-size:12px;"><Label>Expiry Date: </Label></td>
<td>
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

</td></tr>
<tr><td style="font-size:12px;"><Label>CVV:</Label></td><td><input type="text" name="ccode" <?php if ($pmtflag == '0') {echo 'disabled="disabled"';} ?> id="ccode" value="<?php echo $x_card_code; ?>" maxlength="4" size="4" /><a href="cvv.html" onClick="return popitup('cvv.html')"> What is CVV ?</a></td></tr>


<?php /*?><tr><td style="font-size:12px;"><Label>Paypal Email ID: </Label></td><td><input type="text" name="payemail" disabled="disabled" style="width:225px; " id="payemail" value="<?php echo $payemail; ?>" /></td></tr>

<tr><td style="font-size:12px;"><Label>Paypal Password: </Label></td><td><input type="password" name="paypass" disabled="disabled" style="width:225px; " id="paypass" value="<?php echo $x_paypass; ?>" /></td></tr>
<?php */?>
<tr><td style="font-size:12px;"><Label>Total Amount: </Label></td><td><input type="text" name="camount" id="camount" disabled="disabled" style="width:60px; " value="<?php echo $grandtotal; ?>" /></td></tr>


<tr><td style="font-size:12px;"><Label>Name: </Label></td><td><input type="text" name="cfname" id="cfname"  style="width:225px; " value="<?php echo $firstname." ".$middlename; ?>" /></td></tr>
<tr><td style="font-size:12px;"><Label>Address: </Label></td><td><input type="text" name="caddress" id="caddress"   value="<?php echo $billing_address_1." ".$billing_address_2; ?>"  style="width:225px; "/></td></tr>
<tr><td style="font-size:12px;"><Label>Phone: </Label></td><td><input type="text" name="cphone" id="cphone" style="width:225px; " value="<?php echo $mobile; ?>" /><input type="hidden" name="pflag" id="pflag" value="<?php echo $pflag; ?>" /></td></tr>
<tr><td colspan="2" align="center"><img src="images/blanker.png" height="20px" /></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Payment" <?php if ($pmtflag == '0') {echo 'disabled="disabled"';} ?>  name="ccpmt" id="ccpmt" /></td></tr>
</table>
</form>
</td>

</tr>
</table>
          
             
				﻿</div> <!-- for AJAX -->
			</div>
