<?php

class Car extends Database{
	/**
	* This is the constructor of the class Dealer
	* @author Abdul Waqar
	*/
	public function __construct(){
		parent::__construct();
	}

	/**
	* This method is used to list the Dealers
	* @author Abdul Waqar
	*/
	public function lstCar($lang = false){
		$Sql = "SELECT
					car_id,
					cc_id,
					car_name,
					car_model,
					car_description,
					car_plateno,
					air_conditioned,
					no_seats,
					car_price_perday,
					car_price_without_driver,
					image1,
					image2,
					pickup_location
					
				FROM
					tbl_car
				WHERE
					1=1 ";
		
		
		
		if($this->isPropertySet("car_id", "V")){
			$Sql .= " AND car_id=" . $this->getProperty("car_id");
		}
		if($this->isPropertySet("cc_id", "V")){
			$Sql .= " AND cc_id=" . $this->getProperty("cc_id");
		}
		
		if($this->isPropertySet("orderby", "V"))
			$Sql .= " order by " . $this->getProperty("orderby");
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		return $this->dbQuery($Sql);
	}

	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table tbl_carcompany the basis of property set
	* @author Abdul Waqar
	* @Date 25 May, 2022
	* @modified 25 May, 2022 by Abdul Waqar
	*/
	public function actCar($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO tbl_car(
						car_id,
					cc_id,
					car_name,
					car_model,
					car_description,
					car_plateno,
					air_conditioned,
					no_seats,
					car_price_perday,
					car_price_without_driver,
					image1,
					image2,					
					pickup_location
					
					)
						VALUES(";
						$Sql .= $this->isPropertySet("car_id", "V") ? $this->getProperty("car_id") : "NULL";
				$Sql .= ",";	
				$Sql .= $this->isPropertySet("cc_id", "V") ? $this->getProperty("cc_id") : "NULL";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("car_name", "V") ? "'" . $this->getProperty("car_name") . "'" : "''";
				$Sql .= ",";			
				$Sql .= $this->isPropertySet("car_model", "V") ? "'" . $this->getProperty("car_model") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("car_description", "V") ? "'" . $this->getProperty("car_description") . "'" : "''";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("car_plateno", "V") ? "'" . $this->getProperty("car_plateno") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("air_conditioned", "V") ? "'" . $this->getProperty("air_conditioned") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("no_seats", "V") ? "'" . $this->getProperty("no_seats") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("car_price_perday", "V") ? "'" . $this->getProperty("car_price_perday") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("car_price_without_driver", "V") ? "'" . $this->getProperty("car_price_without_driver") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("image1", "V") ? "'" . $this->getProperty("image1") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("image2", "V") ? "'" . $this->getProperty("image2") . "'" : "''";
				$Sql .= ",";
				
				
				$Sql .= $this->isPropertySet("pickup_location", "V") ? "'" . $this->getProperty("pickup_location") . "'" : "'Y'";
				
				 $Sql .= ")";
				break;
			case "U":
			
				$Sql = "UPDATE tbl_car SET ";
				
				if($this->isPropertySet("cc_id", "K")){
					$Sql .= "$con cc_id='" . $this->getProperty("cc_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("car_name", "K")){
					$Sql .= "$con car_name='" . $this->getProperty("car_name") . "'";
					$con = ",";
				}
			
				if($this->isPropertySet("car_model", "K")){
					$Sql .= "$con car_model='" . $this->getProperty("car_model") . "'";
					$con = ",";
				}
				if($this->isPropertySet("car_description", "K")){
					$Sql .= "$con car_description='" . $this->getProperty("car_description") . "'";
					$con = ",";
				}
				if($this->isPropertySet("car_plateno", "K")){
					$Sql .= "$con car_plateno='" . $this->getProperty("car_plateno") . "'";
					$con = ",";
				}
				if($this->isPropertySet("air_conditioned", "K")){
					$Sql .= "$con air_conditioned='" . $this->getProperty("air_conditioned") . "'";
					$con = ",";
				}
				if($this->isPropertySet("no_seats", "K")){
					$Sql .= "$con no_seats='" . $this->getProperty("no_seats") . "'";
					$con = ",";
				}
				if($this->isPropertySet("car_price_perday", "K")){
					$Sql .= "$con car_price_perday='" . $this->getProperty("car_price_perday") . "'";
					$con = ",";
				}if($this->isPropertySet("car_price_without_driver", "K")){
					$Sql .= "$con car_price_without_driver='" . $this->getProperty("car_price_without_driver") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("image1", "K")){
					$Sql .= "$con image1='" . $this->getProperty("image1") . "'";
					$con = ",";
				}
				if($this->isPropertySet("image2", "K")){
					$Sql .= "$con image2='" . $this->getProperty("image2") . "'";
					$con = ",";
				}
				
				
				
				if($this->isPropertySet("pickup_location", "K")){
					$Sql .= "$con pickup_location='" . $this->getProperty("pickup_location") . "'";
					
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND car_id=" . $this->getProperty("car_id");
				break;
			case "D":
				$Sql = "DELETE FROM tbl_car WHERE car_id=" . $this->getProperty("car_id");
				break;
			default:
				break;
		}
	//echo $Sql;
		return $this->dbQuery($Sql);
	}
public function actCarDoc($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO tbl_documents_car(
						dc_id,						
						car_id,
						doc_title,
						submitted_on,
						file_name,
						remarks)
						VALUES(";
				$Sql .= $this->isPropertySet("dc_id", "V") ? $this->getProperty("dc_id") : "NULL";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("car_id", "V") ? "'" . $this->getProperty("car_id") . "'" : "''";
				$Sql .= ",";			
				$Sql .= $this->isPropertySet("doc_title", "V") ? "'" . $this->getProperty("doc_title") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("submitted_on", "V") ? "'" . $this->getProperty("submitted_on") . "'" : "''";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("file_name", "V") ? "'" . $this->getProperty("file_name") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("remarks", "V") ? "'" . $this->getProperty("remarks") . "'" : "''";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE tbl_documents_car SET ";
				if($this->isPropertySet("car_id", "K")){
					$Sql .= "$con car_id='" . $this->getProperty("car_id") . "'";
					$con = ",";
				}
			
				if($this->isPropertySet("doc_title", "K")){
					$Sql .= "$con doc_title='" . $this->getProperty("doc_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("submitted_on", "K")){
					$Sql .= "$con submitted_on='" . $this->getProperty("submitted_on") . "'";
					$con = ",";
				}
				if($this->isPropertySet("file_name", "K")){
					$Sql .= "$con file_name='" . $this->getProperty("file_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("remarks", "K")){
					$Sql .= "$con remarks='" . $this->getProperty("remarks") . "'";
					
				}
				
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND dc_id=" . $this->getProperty("dc_id");
				break;
			case "D":
				$Sql = "DELETE FROM tbl_documents_car WHERE dc_id=" . $this->getProperty("dc_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	public function lstCarDoc(){
		$Sql = "SELECT
						dc_id,						
						car_id,
						doc_title,
						submitted_on,
						file_name,
						remarks
				FROM
					tbl_documents_car
				WHERE
					1=1 ";
		
		
		
		if($this->isPropertySet("car_id", "V")){
			$Sql .= " AND car_id=" . $this->getProperty("car_id");
		}
		if($this->isPropertySet("dc_id", "V"))
			$Sql .= " AND dc_id='" . $this->getProperty("dc_id") . "'";
		if($this->isPropertySet("orderby", "V"))
			$Sql .= " order by " . $this->getProperty("orderby");
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		
		return $this->dbQuery($Sql);
	}
	
	public function checkAdminEmailAddress(){
		$Sql = "SELECT 
					
					email
					
				FROM
					tbl_carcompany
				WHERE 
					1=1";
		if($this->isPropertySet("email", "V"))
			$Sql .= " AND email='" . $this->getProperty("email") . "'";
		
		return $this->dbQuery($Sql);
	}
}
?>