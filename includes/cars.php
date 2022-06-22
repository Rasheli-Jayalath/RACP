<?php 
$objDb= new Database;
$objDb1= new Database;		
if($_GET['mode'] == 'Delete')
{
	$car_id = $_GET['car_id'];
	
	$objCar->setProperty("car_id", $car_id);
	$objCar->actCar('D');
	$objCommon->setMessage('Car deleted successfully.', 'Error');
	
	
}
if($objAdminUser->user_type==2)
{
	  $username= $objAdminUser->username;
	
	 $car_sq2 = "select cc_id,company_name from tbl_carcompany where userName='$username'";
            $car_result2 = $objDb->dbQuery($car_sq2);
			$car_data2 = $objDb->dbFetchArray();
			 $company_name=$car_data2['company_name'];
			  $cc_id=$car_data2['cc_id'];
			 $objCar->setProperty("cc_id", $cc_id);
}
if(isset($_GET['cc_id']))
{
	$cc_id=$_GET['cc_id'];
	 $objCar->setProperty("cc_id", $cc_id);
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_REQUEST["go_submit"])){
$cc_id = $_POST['cc_id'];
if($cc_id=='0')
{
header('Location:index.php?page=cars');
}
else
{
header('Location:index.php?page=cars&cc_id='.$cc_id);
}
}


?>
<script>
function doConfirm(msg){
	if(confirm(msg)){
		return true;	
	}
	else{
		return false;
	}
}
</script>
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">            
            
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Manage Cars</label>
        					</div>
                        </div>
								<?php
                               
								echo "<h1>Registered Cars</h1>";
								?>
                                 <?php if ($objAdminUser->user_type==1 || $objAdminUser->user_type==2)
	   {?>
                               <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a  href="index.php?page=new_car" class="button" >Add Car
                               </a></div>
                               <?php
	   }
	   ?>
                              
           <form name="filter_1" id="filter_1" method="post" action="?page=cars&cc_id=<?php echo $_GET['cc_id']?>" align="right"> 
<select  name="cc_id" id="cc_id" class="" <?php if($objAdminUser->user_type==2) { echo "disabled"; }?> >
 
  		<option value="0" <?php if(!isset($_GET['cc_id']))echo "selected";?>>All  Dealers</option>
      <?php  $car_sql_3 = "select cc_id,company_name from tbl_carcompany";
            $car_result_3 = $objDb1->dbQuery($car_sql_3);
			while($car_data1_3 = $objDb1->dbFetchArray())
			{
				echo $cc_idd=$car_data1_3['cc_id'];
				$company_name=$car_data1_3['company_name'];
				?>
                <option value="<?php echo $cc_idd;?>" <?php if($cc_idd==$cc_id) { echo "selected"; }?>><?php echo $company_name;?></option>
                <?php
			}
			 ?>
        
       
		
</select>
		
		<button type="submit" form="filter_1" name="go_submit" id="go_submit" value="GO" class="button-33 " style="padding-top: 2px; padding-bottom: 3px; border-radius: 0; margin-right:1%;"> Go </button></form>                    
            <table id="customers" class="table" style="font-size: small;">
             <thead>
        <tr class="">
                
         <th scope="col" class="semibold"><?php echo "Car Name";?></th>
          <th scope="col" class="semibold"><?php echo "Dealer Name";?></th>
		<th scope="col" class="semibold"><?php echo "Model";?></th>
        <th scope="col" class="semibold"><?php echo "Plate #";?></th>
        <th scope="col" class="semibold"><?php echo "Air Conditioned";?></th>
        <th scope="col" class="semibold"><?php echo "Price per Day <br/> With Driver";?></th>
         <th scope="col" class="semibold"><?php echo "Price per Day<br/> Without Driver";?></th>
		<th scope="col" class="semibold" style="text-align:center">Action</th>
		</tr>
         </thead>
		<?php
	//$objAdminUser->setProperty("ORDER BY", "a.first_name");
	//$objDealer->setProperty("limit", PERPAGE);
	//$objDealer->setProperty("GROUP BY", "cms_cd");
	$objCar->lstCar();
	 $objCar->totalRecords();
	if($objCar->totalRecords() >= 1){
		$sno = 1;
		while($rows = $objCar->dbFetchArray(1)){
			 $cc_id=$rows['cc_id'];
			 $car_sql = "select company_name from tbl_carcompany where cc_id=".$cc_id;
            $car_result = $objSDb->dbQuery($car_sql);
			$car_data1 = $objSDb->dbFetchArray();
			
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			?>
			<!-- Start Your Php Code her For Display Record's -->
			<tr style="background-color:<?php echo $bgcolor;?>">
				<td><?php echo $rows['car_name'];?></td>
                <td><?php echo $car_data1['company_name'];?></td>
                <td><?php echo $rows['car_model'];?></td>
                <td><?php echo $rows['car_plateno'];?></td>
                <td><?php echo $rows['air_conditioned'];?></td>
                 <td><?php echo $rows['car_price_perday'];?></td>
                <td><?php echo $rows['car_price_without_driver'];?></td>
                  <?php if ($objAdminUser->user_type==1 || $objAdminUser->user_type==2)
	   {?>
               <td style="text-align:right"><a href="index.php?page=car_detail&car_id=<?php echo $rows['car_id'];?>" style="text-decoration:none"title="See Detail"><img src="images/see_detail.png" border="0" width="25px" height="25px" /></a> |<a href="index.php?page=car_docs&mode=add&car_id=<?php echo $rows['car_id'];?>" style="text-decoration:none"title="Add Doc"><img src="images/Folder-Edit-icon.png" border="0" width="25px" height="25px" /></a> | <a href="index.php?page=new_car&mode=edit&car_id=<?php echo $rows['car_id'];?>" style="text-decoration:none"title="Edit"><img src="images/iconedit.png" border="0" /></a> | <a onClick="return confirm('Are you sure to delete this Car Documents?');" href="./?page=cars&mode=delete&car_id=<?php echo $rows['car_id'];?>" style="text-decoration:none" title="Delete"><img src="images/icondelete.png" border="0" /></a></td></tr>
			<?php
	   }
	   else
	   {
		   ?>
                          <td style="text-align:right"><a href="index.php?page=car_detail&car_id=<?php echo $rows['car_id'];?>" style="text-decoration:none"title="See Detail"><img src="images/see_detail.png" border="0" width="25px" height="25px" /></a> |                <a href="index.php?page=car_booking&car_id=<?php echo $rows["car_id"];?>" class="button"><i class="bi bi-plus-square" style="margin-right: 10px;"></i>Book Now</a>
 </td></tr>

           <?php
	   }
			
		}
    }
	else{
	?>
	<tr>
	<td colspan="7">
  <div align="center" style="padding:5px 5px 5px 5px"> <?php echo "No Car Information Found";?></div>
   </td></tr>
    <?php
	}
	?> </table>
          
             
				﻿</div> <!-- for AJAX -->
			</div>
