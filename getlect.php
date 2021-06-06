<?php
ob_start();
session_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
error_reporting(0);
require_once("script/dbconnection.php");
$id = $_REQUEST['id'];
$msg="";
if(empty($id)){
 $msg = "id is required";
}
try{
  $query = "select * from lectures where id = ?";
  $data = getData($con,$query,[$id]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
   $msg ="Query Error";

}
ob_end_clean();
echo json_encode(array('code'=>200,'message'=>$msg,"success"=>$success,"lec"=>$data),JSON_PRETTY_PRINT);
?>