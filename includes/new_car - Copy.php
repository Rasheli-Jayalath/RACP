<?php
$pathimage="Documents/";
$mode	= "I";
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$flag 		= true;
	$cc_id = trim($_POST['cc_id']);
	$car_name = trim($_POST['car_name']);
	$car_model= trim($_POST['car_model']);
	$car_description 	= trim($_POST['car_description']);
	$car_plateno 	= trim($_POST['car_plateno']);
	$air_conditioned 	= trim($_POST['air_conditioned']);
	$no_seats 		= trim($_POST['no_seats']);
	$car_price_perday= trim($_POST["car_price_perday"]);
	$car_price_without_driver 		= trim($_POST['car_price_without_driver']);
	$pickup_location 		= trim($_POST['pickup_location']);
	
	 $image1		=$_FILES['image1'];
		 $old_image1=trim($_POST['old_image1']);
		  $image2	=$_FILES['image2'];
		 $old_image2=trim($_POST['old_image2']);
		
	
	
	$mode 		= trim($_POST['mode']);
	/*$designation= trim($_POST['designation']);*/
	/*if(isset($_POST['user_type'])&&$_POST['user_type']!="")
	 $user_type= trim($_POST['user_type']);
	
	if(empty($first_name)){
		$flag 	= false;
		$objCommon->setMessage(USER_FLD_MSG_FIRSTNAME,'Error');
	}
	if(empty($last_name)){
		$flag 	= false;
		$objCommon->setMessage(USER_FLD_MSG_LASTNAME,'Error');
	}*/
	$flag 	== true;
	
	if($flag != false){
		$car_id = ($mode == "U") ? $_POST['car_id'] : 
		$objCar->genCode("tbl_car", "car_id");
		
		$objCar->resetProperty();
		$objCar->setProperty("car_id", $car_id);
		$objCar->setProperty("cc_id", $cc_id);
		$objCar->setProperty("car_name", $car_name);
		$objCar->setProperty("car_model", $car_model);
		/*$objAdminUser->setProperty("middle_name", $middle_name);*/
		$objCar->setProperty("car_description", $car_description);
		$objCar->setProperty("car_plateno", $car_plateno);
		$objCar->setProperty("air_conditioned", $air_conditioned);
		$objCar->setProperty("no_seats", $no_seats);
		$objCar->setProperty("car_price_perday", $car_price_perday);
		$objCar->setProperty("car_price_without_driver", $car_price_without_driver);
		$objCar->setProperty("pickup_location", $pickup_location);
		if(isset($_FILES["image1"]["name"])&&$_FILES["image1"]["name"]!="")
		{
			
		/* Upload the image File */
		import("Image");
		$objImage = new Image($pathimage);
		$objImage->setImage($image1);
		if(($_FILES["image1"]["type"] == "image/jpg")|| 
		($_FILES["image1"]["type"] == "image/jpeg")|| 
		($_FILES["image1"]["type"] == "image/gif") || 
		($_FILES["image1"]["type"] == "image/png"))
		{ # max allowable image size in mb
			
			if($old_image1){
					@unlink($pathimage . $old_image1);
						
					}
			if($objImage->uploadImage($car_id."_d".$cc_id)){
				
					echo $n_image1 = $objImage->filename;
					$objCar->setProperty("image1",$n_image1);
			}
		 }
			else
		 {
		 $objCommon->setMessage("Invalid file ", 'Error');
		 }
		 
		}
		
		if(isset($_FILES["image2"]["name"])&&$_FILES["image2"]["name"]!="")
		{
			
		/* Upload the image File */
		import("Image");
		$objImage = new Image($pathimage);
		$objImage->setImage($image2);
		if(($_FILES["image2"]["type"] == "image/jpg")|| 
		($_FILES["image2"]["type"] == "image/jpeg")|| 
		($_FILES["image2"]["type"] == "image/gif") || 
		($_FILES["image2"]["type"] == "image/png"))
		{ # max allowable image size in mb
			
			if($old_image2){
					@unlink($pathimage . $old_image2);
						
					}
			if($objImage->uploadImage($car_id."_d".$cc_id)){
				
					echo $n_image2 = $objImage->filename;
					$objCar->setProperty("image2",$n_image2);
			}
		 }
			else
		 {
		 $objCommon->setMessage("Invalid file ", 'Error');
		 }
		 
		}
		
		
		//$objAdminUser->setProperty("user_type", $user_type);
		if($objCar->actCar($_POST['mode'])){
			
			if($mode=="U")
			{
			$objCommon->setMessage("Car Updated Successfully",'Update');
				
			}
			else
			{
			
			$objCommon->setMessage("New Car added successfully",'Info');
				
			}
			
			
				redirect('index.php?page=cars');
				

		}
	}
	extract($_POST);
}
else{
if(isset($_GET['car_id']) && !empty($_GET['car_id']))
	{	
	 $car_id = $_GET['car_id'];
	if(isset($car_id) && !empty($car_id)){
		$objCar->setProperty("car_id", $car_id);
		$objCar->lstCar();
		$data = $objCar->dbFetchArray(1);
		$mode	= "U";
		extract($data);

	}
	}
	
}
echo "ghgh";
?>



