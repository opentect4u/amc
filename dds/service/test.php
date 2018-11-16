<?php
$arrayName = array('name' => 'pk', 'nickName' => 'Pk');
var_dump($arrayName);
$comp_name = implode('*/*',$_POST["comp_name"]);
$comp_name = explode('*/*',$comp_name);
var_dump($comp_name);
 ?>
