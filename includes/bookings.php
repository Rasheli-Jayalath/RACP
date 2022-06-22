 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

<?php

$objDb		= new Database;
$objDb1		= new Database;
$objBooking		= new Booking;
$objBookingD		= new Booking;
if($_GET['mode'] == 'delete'){
	$objBookingD->setProperty('b_id', $_GET['b_id']);
	 	
	$objBookingD->actBooking('D');
	
	$objCommon->setMessage('Booking deleted successfully!', 'Info');
	
		
	redirect('./?page=bookings');
}

		//$objBooking->setProperty("cc_id", $cc_id);
		if($objAdminUser->user_type==3){
			 $user_cd=$objAdminUser->user_cd;
		}
		$objBooking->setProperty("user_cd", $user_cd);
		$objBooking->lstBookings();
		
	
?> <link href="../css/table-styling.css" rel="stylesheet">
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Bookings</label>
        					</div>
                        </div>
								<?php
								if($objAdminUser->user_type==3){
									echo "<h1>My Bookings History</h1>";
								}
								else
								{
                               
								echo "<h1>Manage Bookings</h1>";
								}
								?>
                                  <h3 style=" color:#F00; text-align:center"> <?php echo $objCommon->displayMessage();?></h3>
                             <!--  <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a  href="index.php?page=new_dealer" class="button" >Add Booking
                               </a></div>-->
                              
                               
            <table id="customers" class="table" style="font-size: small;">
             <thead>
        <tr class="">
                
         <th scope="col" class="semibold"><?php echo "Dealer ";?></th>
		<th scope="col" class="semibold"><?php echo "Car";?></th>
        <th scope="col" class="semibold"><?php echo "Plate #";?></th>
        <th scope="col" class="semibold"><?php echo "Booking Date";?></th>
        <th scope="col" class="semibold"><?php echo "Return Date";?></th>
         <th scope="col" class="semibold"><?php echo "Post Date";?></th>
         <th scope="col" class="semibold"><?php echo "Status";?></th>
         <th scope="col" class="semibold"><?php echo "Ride Completed";?></th>
		<th scope="col" class="semibold" style="text-align:center">Action</th>
		</tr>
         </thead>
		<?php
	//$objAdminUser->setProperty("ORDER BY", "a.first_name");
	//$objBooking->setProperty("limit", PERPAGE);
	//$objBooking->setProperty("GROUP BY", "cms_cd");

	if($objBooking->totalRecords() >= 1){
		$sno = 1;
		while($rows = $objBooking->dbFetchArray(1)){
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			?>
			<!-- Start Your Php Code her For Display Record's -->
			<tr style="background-color:<?php echo $bgcolor;?>">
				<td><?php echo $rows['dealer_name'];?></td>
                <td><?php echo $rows['car_name'];?></td>
                <td><?php echo $rows['car_plateno'];?></td>
                <td><?php echo date('d-m-Y',strtotime($rows['bookingDate']));?></td>
                <td><?php echo date('d-m-Y',strtotime($rows['returnDate']));?></td>
                <td><?php echo date('d-m-Y',strtotime($rows['posting_date']));?></td>
                 <td><?php if($rows['b_status']=='Y') echo "Booked"; else echo "Pending";?></td>
                <td><?php if($rows['ride_completed']==1) echo "Yes"; else echo "No";?></td>
              <?php  $sqlw="Select * from tbl_customerexperience where b_id=".$rows['b_id'];
$queryw=$objDb1->dbQuery($sqlw);
if($objDb1->totalRecords()>=1)
{
	$remarks="See Remarks";
	
}
else
{
	$remarks="Add Remarks";
}
 ?>
                 
               <td style="text-align:right"><?php if($rows['b_status']=='N'){?><a href="index.php?page=add_payment&b_id=<?php echo $rows['b_id'];?>" style="text-decoration:none;" title="Booking Payment">Make Payment</a>  |<?php }?> <a href="index.php?page=ride_complete&b_id=<?php echo $rows['b_id'];?>" style="text-decoration:none"title="Ride Complete">Ride Complete</a>  | <?php if($objAdminUser->user_type==3){ ?> <a href="index.php?page=ratings&b_id=<?php echo $rows['b_id'];?>" style="text-decoration:none"title="<?php echo $remarks;?>"><?php echo $remarks;?></a>|<?php }else{?><a href="index.php?page=track&&b_id=<?php echo $rows['b_id'];?>" style="text-decoration:none"title="Track Car">Track Car</a>|<?php }?><a href="index.php?page=car_booking&mode=edit&b_id=<?php echo $rows['b_id'];?>" style="text-decoration:none"title="Edit Booking"><img src="images/iconedit.png" border="0" /></a>  | <a onClick="return confirm('Are you sure to delete this Booking?');" href="./?page=bookings&mode=delete&b_id=<?php echo $rows['b_id'];?>" style="text-decoration:none" title="Delete"><img src="images/icondelete.png" border="0" /></a></td></tr>
			<?php
			
		}
    }
	else{
	?>
	<tr>
	<td colspan="7">
  <div align="center" style="padding:5px 5px 5px 5px"> <?php echo "No Booking Information Found";?></div>
   </td></tr>
    <?php
	}
	?> </table>
          
             
				﻿</div> <!-- for AJAX -->
			</div>