<style>
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
   <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <!--   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link href="../css/styleN.css" rel="stylesheet">-->
    
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Add New Dealer</label>
        					</div>
                        </div>
								<?php
                               
								echo "<h1>Cars Detail</h1>";
								?>
                               <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a href="index.php?page=cars" class="button" >Back</a></div>
                              <form name="frmProfile" id="frmProfile" action="" method="post" onSubmit="return frmValidate(this);" enctype="multipart/form-data">
        <input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
        <input type="hidden" name="car_id" id="car_id" value="<?php echo $car_id;?>" />
        
        
        <div class="row" >

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Select Dealer";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                       <!-- <input class="form-control" type="text" placeholder="Car Name..." style="font-size: small;" name="car_name" id="car_name" value="<?php echo 
			$car_name;?>">-->
             <select name="cc_id" id="cc_id" class="form-select">
             <option value="0" selected>--select---</option>
             <?php
                               echo  $copmany_sql = "select cc_id, company_name from tbl_carcompany";
                                $company_result = $objSDb->dbQuery($copmany_sql);
								while($result_d=$objSDb->dbFetchArray())
								{
									echo $cc_id1=$result_d['cc_id'];
									echo $company_name=$result_d['company_name'];
								?>

			
			<option value="<?php echo $cc_id1;?>" <?php if($cc_id1==$cc_id){ echo "selected";}?>> <?php echo $company_name;?></option>
			
            <?php
								}
								?>
		</select>
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row" style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Car Name";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Car Name..." style="font-size: small;" name="car_name" id="car_name" value="<?php echo 
			$car_name;?>">
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Car Model";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Car Model..." style="font-size: small;" name="car_model" id=
			"car_model" value="<?php echo $car_model;?>">
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Car Description";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Car Description.." style="font-size: small;" name="car_description" id="car_description"
			 value="<?php echo $car_description;?>" >
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
           
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Plate #";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Plate #..." style="font-size: small;"  name="car_plateno" id="car_plateno" 
			value="<?php echo $car_plateno;?>" >
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
        
            
            
           

            <div class="row" style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                  <label  class="sr-only semibold"><?php echo "Air Conditioned";?>:</label>
                  </div>

                <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
               <input  type="radio" class="form-check-input"  id="air_conditioned" name="air_conditioned" value="Yes"  <?php echo ($air_conditioned=="Yes") ? 'checked="checked"' : "";?>/> Yes
               <input  type="radio" class="form-check-input" id="air_conditioned" name="air_conditioned" value="No"   checked="checked" /> No
                    
		
                   </div>  
                   
                   <div class="col-md-3">
                </div>

        </div>

        

        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold">No. of Seats:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small; ">
                <input class="form-control" type="text" placeholder="No. of Seats..." style="font-size: small;" name="no_seats" id="no_seats" value="<?php echo $no_seats;?>">
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php echo "Car Price Perday";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small; ">
                <input class="form-control" type="text" placeholder="Car Price Perday..." style="font-size: small;" name="car_price_perday" id="car_price_perday" value
			="<?php echo $car_price_perday;?>">
               </div> 

               <div class="col-md-3">
            </div>  

        </div>
        
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php echo "Car Price Without Driver";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small; ">
                <input class="form-control" type="text" placeholder="Car Price Without Driver..." style="font-size: small;" name="car_price_without_driver" id="car_price_without_driver" value
			="<?php echo $car_price_without_driver;?>">
               </div> 

               <div class="col-md-3">
            </div>  

        </div>
        
        
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php echo "Pickup Location";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small; ">
                <input class="form-control" type="text" placeholder="Pickup Location..." style="font-size: small;" name="pickup_location" id="pickup_location" value
			="<?php echo $car_price_without_driver;?>">
               </div> 

               <div class="col-md-3">
            </div>  

        </div>
        
        
        
        
        
        
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php echo " Upload Image 1 ";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small; ">
               <input type="file" name="image1" id="image1" class=" form-control  bg-light text-dark " />
            				<input type="hidden" name="old_image1" value="<?php echo $image1;?>" />
              <?php if($image1!="") {?>
                        <a href="<?php echo $pathimage.$image1 ;?>"  target="_blank"><img src="<?php echo $pathimage.$image1 ;?>" width="40px" height="40px" /></a>
                     
					   
					 
                        <?php }?>
               </div> 

               <div class="col-md-3">
            </div>  

        </div>
        <div class="row" style="margin-top: 20px;">

            <div class="col-md-2">
            </div>

            <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
              <label  class="sr-only semibold"><?php echo " Upload Image 2 ";?>:</label>
              </div>

            <div class=" col-md-4 regular mobileclass2" style="font-size: small; ">
               <input type="file" name="image2" id="image2" class=" form-control  bg-light text-dark " />
            				<input type="hidden" name="old_image2" value="<?php echo $image2;?>" />
                             <?php if($image2!="") {?>
                        <a href="<?php echo $pathimage.$image2 ;?>"  target="_blank"><img src="<?php echo $pathimage.$image2 ;?>" width="40px" height="40px" /></a>
                     
					   
					 
                        <?php }?>
              
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
                <input type="button" class="btn btn-danger mb-2" style="font-size: 13px;" value="Cancel" onClick="document.location='index.php?page=cars';">
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        </form>     
				﻿</div> <!-- for AJAX -->
			</div>
