<?php 
$pathimage="Documents/";
$car_id=$_GET['car_id'];?>
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Manage Cars</label>
        					</div>
                        </div>
								<?php
                                $car_sql = "select * from tbl_car where car_id=$car_id";
                                $car_result = $objSDb->dbQuery($car_sql);
								echo "<h1>Detail</h1>";
								?>
                                <div style="text-align: right; margin-bottom: 20px; margin-right:15px">
                                 <?php if ($objAdminUser->user_type==1 || $objAdminUser->user_type==2)
	   {?>
                                   <a href="index.php?page=cars" class="button"><i class="bi bi-plus-square" style="margin-right: 10px;"></i>Manage Cars</a>
                                   <?php
	   }?>
               <a href="index.php?page=car_booking&car_id=<?php echo $_REQUEST["car_id"];?>" class="button"><i class="bi bi-plus-square" style="margin-right: 10px;"></i>Book Now</a>
                             </div>  
                                <?php
								 while($car_data = $objSDb->dbFetchArray())
								 {
									 ?>
									 <table width=100%  style='border-color:#000;' cellspacing="10px" >
                               <tr><td width="15%" align="left" style="font-weight:bold">Car Model:</td><td width="85%" align="left"><?php echo $car_data['car_model'];?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Car Description:</td><td width="85%" align="left"><?php echo $car_data['car_description'];?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Plate #:</td><td width="85%" align="left"><?php echo $car_data['car_plateno'];?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Air Conditioned:</td><td width="85%" align="left"><?php echo $car_data['air_conditioned'];?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">No. of Seats:</td><td width="85%" align="left"><?php echo $car_data['no_seats'];?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Car Price Perday:</td><td width="85%" align="left"><?php echo $car_data['car_price_perday'];?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Car Price Without Driver:</td><td width="85%" align="left"><?php echo $car_data['car_price_without_driver'];?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Pickup Location:</td><td width="85%" align="left"><?php echo $car_data['pickup_location'];?></td></tr>
                               
                               <tr><td width="15%" align="left" style="font-weight:bold">Image1:</td><td width="85%" align="left"><img src="<?php echo $pathimage.$car_data['image1'];?>" width="400px"/></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Image2:</td><td width="85%" align="left"><img src="<?php echo $pathimage.$car_data['image2'];?>" width="400px"/></td></tr>
                               
                              
                               
                               
                               
                               
                               </table>
                               <?php
								 }
								?>
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
