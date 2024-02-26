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
$query_DetailRS1 = sprintf("SELECT * FROM users WHERE username = %s", GetSQLValueString($colname_DetailRS1, "text"));
$DetailRS1 = mysqli_query($roywang21hb, $query_DetailRS1) or die(mysql_error($roywang21hb));
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);
$totalRows_DetailRS1 = mysqli_num_rows($DetailRS1);

mysqli_select_db($roywang21hb, $database_roywang21hb);
$query_DetailRS2 = sprintf("SELECT * FROM TaskLottime WHERE username = %s", GetSQLValueString($colname_DetailRS1, "text"));
$DetailRS2 = mysqli_query($roywang21hb, $query_DetailRS2) or die(mysql_error($roywang21hb));
$row_DetailRS2 = mysqli_fetch_assoc($DetailRS2);
$totalRows_DetailRS2 = mysqli_num_rows($DetailRS2);

$TKuserID = $row_DetailRS1['userID'];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
  $updateSQL = sprintf("UPDATE TaskLottime SET userID=%s WHERE username=%s",
                       GetSQLValueString($TKuserID, "text"),
                       GetSQLValueString($colname_DetailRS1, "text"));

  mysqli_select_db($roywang21hb, $database_roywang21hb);
  $Result1 = mysqli_query($roywang21hb, $updateSQL) or die(mysql_error());

  $updateGoTo = "userList.php";

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