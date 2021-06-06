<?php
ob_start();
session_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
error_reporting(0);
require_once("script/dbconnection.php");
$stage = $_REQUEST['stage'];
$orders = 0;
$msg="";
$limit = $_REQUEST['limit'];
$page = $_REQUEST['page'];
if(empty($limit)){
 $limit = 10;
}
if(empty($page)){
 $page = 1;
}
try{
  $count = "select count(*) as count from lectures";
  $query = "select * from lectures";
  $where = "where";
  $filter = "";
  if($stage > 0 && $stage < 8){
    $filter .= " lectures.stage = ".$stage;
  }
  if($filter != ""){
    $filter = preg_replace('/^ and/', '', $filter);
    $filter = $where." ".$filter;
    $count .= " ".$filter;
    $query .= " ".$filter;
  }
  if($page != 0){
    $page = $page - 1;
  }
  $query .= " order by lectures.id DESC limit ".($page * $limit).",".$limit;
  $data = getData($con,$query);
  $ps = getData($con,$count);
  $lectures = $ps[0]['count'];
  $pages= ceil($ps[0]['count']/$limit);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
   $msg = "Query Error";
}
$code = 200;
ob_end_clean();
echo (json_encode(array('code'=>$code,'message'=>$msg,'count'=>$lectures,"success"=>$success,"lectures"=>$data,'pages'=>$pages,'nextPage'=>$page+2),JSON_PRETTY_PRINT));
?>