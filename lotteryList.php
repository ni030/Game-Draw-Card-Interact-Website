<?php
  
// Starting the session, to use and 
// store data in session variable 
session_start(); 
require_once('../Connections/roywang21hb.php');
   
// If the session variable is empty, this  
// means the user is yet to login 
// User will be sent to 'login.php' page 
// to allow the user to login 
if (!isset($_SESSION['username'])) { 
    $_SESSION['msg'] = "请登入"; 
    header('location: RoyAdminLogin.php'); 
} 
 if (isset($_SESSION['success'])) : ?> 
                    <?php
                        echo $_SESSION['success'];  
                        unset($_SESSION['success']); 
                    ?> 
        <?php endif ?> 
   
        <!-- information of the user logged in -->
        <!-- welcome message for the logged in user -->
        <?php  if (isset($_SESSION['username'])) : ?> 
            <p> 
                Welcome  
                <strong> 
                    <?php echo $_SESSION['username']; ?> 
                </strong> 
            </p> 
        <?php endif ?> 
<?php 
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
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 15;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysqli_select_db($roywang21hb, $database_roywang21hb);
$query_Recordset1 = "SELECT * FROM lottery";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysqli_query($roywang21hb, $query_limit_Recordset1) or die(mysqli_error($roywang21hb));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysqli_query($roywang21hb,$query_Recordset1);
  $totalRows_Recordset1 = mysqli_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

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
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>抽奖总名单</title>
<style type="text/css">
body { 
	font: 100% Verdana, Arial, Helvetica, sans-serif; 
	padding: 0; 
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */ 
	color: #000000; 
	background-color: #FFFFFF; 
}
.oneColFixCtr #container {
	width: 90%;  /* using 20px less than a full 800px width allows for browser chrome and avoids a horizontal scroll bar */
	background: #FFFFFF;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	border: 0px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
}
.oneColFixCtr #mainContent {
	padding: 0 20px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
}
.style1 { 
	color: #09630C; 
	font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;
	font-size: 50px; 
	-webkit-text-stroke: 5px black #247C27 ; 
}
.style2{
    block:#000000;
}
.style3 { 
	color: #000000; 
	font-family:  Georgia, "Times New Roman", Times, serif;
	font-size: xx-large; 
}
.style4 { 
	color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: xx-large; 
}
.style5 { 
	color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: x-large; 
}
.style6 { 
	color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: x-large; 
}
.style7 { 
    color: #009900;
	font-size: 46px; 
}
.style8 { 
    color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: 35px; 
	font-weight: bold;

}
.style9 { 
	color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: 30px; 
}
.style10{
    color:red;
    font-size:18px;
}
</style>
</head> 
<P class="style7" align="center">抽奖总名单</P>
<p class="style6">&nbsp;</p>
<P class="style10">删除前通知小O</P>
<table width="80%" height="" border="8" align="center" bordercolor="#13D669">
        <tr align="center">
          <td height="45" class="style8">ID</td>
          <td height="45" class="style8">用户名</td>
          <td height="45" class="style8">奖励</td>
          <td height="45" align="center" class="style8">删除</td>
        </tr>
        <?php do { ?>
          <tr>
            <td height="35" align="left" class="style9"><?php echo $row_Recordset1['lotteryID']; ?>&nbsp; </td>
            <td height="35" align="left" class="style9"><a href="userConclude.php?recordID=<?php echo $row_Recordset1['nickname']; ?>"/><?php echo $row_Recordset1['nickname']; ?>&nbsp; </td>
            <td height="35" align="left" class="style9"><?php echo $row_Recordset1['gift']; ?>&nbsp; </td>
            <td height="35" align="center" class="style9"><a href="lotteryDelete.php?recordID=<?php echo $row_Recordset1['lotteryID']; ?>" onclick="return confirm('确定删除？')"><img src="../image/ADdelete.png" alt="delete" width="" height="" /></a></td>
          </tr>
          <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
      </table>
      <p align="center" class="style6">&nbsp;</p>
      <table border="0">
        <tr>
          <td class="style4"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a>
                <?php } // Show if not first page ?>          </td>
          <td class="style4"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Previous</a>
                <?php } // Show if not first page ?>          </td>
          <td class="style4"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a>
                <?php } // Show if not last page ?>          </td>
          <td class="style4"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>
                <?php } // Show if not last page ?>          </td>
        </tr>
      </table>
      <span class="style4">Records <?php echo ($startRow_Recordset1 + 1) ?> to <?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?> of <?php echo $totalRows_Recordset1 ?></span>
            <p align="center" class="style6">&nbsp;</p>
      <p align="left"><a href="mainPage.php"><img src="../image/ADindex.png" alt="home" width="" height=""/></a></p>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
