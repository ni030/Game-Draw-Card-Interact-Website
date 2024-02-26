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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

function generate_password($len = 8){
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $len );
    return $password;
    }
    
$param_password = generate_password();
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    
    
    $insertSQL1 = sprintf("INSERT INTO users (username,password) VALUES (%s,%s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"));
                       
    mysqli_select_db($roywang21hb ,$database_roywang21hb);
    $Result1 = mysqli_query($roywang21hb ,$insertSQL1) or die(mysqli_error($roywang21hb));                   

    $insertSQL2 = sprintf("INSERT INTO info (nickname) VALUES (%s)",
                       GetSQLValueString($_POST['username'], "text"));
                       
    mysqli_select_db($roywang21hb ,$database_roywang21hb);
    $Result1 = mysqli_query($roywang21hb ,$insertSQL2) or die(mysqli_error($roywang21hb));
                       
    $insertSQL3 = sprintf("INSERT INTO TaskLottime (username) VALUES (%s)",
                       GetSQLValueString($_POST['username'], "text"));              
                       
    mysqli_select_db($roywang21hb ,$database_roywang21hb);
    $Result1 = mysqli_query($roywang21hb ,$insertSQL3) or die(mysqli_error($roywang21hb));
  
  $updateGoTo = "userIDupdate.php?recordID=".$_POST['username'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
      header(sprintf("Location: %s", $updateGoTo));exit;
}
        
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysqli_select_db($roywang21hb, $database_roywang21hb);
$query_Recordset1 = "SELECT * FROM users";
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
<title>用户名单(新用户注册)</title>
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
	font-size: xx-large; 
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
	font-size: 30px; 
	font-weight: bold;

}
.style9 { 
	color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: 20px; 
}
.form-control {
    display: block;
    position: relative;
    margin:20px auto 0px;
    top:-10px;
    left:10px;
    width: 280px;
    height: 30px;
    padding: 3px 6px;
    font-size: 20px;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #3CB371;
    border-radius: 2px;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.button{
    border-radius: 25px;
    background: #3CB371;
    width: 150px;
    position: relative;
    margin:20px auto 0px;
    left:80px;
    font-size:20px;
    color:#ffffff;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
</style>
</head> 
<p class ="style7">注册</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <p class = style8>用户名</p>
    <input type="text" name="username" class="form-control">
                <input type="hidden" name="password" class="form-control" value="<?php echo $param_password; ?>">
                <input type="submit" class="button" value="提交">
                <input type="hidden" name="MM_insert" value="form1" />
        </form>
<P class="style7" align="center">用户名单</P>
<p class="style6">&nbsp;</p>
<table width="95%" height="" border="8" align="center" bordercolor="#13D669">
        <tr align="center">
          <td height="" class="style8">ID</td>
          <td height="" class="style8">用户名</td>
          <td height="" class="style8">密码</td>
          <td height="" class="style8">加入时间</td>
          <td height="" class="style8">抽奖次数</td>
        </tr>
        <?php do { ?>
          <tr>
            <td height="" align="left" class="style5"><?php echo $row_Recordset1['userID']; ?>&nbsp; </td>
            <td height="" align="left" class="style9"><a href="userConclude.php?recordID=<?php echo $row_Recordset1['username']; ?>"/><?php echo $row_Recordset1['username']; ?>&nbsp; </td>
            <td height="" align="left" class="style9"><?php echo $row_Recordset1['password']; ?>&nbsp; </td>
            <td height="" align="left" class="style9"><?php echo $row_Recordset1['created_at']; ?>&nbsp; </td>
            <td height="" align="center" class="style9"><?php echo $row_Recordset1['lottime']; ?>&nbsp; </td>
          </tr>
          <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
      </table>
<p class="style6">&nbsp;</p>
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
      <p class="style6">&nbsp;</p>
      <p align="left"><a href="mainPage.php"><img src="../image/ADindex.png" alt="home" width="" height=""/></a></p>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
