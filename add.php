<?php
error_reporting(E_ALL ^ E_WARNING);
error_reporting(E_ALL & ~E_NOTICE);
session_start(); 
include 'include/config.php';
include 'include/para.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<title>签写留言 - <?php echo $gb_name?></title>
<script language="JavaScript" type="text/javascript" src="include/checkform.js"></Script>
<link href="css/css.css" rel="stylesheet" type="text/css">
</head>
<body onload="i=0">
<div id="main">
<?php include 'include/head.php';?>
<div id="submit">
<?php if(isset($_SESSION['timer']) && time() - $_SESSION['timer'] <$timejg){?>
<div id="alertmsg">
对不起，您不是刚留言过吗？请<?php echo $timejg;?>秒后再留言……您还需等待：<?php echo abs($timejg-(time()-$_SESSION['timer']))?>秒<br>
<a href="javascript:history.back();">如果没有自动返回，请点击此处手动返回</a>
</div>
<?php 
	echo "<meta http-equiv=\"refresh\" content=\"3; url=index.php\">";
}else{
	if(empty($_POST['ac'])){
?>


<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']?>" onSubmit="return FrontPage_Form1_Validator(this)">
<p><img src="images/i1.gif" /><img src="images/add.gif" /></p><br />
<label for="user">昵称：</label><input type="text" id=username name="username" value="" />*<br />
<label for="email">Email：</label><input type="text" id=email name="email" value="" /><br />
<label for="comment">内容：</label><textarea id=content name="content"></textarea>*<br />
<label for="comment">　</label><span>提交之前请先按CTRL+C保存您的留言内容，以免程序出错而丢失！
留言内容最少5个字符！</span><br />
<label for="email">悄悄话：</label>
<input name="ifqqh" type="checkbox" id="ifqqh" value="1"> <span>当选中时，此留言只有管理员可见</span><br />
<label for="umum">验证码：</label><input name="unum" type="text" id="unum" size="10">* <img src="include/randnum.php?id=-1" title="点击刷新" style="cursor:pointer" onclick=eval('this.src="include/randnum.php?id='+i+++'"')><br />
<input type="submit" id="sbutton" value="确  定" /><br /><input name="ac" type="hidden" id="ac" value="add">
</form>

<?php }else{?>
<div id="alertmsg">

            <?php
		 if($_POST['unum']==$_SESSION["randValid"]){
			$username=htmlspecialchars($_POST['username'],ENT_QUOTES,'GB2312' );
			//$email=addslashes(htmlspecialchars($_POST['email']));
			$content=$_POST['content'];
			$userip=$_SERVER["REMOTE_ADDR"];
			$ifqqh=$_POST["ifqqh"];
			if(empty($ifqqh)) $ifqqh=0;
			$systime=date("Y-m-d H:i:s");
			if(!empty($content) or !empty($username)){
			$ifshow="";
			//还原空格和回车
// 			if(!empty($content)){
// 				$content=str_replace("　","",$content);
// 				$content=ereg_replace("\n","<br>　　",ereg_replace(" ","&nbsp;",$content));
// 			}
			if($ifauditing==1){$ifshow=0;}else{$ifshow=1;}
			//还原结束
			$sql="insert into ".TABLE_PREFIX."message(username,content,userip,systime,ifshow,ifqqh)
		values('".$username."','".$content."','".$userip."','".$systime."',".$ifshow.",".$ifqqh.")";
			//echo $sql;
				if(($db->insert($sql))>0){
					$_SESSION['timer']=time();
					echo "恭喜您留言成功，正在返回请稍候……<br><a href=index.php>您可以点此手动返回</a>";
					echo "<meta http-equiv=\"refresh\" content=\"3; url=index.php\">";
				}else{
					echo "留言失败！信息中可能含有敏感字符或不利于程序运行的特殊字符……";
					echo "<meta http-equiv=\"refresh\" content=\"5; url=".$_SERVER['PHP_SELF']."\">";
				}
			}else{
				echo "昵称和留言内容不能空，请重填！正在返回……<br><a href=index.php>您可以点此手动返回</a>";
				echo "<meta http-equiv=\"refresh\" content=\"3; url=".$_SERVER["HTTP_REFERER"]."\">";
			}
		}else{
			echo "<script language=\"javascript\">alert('对不起，验证码不正确，请重新输入……');history.back()</script>";
		}
			?>
</div>
<?php }}?>
</div></div>
<?php include 'include/foot.php';?>
</body>
</html>