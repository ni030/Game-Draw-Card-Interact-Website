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
$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
mysqli_select_db($roywang21hb, $database_roywang21hb);
$query_DetailRS1 = sprintf("SELECT * FROM lottery WHERE nickname = %s", 
                   GetSQLValueString($colname_DetailRS1, "text"));
$DetailRS1 = mysqli_query($roywang21hb, $query_DetailRS1) or die(mysqli_error($roywang21hb));
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);

mysqli_select_db($roywang21hb, $database_roywang21hb);
$query_DetailRS2 = sprintf("SELECT * FROM info WHERE nickname = %s", 
                   GetSQLValueString($colname_DetailRS1, "text"));
$DetailRS2 = mysqli_query($roywang21hb, $query_DetailRS2) or die(mysqli_error($roywang21hb));
$row_DetailRS2 = mysqli_fetch_assoc($DetailRS2);

mysqli_select_db($roywang21hb, $database_roywang21hb); 
$query_A1 = sprintf("SELECT COUNT(*) FROM lottery WHERE nickname= %s", GetSQLValueString($colname_DetailRS1, "text"));
$A1= mysqli_query($roywang21hb, $query_A1) or die(mysqli_error($roywang21hb)); 
$row_A1= mysqli_fetch_assoc($A1); 
$totalRows_A1 = mysqli_num_rows($A1);

$minus = $row_A1['COUNT(*)'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户详情总结</title>
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
	font-size:26px; 
	font-weight: bold;
}
.style5 { 
	color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: xx-large; 
}
.style6 { 
	color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: large; 
}
.style7 { 
    color: #009900;
	font-size: 46px; 
}
.style8 { 
    color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: 30px; 
	font-weight: bold;

}
.style9 { 
	color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: 20px; 
}
</style>
</head> 
<body>
<P class="style7" align="center">用户详情总结</P>
<p class="style6">&nbsp;</p>
<table width="95%" height="" border="8" align="center" bordercolor="#13D669"> 
<tr align="center">
          <td height="" class="style8">昵称</td>
          <td height="" class="style8">真实名称</td>
          <td height="" class="style8">手机号</td>
          <td height="" class="style8">邮箱</td>
          <td height="" class="style8">地址</td>
          <td height="" class="style8">邮编</td>
          <td height="" class="style8">州属</td>
        </tr>
        <tr>
            <td height="20" align="left" class="style9"><?php echo $row_DetailRS2['nickname']; ?>&nbsp; </td>
            <td height="20" align="left" class="style9"><?php echo $row_DetailRS2['name']; ?>&nbsp; </td>
            <td height="20" align="left" class="style9"><?php echo $row_DetailRS2['phoneNum']; ?>&nbsp; </td>
            <td height="20" align="left" class="style9"><?php echo $row_DetailRS2['gmail']; ?>&nbsp; </td>
            <td height="20" align="left" class="style9"><?php echo $row_DetailRS2['address']; ?>&nbsp; </td>
            <td height="20" align="left" class="style9"><?php echo $row_DetailRS2['poscode']; ?>&nbsp; </td>
            <td height="20" align="left" class="style9"><?php echo $row_DetailRS2['negeri']; ?>&nbsp; </td>

          </tr>
          </table>
          <p class="style6">&nbsp;</p>
          <table width="60%" height="" border="8" align="center" bordercolor="#13D669"> 
    <tr>
         <td height="" class="style8" align="center">时间</td>
         <td height="" class="style8" align="center">礼物</td>
        </tr>
<?php do { ?>
<tr>
    <td height="20" align="left" class="style9"><?php echo $row_DetailRS1['created_at']; ?></td>
    <td height="20" align="left" class="style9"><?php echo $row_DetailRS1['gift']; ?></td>
</tr>
<?php } while ($row_DetailRS1 = mysqli_fetch_assoc($DetailRS1)); ?>
</table>
<p align="center" class="style4">已获得<?php echo $minus;?>张小卡</p>
<p class="style6">&nbsp;</p>
<p align="left"><a href="userInfoList.php"><img src="../image/ADback.png" alt="back" width="" height=""/></a></p>
<p align="left"><a href="mainPage.php"><img src="../image/ADindex.png" alt="home" width="" height=""/></a></p>
</body>
</html>