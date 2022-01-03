<?php 
/*****************Function For Recieve Value Using POST, GET, REQUEST **********************/



function loadvariable($name,$val)
{


	if($_POST[$name]!="")
	{
		$val=$_POST[$name];

		return $val;
	}
	else if($_GET[$name]!="")
	{
		$val=$_GET[$name];

		return $val;
	}
	else if($_REQUEST[$name]!="")
	{
		$val=$_REQUEST[$name];

		return $val;
	}
	else
	{
		$val=$val;
		return $val;
	}

	

}

    function  Resgister_User()
{
       
connect_db();

    $SQL="SELECT COUNT(*) AS register_user  FROM `users` where not_registered=0";
   
    $Res_Usr= mysql_fetch_assoc(mysql_query($SQL));   
    return $Res_Usr;
}

 function  never_activate()
{
       
connect_db();

    $SQL="SELECT count(*) as not_activate FROM `users` WHERE `is_active`=0 and not_registered=0";
    
    $never_activate= mysql_fetch_assoc(mysql_query($SQL));   
    return $never_activate;
}
function  male_reg()
{
       
connect_db();


    $SQL="SELECT count(*) as male_reg FROM user_details inner join  users on user_details.id=users.user_detail_id WHERE user_details.`sex`='male' and users.`not_registered`= 0";
    $male_reg= mysql_fetch_assoc(mysql_query($SQL));   
    return $male_reg;
}
function  female_reg()
{
       
connect_db();

    $SQL="SELECT count(*) as female_reg FROM user_details inner join  users on user_details.id=users.user_detail_id WHERE user_details.`sex`='female' and users.`not_registered`= 0";
    
    $female_reg= mysql_fetch_assoc(mysql_query($SQL));   
    return $female_reg;
}
function  last_24_hours_user()
{
       
connect_db();

    $SQL="SELECT count(*) as last24user FROM `users` WHERE `registration_date` > DATE_SUB(CURDATE(), INTERVAL 1 DAY) and users.`not_registered`= 0";
    
    $last_24_hours= mysql_fetch_assoc(mysql_query($SQL));   
    return $last_24_hours;
}
function  paid_user()
{
       
connect_db();


    $SQL="SELECT count(*) as paid_user FROM `payments`";
    
    $paid_users= mysql_fetch_assoc(mysql_query($SQL));   
    return $paid_users;
}
function  active_after_register()
{
       
connect_db();
    $SQL="SELECT count(*) as active_after_register FROM `users` WHERE `registration_date` IS NOT NULL AND `is_active`=1";
    
    $active_after_register= mysql_fetch_assoc(mysql_query($SQL));   
    return $active_after_register;
}
function  unpaid_users()
{
       
connect_db();

    $SQL="SELECT count(*) as unpaid_users FROM users WHERE id NOT IN (SELECT user_id FROM payments) and `not_registered`= 0";
    
    $unpaid_users= mysql_fetch_assoc(mysql_query($SQL));   
    return $unpaid_users;
}
function  activated_but_deactivated()
{
       
connect_db();

    $SQL="SELECT count(*) as activated_but_deactivated FROM `users` WHERE `is_blocked`=1";
    
    $activated_but_deactivated= mysql_fetch_assoc(mysql_query($SQL));   
    return $activated_but_deactivated;
}
function  users_by_country()
{
    connect_db();

    $SQL="SELECT count(*) as total, user_details.location from user_details inner join users on user_details.id=users.user_detail_id where users.not_registered = 0  group by user_details.`location`";
$i=0;
$ROW=array();
   $res= mysql_query($SQL);
   while ($data=  mysql_fetch_assoc($res))
   {
        
       if($data['location']=='' )
       {
           $ROW[$i]['total']=$data['total'];
       $ROW[$i]['location']='Sri Lanka';
       }
	   else
	   {
       $ROW[$i]['total']=$data['total'];
       $ROW[$i]['location']=$data['location'];
	   }
       
       $i++;
   }
   return $ROW;
    
}

