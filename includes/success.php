 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<?php

$objDb		= new Database;
$objPayment		= new Payment;
$objPaymentD		= new Payment;
if($_GET['flag'] == '1'){

	
	$objCommon->setMessage('Payment is successfully!', 'Info');
}
else
{
	$objCommon->setMessage('Payment is not successfully!', 'Info');
}
	
?> <link href="../css/table-styling.css" rel="stylesheet">
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Manage Payments</label>
        					</div>
                        </div>
								<?php
                               
								echo "<h1>Payment Status</h1>";
								?>
                                  <h3 style=" color:#F00; text-align:center"> <?php echo $objCommon->displayMessage();?></h3>
                             <!--  <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a  href="index.php?page=new_dealer" class="button" >Add Payment
                               </a></div>-->
                              
                               
            
          
             
				﻿</div> <!-- for AJAX -->
			</div>
