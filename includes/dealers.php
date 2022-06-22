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
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Manage Dealers and Car Companies</label>
        					</div>
                        </div>
								<?php
                               
								echo "<h1>Registered Car Companies and Dealers</h1>";
								?>
                                  <h3 style=" color:#F00; text-align:center"> <?php echo $objCommon->displayMessage();?></h3>
                               <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a  href="index.php?page=new_dealer" class="button" >Add Dealer
                               </a></div>
                              
                               
            <table id="customers" class="table" style="font-size: small;">
             <thead>
        <tr class="">
                
         <th scope="col" class="semibold"><?php echo "Owner Name";?></th>
		<th scope="col" class="semibold"><?php echo "Company";?></th>
        <th scope="col" class="semibold"><?php echo "Email";?></th>
        <th scope="col" class="semibold"><?php echo "Mobile";?></th>
        <th scope="col" class="semibold"><?php echo "Account";?></th>
         <th scope="col" class="semibold"><?php echo "Status";?></th>
		<th scope="col" class="semibold" style="text-align:center">Action</th>
		</tr>
         </thead>
		<?php
	//$objAdminUser->setProperty("ORDER BY", "a.first_name");
	//$objDealer->setProperty("limit", PERPAGE);
	//$objDealer->setProperty("GROUP BY", "cms_cd");

	if($objDealer->totalRecords() >= 1){
		$sno = 1;
		while($rows = $objDealer->dbFetchArray(1)){
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			?>
			<!-- Start Your Php Code her For Display Record's -->
			<tr style="background-color:<?php echo $bgcolor;?>">
				<td><?php echo $rows['owner_name'];?></td>
                <td><?php echo $rows['company_name'];?></td>
                <td><?php echo $rows['email'];?></td>
                <td><?php echo $rows['mobile_no'];?></td>
                <td><?php echo $rows['account_detail'];?></td>
                 <td><?php if($rows['verifying_status']=='Y') echo "Approved"; else echo "Not Approved";?></td>
               <td style="text-align:right"><a href="index.php?page=new_dealer_doc&mode=add&cc_id=<?php echo $rows['cc_id'];?>" style="text-decoration:none"title="Add Doc"><img src="images/Folder-Edit-icon.png" border="0" /></a> | <a href="index.php?page=new_dealer&mode=edit&cc_id=<?php echo $rows['cc_id'];?>" style="text-decoration:none"title="Edit"><img src="images/iconedit.png" border="0" /></a> | <a onClick="return confirm('Are you sure to delete this Dealer?');" href="./?page=dealers&mode=delete&cc_id=<?php echo $rows['cc_id'];?>" style="text-decoration:none" title="Delete"><img src="images/icondelete.png" border="0" /></a></td></tr>
			<?php
			
		}
    }
	else{
	?>
	<tr>
	<td colspan="7">
  <div align="center" style="padding:5px 5px 5px 5px"> <?php echo "No Dealer Information Found";?></div>
   </td></tr>
    <?php
	}
	?> </table>
          
             
				﻿</div> <!-- for AJAX -->
			</div>