function connect_db()
{

$conn =  mysql_connect("localhost","ipintooc","Harvard41##");
mysql_select_db('ipintooc_main',$conn);
}
//data for last 1 month 

 function  Resgister_User_knob($date,$newdate)
{
       
connect_db();


    $SQL="SELECT count(*) as register_last_week FROM `users`WHERE `registration_date`BETWEEN '$newdate' AND '$date'";
    //echo  $SQL;
    $Resgister_User_knob=  mysql_fetch_assoc(mysql_query($SQL));   
    return $Resgister_User_knob;
}
 function  Resgister_linechart($date,$newdate)
{
global $db;      
$db=new DB();

    $SQL="SELECT COUNT(*) as total,DATE_FORMAT(time, '%d-%M') as dates FROM `activities` where time BETWEEN '".$newdate."' AND '".$date."' GROUP BY DATE_FORMAT(time, '%d') ORDER BY dates DESC";
   $res=$db->get_results($SQL);
    //echo  $SQL;
    return $res;
}

function  male_reg_knob($date,$newdate)
{
       
connect_db();


    $SQL="select count(*) as male_reg from users inner join user_details on users.user_detail_id=user_details.id where user_details.sex='male' AND users.registration_date BETWEEN '$newdate' AND '$date';";
    
    $male_reg= mysql_fetch_assoc(mysql_query($SQL));   
    return $male_reg;
}
function  female_reg_knob($date,$newdate)
{
       
connect_db();


    $SQL="select count(*) as female_reg from users inner join user_details on users.user_detail_id=user_details.id where user_details.sex='female' AND users.registration_date BETWEEN '$newdate' AND '$date';";
    
    $female_reg= mysql_fetch_assoc(mysql_query($SQL));   
    return $female_reg;
}
function  paid_user_knob($date,$newdate)
{
       
connect_db();

    $SQL="SELECT count(*)as paid_user FROM `payments` inner join users on users.id=payments.user_id AND users.registration_date BETWEEN '$newdate' AND '$date'";
    
    $paid_users= mysql_fetch_assoc(mysql_query($SQL));   
    return $paid_users;
}
function  unpaid_user_knob($date,$newdate)
{
       global $db;
    $db=new DB();
//$conn =  mysql_connect("localhost","root","");
//mysql_select_db('nepalivivah',$conn);


    $SQL="SELECT count(*) as unpaid_users FROM users WHERE ID NOT IN (SELECT user_id FROM payments) and users.registration_date BETWEEN '$newdate' AND '$date'";
    
//    $unpaid_users= mysql_fetch_assoc(mysql_query($SQL));  
    $unpaid_users= $db->get_results($SQL);
    return $unpaid_users[0]['unpaid_users'];
}
//function for users table for religion 
function religion($rel)
{
    global $db;
    $db=new DB();
//$conn =  mysql_connect("localhost","root","");
//mysql_select_db('nepalivivah',$conn);
   $SQL="SELECT Value from religion where id='$rel'";
   
//   $reli= mysql_fetch_assoc(mysql_query($SQL));  
    $reli=$db->get_results($SQL);
    echo $reli[0]['Value'];
}
function active($rel)
{
connect_db();
   $SQL="SELECT is_active from users";
   
   $reli= mysql_fetch_assoc(mysql_query($SQL));
 // echo $reli['is_active'];
   if ($reli['is_active']==1){
       echo "Activated Users";
   }
   else{
       echo "Deactivate users";
   }
    
}

function get_education($id)
{
connect_db();
 $SQL="SELECT `Value` FROM `education` WHERE `Id`='$id'";
 $res= mysql_fetch_assoc(mysql_query($SQL));
 return $res['Value'];
 
}

