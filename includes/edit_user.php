<?php
$objReg 		= new Register;
$file_path="documents/";
function genRandom($char = 5){
	$md5 = md5(time());
	return substr($md5, rand(5, 25), $char);
}
function getExtention($type){
	if($type == "image/jpeg" || $type == "image/jpg" || $type == "image/pjpeg")
		return "jpg";
	elseif($type == "image/png")
		return "png";
	elseif($type == "image/gif")
		return "gif";
	elseif($type == "application/pdf")
		return "pdf";
	elseif($type == "application/msword")
		return "doc";
	elseif($type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
		return "docx";
	elseif($type == "text/plain")
		return "doc";
		
}
$mode	= "I";
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$flag 		= true;
	$first_name = trim($_POST['first_name']);
	$last_name= trim($_POST['last_name']);
	$username 	= trim($_POST['username']);
	$email_old 	= trim($_POST['email_old']);
	$email 		= trim($_POST['email']);
	$address= trim($_POST["address"]);
	$phone 		= trim($_POST['phone']);
	$cnic_no 		= trim($_POST['cnic_no']);
	$user_type=3;
	$mode 		= trim($_POST['mode']);
	$password=rand(100000,1000000);
	$user_cd = ($mode == "U") ? $_POST['user_cd'] : $objReg->genCode(" mis_tbl_users", "user_cd");
	
	
	$old_al_file= $_POST["old_al_file"];
if(isset($_FILES["al_file"]["name"])&&$_FILES["al_file"]["name"]!="")
	{
		
		if($old_al_file){
			if(isset($_FILES["al_file"]["name"])&&$_FILES["al_file"]["name"]!="")
			{			
				@unlink($file_path . $old_al_file);
			}
		}
	$extension=getExtention($_FILES["al_file"]["type"]);
	 $file_name=genRandom(5)."-".$user_cd. ".".$extension;
   
	if(($_FILES["al_file"]["type"] == "application/pdf")|| 
	($_FILES["al_file"]["type"] == "application/msword") || 
	($_FILES["al_file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")||
	($_FILES["al_file"]["type"] == "text/plain") || 
	($_FILES["al_file"]["type"] == "image/jpg")|| 
	($_FILES["al_file"]["type"] == "image/jpeg")|| 
	($_FILES["al_file"]["type"] == "image/gif") || 
	($_FILES["al_file"]["type"] == "image/png"))
	{ 
	$target_file=$file_path.$file_name;
	move_uploaded_file($_FILES['al_file']['tmp_name'],$target_file);
	}
	
	 $upload_cnic= $file_name;
	}
	else
	{
		  $upload_cnic= $old_al_file;
	 }
	 
	 
	 $old_al_file1= $_POST["old_al_file1"];
if(isset($_FILES["al_file1"]["name"])&&$_FILES["al_file1"]["name"]!="")
	{
		
		if($old_al_file1){
			if(isset($_FILES["al_file1"]["name"])&&$_FILES["al_file1"]["name"]!="")
			{			
				@unlink($file_path . $old_al_file1);
			}
		}
	$extension=getExtention($_FILES["al_file1"]["type"]);
	 $file_name1=genRandom(5)."-".$user_cd. ".".$extension;
   
	if(($_FILES["al_file1"]["type"] == "application/pdf")|| 
	($_FILES["al_file1"]["type"] == "application/msword") || 
	($_FILES["al_file1"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")||
	($_FILES["al_file1"]["type"] == "text/plain") || 
	($_FILES["al_file1"]["type"] == "image/jpg")|| 
	($_FILES["al_file1"]["type"] == "image/jpeg")|| 
	($_FILES["al_file1"]["type"] == "image/gif") || 
	($_FILES["al_file1"]["type"] == "image/png"))
	{ 
	$target_file=$file_path.$file_name1;
	move_uploaded_file($_FILES['al_file1']['tmp_name'],$target_file);
	}
	
	$upload_pic= $file_name1;
	}
	else
	{
		 $upload_pic= $old_al_file1;
	 }
	
	
	
	
	
	if($mode=="I")
			{
	
	# Check user name should not be same.
	$sqlCN="select username from  mis_tbl_users where username='$username' ";		
	$sqlrCN=$objDb->dbQuery($sqlCN);
	if($objDb->totalRecords()>=1)
	{
	$flag 	= false;
			$objCommon->setMessage("User Name already exist",'Error');
	}
	# Check whether the email address is changed.
	if($email_old != $email){
		$objReg->setProperty("email", $email);
		$objReg->checkAdminEmailAddress();		
		if($objReg->totalRecords() >= 1){
			$flag 	= false;
			$objCommon->setMessage("Email already exist.",'Error');
		}
	}
	
	}
	if($flag != false){
		
		
		$objReg->resetProperty();
		$objReg->setProperty("user_cd", $user_cd);
		$objReg->setProperty("first_name", $first_name);
		$objReg->setProperty("last_name", $last_name);
		$objReg->setProperty("username", $username);
		$objReg->setProperty("passwd", $password);
		$objReg->setProperty("email", $email);
		$objReg->setProperty("address", $address);
		$objReg->setProperty("phone", $phone);
		$objReg->setProperty("cnic_no", $cnic_no);
		$objReg->setProperty("user_type", $user_type);
		$objReg->setProperty("upload_cnic", $upload_cnic);
		$objReg->setProperty("upload_pic", $upload_pic);
		
		if($objReg->actRegister($_POST['mode'])){
			
			
			
			
			
			
			
			

			
			$objCommon->setMessage("User updated Successfully.",'Error');	
			
			//	redirect('./?page=dealers');
			
				

		}
	}
	extract($_POST);
}
else{
if(isset($_GET['user_cd']) && !empty($_GET['user_cd']))
	{	
	 $user_cd = $_GET['user_cd'];
	if(isset($user_cd) && !empty($user_cd)){
		$objReg->setProperty("user_cd", $user_cd);
		$objReg->lstRegister();
		$data = $objReg->dbFetchArray(1);
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
          						
        					</div>
                        </div>
								<?php
                                //$copmany_sql = "select * from tbl_carcompany";
                               // $company_result = $objSDb->dbQuery($copmany_sql);
								echo "<h2>Registration Form:</h2>";
								
								?>
                              
                               <h3 style=" color:#F00; text-align:center"> <?php echo $objCommon->displayMessage();?></h3>
                               
                              <form name="frmProfile" id="frmProfile" action="" method="post" onSubmit="return frmValidate(this);" enctype="multipart/form-data">
        <input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
        <input type="hidden" name="user_cd" id="user_cd" value="<?php echo $user_cd;?>" />
            <div class="row" >

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "First Name";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text"  placeholder="First Name..." style="font-size: small;" name="first_name" id="first_name" value="<?php echo 
			$first_name;?>" required>
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Last Name";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Last Name..." style="font-size: small;" name="last_name" id=
			"last_name" value="<?php echo $last_name;?>" required>
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
                        <input class="form-control" type="text" placeholder="User Name..." style="font-size: small;" name="username" id="username"
			 value="<?php echo $username;?>" <?php if($mode=='U'){?> readonly=""<?php } ?> required>
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
                    <input class="form-control" type="text"  required placeholder="E-mail@email.com" style="font-size: small;" name="email" id="email" value="<?php echo $email;?>" 
		 <?php if($mode=='U'){?> readonly=""<?php } ?> >
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
                <input class="form-control" required  type="text" placeholder="Address..." style="font-size: small;" name="address" id="address" value="<?php echo $address;?>">
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
                <input class="form-control" type="text" placeholder="Phone..." style="font-size: small;" name="phone" id="phone" value
			="<?php echo $phone;?>" required >
               </div> 

               <div class="col-md-3">
            </div>  

        </div>
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php echo "CNIC No";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small; ">
                <input class="form-control" required  type="text" placeholder="CNIC No...." style="font-size: small;" name="cnic_no" id="cnic_no" value
			="<?php echo $cnic_no;?>">
               </div> 

               <div class="col-md-3">
            </div>  

        </div>
        
       <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo 'Upload CNIC';?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="file" name="al_file" id="al_file"  style="font-size: small;"  >
                        <input type="hidden" name="old_al_file" value="<?php echo $upload_cnic;?>" /><span style="color:green">Upload CNIC in any format: PDF, Word, JPEG, PNG</span>
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
             <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo 'Profile Pic';?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="file" name="al_file1" id="al_file1"  style="font-size: small;" >
                        <input type="hidden" name="old_al_file1" value="<?php echo $upload_pic;?>" /><span style="color:green">Profile PIC in jpeg and png</span>
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
                <input type="button" class="btn btn-danger mb-2" style="font-size: 13px;" value="Cancel" onClick="document.location='index.php';">
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        </form>     
				﻿</div> <!-- for AJAX -->
			</div>
