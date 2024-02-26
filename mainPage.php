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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理首页</title>
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
	font-size: large; 
}
.style7 { 
    color: #009900;
	font-size: 55px; 
}
.style8 { 
    color: #000000; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: 30px; 
	font-weight: bold;

}
.style9 { 
	color: #009900; 
	font-family: "迷你简硬笔楷书", Times, serif; 
	font-size: 60px; 
}
</style>
</head> 
<P class="style9" align="center">管理首页</P>
<p align="center" class="style7"><a href="userList.php">用户名单(新用户注册)</a></p>
<p align="center" class="style7"><a href="TaskList.php">抽奖任务名单</a></p>
<p align="center" class="style7"><a href="userInfoList.php">用户信息列表</a></p>
<p align="center" class="style7"><a href="lotteryList.php">抽奖总名单</a></p>