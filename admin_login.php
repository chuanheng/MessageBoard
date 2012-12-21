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
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>管理登录 - <?php echo $gb_name?></title>
<link href="css/css.css" rel="stylesheet" type="text/css">

 <script language=JavaScript>
function FrontPage_Form1_Validator(theForm)
{
  if (theForm.admin_user.value == "")
  {
    alert("请输入管理员帐号！");
    theForm.admin_user.focus();
    return (false);
  }
  if (theForm.admin_pass.value == "")
  {
    alert("请输入管理员密码！");
    theForm.admin_pass.focus();
    return (false);
  }
  if (theForm.unum.value == "")
  {
    alert("请您输入验证码！");
    theForm.unum.focus();
    return (false);
  }
   return (true);
}
</script>
</head>
<body onload="i=0;document.getElementsByName('unum')[0].value=''">
<div id="main">
<?php include 'include/head.php';?>
<div id="submit">
<?php if(empty($_POST['action'])){?>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']?>" onsubmit="return FrontPage_Form1_Validator(this)">
<p><img src="images/i3.gif" /><img src="images/login.gif" /></p><br />
<div id="submit_div">
<label for="admin_user">管理员帐号：</label><input name="admin_user" type="text" id="admin_user"><br />
<label for="admin_pass">管理员密码：</label><input name="admin_pass" type="password" id="admin_pass"><br />
<label for="unum">登录验证码：</label>
<input name="unum" type="text" id="unum" size="10">* <img src="include/randnum.php?id=-1" title="点击刷新" style="cursor:pointer" onclick=eval('this.src="include/randnum.php?id='+i+++'"')><br />
<input type="submit" id="sbutton" value="确  定" /><br /><input name="action" type="hidden" value="add">
</div>
</form>

<?php }else{?>
<div id="alertmsg">
<?php
		 if($_POST['unum']==$_SESSION["randValid"]){
			$admin_user=$_POST['admin_user'];
			//$admin_pass=md5($_POST['admin_pass']);
			$admin_pass=$_POST['admin_pass'];
			$rs=$db->execute("select account,password from ".TABLE_PREFIX."users where account='".$admin_user."'");
				if($db->num_rows($rs)!=0){
					//Check PASSWORD
					///////////////////////////////////////////////////////////
					$row=$db->fetch_array($rs);
					$db->free_result($rs);
					if($row['password']==$admin_pass){

						$_SESSION['admin_pass']=$admin_pass;
						echo "成功登录，请稍候……<br><a href=".$pageUrl.">如果浏览器没有自动返回，请点击此处返回</a>";
						echo "<meta http-equiv=\"refresh\" content=\"2; url=index.php\">";
						
					}else{
						echo "<script language=\"javascript\">alert('密码不正确！');history.go(-1)</script>";
					}
				}else{
					echo "<script language=\"javascript\">alert('管理帐号不正确！');history.go(-1)</script>";
				}
		}else{
			echo "<script language=\"javascript\">alert('验证码不正确，请重新输入……');history.go(-1)</script>";
		}
?>
</div>
<?php }?>
</div>
</div>
<?php include 'include/foot.php';?>
</body>
</html>