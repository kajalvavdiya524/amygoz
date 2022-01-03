<?php 
error_reporting(0);
include('../script/function.php');
$msg=$_GET['msg'];

if($msg=='1')
{
    $str="We have sent an email to your registered email address with a password reset link. Please check your email and click on the link.";
    $css = "color:green";
}
if($msg=='0')
{
    $str="Sorry, this email is not registered in our system as admin user.";
    $css = "color:red";
}


 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CallItMe | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
	<link rel="icon" href="../dist/images/favicon.ico" type="image/x-icon" />
	<link rel="icon" type="image/png" href="../dist/images/favicon.png">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
     
      <div class="login-box-body">
         <div class="login-logo">
        <a href="../../index2.html"><img style="hight:70px; width:200px;" src="../assets/img/logo1.png"></a>
      </div><!-- /.login-logo -->
      <p style="<?php echo $css;?>">

      <?php  echo $str;?>
      </p>
        <form action="../script/forgot_password.php" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Enter Email" name="Email" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          
          <div class="row">
            
            <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
          </div>
        </form>

      
        <br>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
