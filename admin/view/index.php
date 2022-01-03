<?php
session_start();
error_reporting(0);
if($_SESSION['Name']=="")
{
		header("location:login.php");

}


include('../script/function.php');
include('../script/class.db.php');
include('../script/config.php');


global $db;
$db=new DB();
$summary_users=loadvariable('summary_users','');
$p=loadvariable("p","home");

$page=$p.".php";
	
 ?>

<html>
<title> Callitme Administration </title>

<?php
include('head_tag.php');
 ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
 <div class="wrapper">
 	<?php include('header.php');?>
 	<?php include('sidebar.php');?>
 	<?php require($page);
?>
 	<?php include('footer.php');?>

</div>
</body>
</html>
