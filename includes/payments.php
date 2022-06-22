 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<?php

$objDb		= new Database;
$objPayment		= new Payment;
$objPaymentD		= new Payment;
if($_GET['mode'] == 'delete'){
	$objPaymentD->setProperty('b_id', $_GET['b_id']);
	 	
	$objPaymentD->actPayment('D');
	
	$objCommon->setMessage('Payment deleted successfully!', 'Info');
	
		
	redirect('./?page=payments');
}
		//$objPayment->setProperty("cc_id", $cc_id);
		$objPayment->lstPayments();
		
	
?> <link href="../css/table-styling.css" rel="stylesheet">
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Manage Payments</label>
        					</div>
                        </div>
								<?php
                               
								echo "<h1>Manage Payments</h1>";
								?>
                                  <h3 style=" color:#F00; text-align:center"> <?php echo $objCommon->displayMessage();?></h3>
                             <!--  <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a  href="index.php?page=new_dealer" class="button" >Add Payment
                               </a></div>-->
                              
                               
            <table id="customers" class="table" style="font-size: small;">
             <thead>
        <tr class="">
                
         <th scope="col" class="semibold"><?php echo "Dealer ";?></th>
		<th scope="col" class="semibold"><?php echo "Car";?></th>
        <th scope="col" class="semibold"><?php echo "Plate #";?></th>
        <th scope="col" class="semibold"><?php echo "Payment Date";?></th>
        <th scope="col" class="semibold"><?php echo "Payment  Amount";?></th>
         <th scope="col" class="semibold"><?php echo "Payment Method ";?></th>
         <th scope="col" class="semibold"><?php echo "Status";?></th>
		<th scope="col" class="semibold" style="text-align:center">Action</th>
		</tr>
         </thead>
		<?php
	//$objAdminUser->setProperty("ORDER BY", "a.first_name");
	//$objPayment->setProperty("limit", PERPAGE);
	//$objPayment->setProperty("GROUP BY", "cms_cd");

	if($objPayment->totalRecords() >= 1){
		$sno = 1;
		while($rows = $objPayment->dbFetchArray(1)){
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			$car_id=$rows["car_id"];
			if(isset($car_id) && !empty($car_id)){
		$objCar->setProperty("car_id", $car_id);
		$objCar->lstCar();
		$car_data = $objCar->dbFetchArray(1);
		$car_name=$car_data['car_name'];
		$car_model=$car_data['car_model'];
		$car_plateno=$car_data['car_plateno'];
			}?>
			<!-- Start Your Php Code her For Display Record's -->
			<tr style="background-color:<?php echo $bgcolor;?>">
				<td><?php echo $rows['dealer_name'];?></td>
                <td><?php echo $car_name;?></td>
                <td><?php echo $car_plateno;?></td>
                <td><?php echo date('d-m-Y',strtotime($rows['payment_date']));?></td>
                <td><?php echo number_format($rows['total_amount'],2);?></td>
                <td><?php if($rows['payment_method']==1)
				{echo "VISA";}
				else
				{ echo "Masters";}?></td>
                 <td><?php if($rows['payment_status']=='Y') echo "Paid"; else echo "Pending";?></td>
               <td style="text-align:right"><a href="index.php?page=car_booking&mode=edit&b_id=<?php echo $rows['b_id'];?>" style="text-decoration:none"title="Edit Payment"><img src="images/iconedit.png" border="0" /></a>  | <a onClick="return confirm('Are you sure to delete this Payment?');" href="./?page=bookings&mode=delete&b_id=<?php echo $rows['b_id'];?>" style="text-decoration:none" title="Delete"><img src="images/icondelete.png" border="0" /></a></td></tr>
			<?php
			
		}
    }
	else{
	?>
	<tr>
	<td colspan="7">
  <div align="center" style="padding:5px 5px 5px 5px"> <?php echo "No Payment Information Found";?></div>
   </td></tr>
    <?php
	}
	?> </table>
          
             
				﻿</div> <!-- for AJAX -->
			</div>
