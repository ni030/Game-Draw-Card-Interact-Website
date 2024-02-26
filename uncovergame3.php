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
    
    $updateSQL = sprintf("UPDATE TaskLottime SET task15=%s WHERE userID=%s",
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
<title>Fly With Roy</title>
<meta name="viewport" content="width=device-width, initial-scale=0.5,minimum-scale=0.5,maximum-scale=0.5, user-scalable=no">
<link rel="stylesheet" href="../css/game3.css">
<link rel="stylesheet" href="../css/loader2.css">
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
<div id="word" class="word"><h1><span>F</span><span>L</span><span>Y</span> <span></span><span>W</span><span>I</span><span>T</span><span>H</span><span> </span><span>R</span><span>O</span><span>Y</span><span>!</span></h1></div>
    <!--游戏说明和过关条件-->
<div id="info" class="info">在限定时间之内获得3000分即可通关</div>
<div id="content"><span> </span><span class="time" id="tword">时间：</span><span class="time" id="countdown" class="timer">60</span>
    <div id="piece" class="piece"><img src="../image/game3_roy.gif" width="560px" height="560px" /></div>
    <div class="start" name="start" id="start" onclick="startGame()">开始游戏</div>
    <div class="start" id="restart" onclick="restart()">重新游戏</div>
    <div class="arrow">
    <div class="arrowed1" id="moveup">
	<div class="arrow-1" onmousedown="move('up')" onmouseup="clearmove()" ontouchstart="move('up')"></div></div>
    <div class="arrowed2" id="movedown">
	<div class="arrow-2" onmousedown="move('down')" onmouseup="clearmove()" ontouchstart="move('down')"></div></div>
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
var myGamePiece;
var myObstacles = [];
var myScore;
var mySound;
var myMusic;
var myTimer;

$(document).ready(function(){
    document.getElementById("moveup").style.display = "none";
    document.getElementById("movedown").style.display = "none";
    document.getElementById("restart").style.display = "none";
});

function restart(){
    document.getElementById("restart").style.display = "none";
    document.getElementById("moveup").style.display = "block";
    document.getElementById("movedown").style.display = "block";
    ctx.save();
    ctx.restore();
    myMusic.stop();
    myGameArea.stop();
    myGameArea.clear();
    startGame();
}

    function startGame() {
        document.getElementById("piece").style.display = "none";
        document.getElementById("start").style.display = "none";
        document.getElementById("info").style.display = "none";
        document.getElementById("moveup").style.display = "block";
        document.getElementById("movedown").style.display = "block";
        myGamePiece = new component(130, 130, "image/game3_roy1.png", 50, 120,"image");
        myScore= new component("40px","Console","firebrick",240,80,"text");
        mySound = new sound("sound_effect/game3_collision.wav");
        myMusic = new sound("audio/game3_bg.mp3");
        myMusic.play();
        myObstacles = []; 
        myGameArea.start();
        myTimer = setInterval(myClock, 1000);
        var s = 60;//倒数的时间
    
    function myClock() {
    document.getElementById("countdown").innerHTML = --s;
       if (s == 0) {
         clearInterval(myTimer);
         document.getElementById("tword").style.display = "none";
         myMusic.stop();
         myGameArea.stop();
         if(myGameArea.frameNo >=3000){
                var div=$('<div class="ann">恭喜获得2个抽奖机会点击去抽奖</div><div class="win">通关成功</div>')
		        var audioWin = new Audio('../sound_effect/game3_win.mp3')
                audioWin.play()
                document.getElementById("content").style.display = "none";
		        $('body').append(div)
		        back()
        }else{
         document.getElementById('countdown').innerHTML = "时间到！";
         var div=$('<div class="ann">恭喜获得2个抽奖机会点击去抽奖</div><div class="win">通关成功</div>')
		        var audioWin = new Audio('../sound_effect/game3_win.mp3')
                audioWin.play()
                document.getElementById("content").style.display = "none";
		        $('body').append(div)
		        back()
         return;
        }
       }
     }
   }   
   var myGameArea = {
    canvas : document.createElement("canvas"),
    start : function() {
        this.canvas.width = 640;
        this.canvas.height = 640;
        this.context = this.canvas.getContext("2d");
        document.body.insertBefore(this.canvas, document.body.childNodes[3]);
        this.frameNo = 0;
        this.interval = setInterval(updateGameArea, 10);
    },
    stop : function() {
        clearInterval(this.interval);
    },    
    clear : function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }
}

