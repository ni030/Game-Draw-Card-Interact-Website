<?php
require_once('../Connections/roywang21hb.php');

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}

mysqli_select_db($roywang21hb, $database_roywang21hb);
$query_DetailRS1 = sprintf("SELECT * FROM TaskLottime WHERE userID = %s", GetSQLValueString($colname_DetailRS1, "text"));
$DetailRS1 = mysqli_query($roywang21hb, $query_DetailRS1) or die(mysql_error());
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);
$totalRows_DetailRS1 = mysqli_num_rows($DetailRS1);

if($row_DetailRS1['task1']==1){
    $point1 = 2;
}else{
    $point1 = 0;
}

if($row_DetailRS1['task2']==1){
    $point2 = 1;
}else{
    $point2 = 0;
}

if($row_DetailRS1['task3']==1){
    $point3 = 1;
}else{
    $point3 = 0;
}
if($row_DetailRS1['task4']==1){
    $point4 = 1;
}else{
    $point4 = 0;
}

if($row_DetailRS1['task5']==1){
    $point5 = 5;
}else{
    $point5 = 0;
}

if($row_DetailRS1['task6']==1){
    $point6 = 3;
}else{
    $point6 = 0;
}
if($row_DetailRS1['task7']==1){
    $point7 = 5;
}else{
    $point7 = 0;
}

if($row_DetailRS1['task8']==1){
    $point8 = 3;
}else{
    $point8 = 0;
}

if($row_DetailRS1['task9']==1){
    $point9 = 3;
}else{
    $point9 = 0;
}
if($row_DetailRS1['task10']==1){
    $point10 = 3;
}else{
    $point10 = 0;
}

if($row_DetailRS1['task11']==1){
    $point11 = 1;
}else{
    $point11 = 0;
}

if($row_DetailRS1['task12']==1){
    $point12 = 1;
}else{
    $point12 = 0;
}
if($row_DetailRS1['task13']==1){
    $point13 = 3;
}else{
    $point13 = 0;
}

if($row_DetailRS1['task14']==1){
    $point14 = 3;
}else{
    $point14 = 0;
}

if($row_DetailRS1['task15']==1){
    $point15 = 3;
}else{
    $point15 = 0;
}
if($row_DetailRS1['task16']==1){
    $point16 = 1;
}else{
    $point16 = 0;
}

if($row_DetailRS1['task17']==1){
    $point17 = 1;
}else{
    $point17 = 0;
}

if($row_DetailRS1['task18']==1){
    $point18 = 2;
}else{
    $point18 = 0;
}
if($row_DetailRS1['task19']==1){
    $point19 = 5;
}else{
    $point19 = 0;
}

if($row_DetailRS1['task20']==1){
    $point20 = 3;
}else{
    $point20 = 0;
}

$total=2+$point1+$point2+$point3+$point4+$point5+$point6+$point7+$point8+$point9+$point10+$point11+$point12+$point13+$point14+$point15+$point16+$point17+$point18+$point19+$point20;

$userID = $colname_DetailRS1;

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
  $updateSQL = sprintf("UPDATE TaskLottime SET lottimePlus=%s WHERE userID=%s",
                       GetSQLValueString($total, "int"),
                       GetSQLValueString($userID, "text"));

  mysqli_select_db($roywang21hb, $database_roywang21hb);
  $Result1 = mysqli_query($roywang21hb, $updateSQL) or die(mysqli_error($roywang21hb));

  $updateGoTo = "gameLottimeCount.php?recordID=".$userID;
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
      header(sprintf("Location: %s", $updateGoTo));exit;

$currentPage = $_SERVER["PHP_SELF"];

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_DetailRS1, $queryString_Recordset1);
?>