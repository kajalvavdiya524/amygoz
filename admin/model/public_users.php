<?php 
session_start();
error_reporting(0);
include('../script/config.php');
include('../script/function.php');
include('../script/class.db.php');
$db=new DB();
$start=loadvariable('start','');
$a=loadvariable('a','');
$id=loadvariable('id','');


if($a=='block')
{
		$status=loadvariable('is_blocked','');
		$id=loadvariable('id','');

		$SQL="UPDATE `users` SET `is_deleted`='".$status."' WHERE `username`='".$id."'";
                
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=public_users&msg=1&start='.$start);
		}
		else
		{
		header('location:../view/index.php?p=public_users&msg=0&start='.$start);
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
			header('location:../view/index.php?p=public_users&msg=10&start='.$start);
		}
		else
		{
		header('location:../view/index.php?p=public_users&msg=0&start='.$start);
		}
		}
	
		else
		{
		header('location:../view/index.php?p=public_users&msg=0&start='.$start);
		}
		
	
}
if($a=='edit')
{
			 $id=loadvariable('id','');
			 $first_name=loadvariable('first_name','');
			 $last_name=loadvariable('last_name','');
			 $email=loadvariable('email','');
			 $mobile=loadvariable('phone','');
			 $sex=loadvariable('sex','');
			 $username=loadvariable('username','');
			 $phase_of_life=loadvariable('phase_of_life','');
			 $website=loadvariable('website','');
			 $birthday=loadvariable('birthday','');
			 $location=loadvariable('location','');
			 $education=loadvariable('education','');
			 $employment=loadvariable('employment','');
			 $designation=loadvariable('designation','');
			 $about=loadvariable('about','');
			 

		$SQL="update `users`,`user_details` 
			SET 	user_details.first_name ='".$first_name."',
					user_details.last_name ='".$last_name."',
					users.email='".$email."',
					user_details.phone='".$mobile."',
					user_details.sex='".$sex."',
					users.username='".$username."',
					user_details.phase_of_life='".$phase_of_life."',
					user_details.website='".$website."',
					user_details.birthday='".$birthday."',
					user_details.location='".$location."',
					user_details.education='".$education."',
					user_details.employment='".$employment."',
					user_details.designation='".$designation."',
					user_details.about='".$about."'
					WHERE  user_details.id=users.user_detail_id and users.`user_detail_id`='".$id."'";
			$res=$db->query($SQL);
			
		if($res)
		{
		header('location:../view/index.php?p=public_users&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=public_users&msg=0');
		}
}
		
if($a=='delete')
{
		
		$id=loadvariable('id','');

		//$SQL="DELETE FROM `users` WHERE `Id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=public_users&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=public_users&msg=0');
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