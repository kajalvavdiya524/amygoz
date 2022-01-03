<?php	
$id=loadvariable('id','');

 /*$SQL="SELECT * FROM admin_login WHERE Id='".$id."'";

$res=$db->get_results($SQL);*/

$SQL="SELECT admin_login.*, admin_info.* FROM admin_login INNER JOIN admin_info ON admin_login.ID=admin_info.Admin_ID AND admin_login.Id ";
$res=$db->get_results($SQL);



?>


  
 

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
	
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Admin Profile</h1>
      
          <ol class="breadcrumb">
	  <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="index.php?p=admin">admin profile</a></li> 	
          </ol>
		  <?php// echo  $SQL;?>
        </section>
   
	
         <!-- Main content -->
             <section class="content">
        <div class="row">
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="box box-info">
                
                <!-- form start -->
                <form class="form-horizontal" method="post">
                <div class="box-body">
				
				<?php /*$URL=get_photo($res[0]['Profile_pic']); */?>
				 <a href="index.php?p=admin">
                  <img class="profile-user-img img-responsive img-circle" src="../../maanguadmin/dist/img/user2-160x160.jpg" alt="User profile picture"></a>
                    <div class="box-body"style="margin-left:37%;">
                    <div class="form-group">
                      <label for="Enter User Name" class="col-sm-2 control-label"> User Name :</label>
                      <div class="col-sm-5">
                        <label for="Enter User Name" class="col-sm-2 control-label"> <?php echo  $res[0]['Name']; ?></label>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label"> Email :</label>
                     <div class="col-sm-5">
                       <label for="Enter User Name" class="col-sm-2 control-label">  <?php echo  $res[0]['Email_Id']; ?></label>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Enter User mobile" class="col-sm-2 control-label"> User Mobile :</label>
                      <div class="col-sm-5">
                                             <label for="inputEmail3" class="col-sm-2 control-label"> <?php echo  $res[0]['Mobile']; ?></label>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Enter User Admin" class="col-sm-2 control-label"> Admin Type :</label>
                      <div class="col-sm-5">
                                            <label for="inputEmail3" class="col-sm-2 control-label">   <?php echo  $res[0]['AdminType']; ?></label>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label"> Registration Date :</label>
                     <div class="col-sm-5">
                                            <label for="inputEmail3" class="col-sm-5 control-label">  <?php echo  date('d-m-Y',strtotime($res[0]['Registration_date'])); ?></label>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Enter User Status" class="col-sm-2 control-label"> User Status :</label>
                      <div class="col-sm-5">
                                              <label for="inputEmail3" class="col-sm-2 control-label"> <?php echo  $res[0]['Status']; ?></label>
                      </div>
                    </div>
                    </div>
                    
                  </div><!-- /.box-body -->
                </form>
                </div>
       </div> 
       </div>
       </section> 
      </div><!-- /.content-wrapper --><!-- /.content -->
      <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
 
      <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script> 

  <script>   
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>