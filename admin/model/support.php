<?php 
session_start();
error_reporting(0);
include('../script/config.php');
include('../script/function.php');
include('../script/class.db.php');
$db=new DB();

$a=loadvariable('a','');
$start=loadvariable('start','');
if($a=='update')
{
		$status=loadvariable('status','');
		$id=loadvariable('id','');

		$SQL="UPDATE `support_mail` SET `Status`='".$status."' WHERE `Id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=support&msg=1&start='.$start);
		}
		else
		{
		header('location:../view/index.php?p=support&msg=0&start='.$start);
		}
}
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