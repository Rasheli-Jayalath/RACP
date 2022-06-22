<?php

class Dealer extends Database{
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
	public function lstDealers(){
		$Sql = "SELECT
					cc_id,
					owner_name,
					company_name,
					address,
					email,
					mobile_no,
					userName,
					password,
					account_detail,
					verifying_status
				FROM
					tbl_carcompany
				WHERE
					1=1 ";
		
		
		
		if($this->isPropertySet("cc_id", "V")){
			$Sql .= " AND cc_id=" . $this->getProperty("cc_id");
		}
		if($this->isPropertySet("verifying_status", "V"))
			$Sql .= " AND verifying_status='" . $this->getProperty("verifying_status") . "'";
		if($this->isPropertySet("orderby", "V"))
			$Sql .= " order by " . $this->getProperty("orderby");
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		
		return $this->dbQuery($Sql);
	}
	
	public function lstDealersDoc(){
		$Sql = "SELECT
						d_id,						
						cc_id,
						doc_title,
						submitted_on,
						file_name,
						remarks
				FROM
					tbl_documents_dealer
				WHERE
					1=1 ";
		
		
		
		if($this->isPropertySet("cc_id", "V")){
			$Sql .= " AND cc_id=" . $this->getProperty("cc_id");
		}
		if($this->isPropertySet("d_id", "V"))
			$Sql .= " AND d_id='" . $this->getProperty("d_id") . "'";
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
	public function actDealer($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO tbl_carcompany(
						cc_id,						
						owner_name,
						company_name,
						address,
						email,
						mobile_no,
						userName,
						password,
						account_detail,
						verifying_status)
						VALUES(";
				$Sql .= $this->isPropertySet("cc_id", "V") ? $this->getProperty("cc_id") : "NULL";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("owner_name", "V") ? "'" . $this->getProperty("owner_name") . "'" : "''";
				$Sql .= ",";			
				$Sql .= $this->isPropertySet("company_name", "V") ? "'" . $this->getProperty("company_name") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("address", "V") ? "'" . $this->getProperty("address") . "'" : "''";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("email", "V") ? "'" . $this->getProperty("email") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mobile_no", "V") ? "'" . $this->getProperty("mobile_no") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("userName", "V") ? "'" . $this->getProperty("userName") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("password", "V") ? "'" . $this->getProperty("password") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("account_detail", "V") ? "'" . $this->getProperty("account_detail") . "'" : "''";
				$Sql .= ",";
				
				$Sql .= $this->isPropertySet("verifying_status", "V") ? "'" . $this->getProperty("verifying_status") . "'" : "'Y'";
				
				 $Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE tbl_carcompany SET ";
				if($this->isPropertySet("owner_name", "K")){
					$Sql .= "$con owner_name='" . $this->getProperty("owner_name") . "'";
					$con = ",";
				}
			
				if($this->isPropertySet("company_name", "K")){
					$Sql .= "$con company_name='" . $this->getProperty("company_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("address", "K")){
					$Sql .= "$con address='" . $this->getProperty("address") . "'";
					$con = ",";
				}
				if($this->isPropertySet("email", "K")){
					$Sql .= "$con email='" . $this->getProperty("email") . "'";
					$con = ",";
				}
				if($this->isPropertySet("mobile_no", "K")){
					$Sql .= "$con mobile_no='" . $this->getProperty("mobile_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("userName", "K")){
					$Sql .= "$con userName='" . $this->getProperty("userName") . "'";
					$con = ",";
				}
				if($this->isPropertySet("password", "K")){
					$Sql .= "$con password='" . $this->getProperty("password") . "'";
					$con = ",";
				}if($this->isPropertySet("account_detail", "K")){
					$Sql .= "$con account_detail='" . $this->getProperty("account_detail") . "'";
					$con = ",";
				}
				
				
				if($this->isPropertySet("verifying_status", "K")){
					$Sql .= "$con verifying_status='" . $this->getProperty("verifying_status") . "'";
					
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND cc_id=" . $this->getProperty("cc_id");
				break;
			case "D":
				$Sql = "DELETE FROM tbl_carcompany WHERE cc_id=" . $this->getProperty("cc_id");
				break;
			default:
				break;
		}
	//echo $Sql;	
		return $this->dbQuery($Sql);
	}
	
	public function actDealerDoc($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO tbl_documents_dealer(
						d_id,						
						cc_id,
						doc_title,
						submitted_on,
						file_name,
						remarks)
						VALUES(";
				$Sql .= $this->isPropertySet("d_id", "V") ? $this->getProperty("d_id") : "NULL";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("cc_id", "V") ? "'" . $this->getProperty("cc_id") . "'" : "''";
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
				$Sql = "UPDATE tbl_documents_dealer SET ";
				if($this->isPropertySet("cc_id", "K")){
					$Sql .= "$con cc_id='" . $this->getProperty("cc_id") . "'";
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
				$Sql .= " AND d_id=" . $this->getProperty("d_id");
				break;
			case "D":
				$Sql = "DELETE FROM tbl_documents_dealer WHERE d_id=" . $this->getProperty("d_id");
				break;
			default:
				break;
		}
		
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