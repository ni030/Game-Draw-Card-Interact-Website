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
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE TaskLottime SET task1=%s, task2=%s, task3=%s,task4=%s, task5=%s, task6=%s,task7=%s, task8=%s, task9=%s,task10=%s, task11=%s, task12=%s,task13=%s, task14=%s, task15=%s,task16=%s, task18=%s,task19=%s, task20=%s WHERE userID=%s",
                       GetSQLValueString($_POST['task1'], "int"),
                       GetSQLValueString($_POST['task2'], "int"),
                       GetSQLValueString($_POST['task3'], "int"),
                       GetSQLValueString($_POST['task4'], "int"),
                       GetSQLValueString($_POST['task5'], "int"),
                       GetSQLValueString($_POST['task6'], "int"),
                       GetSQLValueString($_POST['task7'], "int"),
                       GetSQLValueString($_POST['task8'], "int"),
                       GetSQLValueString($_POST['task9'], "int"),
                       GetSQLValueString($_POST['task10'], "int"),
                       GetSQLValueString($_POST['task11'], "int"),
                       GetSQLValueString($_POST['task12'], "int"),
                       GetSQLValueString($_POST['task13'], "int"),
                       GetSQLValueString($_POST['task14'], "int"),
                       GetSQLValueString($_POST['task15'], "int"),
                       GetSQLValueString($_POST['task16'], "int"),
                       GetSQLValueString($_POST['task18'], "int"),
                       GetSQLValueString($_POST['task19'], "int"),
                       GetSQLValueString($_POST['task20'], "int"),
                       GetSQLValueString($_POST['userID'], "text"));

  mysqli_select_db($roywang21hb, $database_roywang21hb);
  $Result1 = mysqli_query($roywang21hb, $updateSQL) or die(mysqli_error($roywang21hb));

  $updateGoTo = "LottimeUpdate.php?recordID=".$_POST['userID'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
      header(sprintf("Location: %s", $updateGoTo));exit;
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' id='admin-css'  href='admin.css' type='text/css' media='all' />
<title>任务进度更改</title>
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
	font-size: 55px; 
}
.style8 { 
    color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: 50px; 
	font-weight: bold;

}
.style9 { 
	color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: 45px; 
}
/* Customize the label (the container) */
.container {
  display: block;
  position: relative;
  left:50%;
  margin-bottom: 50px;
  cursor: pointer;
  font-size: 44px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 50px;
  width: 50px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 18px;
  top: 10px;
  width: 10px;
  height: 20px;
  border: solid white;
  border-width: 0 6px 6px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
</head> 
<body class="oneColFixCtr">
<div id="container">
      <P class="style7" align="center">任务进度更改</P>
      <p class="style6">&nbsp;</p>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="85%" height="" border="8" align="center" bordercolor="#13D669"> 
         <tr align="center">
            <td width="" height="" nowrap="nowrap"><div align="center"><span class="style8">用户名</span></div></td>
            <td height=""><span class="style9"><?php echo $row_DetailRS1['username']; ?></span></td>
          </tr>
          <tr>
            <td width="250" height="40" align="center" nowrap="nowrap"><div align="center"><span class="style8">抽奖次数</span></div></td>
            <td height="35" align="center">
            <span class="style9"><?php echo $row_DetailRS1['lottimePlus']; ?></span>
            </td>
          </tr>
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">加入守护</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk1"  onclick="myFunction(this)" <?php if($row_DetailRS1['task1'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">群掉落1</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk2" onclick="myFunction(this)" <?php if($row_DetailRS1['task2'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">群掉落2</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk3" onclick="myFunction(this)" <?php if($row_DetailRS1['task3'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
           <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">群掉落2</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk4" onclick="myFunction(this)" <?php if($row_DetailRS1['task4'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">王源微博</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk5" onclick="myFunction(this)" <?php if($row_DetailRS1['task5'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">王源超话</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk6" onclick="myFunction(this)" <?php if($row_DetailRS1['task6'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
           <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">王源IG</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk7" onclick="myFunction(this)" <?php if($row_DetailRS1['task7'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">王源YT</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk8" onclick="myFunction(this)" <?php if($row_DetailRS1['task8'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">分享歌曲</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk9" onclick="myFunction(this)" <?php if($row_DetailRS1['task9'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
           <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">王源说</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk10" onclick="myFunction(this)" <?php if($row_DetailRS1['task10'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">关注源聚</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk11" onclick="myFunction(this)" <?php if($row_DetailRS1['task11'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">关注源据</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk12" onclick="myFunction(this)" <?php if($row_DetailRS1['task12'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
           <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">游戏1</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk13" onclick="myFunction(this)" <?php if($row_DetailRS1['task13'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">游戏2</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk14" onclick="myFunction(this)" <?php if($row_DetailRS1['task14'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">游戏3</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk15" onclick="myFunction(this)" <?php if($row_DetailRS1['task15'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          
           <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">电台投稿</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk16" onclick="myFunction(this)" <?php if($row_DetailRS1['task16'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">分享应援</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk18" onclick="myFunction(this)" <?php if($row_DetailRS1['task18'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
           <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">视频录制</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk19" onclick="myFunction(this)" <?php if($row_DetailRS1['task19'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          <tr align="center">
              <td width="192" height="60" align="center" nowrap="nowrap"><div align="center"><span class="style8">祝福评论</span></div></td>
              <td><label class="container"><input type="checkbox" id="chk20" onclick="myFunction(this)" <?php if($row_DetailRS1['task20'] == 1)echo 'checked';?>  /><span class="checkmark"></span></label></td>
          </tr>
          <tr>
            <td height="100" colspan="2" align="center" nowrap="nowrap"><div align="center"><span class="style9"></span>
              <input type="submit" class="style8" value="更新" />
            </div>              
            </td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
        <input type="hidden" id="txt1" name="task1" value="<?php echo $row_DetailRS1['task1']?>"/>
        <input type="hidden" id="txt2" name="task2" value="<?php echo $row_DetailRS1['task2']?>"/>
        <input type="hidden" id="txt3" name="task3" value="<?php echo $row_DetailRS1['task3']?>"/>
        <input type="hidden" id="txt4" name="task4" value="<?php echo $row_DetailRS1['task4']?>"/>
        <input type="hidden" id="txt5" name="task5" value="<?php echo $row_DetailRS1['task5']?>"/>
        
        <input type="hidden" id="txt6" name="task6" value="<?php echo $row_DetailRS1['task6']?>"/>
        <input type="hidden" id="txt7" name="task7" value="<?php echo $row_DetailRS1['task7']?>"/>
        <input type="hidden" id="txt8" name="task8" value="<?php echo $row_DetailRS1['task8']?>"/>
        <input type="hidden" id="txt9" name="task9" value="<?php echo $row_DetailRS1['task9']?>"/>
        <input type="hidden" id="txt10" name="task10" value="<?php echo $row_DetailRS1['task10']?>"/>
        
        <input type="hidden" id="txt11" name="task11" value="<?php echo $row_DetailRS1['task11']?>"/>
        <input type="hidden" id="txt12" name="task12" value="<?php echo $row_DetailRS1['task12']?>"/>
        <input type="hidden" id="txt13" name="task13" value="<?php echo $row_DetailRS1['task13']?>"/>
        <input type="hidden" id="txt14" name="task14" value="<?php echo $row_DetailRS1['task14']?>"/>
        <input type="hidden" id="txt15" name="task15" value="<?php echo $row_DetailRS1['task15']?>"/>
        
        <input type="hidden" id="txt16" name="task16" value="<?php echo $row_DetailRS1['task16']?>"/>
        <input type="hidden" id="txt18" name="task18" value="<?php echo $row_DetailRS1['task18']?>"/>
        <input type="hidden" id="txt19" name="task19" value="<?php echo $row_DetailRS1['task19']?>"/>
        <input type="hidden" id="txt20" name="task20" value="<?php echo $row_DetailRS1['task20']?>"/>
        <input type="hidden" name="userID" value="<?php echo $row_DetailRS1['userID']; ?>" />
      </form>
      <p>&nbsp;</p>
      <p><a href="TaskList.php"><img src="../image/ADback.png" alt="undo" width="" height="" /></a>&nbsp;<a href="mainPage.php"><img src="../image/ADindex.png" alt="home" width="" height=""/></a></p>
</div>
<script>
 function myFunction(el) {
       var txt = document.getElementById(el.id.replace('chk', 'txt'));

        if(el.checked) {
            txt.value = '1';
        }
        else
            txt.value = '0';
    }
</script>
</body>
</html>
<?php
mysqli_free_result($DetailRS1);
?>
