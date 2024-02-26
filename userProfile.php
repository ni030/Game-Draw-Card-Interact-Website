<?php
session_start(); 
require_once('../Connections/roywang21hb.php');
   
if (!isset($_SESSION['username'])) { 
    $_SESSION['msg'] = "You have to log in first"; 
    header('location: login.php'); 
} 
 if (isset($_SESSION['success'])) : ?> 
                    <?php
                        echo $_SESSION['success'];  
                        unset($_SESSION['success']); 
                    ?> 
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
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_DetailRS1 = "-1";
  $colname_DetailRS1 = $_SESSION['username'];
$name = $colname_DetailRS1;

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL2 = sprintf("UPDATE info SET name=%s, phoneNum=%s, gmail=%s, address=%s, poscode=%s, negeri=%s WHERE nickname=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['phoneNum'], "int"),
                       GetSQLValueString($_POST['gmail'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['poscode'], "int"),
                       GetSQLValueString($_POST['negeri'], "text"),
                       GetSQLValueString($_POST['nickname'], "text"));
                       
    mysqli_select_db($roywang21hb, $database_roywang21hb);
    $Result2 = mysqli_query($roywang21hb, $updateSQL2) or die(mysqli_error($roywang21hb));    
}
    mysqli_select_db($roywang21hb, $database_roywang21hb);
    $query_DetailRS3 = sprintf("SELECT * FROM info WHERE nickname = %s", GetSQLValueString($_SESSION['username'], "text"));
    $DetailRS3 = mysqli_query($roywang21hb, $query_DetailRS3) or die(mysqli_error($roywang21hb));
    $row_DetailRS3 = mysqli_fetch_assoc($DetailRS3);
    
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL1 = sprintf("UPDATE users SET password=%s WHERE username=%s",
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['username'], "text"));
                       
    mysqli_select_db($roywang21hb, $database_roywang21hb);
    $Result1 = mysqli_query($roywang21hb, $updateSQL1) or die(mysqli_error($roywang21hb));    
}

mysqli_select_db($roywang21hb, $database_roywang21hb);
$query_Recordset1 =sprintf("SELECT * FROM lottery WHERE nickname = %s", GetSQLValueString($_SESSION['username'], "text"));
$Recordset1 = mysqli_query($roywang21hb, $query_Recordset1) or die(mysqli_error($roywang21hb));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);

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

mysqli_select_db($roywang21hb, $database_roywang21hb); 
$query_A1 = sprintf("SELECT COUNT(*) FROM lottery WHERE nickname= %s", GetSQLValueString($colname_DetailRS1, "text"));
$A1= mysqli_query($roywang21hb, $query_A1) or die(mysqli_error($roywang21hb)); 
$row_A1= mysqli_fetch_assoc($A1); 
$totalRows_A1 = mysqli_num_rows($A1);

$userID = $row_DetailRS1['userID'];
$plus = $row_DetailRS2['lottimePlus'];
$minus = $row_A1['COUNT(*)'];
$Ftotal = $plus-$minus;
 
  $updateSQL = sprintf("UPDATE info SET userID=%s WHERE nickname=%s",
                       GetSQLValueString($userID, "text"),
                       GetSQLValueString($colname_DetailRS1, "text"));
                       
  mysqli_select_db($roywang21hb, $database_roywang21hb);
  $Result1 = mysqli_query($roywang21hb, $updateSQL) or die(mysql_error());

  $updateSQL = sprintf("UPDATE TaskLottime SET userID=%s WHERE username=%s",
                       GetSQLValueString($userID, "text"),
                       GetSQLValueString($colname_DetailRS1, "text"));
                       
  mysqli_select_db($roywang21hb, $database_roywang21hb);
  $Result1 = mysqli_query($roywang21hb, $updateSQL) or die(mysql_error());
  
  $updateSQL = sprintf("UPDATE lottery SET userID=%s WHERE nickname=%s",
                       GetSQLValueString($userID, "text"),
                       GetSQLValueString($colname_DetailRS1, "text"));

  mysqli_select_db($roywang21hb, $database_roywang21hb);
  $Result1 = mysqli_query($roywang21hb, $updateSQL) or die(mysql_error());
  
   $updateSQL = sprintf("UPDATE users SET lottime=%s WHERE username=%s",
                       GetSQLValueString($Ftotal, "int"),
                       GetSQLValueString($colname_DetailRS1, "text"));

  mysqli_select_db($roywang21hb, $database_roywang21hb);
  $Result1 = mysqli_query($roywang21hb, $updateSQL) or die(mysqli_error($roywang21hb));

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

