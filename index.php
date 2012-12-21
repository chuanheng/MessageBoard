<?php 
error_reporting(E_ALL ^ E_WARNING);
error_reporting(E_ALL & ~E_NOTICE);
session_start(); 
include 'include/config.php';include 'include/para.php';include 'include/page_.php';
$pager = new Page;
$page=$_GET['page'];if(empty($page)) $page=1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<title>浏览留言 - <?php echo $gb_name?></title>
<script language="JavaScript" type="text/javascript" src="include/checkform.js"></Script>
<link href="css/css.css" rel="stylesheet" type="text/css">
</head>
<body onload="i=0">
<?php
if(!defined('MCBOOKINSTALLED')){?><div id="alertmsg"></div><?php exit();}?>
<!--最外层主要区域开始-->
<div id="main">
  <?php include 'include/head.php';?>
  <div id="list">
    <div id="listmain">
	<?php
	$sql="select * from ".TABLE_PREFIX."message order by settop desc,id desc";
	$total=$db->get_rows($sql);//直接取出记录集行数供分页之用
	if($total!=0)//判断记录是否为空
	{
		$pager->pagedate($page_,$total,"?page");

		$rs=$db->execute($sql." limit $offset,$pagesize");
		while($rows=$db->fetch_array($rs))
		{
	?>
<h2>
<span class="leftarea">
<img src="images/icon_write.gif" /> 
<?php echo $rows['username']?> 
<font style="color:#999;">于 <?php echo date("Y-m-d H:i",strtotime($rows["systime"]));?> 发表留言：</font>
<?php if(date("Y-m-d",strtotime($rows["systime"]))==date("Y-m-d"))  echo '<img src=images/new.gif>';?>		
<?php if($rows['settop']!=0) echo '<img src=images/settop.gif alt=已置顶>';?>
</span>
<span class="midarea">
<?php if(!empty($_SESSION['admin_pass'])){
if($ifauditing==1){ 
if($rows['ifshow']==0){?>
<a href="admin_action.php?ac=setshow&amp;id=<?php echo $rows['id'];?>&page=<?php echo $page;?>"><img src="images/setshow.gif" alt="审核并显示" /></a>
<?php }else{?>
<a href="admin_action.php?ac=unshow&amp;id=<?php echo $rows['id'];?>&page=<?php echo $page;?>"><img src="images/unshow.gif" alt="隐藏此留言" /></a>
<?php }}?>
<a href="javascript:if(confirm('确认删除此留言?'))location='admin_action.php?ac=delete&amp;id=<?php echo $rows['id'];?>&page=<?php echo $page;?>'"><img src="images/icon_del.gif" alt="删除此留言" /></a> <a href="edit.php?id=<?php echo $rows['id'];?>&page=<?php echo $page;?>"><img src="images/icon_rn.gif" alt="编辑/回复此留言" /></a>
<?php if($rows['settop']==0){?>
<a href="admin_action.php?ac=settop&amp;id=<?php echo $rows['id'];?>&page=<?php echo $page;?>"><img src="images/settop.gif" alt="将本留言置顶" /></a>
<?php }else{?>
<a href="admin_action.php?ac=unsettop&amp;id=<?php echo $rows['id'];?>&page=<?php echo $page;?>"><img src="images/unsettop.gif" alt="取消置顶" /></a>
<?php }}?>
</span>
<span class="rightarea">
<?php if(!empty($rows['email'])){?>
<a href="mailto:<?php echo $rows['email']?>"><img src="images/email.gif" alt="点击用OutLook发送邮件至：<?php echo $rows['email']?>"></a> 
<?php }?><?php if(!empty($_SESSION['admin_pass'])){?>
<img src="images/ip.gif" alt="留言者IP：<?php echo $rows['userip'];?>"> 
<?php }?>
</span></h2>
<div class="content">
<?php 
if(empty($_SESSION['admin_pass'])){
	if($rows["ifqqh"]==1){
			echo '<span class=ftcolor_999>（此留言为悄悄话，只有管理员才能看哦……）</span>';
	}elseif($ifauditing==1){
		if($rows['ifshow']==0){
			echo '<span class=ftcolor_999>（此留言正在通过审核，当前不可见……）</span>';
		}else{
			echo $rows['content'];
		}
	}else{
		echo $rows['content'];
	}
}else{
	echo $rows['content'];
}
?>
</div>
<?php

if(!empty($rows['reply'])){?>
<div class="reply"><p><span class="ftcolor_FF9"><b><?php echo $replyadmtit;?>：</b><?php echo date("Y-m-d H:i",strtotime($rows["replytime"]));?></span></p>
<?php echo $rows['reply'];?>
</div>
<?php 
}}
//记录集循环结束
$db->free_result($rs);
}else{
echo '没有留言……';
}//外层判断记录集为空结束
?>
</div><!--listmain结束-->
</div><!--list结束-->
<div class="clear"></div>
<div id="pages" align="center">留言总数：<?php echo $total;?> 条 　<?php $pager->pageshow();?></div>
<div class="clear"></div>
<div id="submit">
<form name="form1" method="post" action="add.php" onSubmit="return FrontPage_Form1_Validator(this)">
<p><img src="images/i1.gif" /><img src="images/add.gif" /></p><br />
<label for="user">昵称：</label><input type="text" id="username" name="username" value="" />*<br />
<label for="email">Email：</label><input type="text" id="email" name="email" value="" /><br />
<label for="comment">内容：</label><textarea id=content name="content"></textarea>*<br />
<label for="comment">　</label><span>提交前请按Ctrl+C保存留言内容，以免程序出错而丢失！
留言内容不能少于5个字符！</span><br />
<label for="email">悄悄话：</label>
<input name="ifqqh" type="checkbox" id="ifqqh" value="1"> <span>当选中时，此留言只有管理员可见</span><br />
<label for="umum">验证码：</label><input name="unum" type="text" id="unum" size="10">* <img src="include/randnum.php?id=-1" title="点击刷新" style="cursor:pointer" onclick=eval('this.src="include/randnum.php?id='+i+++'"')>
<br />
<input type="submit" id="sbutton" value="确  定" /><br /><input name="ac" type="hidden" id="ac" value="add">
</form>
</div>
<!--最外层主要区域结束-->
</div>
<?php include 'include/foot.php';?>
</body>
</html>