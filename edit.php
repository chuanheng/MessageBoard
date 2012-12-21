<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include 'check.php';
include 'include/config.php';
include 'include/para.php';
if(isset($_GET["page"]))$page=$_GET["page"];else $page=1;
$pageUrl="index.php?page=".$page;

$rs=$db->execute("select * from ".TABLE_PREFIX."message where id=".$_GET["id"]);
if($db->num_rows($rs)!=0)
{
	$rows=$db->fetch_array($rs);
	$db->free_result($rs);
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>回复/编辑留言 - <?php echo $gb_name?></title>
<link href="css/css.css" rel="stylesheet" type="text/css">
</head>
<script language=JavaScript>
function FrontPage_Form1_Validator(theForm)
{
  if (theForm.content.value == "")
  {
    alert("您不能将留言内容编辑为空！");
    theForm.content.focus();
    return (false);
  }
   return (true);
}
</script>
<body>
<div id="main">
<?php include 'include/head.php';?>
<div id="submit">
<?php if(empty($_POST['ac'])){?>


<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']?>" onSubmit="return FrontPage_Form1_Validator(this)">
<p><img src="images/i1.gif" /><img src="images/edit.gif" /></p><br>
<h2>
<img src="images/icon_write.gif" /><?php echo $rows['username']?> <font style="color:#999;">于 <?php echo date("Y-m-d H:i",strtotime($rows["systime"]));?> 发表留言：</font>
</h2>　　 
       <textarea name="content" cols="70" rows="9" id="content"><?php echo ereg_replace("<br>　　","\n",ereg_replace("&nbsp;"," ",$rows['content'])); ?></textarea><br>
              
			  <span style="margin-left:80px;">管理员回复的内容：</span><br>
			  <textarea name="reply" cols="50" rows="6" id="reply_textarea"><?php echo ereg_replace("<br>　　","\n",ereg_replace("&nbsp;"," ",$rows['reply'])); ?></textarea><br>
			  
			  <input type="submit" style="margin-left:80px;margin-top:10px;" value="编辑/回复" />
              <input name="ac" type="hidden" id="ac" value="reply"> 
              <input name="id" type="hidden" id="id" value="<?php echo $_GET['id'];?>"> 
                              
</form>

<?php }else{?>

<div id="alertmsg">
<?php

			$id=$_POST['id'];
			$content=addslashes($_POST['content']);
			$reply=addslashes($_POST['reply']);
			$systime=date("Y-m-d H:i:s");
			//还原空格和回车
			if(!empty($content)){
				$content=str_replace("　","",$content);
				$content=ereg_replace("\n","<br>　　",$content);
			}
			if(!empty($reply)){
				$reply=str_replace("　","",$reply);
				$reply=ereg_replace("\n","<br>　　",$reply);
			}
			//还原结束
			$db->update("update ".TABLE_PREFIX."guestbook set content='".$content."',reply='".$reply."',replytime='".$systime."' where id=".$id);
			echo "编辑/回复成功，请稍候……<br><a href=".$pageUrl.">如果浏览器没有自动返回，请点击此处返回</a>";
			echo "<meta http-equiv=\"refresh\" content=\"2; url=".$pageUrl."\">";
?>
</div>
<?php }?>
</div></div>
<?php include 'include/foot.php';?>
</body>
</html>