<html>
<head>
    <title>主页</title>
    <meta charset="UTF-8">
    <!--移动端需要的meta-->
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <script type="text/javascript">
<!--
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
//-->
</script>
    <link rel="stylesheet" href="../css/formUser.css">
</head>
<body>
<div class="welcome"><?php  if (isset($_SESSION['username'])) : ?> 
            <p> 
                嗨，  
                <strong> 
                    <?php echo $_SESSION['username']; ?> 
                </strong> 
            </p> 
        <?php endif ?> </div>
<div class="materialContainer">
	<div class="box">
	    <div class="content1" id="content1">
	    <p class="ptitle">密码</p>
	    <div class="password"><?php echo $row_DetailRS1['password'];?></div>
	    <p class="change" align="center">修改密码</p>
	    <p class="line"></p><p class="point"></p><p class="line2"></p>
	    <p class="lottime">恭喜您获得<?php echo $row_DetailRS1['lottime'];?>抽奖次数</p>
	    <div class="button"><a href="lottery.php?recordID=<?php echo $row_DetailRS1['userID']; ?>" tite="lottery">抽卡</a></div>
	    <div class="button2"><a href="#" tite="lottery">游戏</a></div>
	     <!-- 有游戏放："gamex.php?recordID=php....."；无游戏放：#--> 
	    <div class="logout"><a href="logout.php" tite="logout">登出</a></div>
</div>
<div class="renew" id="renew">
	    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
	        <p class="labelP">新密码</p>
            <input type="text" name="password" class="form-controlP" value="">
            <input type="submit" onclick="MM_popupMsg('新密码修改成功')" class="updateP" value="更改" />
            <input type="hidden" name="MM_update" value="form1" />
            <input type="hidden" name="username" value="<?php echo $row_DetailRS1['username']; ?>" />
	   </form><div class="back" id="back">返回</div>
	    </div>
	    
	   <div class="content2" id="content2">
	       <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
	       <p class="label">真实姓名</p>
                <input type="text" name="name" class="form-control" value="<?php echo $row_DetailRS3['name']; ?>">
           <p class="label">手机号</p>
                <input type="int" name="phoneNum" class="form-control" value="<?php echo $row_DetailRS3['phoneNum']; ?>">
           <p class="label">邮箱地址</p>
                <input type="text" name="gmail" class="form-control" value="<?php echo $row_DetailRS3['gmail']; ?>">
           <p class="label">收件地址</p>
                <input type="text" name="address" class="form-control" value="<?php echo $row_DetailRS3['address']; ?>">    
           <p class="label">邮编</p>
                <input type="int" name="poscode" class="form-control" value="<?php echo $row_DetailRS3['poscode']; ?>">  
           <p class="label">州属</p>
              <label for="negeri"></label>
              </span>
              <div align="left">
                <select name="negeri" id="negeri" class="form-control">
                  <option value="<?php echo $row_DetailRS3['negeri']; ?>"><?php echo $row_DetailRS3['negeri']; ?></option>
                  <option value="JOHOR">JOHOR</option>
                  <option value="KEDAH">KEDAH</option>
                  <option value="KELANTAN">KELANTAN</option>
                  <option value="NEGERI SEMBILAN">NEGERI SEMBILAN</option>
                  <option value="PAHANG">PAHANG</option>
                  <option value="PULAU PINANG">PULAU PINANG</option>
                  <option value="PERAK">PERAK</option>
                  <option value="PERLIS">PERLIS</option>
                  <option value="SABAH">SABAH</option>
                  <option value="SARAWAK">SARAWAK</option>
                  <option value="SELANGOR">SELANGOR</option>
                  <option value="TERENGGANU">TERENGGANU</option>
                  <option value="KUALA LUMPUR">KUALA LUMPUR</option>
                  <option value="LABUAN">LABUAN</option>
                  <option value="PUTRAJAYA">PUTRAJAYA</option>
                </select>
            </div>
            <p class="remind">抽奖所得实体小卡邮寄地址仅限马来西亚</p>
              <input type="submit" onclick="MM_popupMsg('修改成功,抽奖所得实体小卡邮寄地址仅限马来西亚')" class="update" value="更新" />
        <input type="hidden" name="MM_update" value="form2" />
        <input type="hidden" name="nickname" value="<?php echo $row_DetailRS3['nickname']; ?>" />
      </form>
	   </div>
	   
	   <div class="content3" id="content3">
	       <table width="250px" height="" border="2" align="center" bordercolor="#2E8B57"> 
    <tr align="center">
        <td height="30px" width="100px" >日期</td>
        <td height="30px" width="150px">获得小卡</td>
        </tr>
