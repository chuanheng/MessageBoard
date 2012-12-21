<?php
error_reporting(E_ALL ^ E_WARNING);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
if (empty($_SESSION['admin_pass']))
{
echo "<script language=javascript>location.href='admin_login.php';</script>";
exit;
}
?>