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
		$plan_name=loadvariable('plan_name','');
		$r_to_friends=loadvariable('r_to_friends','');
		$r_to_anyone=loadvariable('r_to_anyone','');
		$m_to_friends=loadvariable('m_to_friends','');
		$m_to_anyone=loadvariable('m_to_anyone','');
		$price=loadvariable('price','');
		$validity=loadvariable('validity','');
		$amount=loadvariable('amount','');
		$id=loadvariable('id','');

		$SQL="UPDATE `stripes` SET `plan_name`='".$plan_name."',`r_to_friends`='".$r_to_friends."',`r_to_anyone`='".$r_to_anyone."',`m_to_friends`='".$m_to_friends."',`m_to_anyone`='".$m_to_anyone."' `price`='".$price."', `amount`='".$amount."', `validity`='".$validity."' WHERE `id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=userplans&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=userplans&msg=0');
		}
}

if($a=='edit')
{
		$plan_name=loadvariable('plan_name','');
		$r_to_friends=loadvariable('r_to_friends','');
		$r_to_anyone=loadvariable('r_to_anyone','');
		$m_to_friends=loadvariable('m_to_friends','');
		$m_to_anyone=loadvariable('m_to_anyone','');
		$price=loadvariable('price','');
		$validity=loadvariable('validity','');
		$amount=loadvariable('amount','');
		$id=loadvariable('id','');
		echo $plan_name . $m_to_friends;
		$SQL="UPDATE stripes SET plan_name='".$plan_name."',r_to_friends='".$r_to_friends."',r_to_anyone='".$r_to_anyone."',m_to_friends='".$m_to_friends."',m_to_anyone='".$m_to_anyone."', price='".$price."', amount='".$amount."', validity='".$validity."' WHERE id='".$id."'";
		
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=userplans&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=userplans&msg=0');
		}
}
		
if($a=='delete')
{
		
		$id=loadvariable('id','');

		$SQL="DELETE FROM `stripes` WHERE `id`='".$id."'";
		$res=$db->query($SQL);

		if($res)
		{
		header('location:../view/index.php?p=userplans&msg=1');
		}
		else
		{
		header('location:../view/index.php?p=userplans&msg=0');
		}

}
		if($a=='add')
		{
				
		$plan_name=loadvariable('plan_name','');
		$r_to_friends=loadvariable('r_to_friends','');
		$r_to_anyone=loadvariable('r_to_anyone','');
		$m_to_friends=loadvariable('m_to_friends','');
		$m_to_anyone=loadvariable('m_to_anyone','');
		$price=loadvariable('price','');
		$validity=loadvariable('validity','');
		$amount=loadvariable('amount','');
		$id=loadvariable('id','');	
				
				
				$SQL="INSERT INTO stripes SET plan_name ='".$plan_name."', r_to_friends ='".$r_to_friends."',r_to_anyone='".$r_to_anyone."',m_to_friends='".$m_to_friends."',m_to_anyone='".$m_to_anyone."' , price='".$price."', amount='".$amount."', validity='".$validity."'";
				
				$res=$db->query($SQL);

				if($res)
				{
				header('location:../view/index.php?p=userplans&msg=1');
				}
				else
				{
				header('location:../view/index.php?p=userplans&msg=0');
				}
			
		}






?>