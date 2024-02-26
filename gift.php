<!doctype html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=0.8">
<title>生日快乐</title>
<link rel="stylesheet" href="../css/loader3.css">
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
<link rel="stylesheet" href="../css/gift.css">
<link rel="stylesheet" href="../scss/album2.css">
</head>
<style>
.conVideo {
    position:relative;
    width:100%;
    height:100%;
}
.videobox{
    position:relative;
    width:100%;
    height:auto;
    top:20px;
}
h1{
    color:#fff;
    margin:1em 0 0;
    font-size:60px;
    font-weight:100;
    text-shadow: 4px 4px #00FA9A;
    top:10px;
    bottom:10px;
}
</style>

<script src="../jquery/jquery-1.10.2.js"></script>
<body>
<div id="conVideo" class="conVideo" align="center">

<!-- 所展示的书的内容 -->
<div class="boxbook">
    <div class="before" id="before">上一页</div>
    <div class="after" id="after">下一页</div>
    <div class="cover">
        <div class="left">
        <p class="title">CONTENT</p>
        <table align="center" class="table">
            <tr>
                <td>PART I</td>
                <td>CARD</td>
            </tr>
            <tr>
                <td>PART II</td>
                <td>VIDEO</td>
            </tr>
        </table>
        </div>
        <div class="right">
           <p class="title">THANK YOU</p>
        </div>
    <div class="book">
        <div class="page">
            <span><img src="../card/cover.jpg"><p class="page_number">1</p></span>
            <span><img src="../card/G1.jpg"><p class="page_number">2</p></span>
        </div>
        <div class="page">
            <span><img src="../card/G2.jpg"><p class="page_number">3</p></span>
            <span><img src="../card/G3.jpg"><p class="page_number">4</p></span>
        </div>
        <div class="page">
            <span><img src="../card/G4.jpg"><p class="page_number">5</p></span>
            <span><img src="../card/G5.jpg"><p class="page_number">6</p></span>
        </div>
        <div class="page">
            <span><img src="../card/G6.jpg"><p class="page_number">7</p></span>
            <span><img src="../card/G7.jpg"><p class="page_number">8</p></span>
        </div>
        <div class="page">
            <span><img src="../card/G8.jpg"><p class="page_number">9</p></span>
            <span><img src="../card/G9.jpg"><p class="page_number">10</p></span>
        </div>
        <div class="page">
            <span><img src="../card/G10.jpg"><p class="page_number">11</p></span>
            <span><img src="../card/G11.jpg"><p class="page_number">12</p></span>
        </div>
        <div class="page">
            <span><img src="../card/G12.jpg"><p class="page_number">13</p></span>
            <span><img src="../card/G13.jpg"><p class="page_number">14</p></span>
        </div>
        <div class="page">
            <span>
                <div class="pageVideo">
                <div class="popup"><div id="work">
                <div id="wrapper"class="switch-wrapper">
                <div class="string"></div>
                <div class="switch">
	            <div class="knot"></div>
	            <div class="tassel"></div>
	            <div class="gap"></div>
                    </div>
                </div></div>
                <div class="cliTitle"id="cliTitle">点我</div>
                <video class="popuptext" id="myPopup" style="width:100%;" controls >
                    <source src="../video/FILA.mp4" type="video/mp4">
                </video>
            </div></div></span>
        </div>
    </div>
    </div>
</div>
</div>
   <canvas id="canvas" width="1920" height="100%"></canvas><style>canvas {display: block;position: relative;z-index: 1;pointer-events: none;position: fixed;top: 0;}</style>
<script src="../js/confetti.js"></script>

<main>
<div class="-content -index">
<div>
<header class="top">
<h1>生日快乐</h1>
</header>
<div class="bounce-wrap">
<div class="bounce">
<div class="-shadow"></div>
<div class="-box-wrap js-box-wrap">
<div class="-box">
<div class="front wall"></div>
<div class="back wall"></div>
<div class="right wall"></div>
<div class="left wall"></div>
<div class="front-right wall"></div>
<div class="front-left wall"></div>
<div class="back-right wall"></div>
<div class="back-left wall"></div>
</div>
</div>
<div id="emitter"></div>
<div class="explode">
<span class="cloud -one js-cloud-1"></span>
<span class="cloud -two js-cloud-2"></span>
<span class="cloud -three js-cloud-3"></span>
</div>
</div>
</div>
</div>
</div>
</main>
<script src="https://www.jq22.com/jquery/2.1.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../jquery-2.1.1.min.js"><\/script>')</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js'></script>
<script src="../js/gift.js"></script>
<script type="text/javascript">
     var before = document.querySelector("#before");
     var after = document.querySelector("#after");
     var book = document.querySelector(".book");
     var page = document.getElementsByClassName("page");     rotate();
 
     function rotate(){
         var middle = 0;         for(var z=0;z<book.children.length;z++){
             page[z].style.zIndex = book.children.length-z;
         }
         after.onclick = function(){
             if(middle != book.children.length){
                 page[middle].style.animation = "page 1.5s linear 1 forwards";
                 middle++;
             }else{
                 middle = book.children.length;
             }
         };
         before.onclick = function(){
             if(middle != 0){
                 page[middle-1].style.animation = "page1 1.5s linear 1 forwards";
                 middle--;
         }else{
             middle = 0;
             }
         }
     }

 </script>
 <script>
function myFunction() {
var popup = document.getElementById("myPopup");
popup.classList.toggle("show");

if (popup.paused){ 
    popup.play(); 
    }
  else{ 
    popup.pause();
    }
 
}

const $switchWrapper = $('.switch-wrapper');


const swing = () => {
  $switchWrapper.addClass('swing');

  setTimeout(() => {
    $switchWrapper.removeClass('swing');
  }, 1000);
};

$('.switch').on('click', () => {
  swing();
  myFunction();
  document.getElementById("wrapper").style.display = "none";
  document.getElementById("cliTitle").style.display = "none";
});

$('.string').on('mouseenter', swing);

</script>
</body>
</html>