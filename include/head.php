<div id="top">
<!--logo-->
<div id="logoarea"><a href="index.php"><img src="<?php echo $gb_logo?>" alt="<?php echo $gb_name?> - 留言本"></a></div>
<!--菜单-->
<div id="menu">
<ul>
<li><a href="index.php"><img src="images/i2.gif"><br>浏览留言</a></li>
<li><a href="add.php"><img src="images/i1.gif"><br>签写留言</a></li>
<?php if(empty($_SESSION['admin_pass'])){?>
<li><a href="admin_login.php"><img src="images/i3.gif"><br>管理留言</a></li><?php }else{?><li><a href="javascript:if(confirm('您确认要退出吗?'))location='admin_action.php?ac=logout'"><img src="images/i3.gif"><br>退出管理</a></li><?php }?>
<?php if(!empty($_SESSION['admin_pass'])){?>
<li><a href="admin_set.php"><img src="images/admin_set.gif"><br>系统设置</a></li><?php }?>
<li><a href="<?php echo $index_url?>"></a></li>
</ul>
</div>
</div>