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
    
    $updateSQL = sprintf("UPDATE TaskLottime SET task14=%s WHERE userID=%s",
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
<title>Roy's  Music</title>
<meta name="game2" content="game2">
<meta name="description">
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="../css/game2.css">
<link rel="stylesheet" href="../css/loader.css">
</head>
<script type="text/javascript">
    document.onreadystatechange = function() { 
    if (document.readyState !== "complete") { 
        document.querySelector("body").style.visibility = "hidden"; 
        document.querySelector("#loader").style.visibility = "visible"; 
    } else { 
        document.querySelector("#loader").style.display = "none"; 
        document.querySelector("body").style.visibility = "visible"; 
        document.getElementById("content").style.display = "none";
        document.getElementById("sl").style.display = "none";
        document.getElementById("text4").style.display = "none";
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
<header>
<div class="text text-1">Roy</div><div class="text text-2">'s &nbsp;</div><div class="text text-3">Music</div>
<span id="sl" class="sl">1</span>
<div id="text4" class="text text-4">/12</div>
</header>
<div id="start" class="start"><p><img src="../image/playF2.png" alt="home" width="120px" height="120px"/></p><p class="startT"> 开始游戏</p></div>
<div id="content" class="content">
<div class="btns-bg">
<div class="PlayEy"></div>
<div class="line"></div>
<div class="Play">
<audio src="" id="audios"></audio>

</div>
</div>
<div class="ans"><ul class="wz">
</ul></div>
<ul class="wz1">
</ul></div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
          <p><input type="hidden" name="win" id="last" value="" /></p>
          <p><input type="hidden" name="userID" value="<?php echo $colname_DetailRS1;?>" /></p>
        <input type="hidden" name="MM_update" value="form1" />
      </form>
      
<script src="../jquery/jquery-1.10.2.js"></script>
<script>
			
			
			//数据库
			//-------------------------------------
			var arr=[{
				data:'../audio/01.mp3',
				wz:['归'],
				gs:1
			},
			{
				data:'../audio/02.mp3',
				wz:['姑','娘'],
				gs:2
			},
			{
				data:'../audio/03.mp3',
				wz:['洄'],
				gs:1
			},
			{
				data:'../audio/04.mp3',
				wz:['因','为','遇','见','你'],
				gs:5
			},
			{
				data:'../audio/05.mp3',
				wz:['彩','虹','云','朵'],
				gs:4
			},
			{
				data:'../audio/06.mp3',
				wz:['滚','烫','的','青','春'],
				gs:5
			},
			{
				data:'../audio/07.mp3',
				wz:['十','七'],
				gs:2
			},
			{
				data:'../audio/08.mp3',
				wz:['疯','人','公','园'],
				gs:4
			},
			{
				data:'../audio/09.mp3',
				wz:['飘'],
				gs:1
			},
			{
				data:'../audio/10.mp3',
				wz:['一','些','悲','伤','又','美','好','的','事'],
				gs:9
			},
			{
				data:'../audio/11.mp3',
				wz:['骄','傲'],
				gs:2
			},
			{
				data:'../audio/12.mp3',
				wz:['流','星','也','为','你','落','下','来','了'],
				gs:9
			},
			{
				data:'',
				wz:['流','星','也','为','你','落','下','来','了'],
				gs:9
			}
			]
		//jq代码	
//---------------------------------
    
			var sz=[];
			var b=0;
			var bb=0;
			function len(bb){
				sz=arr[bb].wz.slice();
				sz.length=15;
			};
	
		    //-------------------------------------
			//上面的li生成函数
			function scWz(bb){
				for(var i=0;i<arr[bb].gs;i++){
					$('.wz')[0].innerHTML+='<li></li>';
				}
				
				$('.wz').css('left',(document.body.clientWidth/2)-($('.wz').width()/2)+'px')
			};
			function bt(bb){
				$('.heder').html(arr[bb].title)
			};
		//mp3地址切换
			function audio(bb){
				$('.sl').html(bb+1)
				if(bb+1 == 13){
				    var str='<div class="zg"></div>'
					var div=$('<div class="ann">恭喜获得3个抽奖机会点击去抽奖</div><div class="win">通关成功</div>')
					var audioWin = new Audio('../sound_effect/game_win.mp3')
                    audioWin.play()
                    $('div').remove('.content')
                    document.getElementById("sl").style.display = "none"
                    document.getElementById("text4").style.display = "none"
					$('body').append(div)
					back()
				}else if(bb == 0){
				var audio = document.getElementById('audios');
			    audios.pause();
			    $(".start").click(function (){
			        $('div').remove('.start')
			        document.getElementById("content").style.display = "block"
			        document.getElementById("sl").style.display = "block"
                    document.getElementById("text4").style.display = "block"
			        var audio = document.getElementById('audios')
			        audios.src = arr[bb].data;
			        audios.load();
			        audios.play();
			        var oPlayEy = document.getElementsByClassName("PlayEy")[0];
			        var seii = setInterval(function() {
		            (i == 360) ? i = 0 : i++;
	            	oPlayEy.style.transform = "rotate(" + i + "deg)";
		                if(audios.paused) {
			                clearInterval(seii);
			                oPlay.style.backgroundImage = "url(../image/play.png)";
		                }
                	}, 30);
		       	});
				}else{
				var audio = document.getElementById('audios');
				audios.src = arr[bb].data;
			    audios.load();
			    audios.play();
			    oPlay.style.backgroundImage = "url(../image/pause.png)";
				}
			};
				//下面的html点击总函数
			function scWz1(bb){
				var str='<li></li>'
				for(var i=0;i<15;i++){
					$('.wz1')[0].innerHTML+=str;
				}
				for(var i=0;i<sz.length;i++){
					if(typeof sz[i]=='undefined'){
						sz[i]=randomText()
					}
				}
			//数组随机数	
			sz.sort(function (){
				return 0.5-Math.random()
			})
			//随机结果存储到下面的所有html中
			for(var i=0;i<sz.length;i++){
					$('.wz1 li')[i].innerHTML=sz[i];
				}
			//随机产生汉字
			function randomText(){
				var _str = "";
				var myArray = ['厂','八','儿','二','几','九','力','入','广','才','大','飞','干','个','工','及','己','口','马','么','门','万','千','三','山','上','土','习','小','已','义','于','与','之','子','办','比','不','长','车','从','斗','队','反','方','分','风','化','火','计','今','开','历','六','内','区','片','气','切','认','日','少','什','手','书','水','太','天','王','文','无','五','心','以','引','元','月','支','中','专','毛','白','半','包','北','本','必','边','布','出','处','打','代','石','电','东','对','发','号','记','加','叫','节','且','可','立','龙','们','民','目','平','去','生','史','世','市','示','术','四','他','它','头','外','务','写','业','议','用','由','正','只','主','安','百','并','产','场','成','传','此','次','存','达','当','导','地','动','多','而','合','各','红','共','关','观','光','过','行','后','许','华','划','回','会','机','级','价','件','江','交','阶','她','决','军','老','列','论','米','名','那','年','农','全','权','任','如','色','设','式','收','同','团','问','西','先','向','压','约','有','在','再','则','争','至','众','自','把','报','别','步','层','但','低','改','更','还','何','花','即','极','系','技','际','间','角','进','近','究','局','克','快','况','劳','里','利','连','两','没','每','求','却','社','身','声','时','识','体','条','听','完','位','我','县','形','严','应','员','运','张','这','证','志','住','状','走','作','备','变','表','采','参','单','到','定','法','放','非','府','该','构','规','国','果','和','话','或','其','建','金','经','京','具','空','矿','拉','例','林','明','命','取','实','使','始','受','所','图','往','委','物','细','现','线','性','学','易','油','育','者','知','织','直','制','治','质','周','转','组','按','保','便','标','查','持','种','重','除','带','点','度','段','复','革','给','很','活','济','将','结','界','看','科','适','类','律','面','南','派','品','前','亲','思','信','省','是','说','统','相','响','型','须','选','研','养','要','音','院','战','政','指','总','般','被','部','称','党','调','都','高','格','根','海','候','积','家','较','离','料','能','难','起','热','容','素','速','特','铁','通','消','效','验','样','原','圆','造','展','真','值','准','资','常','得','第','断','基','教','接','据','理','领','率','清','情','商','深','维','象','眼','着','族','做','程','道','等','提','期','集','强','就','联','量','确','然','属','斯','温','越','装','最','感','解','路','群','数','想','新','意','照','置','满','管','精','酸','算','需','题','影','增','器','整'];
				var randomItem = myArray[Math.floor(Math.random()*myArray.length)];
				_str = randomItem;
				return _str;
			}
			}
			
			ffn()
			//整个ffn文件是  包括各种小事件 全部封装到一起直接调用
			function ffn(){
				len(bb)
				bt(bb)
				scWz(bb)
				scWz1(bb)
				audio(bb)
				//点击下面文字，发生相应变化，并且提升到上面的html中
				
			$(".wz1 li").on('touchstart',function (){
			    var audioClick = new Audio('../sound_effect/button_click.mp3')
                audioClick.play()
				if(b<$('.wz li').length){
					$(this).css('opacity','0')
					$(this).css('pointer-events','none')
					var _thisHtml=$(this).html()
					for(var i=0;i<$('.wz li').length;i++){
						if($('.wz li').eq(i).html()==''){
							$('.wz li').eq(i).html(_thisHtml)
							b++;
							break
						}
					}
				}
				pd()

				//判断所有当前上面文字的内容是不是和数组内部文字相等，如果相等就通关调用fn
				function pd(){
					if(b==$(".wz li").length){
					for(var i=0;i<$(".wz li").length;i++){
						if($(".wz li").eq(i).html()==arr[bb].wz[i]){
							if(i==$(".wz li").length-1){
							    var audioWin = new Audio('../sound_effect/game_win.mp3')
                                audioWin.play()
								var str='<div class="zg"></div>'
								var div=$('<div class="next">下一关</div>')
								$('body').append(str)
								$('body').append(div)
								fn()
								}
							}else{
							    $('.wz li').css('background','red')
								$('.wz li').css('color','white')
								$('.wz li').animate({'left':'+=30px'},50)
								$('.wz li').animate({'left':'-=60px'},100)
								$('.wz li').animate({'left':'+=30px'},50)
								var audioWrong = new Audio('../sound_effect/incorrect_error.mp3')
                                audioWrong.play()
								break;
							}
						}
					}
				};
				
			})
			
			//点击上面小文字  点击那个就把对应的内容清空把下面文字还原
			$(".wz li").click(function (){
			    var audioClick = new Audio('../sound_effect/button_click.mp3')
                audioClick.play()
				var _thisHtml=$(this).html()
				$('.wz li').css('background','#F0FFFF')
				$('.wz li').css('color','#006400')
				$(this).html('')
				b--
				for(var i=0;i<$(".wz1 li").length;i++){
					if($(".wz1 li").eq(i).html()==_thisHtml){
						$('wz li').eq(i).html('')
						$(".wz1 li").eq(i).css('opacity',1)
						$(".wz1 li").eq(i).css('pointer-events','auto')
						break
					}
				}
			})
			}
			//重置所有变量，删除原来多余的内容
			function fn(){
				$('.next').click(function (){
					
					$('div').remove('.zg')
					$('div').remove('.next')
					$('.wz').empty()
					$('.wz1').empty()
					bb=bb*1+1
					b=0
					sz=[]
					ffn()
				})
			}
			
			function back(){
				$('.win').click(function (){
				document.getElementById("last").value = '1';
				document.getElementById("form1").submit();
				})
			}

		</script>
		<script type="text/javascript" src="../js/game2.js"></script>
</body>
</html>
