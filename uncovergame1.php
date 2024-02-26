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
$DetailRS1 = mysqli_query($roywang21hb, $query_DetailRS1) or die(mysqli_error($roywang21hb));
$row_DetailRS1 = mysqli_fetch_assoc($DetailRS1);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    
    $updateSQL = sprintf("UPDATE TaskLottime SET task13=%s WHERE userID=%s",
                       GetSQLValueString($_POST['win'], "int"),
                       GetSQLValueString($colname_DetailRS1, "text"));
                       
    mysqli_select_db($roywang21hb ,$database_roywang21hb);
    $Result1 = mysqli_query($roywang21hb ,$updateSQL) or die(mysqli_error($roywang21hb));
    
 $updateGoTo = "gameLottimeUpdate.php?recordID=".$colname_DetailRS1;
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
      header(sprintf("Location: %s", $updateGoTo));
}
    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Step On With Roy</title>
<meta name="game1" content="game1">
<meta name="description">
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0, user-scalable=no">
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
<link rel="stylesheet" href="../css/game1.css">
<link rel="stylesheet" href="../css/loader.css">
<body>
<div class="title">Step On With Roy</div>
<h3 id ="h3">点击所有绿格子<br>得分118者获得3抽奖机会</h3>
<div id="count"></div>
<div id="box"  class="box">

<div id="cont">
<div id="go">
<span>开始游戏</span>
</div>
<div id="main"></div>
</div>
</div>
</body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <p><input type="hidden" name="win" id="last" value="" /></p>
    <p><input type="hidden" name="userID" value="<?php echo $colname_DetailRS1;?>" /></p>
     <input type="hidden" name="MM_update" value="form1" />
</form>
<script src="../jquery/jquery-1.10.2.js"></script>

<script>
  //得当前样式
    function getStyle(obj,arrt){
  //兼容IE
      return obj.currentStyle ? obj.currentStyle[arrt] : getComputedStyle(obj,null)[arrt];
  }

  var main = document.getElementById('main');
  var go = document.getElementById('go');
  var count = document.getElementById('count');
  var h3 = document.getElementById('h3');
  var cols = ['#006400','#008000','#32CD32','#90EE90'];
  var box = document.getElementById('box');
  var bg = new Audio('../audio/game1_bg.mp3');


  //动态创建div
    function cDiv(classname){
  //创建div
      var oDiv = document.createElement('div');
  //随机值
      var index = Math.floor(Math.random()*4);
  //行 添加相应的class类
      oDiv.className = classname; 
  //创建行之后再动态创建4个小div并添加到行里面 
        for(var j =0;j<4;j++){
          var iDiv = document.createElement('div'); 
          oDiv.appendChild(iDiv); 
        }
  //然后把行添加到main里面
  //判断需要添加的位置
        if(main.children.length == 0){
          main.appendChild(oDiv);
        }else {
          main.insertBefore(oDiv, main.children[0]);
        }
  //随机给行里面的某一个div添加背景色 
    oDiv.children[index].style.backgroundColor = cols[index];
  //标记颜色盒子
    oDiv.children[index].className = "i";
  }


  //移动div
  function move(obj){
  //关闭上一个定时器
      clearInterval(obj.timer);
  //默认速度与计分
      var speed = 4,num = 0;
  //定时器管理与开启定时器
      obj.timer = setInterval(function(){
  //速度 
      var step = parseInt(getStyle(obj,'top')) + speed;
  //移动盒子
      obj.style.top = step + 'px';
  //判断并创建新的盒子
        if(parseInt(getStyle(obj,'top')) >= 0){  
          cDiv('row');
          obj.style.top = -100 + 'px';
        }
  //删除边界外的盒子
        if(obj.children.length == 6){
  //删除前，如果有盒子没有点击则结束游戏
          for(var i = 0;i<4;i++){
            if(obj.children[obj.children.length - 1].children[i].className == 'i'){
  //游戏结束
              obj.style.top = '-150px';
              count.innerHTML = '游戏结束,最高得分: ' + num;
  //关闭定时器
              clearInterval(obj.timer);
  //显示开始游戏
              bg.pause();
              bg.currentTime = 0
              go.children[0].innerHTML = '重新开始';
              go.style.display = "block";  
              if (num >= 118){
              var div=$('<div class="ann">恭喜获得3个抽奖机会点击去抽奖</div><div class="win">通关成功</div>')
              $('div').remove('.box')
              var audioWin = new Audio('../sound_effect/game1_win.mp3')
              audioWin.play()
              $('body').append(div)
			  back()
          }else{
              var audioErr = new Audio('../sound_effect/game1_error.mp3')
              audioErr.play()
          }
            }
          }  
          obj.removeChild(obj.children[obj.children.length - 1]);
        }

  //点击与计分
  obj.onmousedown = function(event){
  //点击的不是白盒子 
  // 兼容IE
      event = event || window.event;
      if((event.target? event.target : event.srcElement).className          == 'i'){
  //点击后的盒子颜色
        (event.target? event.target : event.srcElement).style.backgroundColor = "#bbb";
  //清除盒子标记
        (event.target? event.target : event.srcElement).className             = '';
  //计分
        num++;
  //显示得分
        count.innerHTML = '当前得分: ' + num;
        }
        else{
  //游戏结束
          obj.style.top = 0;
          bg.pause();
          bg.currentTime = 0
          count.innerHTML = '游戏结束,最高得分: ' + num;
          if (num >=118){
              var div=$('<div class="ann">恭喜获得3个抽奖机会点击去抽奖</div><div class="win">通关成功</div>')
              $('div').remove('.box')
              var audioWin = new Audio('../sound_effect/game1_win.mp3')
              audioWin.play()
              $('body').append(div)
			  back()
          }else{
              var audioErr = new Audio('../sound_effect/game1_error.mp3')
              audioErr.play()
          }
  //关闭定时器
          clearInterval(obj.timer);
  //显示开始游戏
          go.children[0].innerHTML = '重新开始';
          go.style.display = "block";
        }
  //盒子加速
      if(num%20 == 0){
        speed=speed+0.3;
      }
    }
  //松开触发停止
    obj.onmouseup=function(event){
    }
  },20) 
    }


  //开始游戏
    go.children[0].onclick = function(){
        bg.play();
        h3.style.display = "none";
  //开始前判断main里面是否有盒子，有则全部删除
    if(main.children.length){
  //暴力清楚main里面所有盒子
        main.innerHTML = '';
      }
  //清空计分
    count.innerHTML = '游戏开始'; 
  //隐藏开始盒子
    this.parentNode.style.display = "none";
  //调用定时器
    move(main);
  } 
  
  	function back(){
				$('.win').click(function (){
				document.getElementById("last").value = '1';
				document.getElementById("form1").submit();
				})
			}
  </script>
</html>