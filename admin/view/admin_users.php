<?php 
$db=new DB();
$str="";
$msg=loadvariable('msg','');
$a=loadvariable('a','list');

if($msg=='1')
{
		$str="Successfully Updated ";
		$cls="alert alert-success";
}
if($msg=='0')
{
		$str="Not Updated ....Problem Occured ";
		$cls="alert alert-danger";
}
if($a=='list')
{
	$SQL="SELECT * FROM `admin_login`";
	$res=$db->get_results($SQL);
}

if($a=='edit')
{
	$id=loadvariable('id','');
	$SQL="SELECT * FROM `admin_login` WHERE Id='".$id."'";
	$res=$db->get_results($SQL);
	if($res[0]['Status']=='Y')
    {
		$chk1='Checked';
		$chk2='';
    }
	else
	{
		$chk2='Checked';
		$chk1='';
	}

}

$id=loadvariable('id','');
?>
   
	<script>
		$(document).ready(function(){
		    $('#myTable').dataTable();
		    //myTable is you table id.
		});

	</script>




<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
	  <section class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Admin Users
            <small>Report</small>
          </h1>
          <ol class="breadcrumb">

	  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="index.php?p=users">Users</a></li>
			<li class="active">Data tables</li>  	
          </ol>
        </section>

       
      <div class="content">
         <!-- Main content -->
          <div class="row">
            <div class="col-xs-12">
             <div class="box">
			  <a class="btn btn-info pull-right" href="index.php?p=admin_users&a=add"> Add New Record</a>
	</div> 
		<?php 
			if($str!="")
			{?>
		    	<div class="<?php echo  $cls;?>" role="alert">
          <a href="#" class="alert-link"><?php  echo $str;?></a>
        </div>
			<?php }
			?>
                <div class="box-header">
                  <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php if($a=='list')
				{?>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                       
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Admin Type</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php for($i=0;$i<count($res);$i++)
					{?>
                      <tr>
                     <td> <?php echo $i+1; ?></td>
					
					  <td> <?php echo $res[$i]['Name']; ?></td>
             <td> <?php echo $res[$i]['Email_Id']; ?></td>
             <td> <?php echo $res[$i]['Mobile']; ?></td>
              <td> <?php echo $res[$i]['AdminType']; ?></td>
					   <td> 
					   <?php if($res[$i]['Status']=='Y')
								{?>
									<a class="btn btn-success" href="../model/admin_users.php?a=update&status=N&id=<?php echo $res[$i]['Id'];?>" title="Click to IN-Active Mode"><i class="fa fa-check"></i></a>
								<?php }?>
								<?php
								if($res[$i]['Status']=='N')	
								{?>
									<a class="btn btn-danger" href="../model/admin_users.php?a=update&status=Y&id=<?php echo $res[$i]['Id'];?>" title="Click to Active Mode"><i class="fa fa-hand-pointer-o"></i></a>
								<?php }?>
						</td>
					   <td>
					   <a class="btn btn-success" href="index.php?p=admin_users&a=edit&id=<?php echo $res[$i]['Id']; ?>"><i class="fa fa-edit"></i>&nbsp; Edit</a>
             <a class="btn btn-info btn-sm" href="index.php?p=admin_users&a=changepass&id=<?php echo $res[$i]['Id']; ?>"><i class="fa fa-edit"></i>&nbsp; Change Password</a>
					 </td>
                      </tr>
					  <?php }?>
                     </tbody>

            </table>
				  <?php }?><!-----LIST CLOSE-------------->
				   
				   <?php 			  
				  if($a=='add')
				  { ?>
				  <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Enter Details For Admin </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="../model/admin_users.php">
				<input type="hidden" name="a" value="add">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control"  name="name"id="inputEmail3" placeholder="Name" required>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Mobile No.</label>
                      <div class="col-sm-6">
                        <input pattern="[7-9]{1}[0-9]{9}" type="text" maxlength="10" class="form-control" name="mobile" id="mobile" placeholder="Mobile No."required>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Email Id</label>
                      <div class="col-sm-6">
                        <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email" required>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-6">
                        <input type="password" class="form-control" name="password" id="txtPassword" placeholder="Password" required >
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>
                      <div class="col-sm-6">
                        <input type="password" class="form-control" name="password" id="txtConfirmPassword" placeholder="Confirm Password" required>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Admin Type</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="admintype" id="inputEmail3" placeholder="Value " required>
                      </div>
                    </div>
				
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">STATUS</label>
                      <div class="col-sm-6">
					   <label for="inputEmail3" >
					  <input type="radio" name="status" value="Y">  Y</label>
					   <label for="inputEmail3" >
					  <input type="radio" name="status" value="N">  N</label>
                        
                      </div>
                    </div>
                   
                   
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-info" id="btnSubmit">Insert Data</button>
                  </div><!-- /.box-footer -->
                </form>
				
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
					<script type="text/javascript">
								$(function () {
								
							$("#btnSubmit").click(function () {
								var password = $("#txtPassword").val();
								var confirmPassword = $("#txtConfirmPassword").val();
								if (password != confirmPassword) {
									alert("Passwords do not match.");
									return false;
								}
								return true;
							});
						});
					</script>
								
              </div>
				  <?php }
				  ?>
				  
				 <?php if($a=='edit')
				  { 
				// print_r($res);
				  ?>
				  <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Update Details For Admin Users </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="../model/admin_users.php">
				<input type="hidden" name="a" value="edit">
				<input type="hidden" name="id" value="<?php echo $res[0]['Id']; ?>">
                  <div class="box-body">
                    
					       <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">NAME</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['Name'] ?>"class="form-control" name="name" id="inputEmail3" placeholder="Name ">
                      </div>
                    </div>
                  <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['Email_Id'] ?>"class="form-control" name="email" id="inputEmail3" placeholder="Email ">
                      </div>
                    </div>
                   <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Mobile No</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['Mobile'] ?>"class="form-control" name="mobile" id="inputEmail3" placeholder="Mobile No ">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Admin Type</label>
                        <div class="col-sm-6">
                        
                       
                          <input name="admintype" type='text' class="form-control" value="<?php echo  $value['AdminType'];?>"><?php echo $value['AdminType'];?></option>
                        </div> 
                     </div>
                      
                   <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">STATUS</label>
                      <div class="col-sm-6">
					   <label for="inputEmail3" >
					  <input type="radio" name="status" value="Y" <?php echo $chk1;?>>  Y</label>
					   <label for="inputEmail3" >
					  <input type="radio" name="status" value="N" <?php echo $chk2; ?>>  N</label>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    <button type="submit" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-info">Update Data</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
				  <?php }
				  ?>


          <?php if($a=='changepass'){?> 
          <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Update Password For Admin Users </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="../model/admin_users.php">
				<input type="hidden" name="a" value="changepass">
				<input type="hidden" name="id" value="<?php echo  $Id;?>">
			  <div class="box-body">
                    
                 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Current Password</label>
                      <div class="col-sm-6">
                        <input type="password"  value=""class="form-control" name="current_password" id="inputEmail3" placeholder="Current Password "required>
                      </div>
                    </div>
                  <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">New Password</label>
                      <div class="col-sm-6">
                        <input type="password"  value=""class="form-control" name="password" id="txtPassword1" placeholder="New Password "required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Retype Password</label>
                      <div class="col-sm-6">
                        <input type="password"  value=""class="form-control" name="password" id="txtConfirmPassword1" placeholder="Retype Password "required>
                      </div>
                    </div>
                    <div class="box-footer">
                   
                    <button type="submit" class="btn btn-info" id="btnSubmit">Update Password</button>
                  </div>
                  </form>
				  
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
				<script type="text/javascript">
					$(function () {
						$("#btnSubmit").click(function () {
							var password = $("#txtPassword1").val();
							var confirmPassword = $("#txtConfirmPassword1").val();
							if (password != confirmPassword) {
								alert("Passwords do not match.");
								return false;
							}
							return true;
						});
					});
				</script>
				  
				  
				  
				  
				  
				  
				  
				  
                </div>
                <?php }?>
                </div><!-- /.box-body -->
				
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
		  </div>
		  
        </section><!-- /.content -->
		
      </div><!-- /.content-wrapper --><!-- /.content -->
	