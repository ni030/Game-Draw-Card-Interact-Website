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
$query_DetailRS1 = sprintf("SELECT * FROM users WHERE userID = %s", GetSQLValueString($colname_DetailRS1, "text"));
$DetailRS1 = mysqli_query($roywang21hb, $query_DetailRS1) or die(mysqli_error($roywang21hb));
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);

mysqli_select_db($roywang21hb, $database_roywang21hb);
$query_DetailRS2 = sprintf("SELECT GROUP_CONCAT(gift) AS grp from lottery WHERE userID= %s", 
GetSQLValueString($colname_DetailRS1, "text"));
$DetailRS2 = mysqli_query($roywang21hb, $query_DetailRS2) or die(mysqli_error($roywang21hb));
$row_DetailRS2 = mysqli_fetch_assoc($DetailRS2);

 $editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$time=$row_DetailRS1['lottime'];
if($time>0){
    $newTime = $time-1;
}else{
    $newTime = '0';
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1") && $time>0) {
  $insertSQL = sprintf("INSERT INTO lottery (`nickname`, gift) VALUES (%s, %s)",
                       GetSQLValueString($_POST['nickname'], "text"),
                       GetSQLValueString($_POST['last'], "text"));
                      
  $updateSQL = sprintf("UPDATE users SET lottime=%s WHERE userID=%s",
                       GetSQLValueString($_POST['lottime'], "int"),
                       GetSQLValueString($colname_DetailRS1, "text"));

  $updateSQL2 = sprintf("UPDATE lottery SET userID=%s WHERE nickname=%s",
                       GetSQLValueString($colname_DetailRS1, "text"),
                       GetSQLValueString($_POST['nickname'], "text"));

  mysqli_select_db($roywang21hb ,$database_roywang21hb);
  $Result1 = mysqli_query($roywang21hb ,$insertSQL) or die(mysqli_error($roywang21hb));
                       
  mysqli_select_db($roywang21hb ,$database_roywang21hb);
  $Result1 = mysqli_query($roywang21hb ,$updateSQL) or die(mysqli_error($roywang21hb));
  
  mysqli_select_db($roywang21hb, $database_roywang21hb);
  $Result1 = mysqli_query($roywang21hb, $updateSQL2) or die(mysql_error($roywang21hb));
  
  mysqli_select_db($roywang21hb, $database_roywang21hb);
  $query_DetailRS2 = sprintf("SELECT GROUP_CONCAT(gift) AS grp from lottery WHERE userID= %s", 
  GetSQLValueString($colname_DetailRS1, "text"));
  $DetailRS2 = mysqli_query($roywang21hb, $query_DetailRS2) or die(mysqli_error($roywang21hb));
  $row_DetailRS2 = mysqli_fetch_assoc($DetailRS2);
  
  $updateGoTo = "LottimeCount.php?recordID=".$_POST['nickname'];
      header(sprintf("Location: %s", $updateGoTo));
}

mysqli_select_db($roywang21hb, $database_roywang21hb);
$query_Recordset1 = "SELECT * FROM lottery";
$Recordset1 = mysqli_query($roywang21hb, $query_Recordset1) or die(mysqli_error($roywang21hb));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>

<?php
do{
    $b = array();
    $invite2 = $row_DetailRS2['grp'];
    $b = explode(",",$invite2);
    } while  ($row_DetailRS2 = mysqli_fetch_assoc($DetailRS2));

