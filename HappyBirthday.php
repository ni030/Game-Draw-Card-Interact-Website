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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO message (`text`) VALUES (%s)",
                       GetSQLValueString($_POST['text'], "text"));
                      
  mysqli_select_db($roywang21hb ,$database_roywang21hb);
  $Result1 = mysqli_query($roywang21hb ,$insertSQL) or die(mysqli_error($roywang21hb));
}

mysqli_select_db($roywang21hb, $database_roywang21hb);
$query_Recordset1 = "SELECT * FROM message";
$Recordset1 = mysqli_query($roywang21hb, $query_Recordset1) or die(mysqli_error($roywang21hb));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>生日倒计时</title>
<meta name="CD" content="CountDown">
<meta name="description" content="时钟">
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" href="../css/loader.css">
<link rel="stylesheet" type="text/css" href="../scss/star.css">

<link rel="stylesheet" type="text/css" href="https://at.alicdn.com/t/font_1191451_h720mljzrsc.css">
<script src="../jquery/jquery-1.10.2.js"></script>
<script src="../js/app.js"></script>
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
<body>
    
<div class="container">
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
  <div class="circle-container">
    <div class="circle"></div>
  </div>
<div class="key">
<div class="iocnBox"><i class="iconfont icon-delete"></i></div>
<div class="empty">清空</div>
<textarea maxlength="15" placeholder="想对21岁的王源说的话..." rows="1" class="van-field__control"></textarea>
<div class="buts">发送</div>
</div>
<div class="today">
<div class="clock">
<div class="pos SS"></div>
<div class="pos MM"></div>
<div class="pos HH"></div>
<div class="spot"></div>
</div>
<div class="time"></div>
<div class="sydate"></div>
</div>
<div class="Barrage"></div>
<div class="message">发送弹幕</div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <input type="hidden" onkeyup="value=value.replace(/[^\w\u4E00-\u9FA5]/g,'')" value="" id="text" name="text"/>
    <input type="hidden" name="MM_insert" value="form1" />
</form>
<script>
    // 发送弹幕
    $(".message").click(function(){
        $(".key").addClass("keys");
        $(".key").removeClass("remove");
    });

    function Closs(){
      $(".key").removeClass("keys");
      $(".key").addClass("remove");
      setTimeout(function(){
          $(".key").removeClass("remove");
      },1000);
    };

    $(".iocnBox").click(function(){
      Closs()
    });
    $(".today").click(function(){
       var ksyss = $(".key").hasClass("keys");
       if(ksyss == true){
         Closs()
       }
    });

    var mess = "<?php do{
    echo "<span class='B-span2'>";
    echo $row_Recordset1['text'];
    echo"</span>";
    } while  ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>";
    $(".Barrage").append(mess);

    $(".buts").click(function(){
        var mes = $(".van-field__control").val();
        if(!mes){
          // alert("你还没输入内容呢!")
          var Tipss = "<div class='Tipss'>请输入内容</div>";
          $("body").append(Tipss);
          setTimeout(function(){
            $(".Tipss").remove();
          },1500)
        }else{
          //生成随机数: x上限，y下限     
          var x = 10;
          var y = 0;
          
          var col = ["#3fd316","#0dd2ef","#ff0000","#3fd316","#0dd2ef","#ffffff","#3fd316","#0dd2ef","#ff0000","#3fd316"]; 
          // 随机颜色
          var colors = parseInt(Math.random() * (x - y + 1) + y);
          // 随机高度
          var rand = parseInt(Math.random() * (x - y + 1) + y) * 15;
          // 随机速度
          var sudu = parseInt(Math.random() * (x - y + 1) + y) * 3;
          // 设置最低速度，禁止为0
          if(sudu < 1){
            sudu = 10;
          };
          var dasdass = " animation: Barrag " + sudu + "s linear infinite;";
          var dasdass2 = " -webkit-animation: Barrag " + sudu + "s linear infinite;";
          var colorss = "color:" + col[colors] + ";";
          var spans = "<span" + " style='top:" + rand + "px;" + colorss + dasdass + dasdass2 + "'>" + mes + "</span>";
          document.getElementById("text").value = mes;
          document.getElementById("form1").submit();
          $(".Barrage").append(spans);

          var Tips = "<div class='Tips'>发送成功</div>";
          $("body").append(Tips);
          setTimeout(function(){
            $(".Tips").remove();
          },1500)
        }

    });
    $(".empty").click(function(){
      $(".van-field__control").val("");
      $(".empty").css("opacity","0")
    });
    $(".van-field__control").bind('input propertychange', function() {
      var vals = $(".van-field__control").val();
      if(vals == ""){
        $(".empty").css("opacity","0")
      }else{
        $(".empty").css("opacity","1")
      }
    })
</script>
</div>
</body>
</html>