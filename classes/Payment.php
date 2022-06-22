<?php

class Payment extends Database{
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
	public function lstPayments(){
		$Sql = "SELECT
					b.p_id,
					b.b_id,
					(SELECT car_id from tbl_booking a where a.b_id=b.b_id) as car_id,
					b.user_cd,
					(SELECT first_name from mis_tbl_users a where a.user_cd=b.user_cd) as dealer_name,
					b.payment_method,
					b.total_amount,
					b.payment_status,
					b.payment_date,
					b.tax
				FROM
					tbl_payment b
				WHERE
					1=1 ";
		
		
		
		if($this->isPropertySet("p_id", "V")){
			$Sql .= " AND p_id=" . $this->getProperty("p_id");
		}
		if($this->isPropertySet("b_id", "V")){
			$Sql .= " AND b_id=" . $this->getProperty("b_id");
		}
		if($this->isPropertySet("tax", "V"))
			$Sql .= " AND tax='" . $this->getProperty("tax") . "'";
		if($this->isPropertySet("orderby", "V"))
			$Sql .= " order by " . $this->getProperty("orderby");
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		
		return $this->dbQuery($Sql);
	}
	
	

	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table tbl_payment the basis of property set
	* @author Abdul Waqar
	* @Date 25 May, 2022
	* @modified 25 May, 2022 by Abdul Waqar
	*/
	public function actPayment($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO tbl_payment(
						p_id,						
						b_id,
						user_cd,
						payment_method,
						total_amount,
						payment_status,
						payment_date,
						tax)
						VALUES(";
				$Sql .= $this->isPropertySet("p_id", "V") ? $this->getProperty("p_id") : "NULL";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("b_id", "V") ? "'" . $this->getProperty("b_id") . "'" : "''";
				$Sql .= ",";			
				$Sql .= $this->isPropertySet("user_cd", "V") ? "'" . $this->getProperty("user_cd") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_method", "V") ? "'" . $this->getProperty("payment_method") . "'" : "''";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("total_amount", "V") ? "'" . $this->getProperty("total_amount") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_status", "V") ? "'" . $this->getProperty("payment_status") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_date", "V") ? "'" . $this->getProperty("payment_date") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tax", "V") ? "'" . $this->getProperty("tax") . "'" : "'0'";
				
				 $Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE tbl_payment SET ";
				if($this->isPropertySet("b_id", "K")){
					$Sql .= "$con b_id='" . $this->getProperty("b_id") . "'";
					$con = ",";
				}
			
				if($this->isPropertySet("user_cd", "K")){
					$Sql .= "$con user_cd='" . $this->getProperty("user_cd") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payment_method", "K")){
					$Sql .= "$con payment_method='" . $this->getProperty("payment_method") . "'";
					$con = ",";
				}
				if($this->isPropertySet("total_amount", "K")){
					$Sql .= "$con total_amount='" . $this->getProperty("total_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payment_status", "K")){
					$Sql .= "$con payment_status='" . $this->getProperty("payment_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payment_date", "K")){
					$Sql .= "$con payment_date='" . $this->getProperty("payment_date") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("tax", "K")){
					$Sql .= "$con tax='" . $this->getProperty("tax") . "'";
					
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND b_id=" . $this->getProperty("b_id");
				break;
			case "D":
				$Sql = "DELETE FROM tbl_payment WHERE b_id=" . $this->getProperty("b_id");
				break;
			default:
				break;
		}
	echo $Sql;	
		return $this->dbQuery($Sql);
	}
	
	
}
?>