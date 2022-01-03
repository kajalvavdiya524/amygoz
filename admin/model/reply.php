<?php
session_start();
error_reporting(0);
include('../script/config.php');
include('../script/function.php');
include('../script/class.db.php');
$db=new DB();
$a=loadvariable('a','')
if($a=='relpy')
{
		$email=loadvariable('email','');
		$id=loadvariable('id','');

		$SQL="UPDATE `support_mail` SET  Value='".$email."', WHERE `Id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=Sopport&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=Support&msg=0');
		}
}





?>