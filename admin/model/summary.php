<?php 
session_start();
error_reporting(0);
include('../script/config.php');
include('../script/function.php');
include('../script/class.db.php');
$db=new DB();
$start=loadvariable('start','');
$a=loadvariable('a','');
$summary_users=loadvariable('summary_users','');
if($a=='update')
{
		$summary_users=loadvariable('summary_users','');

		$status=loadvariable('status','');
		$id=loadvariable('id','');
		
		$SQL="UPDATE `users` SET `is_active`='".$status."' WHERE `id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=summary&summary_users='.$summary_users.'&msg=1&start='.$start);
		}
		else
		{
		header('location:../view/index.php?p=summary&summary_users='.$summary_users.'&msg=0&start='.$start);
		}
}

if($a=='block')
{
		$status=loadvariable('is_blocked','');
	
		$id=loadvariable('id','');
		
		$summary_users=loadvariable('summary_users','');

		$SQL="UPDATE `users` SET `is_blocked`= $status WHERE `id`='".$id."'";
		
		$res=$db->query($SQL);
		
		
		if($res)
		{
		header('location:../view/index.php?p=summary&summary_users='.$summary_users.'&msg=1&start='.$start);
		}
		else
		{
		header('location:../view/index.php?p=summary&summary_users='.$summary_users.'&msg=0&start='.$start);
		}
}
if($a=='updateexp')
{
		//$status=loadvariable('status','');
		$id=loadvariable('id','');
		$start=loadvariable('start','');


		$SQL="select user_details.*, users.* from users ,user_details Where users.user_detail_id=user_details.id AND users.id='".$id."' ";
		echo $SQL;
		$res=$db->get_results($SQL);
		$date_of_exp=date('Y-m-d',strtotime($res[0]['delete_expires']));
		
		$date1=date('Y-m-d');
		$email=$res[0]['email'];
		$name=$res[0]['first_name']." ".$res[0]['last_name'];
		$NewDate = date('Y-m-d 23:59:59', strtotime($date1 . " +30 days"));
		
		$SQL_UPDATE="UPDATE `users` SET  delete_expires='".$NewDate."' WHERE id='".$id."' ";
		
		$res=$db->query($SQL_UPDATE);

		if($res)
		{
			$to=$email;
			$form='support@ipintoo.com';
                        $subject=' Your Fee Has Been Waived';
			$message =file_get_contents('templete.php');
			$headers = 'MIME-Version: 1.0'."\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
			$headers .= "From:". $email;
		
		if(mail($to,$subject,$message,$headers))
		{
			header('location:../view/index.php?p=users&msg=10&start='.$start);
		}
		else
		{
		header('location:../view/index.php?p=users&msg=0&start='.$start);
		}
		}
	
		else
		{
		header('location:../view/index.php?p=users&msg=0&start='.$start);
		}
		
	
}
if($a=='edit')
{
		$status=loadvariable('status','');
		$name=loadvariable('name','');
		$id=loadvariable('id','');

		$SQL="UPDATE `users` SET  Value='".$name."',`Status`='".$status."' WHERE `id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=users&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=users&msg=0');
		}
}
		
if($a=='delete')
{
		
		$id=loadvariable('id','');

		//$SQL="DELETE FROM `users` WHERE `Id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=users&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=users&msg=0');
		}

}
		if($a=='add')
		{
				
				$name=loadvariable('name','');
				$value=loadvariable('value','');
				$status=loadvariable('status','');
				
				
				
				//$SQL="INSERT INTO  `caste` SET  `Id`='".$value."',Value='".$name."',Status='".$status."' ";
				$res=$db->query($SQL);

				if($res)
				{
				header('location:../view/index.php?p=caste&msg=1');
				}
				else
				{
				header('location:../view/index.php?p=caste&msg=0');
				}
			
		}






?>