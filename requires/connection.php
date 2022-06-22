<?php
$host ='localhost';
$dbname='racp';
$username='root';
$password='';
try{
    $con=mysqli_connect($host,$username,$password,$dbname);
if($con){
}
}catch(Exception $e){
    echo $e->getMessage();}
?>