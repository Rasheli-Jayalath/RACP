<?php
$objDb		= new Database;
$objReg		= new Register;
$objRegD		= new Register;
if(!empty($_GET['search_by'])){
	$search_by = urldecode($_GET['search_by']);
	$search_value = urldecode($_GET['search_value']);
	if($search_by=="first_name")
	{
	$objReg->setProperty("first_name", strtolower($search_value));
	}
	if($search_by=="last_name")
	{
	$objReg->setProperty("last_name", strtolower($search_value));
	}
	if($search_by=="username")
	{
	$objReg->setProperty("username", strtolower($search_value));
	}
	if($search_by=="phone")
	{
	$objReg->setProperty("phone", strtolower($search_value));
	}if($search_by=="cnic_no")
	{
	$objReg->setProperty("cnic_no", strtolower($search_value));
	}
	if($search_by=="email")
	{
	$objReg->setProperty("email", strtolower($search_value));
	}
	if($search_by=="address")
	{
	$objReg->setProperty("address", strtolower($search_value));
	}
}
if(!empty($_GET['search_value'])){
	$search_value = urldecode($_GET['search_value']);
	$objReg->setProperty("search_value", strtolower($search_value));
}
?>

 <script type="text/javascript">
function doFilter(frm){
	var qString = '';
	if(frm.search_value.value=='')
	{
	alert("Please enter search value");
	}
	else
	{
	if(frm.search_by.value == "first_name"){
		qString += '&search_by=first_name&search_value=' + escape(frm.search_value.value);
	}
	if(frm.search_by.value == "last_name"){
		qString += '&search_by=last_name&search_value=' + escape(frm.search_value.value);
	}
	if(frm.search_by.value == "username"){
		qString += '&search_by=username&search_value=' + escape(frm.search_value.value);
	}
	if(frm.search_by.value == "phone"){
		qString += '&search_by=phone&search_value=' + escape(frm.search_value.value);
	}
	if(frm.search_by.value == "cnic_no"){
		qString += '&search_by=cnic_no&search_value=' + escape(frm.search_value.value);
	}
	if(frm.search_by.value == "email"){
		qString += '&search_by=email&search_value=' + escape(frm.search_value.value);
	}
	if(frm.search_by.value == "address"){
		qString += '&search_by=address&search_value=' + escape(frm.search_value.value);
	}
	document.location = '?page=users' + qString;
	}
}
</script>
 
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<?php


if($_GET['mode'] == 'delete'){
	$objRegD->setProperty('user_cd', $_GET['user_cd']);
	 	
	$objRegD->actRegister('D');
	
	$objCommon->setMessage('User deleted successfully!', 'Info');
	
		
	redirect('./?page=users');
}
		
		
	
?> <link href="../css/table-styling.css" rel="stylesheet">
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Manage Users</label>
        					</div>
                        </div>
                        
								<?php
                               
								echo "<h1>Registered Users</h1>";
								?>
                                <form name="frmCustomer" id="frmCustomer" class="form-inline">

                                <div  >
        <div class="row">

            
                    <div class="col-md-3 regular" style="text-align: right; margin: auto; font-size: small;">
                      <label  class="sr-only">Search By</label>
                      </div>

                    <div class=" col-md-3 regular" style="text-align: center; margin: auto; margin-top: 10px;">
                        <select class="form-select" style="font-size: small;" name="search_by" >
							<option value="first_name" selected>  First Name  </option>
							<option value="last_name" >           Last Name   </option>
                            <option value="username" >           User Name   </option>
							<option value="phonr" >             Mobile #    </option>
							<option value="cnic_no" >           CNIC    </option>
			 				<option value="email">               Email       </option>
			 				<option value="address">             Address     </option>
                          </select>
                    </div>

                    <div class=" col-md-3 regular" style="text-align: center; margin: auto; margin-top: 10px;">
                        <input type="text" style="font-size: small;" class="form-control" id="search_value" placeholder="Enter" name="search_value" value="" >
                      </div>

                    <div class=" col-md-3 regular" style="text-align: left;  margin-top: 8px;">
                        <button type="button" onClick="doFilter(this.form);" class="btn btn-primary mb-2 commontextsize" name="Submit" id="Submit"><i class="bi bi-search" style="margin-right: 10px;"></i>Search</button>
                      </div>

        </div>

    </div>
    </form>
                                
                                  <h3 style=" color:#F00; text-align:center"> <?php echo $objCommon->displayMessage();?></h3>
<!--                               <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a  href="index.php?page=new_dealer" class="button" >Add Dealer
                               </a></div>-->

                    <?php if(isset($_REQUEST['search_by']) && isset($_REQUEST['search_value']))
		{
		?>
		<p style="margin-left:10px;"><b>Search Results of:</b> <?php echo $_REQUEST['search_value']; ?></p>
		<?php
		}?>          
                               
            <table id="customers" class="table" style="font-size: small;">
             <thead>
             
        <tr class="">
                
         <th scope="col" class="semibold"><?php echo "User Name";?></th>
		<th scope="col" class="semibold"><?php echo "First Name";?></th>
        <th scope="col" class="semibold"><?php echo "Last Name";?></th>
        <th scope="col" class="semibold"><?php echo "Email";?></th>
        <th scope="col" class="semibold"><?php echo "Mobile";?></th>
        <th scope="col" class="semibold"><?php echo "CNIC #";?></th>
         
		<th scope="col" class="semibold" style="text-align:center">Action</th>
		</tr>
         </thead>
		<?php
	//$objAdminUser->setProperty("ORDER BY", "a.first_name");
	//$objDealer->setProperty("limit", PERPAGE);
	//$objDealer->setProperty("GROUP BY", "cms_cd");
		$objReg->setProperty("user_type", '3');
		$objReg->lstSearchUser();
	if($objReg->totalRecords() >= 1){
		$sno = 1;
		while($rows = $objReg->dbFetchArray(1)){
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			?>
			<!-- Start Your Php Code her For Display Record's -->
			<tr style="background-color:<?php echo $bgcolor;?>">
				<td><?php echo $rows['username'];?></td>
                <td><?php echo $rows['first_name'];?></td>
                <td><?php echo $rows['last_name'];?></td>
                <td><?php echo $rows['email'];?></td>
                <td><?php echo $rows['phone'];?></td>
                <td><?php echo $rows['cnic_no'];?></td>
                
               
               <td style="text-align:right"><a href="index.php?page=see_profile&user_cd=<?php echo $rows['user_cd'];?>" style="text-decoration:none"title="Add Doc"><img src="images/see_detail.png" border="0" height="25px" width="25px" /></a> | <a href="index.php?page=edit_user&mode=edit&user_cd=<?php echo $rows['user_cd'];?>" style="text-decoration:none"title="Edit"><img src="images/iconedit.png" border="0" /></a> | <a onClick="return confirm('Are you sure to delete this User?');" href="./?page=users&mode=delete&user_cd=<?php echo $rows['user_cd'];?>" style="text-decoration:none" title="Delete"><img src="images/icondelete.png" border="0" /></a></td></tr>
			<?php
			
		}
    }
	else{
	?>
	<tr>
	<td colspan="7">
  <div align="center" style="padding:5px 5px 5px 5px"> <?php echo "No User Information Found";?></div>
   </td></tr>
    <?php
	}
	?> </table>
          
             
				﻿</div> <!-- for AJAX -->
			</div>
