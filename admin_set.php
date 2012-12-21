<?php
include 'check.php';
include 'include/config.php';
include 'include/para.php';
$pageUrl=$_SERVER['PHP_SELF'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>设置留言本 - <?php echo $gb_name?></title>
<link href="css/css.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<?php include 'include/head.php';?>
<div id="submit">
<?php if(empty($_POST['ac'])){?>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']?>" onSubmit="return FrontPage_Form1_Validator(this)">
<p><img src="images/admin_set.gif" /><img src="images/set.gif" /></p><br />
  <div id="submit_set_left"><ul>
  <li><a href="admin_mp.php">修改管理密码</a>
  <li><a href="admin_set.php">系统参数设置</a>
  </ul></div>

<div id="submit_set_right">
<label for="gb_name">留言本的名称：</label><input type="text" name="gb_name" value="<?php echo $gb_name;?>" />* 将显示在IE标题栏<br />

<label for="gb_logo">留言本LOGO：</label><input type="text"name="gb_logo" value="<?php echo $gb_logo;?>" />* 将显示在左上角<br />
<label for="index_url">网站首页地址：</label><input type="text" name="index_url" value="<?php echo $index_url;?>" />* 点击“网站首页”的地址<br />
<label for="email">每页留言条数：</label>
<select name="pageT" id="pageT">
  <?php //生成数组
	$page_array=array('5','8','10','15','20','25');
	foreach($page_array as $pageT){
		if($page_==$pageT){
		echo "<option value=".$pageT." selected>".$pageT."</option>\n";
		}else{
		echo "<option value=".$pageT.">".$pageT."</option>\n";
		}
	}
	?>
 </select>条 <br />

<label for="comment">连续留言间隔：</label>
<select name="timejgT" id="timejgT">
<?php //生成数组
	$timejg_array=array('20','40','60','120','240','360');
	foreach($timejg_array as $timejgT){
		if($timejg==$timejgT){
		echo "<option value=".$timejgT." selected>".$timejgT."</option>\n";
		}else{
		echo "<option value=".$timejgT.">".$timejgT."</option>\n";
		}
	}
	?>
</select>秒 (同一IP连续留言的时间间隔，以防滥发留言)<br />

<label for="replyadmtit">回复时显示：</label><input type="text"name="replyadmtit" value="<?php echo $replyadmtit;?>"><br /> 
<label for="gb_logo">留言需审开关：</label><input name="ifauditing" type="checkbox" id="ifauditing" <?php if($ifauditing==1) echo 'checked';?> value="1">选中此项后，新留言需要管理员审核后才能显示<br /> 
<input name="ac" type="hidden" id="ac" value="gb_set">
<input type="submit" style="margin-left:110px;" name="Submit" value=" 提 交 设 置 ">
</div>   
<div class="clear"></div>
<script language=JavaScript>
function FrontPage_Form1_Validator(theForm)
{
  if (theForm.gb_name.value == "")
  {
    alert("留言本名称不能空！");
    theForm.gb_name.focus();
    return (false);
  }
  if (theForm.gb_logo.value == "")
  {
    alert("留言本LOGO不能空！");
    theForm.gb_logo.focus();
    return (false);
  }
  
  if (theForm.index_url.value == "")
  {
    alert("网站首页地址不能空！");
    theForm.index_url.focus();
    return (false);
  }
   return (true);
}
</script>
</form>
<?php }else{?>

<div id="alertmsg">
<?php
$gb_name= $_POST["gb_name"];
$gb_logo=$_POST["gb_logo"];
$index_url=$_POST["index_url"];
$pageT= $_POST["pageT"];
$timejgT=$_POST["timejgT"];
$replyadmtit=$_POST["replyadmtit"];
$ifauditing=$_POST["ifauditing"];
			
$parafile="<"."?php

\$gb_name= '$gb_name';
\$gb_logo='$gb_logo';
\$index_url='$index_url';
\$page_= '$pageT';
\$timejg='$timejgT';
\$replyadmtit='$replyadmtit';
\$ifauditing='$ifauditing';
?".">";

// write the para file
$filenum = fopen ("include/para.php","w");
ftruncate($filenum, 0);
fwrite($filenum, $parafile);
fclose($filenum);
	echo "设置已保存，请稍候……<br><a href=".$pageUrl.">如果浏览器没有自动返回，请点击此处返回</a>";
	echo "<meta http-equiv=\"refresh\" content=\"2; url=".$pageUrl."\">";
?>
</div>
<?php }?>
</div>
</div>
<?php include 'include/foot.php';?>
</body>
</html>