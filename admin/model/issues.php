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

		$SQL="UPDATE `issues` SET `Status`='".$status."' WHERE `Id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=issues&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=issues&msg=0');
		}

}

 
if($a=='edit')
{
		$status=loadvariable('status','');
		$name=loadvariable('name','');
		$id=loadvariable('id','');

		$SQL="UPDATE `issues` SET  Value='".$name."',`Status`='".$status."' WHERE `Id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=issues&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=issues&msg=0');
		}

}
if($a=='delete')
{
		
		$id=loadvariable('id','');

		$SQL="DELETE FROM `issues` WHERE `Id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=issues&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=issues&msg=0');
		}

}
		if($a=='add')
		{
				
				$name=loadvariable('name','');
				$value=loadvariable('value','');
				$status=loadvariable('status','');
				
				
				
				$SQL="INSERT INTO  `issues` SET  `Id`='".$value."',Value='".$name."',Status='".$status."' ";
				$res=$db->query($SQL);

				if($res)
				{
				header('location:../view/index.php?p=issues&msg=1');
				}
				else
				{
				header('location:../view/index.php?p=issues&msg=0');
				}
			
		}
?>