<?php do { ?>
<tr align="center">
    <td><?php echo $row_Recordset1['created_at']; ?></td>
    <td><?php echo $row_Recordset1['gift']; ?></td>
</tr>
<?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
</table>
<p class="style1">&nbsp;</p>
<p class="range" align="center">已获得<?php echo $minus;?>张小卡，请再接再厉！</p>
	   </div>
        </div>
        <div class="title" id="t1">个人主页</div>
        <div class="title2" id="t2">个人信息</div>
        <div class="title3" id="t3">抽奖记录</div>
        </div>
    </body>
<script src="../jquery/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function(){
        document.getElementById("content2").style.display = "none";
        document.getElementById("content3").style.display = "none";
        document.getElementById("renew").style.display = "none";

});
$(".title").click(function (){
	    $('.title').css('background-color','#FFFFFF')
    	$('.title').css('color','#2E8B57')
    	$('.title').css('opacity','1')
    	$('.title2').css('background-color','#2E8B57')
    	$('.title2').css('color','#FFFFFF')
    	$('.title2').css('opacity','0.85')
    	$('.title3').css('background-color','#2E8B57')
    	$('.title3').css('color','#FFFFFF')
    	$('.title3').css('opacity','0.85')
    	document.getElementById("content2").style.display = "none"
    	document.getElementById("content3").style.display = "none"
        document.getElementById("content1").style.display = "block"
        document.getElementById("renew").style.display = "none"
})
$(".title2").click(function (){
	    $('.title2').css('background-color','#FFFFFF')
    	$('.title2').css('color','#2E8B57')
    	$('.title2').css('opacity','1')
    	$('.title').css('background-color','#2E8B57')
    	$('.title').css('color','#FFFFFF')
    	$('.title').css('opacity','0.85')
    	$('.title3').css('background-color','#2E8B57')
    	$('.title3').css('color','#FFFFFF')
    	$('.title3').css('opacity','0.85')
    	document.getElementById("content1").style.display = "none"
    	document.getElementById("content3").style.display = "none"
        document.getElementById("content2").style.display = "block"
        document.getElementById("renew").style.display = "none"

})
$(".title3").click(function (){
	    $('.title3').css('background-color','#FFFFFF')
    	$('.title3').css('color','#2E8B57')
    	$('.title3').css('opacity','1')
    	$('.title').css('background-color','#2E8B57')
    	$('.title').css('color','#FFFFFF')
    	$('.title').css('opacity','0.85')
    	$('.title2').css('background-color','#2E8B57')
    	$('.title2').css('color','#FFFFFF')
    	$('.title2').css('opacity','0.85')
    	document.getElementById("content1").style.display = "none"
    	document.getElementById("content2").style.display = "none"
        document.getElementById("content3").style.display = "block"
        document.getElementById("renew").style.display = "none"
})
$(".change").click(function (){
        document.getElementById("renew").style.display = "block"
        document.getElementById("content1").style.display = "none"
})
$(".back").click(function (){
        document.getElementById("renew").style.display = "none"
        document.getElementById("content1").style.display = "block"
})
</script>
</html>