$invite1 = '洄,Home归,你的名字是世界瞒着我最大的事情,希望你听懂的歌能越少越好,飘,疯人公园,一些悲伤又美好的事,流星也为你落下来了,奔跑吧青春,姐姐,答案,离家的人才会想听的故事,鱼缸旅馆,Stop the clocks,在哪里都很好,说唱百家姓,像小强一样活着,花瓣,奇妙直播频道,四百击,读山海经,圆舞曲,柔,这里,夜间游泳池,易碎的吻,彩虹云朵,源,滚烫的青春,姑娘,世界上没有真正的感同身受,吆不到台,随想,友谊地久天长,只要有想见的人就不是孤身一人,长歌行,我不知道,天使,孤注,我的童年,一样,Will You,The Wrong Things,做我自己,宝贝,骄傲,Sleep,十七,阳光不锈,长大以后的世界,最美的时光,因为遇见你';
$a = explode(",",$invite1);

	foreach ($a as $key=>$v1) {
		foreach($b as $key2=>$v2){
			if($v1==$v2){
			unset($a[$key]);//删除$a数组同值元素
			unset($b[$key2]);//删除$b数组同值元素
			}
		}
	}
	//var_dump($a);	
	$c = count($a);
	if ($c >= 8){
	    $d = 8;
	    $randIndex = array_rand($a, $d);
	    $card1=$a[$randIndex[0]];
        $card2=$a[$randIndex[1]];
        $card3=$a[$randIndex[2]];
        $card4=$a[$randIndex[3]];
        $card5=$a[$randIndex[4]];
        $card6=$a[$randIndex[5]];
        $card7=$a[$randIndex[6]];
        $card8=$a[$randIndex[7]];
	    $numLock = '';
	}else if($c == 7){
	    $d = 7;
	    $randIndex = array_rand($a, $d);
	    $card1=$a[$randIndex[2]];
        $card2=$a[$randIndex[3]];
        $card3=$a[$randIndex[0]];
        $card4=$a[$randIndex[4]];
        $card5=$a[$randIndex[6]];
        $card6=$a[$randIndex[5]];
        $card7=$a[$randIndex[1]];
        $card8="无奖";
	    $numLock = '7';
	}else if($c == 6){
	    $d = 6;
	    $randIndex = array_rand($a, $d);
	    $card1=$a[$randIndex[0]];
        $card2=$a[$randIndex[2]];
        $card3=$a[$randIndex[3]];
        $card4=$a[$randIndex[1]];
        $card5=$a[$randIndex[4]];
        $card6=$a[$randIndex[5]];
        $card7="无奖";
        $card8="无奖";
	    $numLock = '6,7';
	}else if($c == 5){
	    $d = 5;
	    $randIndex = array_rand($a, $d);
	    $card1=$a[$randIndex[1]];
        $card2=$a[$randIndex[4]];
        $card3=$a[$randIndex[2]];
        $card4=$a[$randIndex[0]];
        $card5=$a[$randIndex[3]];
        $card6="无奖";
        $card7="无奖";
        $card8="无奖";
	    $numLock = '5,6,7';
	}else if($c == 4){
	    $d = 4;
	    $randIndex = array_rand($a, $d);
	    $card1=$a[$randIndex[2]];
        $card2=$a[$randIndex[1]];
        $card3=$a[$randIndex[0]];
        $card4=$a[$randIndex[3]];
        $card5="无奖";
        $card6="无奖";
        $card7="无奖";
        $card8="无奖";
	    $numLock = '4,5,6,7';
	}else if($c == 3){
	    $d = 3;
	    $randIndex = array_rand($a, $d);
	    $card1=$a[$randIndex[0]];
        $card2=$a[$randIndex[2]];
        $card3=$a[$randIndex[1]];
        $card4="无奖";
        $card5="无奖";
        $card6="无奖";
        $card7="无奖";
        $card8="无奖";
	    $numLock = '3,4,5,6,7';
	}else if($c == 2){
	    $d = 2;
	    $randIndex = array_rand($a, $d);
	    $card1=$a[$randIndex[1]];
        $card2=$a[$randIndex[0]];
        $card3="无奖";
        $card4="无奖";
        $card5="无奖";
        $card6="无奖";
        $card7="无奖";
        $card8="无奖";
	    $numLock = '2,3,4,5,6,7';
	}else if($c == 1){
	    $d = 1;
	    $card1=implode("|",$a);
	    //implode("|",$a);
        $card2="无奖";
        $card3="无奖";
        $card4="无奖";
        $card5="无奖";
        $card6="无奖";
        $card7="无奖";
        $card8="无奖";
	    $numLock = '1,2,3,4,5,6,7';
	}else if($c == 0){
	    $d = 0;
	    $card1="无奖";
        $card2="无奖";
        $card3="无奖";
        $card4="无奖";
        $card5="无奖";
        $card6="无奖";
        $card7="无奖";
        $card8="无奖";
	    $numLock = '0,1,2,3,4,5,6,7';
	}
