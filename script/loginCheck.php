<?php
if(!isset($_SESSION)){
  session_start();
}
if(!empty($_SESSION['login']) && !empty($_SESSION['userid'])){
  require_once('dbconnection.php');
  $sql= "select * from users where user_id=?";
  $result = getData($con,$sql,[$_SESSION['userid']]);
  if(count($result) == 1){
    $college = $result[0]['college_id'];
    $_SESSION['college'] = $result[0]['college_id'];
  }else{
    header('location:index.php');
  die();
  }
}else{
  header('location:index.php');
  die();
}
?>