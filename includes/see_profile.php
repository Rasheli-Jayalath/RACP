<?php 
$pathimage="Documents/";
if(isset($_GET['user_cd']))
{
$user_cd=$_GET['user_cd'];
}
else
{
$user_cd=$objAdminUser->user_cd;
}?>
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Manage Cars</label>
        					</div>
                        </div>
								<?php
                                $u_sql = "select * from mis_tbl_users where user_cd=$user_cd";
                                $u_result = $objSDb->dbQuery($u_sql);
								echo "<h1>Profile</h1>";
								?>
                                <?php if ($objAdminUser->user_type==1 || $objAdminUser->user_type==2)
	   {?>
                                                               <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a href="index.php?page=users" class="button" >Back</a></div>
 
                                <?php
	   }
								 while($u_data = $objSDb->dbFetchArray())
								 {
									 ?>
									 <table width=100%  style='border-color:#000;' cellspacing="10px" >
                               <tr><td width="15%" align="left" style="font-weight:bold">First Name:</td><td width="85%" align="left"><?php echo $u_data['first_name'];?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Last Name:</td><td width="85%" align="left"><?php echo $u_data['last_name'];?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Username #:</td><td width="85%" align="left"><?php echo $u_data['username'];?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Email:</td><td width="85%" align="left"><?php echo $u_data['email'];?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Address:</td><td width="85%" align="left"><?php echo $u_data['address'];?></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">CNIC No.:</td><td width="85%" align="left"><?php echo $u_data['cnic_no'];?></td></tr>
                               
                               <tr><td width="15%" align="left" style="font-weight:bold">CNIC Pic:</td><td width="85%" align="left"><img src="<?php echo $pathimage.$u_data['upload_cnic'];?>" width="400px"/></td></tr>
                               <tr><td width="15%" align="left" style="font-weight:bold">Profile Pic:</td><td width="85%" align="left"><img src="<?php echo $pathimage.$u_data['upload_pic'];?>" width="400px"/></td></tr>
                               
                              
                               
                               
                               
                               
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
