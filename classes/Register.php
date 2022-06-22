<?php

class Register extends Database{
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
	public function lstRegister(){
		$Sql = "SELECT
					user_cd,
					first_name,
					last_name,
					username,
					passwd,
					email,					
					address,
					phone,
					cnic_no,
					upload_cnic,
					upload_pic,
					user_type
				FROM
					mis_tbl_users
				WHERE
					1=1 ";
		
		
		
		if($this->isPropertySet("user_cd", "V")){
			$Sql .= " AND user_cd=" . $this->getProperty("user_cd");
		}
		if($this->isPropertySet("user_type", "V"))
			$Sql .= " AND user_type='" . $this->getProperty("user_type") . "'";
		if($this->isPropertySet("orderby", "V"))
			$Sql .= " order by " . $this->getProperty("orderby");
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		
		return $this->dbQuery($Sql);
	}
	public function lstSearchUser(){
		$Sql = "SELECT
					user_cd,
					first_name,
					last_name,
					username,
					passwd,
					email,					
					address,
					phone,
					cnic_no,
					upload_cnic,
					upload_pic,
					user_type
				FROM
					mis_tbl_users
				WHERE
					1=1 ";
		
		
		
		if($this->isPropertySet("user_cd", "V")){
			$Sql .= " AND user_cd=" . $this->getProperty("user_cd");
		}
		if($this->isPropertySet("user_type", "V"))
			$Sql .= " AND user_type='" . $this->getProperty("user_type") . "'";
		if($this->isPropertySet("first_name", "V"))
			$Sql .= " AND (LOWER(first_name) LIKE '%" . $this->getProperty("first_name") . "%')";
		if($this->isPropertySet("last_name", "V"))
			$Sql .= " AND (LOWER(last_name) LIKE '%" . $this->getProperty("last_name") . "%')";
		if($this->isPropertySet("username", "V"))
			$Sql .= " AND (LOWER(username) LIKE '%" . $this->getProperty("username") . "%')";
		if($this->isPropertySet("phone", "V"))
			$Sql .= " AND (LOWER(phone) LIKE '%" . $this->getProperty("phone") . "%')";
		if($this->isPropertySet("cnic_no", "V"))
			$Sql .= " AND (LOWER(cnic_no) LIKE '%" . $this->getProperty("cnic_no") . "%')";
		if($this->isPropertySet("address", "V"))
			$Sql .= " AND (LOWER(address) LIKE '%" . $this->getProperty("address") . "%')";
		
			
			
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
	public function actRegister($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO mis_tbl_users(
					user_cd,
					first_name,
					last_name,
					username,
					passwd,
					email,					
					address,
					phone,
					cnic_no,					
					user_type,
					upload_cnic,
					upload_pic
					)
						VALUES(";
				$Sql .= $this->isPropertySet("user_cd", "V") ? $this->getProperty("user_cd") : "NULL";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("first_name", "V") ? "'" . $this->getProperty("first_name") . "'" : "''";
				$Sql .= ",";			
				$Sql .= $this->isPropertySet("last_name", "V") ? "'" . $this->getProperty("last_name") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("username", "V") ? "'" . $this->getProperty("username") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("passwd", "V") ? "'" . $this->getProperty("passwd") . "'" : "''";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("email", "V") ? "'" . $this->getProperty("email") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("address", "V") ? "'" . $this->getProperty("address") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("phone", "V") ? "'" . $this->getProperty("phone") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cnic_no", "V") ? "'" . $this->getProperty("cnic_no") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_type", "V") ? "'" . $this->getProperty("user_type") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("upload_cnic", "V") ? "'" . $this->getProperty("upload_cnic") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("upload_pic", "V") ? "'" . $this->getProperty("upload_pic") . "'" : "''";
							
				 $Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE mis_tbl_users SET ";
				if($this->isPropertySet("first_name", "K")){
					$Sql .= "$con first_name='" . $this->getProperty("first_name") . "'";
					$con = ",";
				}
			
				if($this->isPropertySet("last_name", "K")){
					$Sql .= "$con last_name='" . $this->getProperty("last_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("username", "K")){
					$Sql .= "$con username='" . $this->getProperty("username") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("email", "K")){
					$Sql .= "$con email='" . $this->getProperty("email") . "'";
					$con = ",";
				}
				if($this->isPropertySet("address", "K")){
					$Sql .= "$con address='" . $this->getProperty("address") . "'";
					$con = ",";
				}
				if($this->isPropertySet("phone", "K")){
					$Sql .= "$con phone='" . $this->getProperty("phone") . "'";
					$con = ",";
				}
				if($this->isPropertySet("cnic_no", "K")){
					$Sql .= "$con cnic_no='" . $this->getProperty("cnic_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("upload_cnic", "K")){
					$Sql .= "$con upload_cnic='" . $this->getProperty("upload_cnic") . "'";
					$con = ",";
				}
					if($this->isPropertySet("upload_pic", "K")){
					$Sql .= "$con upload_pic='" . $this->getProperty("upload_pic") . "'";
					$con = ",";
				}
				
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND user_cd=" . $this->getProperty("user_cd");
				break;
			case "D":
				$Sql = "DELETE FROM mis_tbl_users WHERE user_cd=" . $this->getProperty("user_cd");
				break;
			default:
				break;
		}
	//echo $Sql;	
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