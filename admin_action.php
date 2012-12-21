<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include 'check.php';
include 'include/para.php';
include 'include/config.php';
$pageUrl="index.php?page=".$_GET['page'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>管理留言</title>
<link href="css/css.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<?php include 'include/head.php';?>
<div id="list">
<div id="alertmsg">
  <?php if(!empty($_GET['ac'])){
	$id=$_GET['id'];
	$ac=$_GET['ac'];
	if($ac=='delete'){
		$db->delete("delete from ".TABLE_PREFIX."guestbook where id=".$id);
		echo "留言已删除，3秒后返回，请稍候……";
	}elseif($ac=='settop'){
		$db->update("update ".TABLE_PREFIX."guestbook set settop=1 where id=".$id);
		echo "留言已置顶，3秒后返回，请稍候……";
	}elseif($ac=='unsettop'){
		$db->update("update ".TABLE_PREFIX."guestbook set settop=0 where id=".$id);
		echo "已取消置顶，3秒后返回，请稍候……";
	}elseif($ac=='setshow'){
		$db->update("update ".TABLE_PREFIX."guestbook set ifshow=1 where id=".$id);
		echo "留言已显示，3秒后返回，请稍候……";
	}elseif($ac=='unshow'){
		$db->update("update ".TABLE_PREFIX."guestbook set ifshow=0 where id=".$id);
		echo "留言已隐藏，3秒后返回，请稍候……";
	}elseif($ac=='logout'){
		session_unset('admin_pass');
    	session_destroy(); 
		echo "您已经退出，3秒后返回，请稍候……";
	}else{
		echo '无此项操作……';
	}
	
echo "<br><a href=".$pageUrl.">如果您的浏览器没有自动返回，请点击此处手动返回</a>";
echo "<meta http-equiv=\"refresh\" content=\"3; url=".$pageUrl."\">";

}?>
</div>
</div>
</div>
<?php include 'include/foot.php';?>
</body>
</html>
