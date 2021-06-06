<?php
header('Content-type:application/json');
session_start();
require_once("dbconnection.php");

$temp = rand(10,70); //Temperature
$ox   = rand(10,100); //Humidity
$beat= rand(10,100); //Humidity
$emg = rand(0,100)/100; //Humidity
$ecg = rand(0,100)/100; //Humidity
   $sql = "insert into records (dev_id,patient_id,temp,oxygen,beat) values(?,?,?,?,?)";
   $result = setData($con,$sql,[1,1,$temp,$ox,$beat]);
   if($result == 1){
    $sql = "insert into ecg (dev_id,patient_id,ecg) values(?,?,?)";
    setData($con,$sql,[1,1,$ecg]);
    $sql = "insert into emg (dev_id,patient_id,ecg) values(?,?,?)";
    setData($con,$sql,[1,1,$emg]);
    $msg = "Temperature and Humidity recorded";
   }
echo $msg;
?>