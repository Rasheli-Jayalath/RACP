<?php

$objDb		= new Database;
$objDealer		= new Dealer;

$mode	= "I";
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$flag 		= true;
	$owner_name = trim($_POST['owner_name']);
	$userName= trim($_POST['userName']);
	$company_name 	= trim($_POST['company_name']);
	$password 	= trim($_POST['password']);
	$email_old 	= trim($_POST['email_old']);
	$email 		= trim($_POST['email']);
	$address= trim($_POST["address"]);
	$mobile_no 		= trim($_POST['mobile_no']);
	$mode 		= trim($_POST['mode']);
	$account_detail= trim($_POST['account_detail']);
	if(isset($_POST['verifying_status'])&&$_POST['verifying_status']!="")
	 $verifying_status= trim($_POST['verifying_status']);
	
	if(empty($owner_name)){
		$flag 	= false;
		$objCommon->setMessage(USER_FLD_MSG_FIRSTNAME,'Error');
	}
	if(empty($company_name)){
		$flag 	= false;
		$objCommon->setMessage(USER_FLD_MSG_LASTNAME,'Error');
	}
	if($mode=="I")
			{
	if(empty($userName)){
		$flag 	= false;
		$objCommon->setMessage("User Name is a Required field",'Error');
	}
	if(empty($email)){
		$flag 	= false;
		$objCommon->setMessage(USER_FLD_MSG_EMAIL,'Error');
	}
	/*if(!$objValidate->checkEmail($email)){
		$flag 	= false;
		$objCommon->setMessage(USER_FLD_MSG_INVALID_EMAIL,'Error');
	}*/
	# Check user name should not be same.
	$sqlCN="select userName from tbl_carcompany where userName='$userName' ";		
	$sqlrCN=$objDb->dbQuery($sqlCN);
	if($objDb->totalRecords()>=1)
	{
	$flag 	= false;
			$objCommon->setMessage("User Name already exist",'Error');
	}
	# Check whether the email address is changed.
	if($email_old != $email){
		$objDealer->setProperty("email", $email);
		$objDealer->checkAdminEmailAddress();		
		if($objDealer->totalRecords() >= 1){
			$flag 	= false;
			$objCommon->setMessage("Email already exist.",'Error');
		}
	}
	
	}
	if($flag != false){
		$cc_id = ($mode == "U") ? $_POST['cc_id'] : 
		$objDealer->genCode("tbl_carcompany", "cc_id");
		
		$objDealer->resetProperty();
		$objDealer->setProperty("cc_id", $cc_id);
		$objDealer->setProperty("userName", $userName);
		$objDealer->setProperty("password", $password);
		$objDealer->setProperty("owner_name", $owner_name);
		$objDealer->setProperty("account_detail", $account_detail);
		$objDealer->setProperty("company_name", $company_name);
		$objDealer->setProperty("email", $email);
		$objDealer->setProperty("mobile_no", $mobile_no);
		$objDealer->setProperty("address", $address);
		$objDealer->setProperty("verifying_status", $verifying_status);
		$objDealer->setProperty("verifying_status", $verifying_status);
		if($objDealer->actDealer($_POST['mode'])){
			
			if($mode='I')
			{
			$user_sql="INSERT INTO mis_tbl_users (username,passwd,first_name,email,phone,user_type,is_active) VALUES('".$userName."', '".$password."', '".$owner_name."', '".$email."' , '".$mobile_no."' ,"."2".","."1)";
			$objDb->dbQuery($user_sql);
			}
			/*else
			{
				$user_sql="UPDATE  mis_tbl_users SET  username='".$userName."', passwd='".$password."', first_name='".$owner_name."', email='".$email."' , phone='".$mobile_no."' ,"."user_type=2".","."is_active=1";
			$objDb->dbQuery($user_sql);
			}*/
				
				redirect('./?page=dealers');
			
				

		}
	}
	extract($_POST);
}
else{
if(isset($_GET['cc_id']) && !empty($_GET['cc_id']))
	{	
	 $cc_id = $_GET['cc_id'];
	if(isset($cc_id) && !empty($cc_id)){
		$objDealer->setProperty("cc_id", $cc_id);
		$objDealer->lstDealers();
		$data = $objDealer->dbFetchArray(1);
		$mode	= "U";
		extract($data);

	}
	}
	
}
?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"> 
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Add New Dealer</label>
        					</div>
                        </div>
								<?php
                                $copmany_sql = "select * from tbl_carcompany";
                                $company_result = $objSDb->dbQuery($copmany_sql);
								echo "<h1>New Dealer's Detail</h1>";
								?>
                               <h3 style=" color:#F00; text-align:center"> <?php echo $objCommon->displayMessage();?></h3>
                               <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a  href="index.php?page=dealers" class="button" >Back</a></div>
                              <form name="frmProfile" id="frmProfile" action="" method="post" onSubmit="return frmValidate(this);">
        <input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
        <input type="hidden" name="cc_id" id="cc_id" value="<?php echo $cc_id;?>" />
            <div class="row" >

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Owner Name";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Owner Name..." style="font-size: small;" name="owner_name" id="owner_name" value="<?php echo 
			$owner_name;?>">
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Company Name";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Company Name..." style="font-size: small;" name="company_name" id=
			"company_name" value="<?php echo $company_name;?>">
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "User Name";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="User Name..." style="font-size: small;" name="userName" id="userName"
			 value="<?php echo $userName;?>" <?php if($mode=='U'){?> readonly=""<?php } ?>>
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
           
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Password";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Password..." style="font-size: small;"  name="password" id="password" 
			value="<?php echo $password;?>" >
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
        
            
            
           

            <div class="row" style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                  <label  class="sr-only semibold"><?php echo "Email";?>:</label>
                  </div>

                <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                <input type="hidden" name="email_old" id="email_old" value="<?php 
			echo $email;?>" />
                    <input class="form-control" type="text" placeholder="E-mail@email.com" style="font-size: small;" name="email" id="email" value="<?php echo $email;?>" 
		 <?php if($mode=='U'){?> readonly=""<?php } ?>>
                   </div>  
                   
                   <div class="col-md-3">
                </div>

        </div>

        

        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold">Address:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small; ">
                <input class="form-control" type="text" placeholder="Address..." style="font-size: small;" name="address" id="address" value="<?php echo $address;?>">
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php echo "Mobile";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small; ">
                <input class="form-control" type="text" placeholder="Phone..." style="font-size: small;" name="mobile_no" id="mobile_no" value
			="<?php echo $mobile_no;?>">
               </div> 

               <div class="col-md-3">
            </div>  

        </div>
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php echo "Bank Account Detail";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small; ">
                <input class="form-control" type="text" placeholder="Account Detail..." style="font-size: small;" name="account_detail" id="account_detail" value
			="<?php echo $account_detail;?>">
               </div> 

               <div class="col-md-3">
            </div>  

        </div>
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php 
			echo "Verification Status";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
            <input type="radio" id="verifying_status" name="verifying_status" value="Y" checked="checked"/>
			 Approved 
			  <input type="radio" 
			 id="verifying_status" name="verifying_status" value="N" <?php echo ($verifying_status=='N') ? 'checked="checked"' : "";?>/>
			Not Approved
           
			
               </div>   

               <div class="col-md-3">
            </div>

        </div>


         <!-- Update Button -->
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3">
            </div>

            <div class="col-md-4 regular" style="font-size: small;text-align: left;">
                <input type="submit" class="btn btn-warning mb-2" style="font-size: 13px;" value="<?php echo ($mode == "U") ? " Update " : " Save ";?>" />
                <input type="button" class="btn btn-danger mb-2" style="font-size: 13px;" value="Cancel" onClick="document.location='?page=dealers';">
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        </form>     
				﻿</div> <!-- for AJAX -->
			</div>
