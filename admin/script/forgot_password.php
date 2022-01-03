<?php
session_start();

include('function.php');
include('config.php');
include('class.db.php');

$Username=loadvariable('Email',' ');
//$Password=loadvariable('Password',' ');

$db=new DB();


$SQL ="SELECT * FROM `admin_login` WHERE Email_Id='".$Username."' AND Status='Y'";

$res=$db->get_results($SQL);


if(count($res)>0)
{
	$to='pranaychauhan992@hotmail.com';
	$form='support@callitme.com';
    $subject='Forgot password for admin';
	$message = 'asdsadsad';//file_get_contents('../model/forgot_password_mail.php');
	/*$headers = 'MIME-Version: 1.0'."\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
	$headers .= "From:". $email;*/
	/*$headers = 'MIME-Version: 1.0'."\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From:". $form;*/
	//mail($to,$form,$subject,$message,$headers;

	echo "asdsad";
	echo "<br>".$to;
	echo "<br>".$form;
	echo "<br>".$subject;
	//echo "<br>".$headers."<br>";
	echo "<br>".$message;

		var_dump(mail($to,$form,$subject,$message));
		exit;
	if(mail($to,$form,$subject,$message,$headers))
	{
		header("location:../view/forgot_password.php?msg=1");
	}else
	{
		header("location:../view/forgot_password.php?msg=0");
	}
}
else {
	header("location:../view/forgot_password.php?msg=0");
}











 ?>