function get_user_plans($plan)
{
connect_db();
 $SQL="SELECT count(*) as free_users  FROM `user_plans` WHERE `name`='".$plan."'";
 $res= mysql_fetch_assoc(mysql_query($SQL));
 return $res['free_users'];
 
}
function get_user_plans_details()
{
connect_db();
 $SQL="SELECT * FROM `stripes`";
 $res= mysql_fetch_assoc(mysql_query($SQL));
 return $res;
 
}
function get_smoke($id)
{
connect_db();
 $SQL="SELECT `Value` FROM `smoke` WHERE `Id`='$id'";
 $res= mysql_fetch_assoc(mysql_query($SQL));
 return $res['Value'];
 
}
function get_no_of_friends($id)
{
connect_db();

 $SQL="SELECT user_id, count(*) as friends FROM `friendships` WHERE user_id=".$id." group by user_id";
 
 $res= mysql_fetch_assoc(mysql_query($SQL));
 return $res['friends'];
 
}
function get_mangalik($id)
{
connect_db();
 $SQL="SELECT `Value` FROM `mangalik` WHERE `Id`='$id'";
 $res= mysql_fetch_assoc(mysql_query($SQL));
 return $res['Value'];
 
}
function get_drink($id)
{
connect_db();
 $SQL="SELECT `Value` FROM `drink` WHERE `Id`='$id'";
 $res= mysql_fetch_assoc(mysql_query($SQL));
 return $res['Value'];
 
}
function get_built($id)
{
connect_db();
 $SQL="SELECT `Value` FROM `built` WHERE `Id`='$id'";
 $res= mysql_fetch_assoc(mysql_query($SQL));
 return $res['Value'];
 
}
function get_phase_of_life($id)
{
connect_db();
if($id==1){
  return "Single";
}
elseif($id==2){
return "Hard to Explain";
}
elseif($id==3){
return "Married";
}
elseif($id==4){
return "Hanging Out With Someone";
}
elseif($id==5){
return "Divorced";
}
elseif($id==6){
return "Engaged";
}
elseif($id==7){
return "Widowed";
}

 
 
}
function get_complexion($id)
{
connect_db();
 $SQL="SELECT `Value` FROM `complexion` WHERE `Id`='$id'";
 $res= mysql_fetch_assoc(mysql_query($SQL));
 return $res['Value'];
 
}
function get_residency_status($id)
{
connect_db();
 $SQL="SELECT `Value` FROM `residency_status` WHERE `Id`='$id'";
 $res= mysql_fetch_assoc(mysql_query($SQL));
 return $res['Value'];
 
}

function get_diet($id)
{
connect_db();
 $SQL="SELECT `Value` FROM `diet` WHERE `Id`='$id'";
 $res= mysql_fetch_assoc(mysql_query($SQL));
 return $res['Value'];
 
}

 function member_age($age)
 {
     $date1 =$age;
//creating a date object
$date2 = date('Y-m-d');
$diff12 = strtotime($date2)-strtotime($date1);
echo "  ".floor($diff12 / (60*60*24*365) )." Years";
 }

function get_follower($id)
{
	connect_db();
	$SQL="SELECT COUNT(following) as followers FROM `followers` WHERE `following`='".$id."' ";

	$res_follower=mysql_fetch_assoc(mysql_query($SQL));
	return $res_follower['followers'];
}

function get_user_agent($id)
{
  connect_db();
  $SQL="SELECT user_agent FROM `logged_users` WHERE `user_id`='".$id."' ";

  $user_agent=mysql_fetch_assoc(mysql_query($SQL));
  return $user_agent['user_agent'];
}


function get_following($id)
{
	connect_db();
	//SELECT COUNT(follower) as followings FROM `followers` WHERE `following`='28'
	$SQL="SELECT COUNT(follower) as following FROM `followers` WHERE `follower`='".$id."'";

	$res_follower=mysql_fetch_assoc(mysql_query($SQL));
	return $res_follower['following'];
}


function get_photo($id)
{
	connect_db();

	$SQL="SELECT profile_pic FROM `photos` Where id='".$id."'";
	$res=mysql_fetch_assoc(mysql_query($SQL));
	return $res['profile_pic'];
}

//for column chart
function  ResgisterUsers_columnchart($date,$newdate)
{
global $db;      
$db=new DB();

   // $SQL="SELECT COUNT(*) as TLR,DATE_FORMAT(registration_date, '%d-%M') as dates FROM `users`   group by registration_date  ORDER BY registration_date DESC LIMIT 15";
$SQL="select count(*) TLR,DATE_FORMAT(registration_date,'%d-%M') as dates, sum(case when is_active =1 then 1 else 0 end) TLA from users group by registration_date order by registration_date DESC limit 15";

   $res=$db->get_results($SQL);
   
   return $res;

   
}




?>
