<?php 
session_start();
error_reporting(0);
include('../script/config.php');
include('../script/function.php');
include('../script/class.db.php');
$db=new DB();


$a=loadvariable('a','');
if($a=='update')
{
		$status=loadvariable('status','');
		$id=loadvariable('id','');

		$SQL="UPDATE `mangalik` SET `Status`='".$status."' WHERE `Id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=mangalik&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=mangalik&msg=0');
		}
}
if($a=='delete')
{
		
		$id=loadvariable('id','');

		$SQL="DELETE FROM `mangalik` WHERE `Id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=mangalik&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=mangalik&msg=0');
		}

}
		if($a=='add')
		{
				
				$name=loadvariable('name','');
				$value=loadvariable('value','');
				$status=loadvariable('status','');
				
				
				
				$SQL="INSERT INTO  `mangalik` SET  `Id`='".$value."',Value='".$name."',Status='".$status."' ";
				$res=$db->query($SQL);

				if($res)
				{
				header('location:../view/index.php?p=mangalik&msg=1');
				}
				else
				{
				header('location:../view/index.php?p=mangalik&msg=0');
				}
			
		}





?>