function component(width, height, color, x, y,type) {
	this.type=type;
    if (type == "image"){
    	this.image= new Image();
        this.image.src = color;
    }
    this.width = width;
    this.height = height;
    this.speedX = 0;
    this.speedY = 0;    
    this.x = x;
    this.y = y;    
    this.update = function() {
        ctx = myGameArea.context;
    
        if (this.type == "text") {
            ctx.font = this.width + " " + this.height;
            ctx.fillStyle = color;
            ctx.fillText(this.text, this.x, this.y);
        } else {
            ctx.fillStyle = color;
            ctx.fillRect(this.x, this.y, this.width, this.height);
        }
        if (type == "image" ){
        ctx.drawImage(this.image,this.x,this.y,this.width,this.height);
       }
    else{
        ctx.fillStyle=color;
        ctx.fillRect(this.x,this.y,this.width,this.height);
        }
    }
    this.newPos = function() {
        this.x += this.speedX;
        this.y += this.speedY;        
    }    
    this.crashWith = function(otherobj) {
        var myleft = this.x;
        var myright = this.x + (this.width);
        var mytop = this.y;
        var mybottom = this.y + (this.height);
        var otherleft = otherobj.x;
        var otherright = otherobj.x + (otherobj.width);
        var othertop = otherobj.y;
        var otherbottom = otherobj.y + (otherobj.height);
        var crash = true;
        if ((mybottom < othertop) || (mytop > otherbottom) || (myright < otherleft) || (myleft > otherright)) {
            crash = false;
        }
        return crash;
    }
}

function updateGameArea() {
    var x, height, gap, minHeight, maxHeight, minGap, maxGap;
    for (i = 0; i < myObstacles.length; i += 1) {
        if (myGamePiece.crashWith(myObstacles[i]) || myGamePiece.y<=0 || myGamePiece.y+myGamePiece.height>=640) {
            mySound.play();
            myMusic.stop();
            myGameArea.stop();
            myGameArea.clear();
            clearInterval(myTimer);
            //过关条件，目前定LIMIT3000分
            if(myGameArea.frameNo >=3000){
                var div=$('<div class="ann">恭喜获得3个抽奖机会点击去抽奖</div><div class="win">通关成功</div>')
		        var audioWin = new Audio('../sound_effect/game_win.mp3')
                audioWin.play()
                document.getElementById("content").style.display = "none";
		        $('body').append(div)
		        back()
            }else{
                //还需要reset按钮，因为不过关
                document.getElementById("moveup").style.display = "none";
                document.getElementById("movedown").style.display = "none";
                document.getElementById("tword").style.display = "none";
                document.getElementById("restart").style.display = "block";
                document.getElementById('countdown').innerHTML = "失败!";
            return;
        } 
        }
    }
    myGameArea.clear();
    myGameArea.frameNo += 1;
    if (myGameArea.frameNo == 1 || everyinterval(300)) {
        x = myGameArea.canvas.height;
        minHeight = 100;
        maxHeight = 400;
        height = Math.floor(Math.random()*(maxHeight-minHeight+1)+minHeight);
        minGap = 150;
        maxGap = 200;
        gap = Math.floor(Math.random()*(maxGap-minGap+1)+minGap);
        var up = "";
        var low = "";
        //两条柱子的颜色需要更改
        up =myObstacles.push(new component(30, height, "salmon", x, 0));
        low = myObstacles.push(new component(30, x - height - gap, "salmon", x, height + gap));
    }
    for (i = 0; i < myObstacles.length; i += 1) {
        myObstacles[i].speedX = -1;
        myObstacles[i].newPos();
        myObstacles[i].update();
    }
    myScore.text="分数: " + myGameArea.frameNo;
    myScore.update();
    myGamePiece.newPos();
    myGamePiece.update();
}

function sound(src) {
    this.sound = document.createElement("audio");
    this.sound.src = src;
    this.sound.setAttribute("preload", "auto");
    this.sound.setAttribute("controls", "none");
    this.sound.style.display = "none";
    document.body.appendChild(this.sound);
    this.play = function(){
        this.sound.play();
    }
    this.stop = function(){
        this.sound.pause();
    }    
}

function everyinterval(n) {
    if ((myGameArea.frameNo / n) % 1 == 0) {return true;}
    return false;
}

function move(dir) {
    myGamePiece.image.src = "image/game3_roy2.png";
    if (dir == "up") {myGamePiece.speedY = -2.5; }
    if (dir == "down") {myGamePiece.speedY = 2.5; }
}

function clearmove() {
    myGamePiece.image.src = "image/game3_roy1.png";
    myGamePiece.speedX = 0; 
    myGamePiece.speedY = 0; 
}

function back(){
	$('.win').click(function (){
	document.getElementById("last").value = '1';
	document.getElementById("form1").submit();
	})
}


</script>
</html>