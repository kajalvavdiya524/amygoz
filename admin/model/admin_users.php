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

		$SQL="UPDATE `admin_login` SET `Status`='".$status."' WHERE `Id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=admin_users&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=admin_users&msg=0');
		}
}

if($a=='edit')
{			

			 $name=loadvariable('name','');
			 $email=loadvariable('email','');
			 $mobile=loadvariable('mobile','');
			 $admin=loadvariable('admintype','');
        	 $status=loadvariable('status','');
        	 $id=loadvariable('id','');


			$SQL="UPDATE `admin_login` SET  Name='".$name."',`Email_Id`='".$email."',Mobile='".$mobile."',AdminType='".$admin."',Status='".$status."' WHERE `Id`='".$id."'";
			$res=$db->query($SQL);

			if($res)
			{
			header('location:../view/index.php?p=admin_users&msg=1');
			}
			else
			{
			header('location:../view/index.php?p=admin_users&msg=0');
			}
}
if($a=='changepass')
{			
			$id=loadvariable('id','');

			$currunt_password=loadvariable('current_password','');
			$password=loadvariable('password','');
			
			$SQL="UPDATE admin_login SET Password='".md5($password)."' WHERE id='".$id."' AND Password='".md5($currunt_password)."'" ;
				$res=$db->query($SQL);

			if($res)
			{

			header('location:../view/index.php?p=admin_users&msg=1');
			}
			else
			{
			header('location:../view/index.php?p=admin_users&msg=0');
			}
			
			
}
if($a=='add')
		{
				 $name=loadvariable('name','');
				 $email=loadvariable('email','');
			     $mobile=loadvariable('mobile','');
			     $admin=loadvariable('admintype','');
			     $password=loadvariable('password','')
;        	     $status=loadvariable('status','');
        	

//$SQL="INSERT INTO  `admin_login` SET  `Name`='".$name."',`Password`='".md5($password)."', `Email_Id`='".$email."',Mobile='".$mobile."',AdminType='".$admin."',Status='".$status."' ";

			   $SQL="INSERT INTO `admin_login`( `Name`, `Email_Id`, `Mobile`, `Password`, `AdminType`, `Status`) VALUES('".$name."','".$email."','".$mobile."','".md5($password)."','".$admin."','".$status."') ";
			  
				$res=$db->query($SQL);
				if($res)
				{
				header('location:../view/index.php?p=admin_users&msg=1');
				}
				else
				{
				header('location:../view/index.php?p=admin_users&msg=0');
				}
			
		}

		
		



?>