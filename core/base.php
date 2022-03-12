<?php

function con(){
    return mysqli_connect("localhost","root","","550qc");
}

$info = array(
  "name" => "550 MCH MDY",
  "short" => "550 MCH",
  "description" => "QC",
);


$role = ['Admin','Editor','User'];

$url = "http://{$_SERVER['HTTP_HOST']}/550mch";

date_default_timezone_set('Asia/Yangon');