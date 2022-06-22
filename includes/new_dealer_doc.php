<?php

$objDb		= new Database;
$objDealer		= new Dealer;
$objDealerN		= new Dealer;
$objDealerD		= new Dealer;
$file_path="documents/";
if(isset($_GET['cc_id'])&&$_GET['cc_id']!=0){
	$cc_id=$_GET['cc_id'];
}
if($_GET['mode'] == 'delete'){
	$objDealerD->setProperty('cc_id', $_GET['cc_id']);
	$objDealerD->setProperty('d_id', $_GET['d_id']);
	 $sql_ii="SELECT * FROM `tbl_documents_dealer` where d_id='$_GET[d_id]'"; 
		$objDb->dbQuery($sql_ii);
		$objDb->totalRecords();
		$sql_resnew=$objDb->dbFetchArray();
		if($sql_resnew['file_name']!="")
		{
		@unlink($file_path . $sql_resnew['file_name']);
		}
		
	$objDealerD->actDealerDoc('D');
	
	$objCommon->setMessage('Dealer deleted successfully!', 'Info');
	
		
	redirect('./?page=new_dealer_doc&cc_id='.$_GET['cc_id']);
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
	
	$d_id = trim($_POST['d_id']);
	$cc_id = trim($_POST['cc_id']);
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
	 $file_name=genRandom(5)."-".$cc_id. ".".$extension;
   
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
		
		$d_id = ($mode == "U") ? $_POST['d_id'] : $objDealer->genCode("tbl_documents_dealer", "d_id");
		$objDealer->resetProperty();
		$objDealer->setProperty("d_id", $d_id);
		$objDealer->setProperty("cc_id", $cc_id);
		$objDealer->setProperty("doc_title", $doc_title);
		$objDealer->setProperty("submitted_on", $submitted_on);
		$objDealer->setProperty("file_name", $file_name);
		$objDealer->setProperty("remarks", $remarks);
		if($objDealer->actDealerDoc($_POST['mode'])){
			
						
				redirect('./?page=new_dealer_doc&cc_id='.$cc_id);
			
			
	
	
		

			}
	extract($_POST);
}
else{
if(isset($_GET['cc_id']) && !empty($_GET['cc_id'])&&isset($_GET['d_id'])&&$_GET['d_id']!=0)
	{	
	 $cc_id = $_GET['cc_id'];
	  $d_id = $_GET['d_id'];
	if(isset($cc_id) && !empty($cc_id)){
		$objDealer->setProperty("cc_id", $cc_id);
		$objDealer->setProperty("d_id", $d_id);
		
		$objDealer->lstDealersDoc();
		if($objDealer->totalRecords() >= 1){
		$data = $objDealer->dbFetchArray(1);
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
								echo "<h1>New Dealer's Document</h1>";
								?>
                               <h3 style=" color:#F00; text-align:center"> <?php echo $objCommon->displayMessage();?></h3>
                               <div style="float:right; width:100%; text-align:right; margin-right:10px"> <a  href="index.php?page=dealers" class="button" >Back</a></div>
                              <form name="frmProfile" id="frmProfile" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
        <input type="hidden" name="d_id" id="d_id" value="<?php echo $d_id;?>" />
          <input type="hidden" name="cc_id" id="cc_id" value="<?php echo $cc_id;?>" />
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
                <input type="button" class="btn btn-danger mb-2" style="font-size: 13px;" value="Cancel" onClick="document.location='?page=dealers';">
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
	$objDealerN->setProperty("cc_id", $cc_id);
	//$objDealer->setProperty("limit", PERPAGE);
	//$objDealer->setProperty("GROUP BY", "cms_cd");
$objDealerN->lstDealersDoc();
	if($objDealerN->totalRecords() >= 1){
		$sno = 1;
		while($rows = $objDealerN->dbFetchArray(1)){
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			?>
			<!-- Start Your Php Code her For Display Record's -->
			<tr style="background-color:<?php echo $bgcolor;?>">
				<td><?php echo $rows['doc_title'];?></td>
                <td><?php echo $rows['submitted_on'];?></td>
                <td><?php echo $rows['remarks'];?></td>
                <td><a href="documents/<?php echo $rows['file_name'];?>" target="_blank"><img src="images/doc.png" border="0" /></a></td>
               <td style="text-align:right"><a href="index.php?page=new_dealer_doc&mode=edit&cc_id=<?php echo $rows['cc_id'];?>&d_id=<?php echo $rows['d_id'];?>" style="text-decoration:none"title="Edit"><img src="images/iconedit.png" border="0" /></a> | <a onClick="return confirm('Are you sure to delete this Dealer?');" href="./?page=new_dealer_doc&mode=delete&cc_id=<?php echo $rows['cc_id'];?>&d_id=<?php echo $rows['d_id'];?>" style="text-decoration:none" title="Delete"><img src="images/icondelete.png" border="0" /></a></td></tr>
			<?php
			
		}
    }
	else{
	?>
	<tr>
	<td colspan="7">
  <div align="center" style="padding:5px 5px 5px 5px"> <?php echo "No Dealer Doc Information Found";?></div>
   </td></tr>
    <?php
	}
	?> </table>
				﻿</div> <!-- for AJAX -->
			</div>
