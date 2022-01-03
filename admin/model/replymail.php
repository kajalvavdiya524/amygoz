<?php 
session_start();
error_reporting(0);
include('../script/config.php');
include('../script/function.php');
include('../script/class.db.php');
$db=new DB();


$a=loadvariable('a','');
if($a=='reply')
{
		
			$id=loadvariable('id','');
			$masssage=loadvariable('msg','');
				$to=loadvariable('email','');

				$subject=loadvariable('sub','');

		if(mail($to, $subject, $message))
		{
				$SQL="UPDATE `support_mail` SET Status='1',Reply='Now()' WHERE `id`='".$id."'";
				$res=$db->query($SQL);

				if($res)
				{
				header('location:../view/index.php?p=support&msg=1');  
				}
				else
				{
				header('location:../view/index.php?p=support&msg=0');
				}

		}
		else
		{
			header('location:../view/index.php?p=replymail&msg=0');
		}
}



?>