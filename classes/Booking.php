<?php

class Booking extends Database{
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
	public function lstBookings(){
		$Sql = "SELECT
					b.b_id,
					b.car_id,
					(SELECT car_name from tbl_car a where a.car_id=b.car_id) as car_name,
					(SELECT car_plateno from tbl_car a where a.car_id=b.car_id) as car_plateno,
					b.user_cd,
					(SELECT first_name from mis_tbl_users a where a.user_cd=b.user_cd) as dealer_name,
					b.detail,
					b.returnDate,
					b.bookingDate,
					b.posting_date,
					b.b_status,
					b.driver_status,
					b.ride_completed
				FROM
					tbl_booking b
				WHERE
					1=1 ";
		
		
		
		if($this->isPropertySet("b_id", "V")){
			$Sql .= " AND b_id=" . $this->getProperty("b_id");
		}
		if($this->isPropertySet("user_cd", "V")){
			$Sql .= " AND user_cd=" . $this->getProperty("user_cd");
		}
		if($this->isPropertySet("b_status", "V"))
			$Sql .= " AND b_status='" . $this->getProperty("b_status") . "'";
		if($this->isPropertySet("orderby", "V"))
			$Sql .= " order by " . $this->getProperty("orderby");
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		
		return $this->dbQuery($Sql);
	}
	
	

	/**
	* This function is used to perform DML (Delete/Update/Add)
	* on the table tbl_booking the basis of property set
	* @author Abdul Waqar
	* @Date 25 May, 2022
	* @modified 25 May, 2022 by Abdul Waqar
	*/
	public function actBooking($mode){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO tbl_booking(
						b_id,						
						car_id,
						user_cd,
						detail,
						returnDate,
						bookingDate,
						posting_date,
						b_status,
						driver_status)
						VALUES(";
				$Sql .= $this->isPropertySet("b_id", "V") ? $this->getProperty("b_id") : "NULL";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("car_id", "V") ? "'" . $this->getProperty("car_id") . "'" : "''";
				$Sql .= ",";			
				$Sql .= $this->isPropertySet("user_cd", "V") ? "'" . $this->getProperty("user_cd") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("detail", "V") ? "'" . $this->getProperty("detail") . "'" : "''";
				$Sql .= ",";				
				$Sql .= $this->isPropertySet("returnDate", "V") ? "'" . $this->getProperty("returnDate") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bookingDate", "V") ? "'" . $this->getProperty("bookingDate") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("posting_date", "V") ? "'" . $this->getProperty("posting_date") . "'" : "''";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("b_status", "V") ? "'" . $this->getProperty("b_status") . "'" : "'N'";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("driver_status", "V") ? "'" . $this->getProperty("driver_status") . "'" : "'0'";
				 $Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE tbl_booking SET ";
				if($this->isPropertySet("car_id", "K")){
					$Sql .= "$con car_id='" . $this->getProperty("car_id") . "'";
					$con = ",";
				}
			
				if($this->isPropertySet("user_cd", "K")){
					$Sql .= "$con user_cd='" . $this->getProperty("user_cd") . "'";
					$con = ",";
				}
				if($this->isPropertySet("detail", "K")){
					$Sql .= "$con detail='" . $this->getProperty("detail") . "'";
					$con = ",";
				}
				if($this->isPropertySet("returnDate", "K")){
					$Sql .= "$con returnDate='" . $this->getProperty("returnDate") . "'";
					$con = ",";
				}
				if($this->isPropertySet("bookingDate", "K")){
					$Sql .= "$con bookingDate='" . $this->getProperty("bookingDate") . "'";
					$con = ",";
				}
				if($this->isPropertySet("posting_date", "K")){
					$Sql .= "$con posting_date='" . $this->getProperty("posting_date") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("b_status", "K")){
					$Sql .= "$con b_status='" . $this->getProperty("b_status") . "'";
					
				}
				if($this->isPropertySet("driver_status", "K")){
					$Sql .= "$con driver_status='" . $this->getProperty("driver_status") . "'";
					
				}
				
				$Sql .= " WHERE 1=1";
				$Sql .= " AND b_id=" . $this->getProperty("b_id");
				break;
			case "D":
				$Sql = "DELETE FROM tbl_booking WHERE b_id=" . $this->getProperty("b_id");
				break;
			default:
				break;
		}
	echo $Sql;	
		return $this->dbQuery($Sql);
	}
	
	
}
?>