//	echo "ArrayLength".$c;
//	echo "PHPnumLock".$numLock;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>抽卡</title>
    <meta charset="UTF-8">
    <!--移动端需要的meta-->
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <!--关键词和描述-->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
	
    <!--css-->
    <link rel="stylesheet" href="css/rotate.css" />
    <link rel="stylesheet" href="../css/loader.css">
    <!--js-->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/rem.js"></script>
    <!--页面抽奖流程相关js-->
    <script type="text/javascript" src="js/rotate.js"></script>
    <!--传统的流式布局-->
    <style>
       body{
            margin: 0;
            padding: 0;
            background: url('../image/BG.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            margin-bottom: 0px;
        } 
        .jpBox{
            position: absolute;
            left: 50%;
            top:50%;
            transform: translate(-50%,-50%);
            font-size: 0.375rem;
            color: #FFFFFF;
            white-space: normal;
            text-align:center;
        }
        .jpBoxTitle{
            position: absolute;
            left: 50%;
            top:50%;
            transform: translate(-50%,-50%);
            font-size: 0.6rem;
            color: #FFFFFF;
            white-space: normal;
        }
        .title{
            width:100%;
            text-align: center;
            font-size: 33px;
            right:12px;
            margin-top: 60px;
            color: white;
            text-shadow: 1px 1px 2px white, 0 0 25px #90EE90, 0 0 5px #98FB98;
            margin-bottom: 40px;
        }
        .style1{
            font-size:40px;
        }
        .backToprofile{
            font-size:26px;
            text-align:center;
            width:100%;
            position:relative;
            margin:20px 0px 0px;
        }
        .backToprofile a:link {
        /* unvisited link */
        color: #FFFFFF;
        text-decoration: none;
        }
        /* visited link */
        .backToprofile a:visited {
        color: #ffffff;
        text-decoration: none;
        }
        /* mouse over link */
        .backToprofile a:hover {
        color: #A9A9A9;
        text-decoration: none;
        }
        /* selected link */
        .backToprofile a:active {
        color: #000000;
        text-decoration: none;
        }
    </style>
</head>
<script type="text/javascript">
    document.onreadystatechange = function() { 
    if (document.readyState !== "complete") { 
        document.querySelector("body").style.visibility = "hidden"; 
        document.querySelector("#loader").style.visibility = "visible"; 
    } else { 
        document.querySelector("#loader").style.display = "none"; 
        document.querySelector("body").style.visibility = "visible"; 
    } 
}; 
</script>
<div id="loader" class="bod">
<div class="loader">
  <span></span>
  <span></span>
  <span></span>
</div></div>
<body style="max-width: 640px;display: block;margin: auto">
<!--当翻牌到了最大数量就显示所有奖品-->

<div class="title">
    <?php if($row_DetailRS1['lottime']>0){
    echo "抽奖次数:".$row_DetailRS1['lottime'];
    }else{
    echo "无抽奖机会";}?></div>
<div id="allParent" class="Y-content" >
    <div class="item i1">
        <div class="parent">
            <div class="face">
                <div class="jpBox">
                <?php echo $card1; ?>
                </div>
            </div>
            <div class="back"><img src="../image/a1.png" style="width: 100%;height: 100%"></div>
        </div>
    </div>
    <div class="item i2">
        <div class="parent">
            <div class="face">
                <div class="jpBox">
                <?php echo $card2; ?>
                </div>
            </div>
            <div class="back"><img src="../image/a1.png" style="width: 100%;height: 100%"></div>
        </div>
    </div>
    <div class="item i3">
        <div class="parent">
            <div class="face">
                <div class="jpBox">
                <?php echo $card3; ?>
                </div>
            </div>
            <div class="back"><img src="../image/a1.png" style="width: 100%;height: 100%"></div>
        </div>
    </div>
    <div class="item i4">
        <div class="parent">
            <div class="face">
                <div class="jpBox">
                <?php echo $card4; ?>
                </div>
            </div>
            <div class="back"><img src="../image/a1.png" style="width: 100%;height: 100%"></div>
        </div>
    </div>
    <div class="item i5">
        <div class="parent">
            <div class="face">
                <div class="jpBox">
                <?php echo $card5; ?>
                </div>
            </div>
            <div class="back"><img src="../image/a1.png" style="width: 100%;height: 100%"></div>
        </div>
    </div>
    <div class="item i6">
        <div class="parent">
            <div class="face">
                <div class="jpBox">
                <?php echo $card6; ?>
                </div>
            </div>
            <div class="back"><img src="../image/a1.png" style="width: 100%;height: 100%"></div>
        </div>
    </div>
    <div class="item i7">
        <div class="parent">
            <div class="face">
                <div class="jpBox">
                <?php echo $card7; ?>
                </div>
            </div>
            <div class="back"><img src="../image/a1.png" style="width: 100%;height: 100%"></div>
        </div>
    </div>
    <div class="item i8">
        <div class="parent">
            <div class="face">
                <div class="jpBox">
                <?php echo $card8; ?>
                </div>
            </div>
            <div class="back"><img src="../image/a1.png" style="width: 100%;height: 100%"></div>
        </div>
    </div>
    <div class="selectBox" id="">
        <div class="parent">
            <div class="face">
                <div class="jpBoxTitle">
                    抽卡
                </div>
            </div>
            <div class="back"></div>
        </div>
    </div>
</div>
<div class="backToprofile"><p align="center"><a href="userProfile.php">返回主页</a></p></div>
    <!--提示框-->

    <div id="tooltip" style="display:none;position: fixed;left: 50%;top: 50%;transform: translate(-50%,-50%);font-size: 18px;background-color: rgba(0,0,0,0.5);color: white;padding: 5px 10px;z-index: 1000;white-space: nowrap"></div>
    <p class="style1">&nbsp;</p>
<script type="text/javascript">
    //提示框
    function showTool(str){
        var ele =  document.getElementById("tooltip");
        ele.innerHTML = str;
        ele.style.display="";
        setTimeout(hideTool,1000);
    }
    function hideTool(str){
        var ele =  document.getElementById("tooltip");
        ele.innerHTML = str;
        ele.style.display="none";
    }
    window.onload = function(){
      var obj =   $("#allParent").rotateEx({
            maxNum:1,
            noFaceEle:[<?php echo $numLock; ?>],
            maxNumCall:function(){
                showTool("翻到了最大的数量啦");
            },
            clickAmtStart:function(o1,o2,o3){
                showTool("恭喜抽中"+o3.innerText);
                document.getElementById("last").value = o3.innerText;
                var num = <?php echo $row_DetailRS1['lottime']; ?>;
                if(num>0){
                    document.getElementById("form1").submit();
                }else{
                    return;
                }
            },
            clickAmtEnd:function(o1,o2,ele,allO){
                if(allO.option.maxNum == o2.getZNum()){
                    o2.allFace();
                }
            },
            changeAmtCall:function(o1,o2){
                //随机修改奖品的位置
                if(<?php echo $c; ?> > 7){
                obj.reset();
                }
            }
        });
        obj.rotate.allBack();
    }
</script>
   <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
          <p><input type="hidden" name="nickname" value="<?php echo $row_DetailRS1['username']; ?>" /></p>
          <p><input type="hidden" name="last" id="last" value="" /></p>
          <p><input type="hidden" name="lottime" value="<?php echo $newTime; ?>" /></p>
          <input type="hidden" name="MM_insert" value="form1" />
      </form>

</body>
</html>