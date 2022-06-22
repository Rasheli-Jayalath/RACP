<?php 
$objDb	= new Database;
$objBooking		= new Booking;
if(isset($_POST['user_cd']))
{
$user_cd=$_GET['user_cd'];
}
else
{
$user_cd=$objAdminUser->user_cd;
}

if(isset($_POST['save']))
{
	$b_id=$_POST['b_id'];
	$ride_completed=$_POST['ride_completed'];
	 $sql_b="update tbl_booking set ride_completed=$ride_completed where b_id=$b_id and b_status='Y'";
	$objDb->dbQuery($sql_b);
	redirect('./?page=bookings');
}

?>
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Manage Cars</label>
        					</div>
                        </div>
								<?php
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
		$ride_completed=$bdata["ride_completed"];
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
								echo "<h1>Detail</h1>";
								?>
                                <?php if ($objAdminUser->user_type==1 || $objAdminUser->user_type==2)
	   {?>
                                                               <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a href="index.php?page=users" class="button" >Back</a></div>
 
                                <?php
	   }
								
									 ?>
                                      <form name="frmProfile" id="frmProfile" action="" method="post" >
									 <table width=100%  style='border-color:#000;' cellspacing="10px" >
                               <tr><td width="15%" align="left" style="font-weight:bold">Car Name:</td><td width="85%" align="left"><?php echo $car_name;?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Model:</td><td width="85%" align="left"><?php echo $car_model?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Plate No.:</td><td width="85%" align="left"><?php echo $car_plateno?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Booking Date:</td><td width="85%" align="left"><?php echo $bookingDate;?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Return Date:</td><td width="85%" align="left"><?php echo $returnDate;?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Price:</td><td width="85%" align="left"><?php echo $total_amount?></td></tr>
                              
                               <tr><td width="15%" align="left" style="font-weight:bold">Ride Completed:</td><td width="85%" align="left">  <input type="radio" id="ride_completed" name="ride_completed" value="0" checked="checked"/>
                              No 
                                <input type="radio" 
                                 id="ride_completed" name="ride_completed" value="1" <?php echo ($ride_completed=='1') ? 'checked="checked"' : "";?>/>
                                 Yes</td></tr>
                                  <tr><td width="15%" align="left" style="font-weight:bold" colspan="2">
                                  <input  type="hidden" name="b_id" id="b_id" value="<?php echo $b_id;?>"/>
                                  <input type="submit" name="save" id="save" class="btn btn-warning mb-2" style="font-size: 13px;" value="<?php echo " Save ";?>" /></td></tr>

                              
                               
                               
                               
                               
                               </table>
                               </form>
                              
                              <?php /*?> <table width=100%  style='border-color:#000;' >
                               <tr><td width="15%" align="left">Car Name:</td><td width="85%" align="left"><?php echo $car_data['car_name'];?></td></tr>
                               </table>
                                <?php
                                echo "<table width=100% border = '1px' style='border-color:#000;' >";
                              
                                                              echo "<tr style='background-color:#006; color:white'><td>Sr#</td><td>Car Name</td><td>Model</td><td>Plate #</td><td>Air Conditioned</td><td>Price per Day<br/> With Driver</td><td>Price per Day<br/> Without Driver</td><td>Action</td></tr>";
  
                                $i==0;
                                while ($car_data = $objSDb->dbFetchArray()) {
									$i=$i+1;
                                echo "<tr><td>".$i."</td><td>".$car_data['car_name']."</td><td>".$car_data['car_model']."</td><td>".$car_data['car_plateno']."</td><td>".$car_data['air_conditioned']."</td><td>".$car_data['car_price_perday']."</td><td>".$car_data['car_price_without_driver']."</td><td>"?>
                                
                                <a href="index.php?page=car_detail&car_id=<?php echo $car_data['car_id']; ?>">See Detail </a> | <a href="index.php?page=car_docs&car_id=<?php echo $car_data['car_id']; ?>">Add Documents </a>| <a href="index.php?page=new_car&car_id=<?php echo $car_data['car_id']; ?>">Edit </a>| <a href="index.php?page=cars&car_id=<?php echo $car_data['car_id']; ?>&mode=Delete" onclick="return doConfirm('Are you sure you want to Delete this car and its documents?');">Delete</a>
                               <?php  echo "</td></tr>";	
                                }
                                echo "</table>";
                                ?>            <?php */?>            
				﻿</div> <!-- for AJAX -->
			</div>
