<?php

$objDb		= new Database;
$objCar		= new Car;
$objCarN		= new Car;
$objCarD		= new Car;
$file_path="documents/";
if(isset($_GET['car_id'])&&$_GET['car_id']!=0){
	$car_id=$_GET['car_id'];
}
if($_GET['mode'] == 'delete'){
	$objCarD->setProperty('car_id', $_GET['car_id']);
	$objCarD->setProperty('dc_id', $_GET['dc_id']);
	 $sql_ii="SELECT * FROM `tbl_documents_car` where dc_id='$_GET[dc_id]'"; 
		$objDb->dbQuery($sql_ii);
		$objDb->totalRecords();
		$sql_resnew=$objDb->dbFetchArray();
		if($sql_resnew['file_name']!="")
		{
		@unlink($file_path . $sql_resnew['file_name']);
		}
		
	$objCarD->actCarDoc('D');
	
	$objCommon->setMessage('Car deleted successfully!', 'Info');
	
		
	redirect('./?page=car_docs&car_id='.$_GET['car_id']);
}
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
	
	$dc_id = trim($_POST['dc_id']);
	$car_id = trim($_POST['car_id']);
	$doc_title = trim($_POST['doc_title']);
	$submitted_on = date('Y-m-d');
	$remarks = trim($_POST['remarks']);
	$mode = trim($_POST['mode']);
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
	 $file_name=genRandom(5)."-".$car_id. ".".$extension;
   
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
	
	$file_name= $file_name;
	}
	else
	{
		 $file_name= $old_al_file;
	 }
		
		$dc_id = ($mode == "U") ? $_POST['dc_id'] : $objCar->genCode("tbl_documents_car", "dc_id");
		$objCar->resetProperty();
		$objCar->setProperty("dc_id", $dc_id);
		$objCar->setProperty("car_id", $car_id);
		$objCar->setProperty("doc_title", $doc_title);
		$objCar->setProperty("submitted_on", $submitted_on);
		$objCar->setProperty("file_name", $file_name);
		$objCar->setProperty("remarks", $remarks);
		if($objCar->actCarDoc($_POST['mode'])){
			
						
				redirect('./?page=car_docs&car_id='.$car_id);
			
			
	
	
		

			}
	extract($_POST);
}
else{
if(isset($_GET['car_id']) && !empty($_GET['car_id'])&&isset($_GET['dc_id'])&&$_GET['dc_id']!=0)
	{	
	 $car_id = $_GET['car_id'];
	  $dc_id = $_GET['dc_id'];
	if(isset($car_id) && !empty($car_id)){
		$objCar->setProperty("car_id", $car_id);
		$objCar->setProperty("dc_id", $dc_id);
		
		$objCar->lstCarDoc();
		if($objCar->totalRecords() >= 1){
		$data = $objCar->dbFetchArray(1);
		$mode	= "U";
		extract($data);
		}

	}
	}
	
}
?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"> 
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Add New Document</label>
        					</div>
                        </div>
								<?php
								echo "<h1>Car Document</h1>";
								?>
                               <h3 style=" color:#F00; text-align:center"> <?php echo $objCommon->displayMessage();?></h3>
                               <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a  href="index.php?page=cars" class="button" >Back</a></div>
                              <form name="frmProfile" id="frmProfile" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
        <input type="hidden" name="dc_id" id="dc_id" value="<?php echo $dc_id;?>" />
          <input type="hidden" name="car_id" id="car_id" value="<?php echo $car_id;?>" />
            <div class="row" >

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Document Title";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Document Title..." style="font-size: small;" name="doc_title" id="doc_title" value="<?php echo 
			$doc_title;?>">
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo 'Upload Document';?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="file" name="al_file" id="al_file"  style="font-size: small;" >
                        <input type="hidden" name="old_al_file" value="<?php echo $file_name;?>" /><span style="color:green">Allowed Documents: PDF, Word, JPEG, PNG</span>
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>

			<div class="row" >

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Remarks";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Remarks..." style="font-size: small;" name="remarks" id="remarks" value="<?php echo 
			$remarks;?>">
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
                <input type="button" class="btn btn-danger mb-2" style="font-size: 13px;" value="Cancel" onClick="document.location='?page=cars';">
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        </form>     
        
        <table id="customers" class="table" style="font-size: small;">
             <thead>
        <tr class="">
                
         <th scope="col" class="semibold"><?php echo "Title";?></th>
		<th scope="col" class="semibold"><?php echo "Submitted Date";?></th>
        <th scope="col" class="semibold"><?php echo "Remarks";?></th>
        <th scope="col" class="semibold"><?php echo "Doc";?></th>
        
		<th scope="col" class="semibold" style="text-align:center">Action</th>
		</tr>
         </thead>
		<?php
	$objCarN->setProperty("car_id", $car_id);

$objCarN->lstCarDoc();
	if($objCarN->totalRecords() >= 1){
		$sno = 1;
		while($rows = $objCarN->dbFetchArray(1)){
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			?>
			<!-- Start Your Php Code her For Display Record's -->
			<tr style="background-color:<?php echo $bgcolor;?>">
				<td><?php echo $rows['doc_title'];?></td>
                <td><?php echo $rows['submitted_on'];?></td>
                <td><?php echo $rows['remarks'];?></td>
                <td><a href="documents/<?php echo $rows['file_name'];?>" target="_blank"><img src="images/doc.png" border="0" /></a></td>
               <td style="text-align:right"><a href="index.php?page=car_docs&mode=edit&car_id=<?php echo $rows['car_id'];?>&dc_id=<?php echo $rows['dc_id'];?>" style="text-decoration:none"title="Edit"><img src="images/iconedit.png" border="0" /></a> | <a onClick="return confirm('Are you sure to delete this Car Documents?');" href="./?page=car_docs&mode=delete&car_id=<?php echo $rows['car_id'];?>&dc_id=<?php echo $rows['dc_id'];?>" style="text-decoration:none" title="Delete"><img src="images/icondelete.png" border="0" /></a></td></tr>
			<?php
			
		}
    }
	else{
	?>
	<tr>
	<td colspan="7">
  <div align="center" style="padding:5px 5px 5px 5px"> <?php echo "No Car Documents Found";?></div>
   </td></tr>
    <?php
	}
	?> </table>
				﻿</div> <!-- for AJAX -->
			</div>
