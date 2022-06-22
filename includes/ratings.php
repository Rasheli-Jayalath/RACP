<?php	
$objDb	= new Database;
$objDb1	= new Database;
if(isset($_POST['user_cd']))
{
$user_cd=$_GET['user_cd'];
}
else
{
$user_cd=$objAdminUser->user_cd;
}
$b_id=$_GET['b_id'];
		if(isset($_POST['submit']))
{
	$b_id=$_POST['b_id'];
	$comments=$_POST['comments'];
	$ratting=$_POST['ratting'];
	 $sql_b="insert into tbl_customerexperience (user_cd, b_id, comments, ratting) VALUES ($user_cd, $b_id,'$comments', $ratting)";
	$objDb->dbQuery($sql_b);
	redirect('./?page=bookings');
}
 $sqlw="Select * from tbl_customerexperience where b_id=".$b_id;
$queryw=$objDb1->dbQuery($sqlw);
if($objDb1->totalRecords()>=1)
{
	$queryw=$objDb1->dbFetchArray();
	 $comments=$queryw['comments'];
	 $ratting=$queryw['ratting'];
	 $flag=1;
}
else
{
	echo $flag=0;
}
?>

            
             <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"> 
            <div class="mainblock">
            	<div id="ReloadThis"> <!-- for AJAX -->
     					<div class="mini_portfolio_item_title">
                        	<div class="block_title" align="center">
          						<label style="float:left; color:#000000; font-family:Verdana, Arial, helvetica, sans-serif; font-size:14px; font-weight:bolder;" >&nbsp;&nbsp;Manage Ratings</label>
        					</div>
                        </div>
								<?php
									echo "<h1>Ratings Page</h1>";
                                ?>
                                
                                <form name="frmProfile" id="frmProfile" action="" method="post" onSubmit="return frmValidate(this);">
        <input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>" />
        <input type="hidden" name="car_id" id="car_id" value="<?php echo $car_id;?>" />
         <input type="hidden" name="b_id" id="b_id" value="<?php echo $b_id;?>" />
         
        
            <div class="row" >

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Comments";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                        <input class="form-control" type="text" placeholder="Comments..." style="font-size: small;" name="comments" id="comments" 
                        value="<?php echo $comments;?>" <?php if($flag==1) { ?> readonly="readonly"<?php }
						?>>
                       </div>   

                       <div class="col-md-3">
                        </div>

            </div>
            <div class="row"  style="margin-top: 20px;">

                <div class="col-md-2">
                </div>

                    <div class="col-md-3 mobileclass" style="font-size: small; margin: auto;">
                      <label  class="sr-only semibold"><?php echo "Rating";?>:</label>
                      </div>

                    <div class=" col-md-4 regular mobileclass2" style="font-size: small;">
                       		<input type="radio" id="ratting" name="ratting" value="1" <?php echo ($ratting=='1') ? 'checked="checked"' : "";?> <?php if($flag==1) { ?> onclick="return false;" <?php }?>/>
                              Poor<br/>
                       		<input type="radio" id="ratting" name="ratting" value="2" checked="checked" <?php if($flag==1) { ?> onclick="return false;" <?php }?>/>
                              normal<br/>
                               <input type="radio" id="ratting" name="ratting" value="3" <?php echo ($ratting=='3') ? 'checked="checked"' : "";?> <?php if($flag==1) { ?> onclick="return false;" <?php }?>/>
                              Average<br/>
                               <input type="radio" id="ratting" name="ratting" value="4" <?php echo ($ratting=='4') ? 'checked="checked"' : "";?> <?php if($flag==1) { ?> onclick="return false;" <?php }?>/>
                              Good<br/>
                               <input type="radio" id="ratting" name="ratting" value="5" <?php echo ($ratting=='5') ? 'checked="checked"' : "";?> <?php if($flag==1) { ?> onclick="return false;" <?php }?>/>
                              Excellent
                                
                       </div> 
                      
                        <input  type="hidden" name="b_id" id="b_id" value="<?php echo $_GET['b_id'];?>"/>  
                        

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
             <?php  if($flag==1)
					   {
					   }
					   else
					   {
					   ?>
                <input type="submit" name="submit" id="submit" class="btn btn-warning mb-2" style="font-size: 13px;" value="<?php echo  " Save ";?>" />
                <?php
					   }
					   ?>
                <input type="button" class="btn btn-danger mb-2" style="font-size: 13px;" value="Cancel" onClick="document.location='?page=bookings';">
               </div>   

               <div class="col-md-3">
            </div>

        </div>
        </form>                        
				﻿</div> <!-- for AJAX -->
			</div>
