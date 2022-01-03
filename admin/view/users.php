<?php 

$db=new DB();
$str="";
$start=loadvariable('start','0');
$end=30;
$msg=loadvariable('msg','');
$action=loadvariable('action','');
$a=loadvariable('a','list');
$id=loadvariable('id','');
if($msg=='1')
{
		$str="Success Fully Update ";
		$cls="alert alert-success";
}
if($msg=='0')
{
		$str="Not Updated ....Problem Occured ";
		$cls="alert alert-danger";
}
if($a=='list')
{
  $SQL="SELECT users.*,user_details.* FROM `users` inner join user_details on user_details.id = users.user_detail_id ";
  $res=$db->get_results($SQL);
}


if($action=='search')
{
$val=loadvariable('val','');
$option=loadvariable('option','');
}

$SQL="select user_details.*, users.* from users inner join user_details on users.user_detail_id=user_details.id WHERE users.not_registered=0 ";
if($val!="")
{
	if($option==0)
	{
	$SQL.=" and user_details.first_name = '$val'";
	}
	if($option==1)
	{
	$SQL.=" and user_details.phone_number='$val'";
	}
	if($option==2)
	{  
	$SQL.=" and users.email='$val'";
	}
}




$SQL.=" ORDER BY  users.registration_date DESC LIMIT $start,$end";
$res=$db->get_results($SQL);

$SQL_COUTN="select user_details.*, users.* from users inner join user_details on users.user_detail_id=user_details.id WHERE users.not_registered=0";
if($val!="")
{
	if($option==0)
	{
	$SQL_COUTN.=" and user_details.first_name LIKE '%$val%'";
	}
	if($option==1)
	{
	$SQL_COUTN.=" and user_details.phone_number='$val'";
	}
	if($option==2)
	{
	$SQL_COUTN.=" and users.email='$val'";
	}
}
$results1=$db->num_rows($SQL_COUTN);
$thispage=$_SERVER['PHP_SELF']."?p=users";
$num=$results1;
$per_page=30;
$showeachside=5;

if(empty($start)){$start=0;}
$max_pages=  ceil($num/$per_page);
$cur=  ceil($start/$per_page)+1; 


?>
   



<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

	  <section class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <?php if($a=='list')
			{ ?>
          <h1>Users Managment</h1>
      
          <ol class="breadcrumb">
	  <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="index.php?p=users">Users</a></li> 	
          </ol>
		  <?php// echo  $SQL;?>
        </section>
      <div class="content">
         <!-- Main content -->
                <?php 
				if($str!="")
				{?>
				<div class="<?php echo  $cls;?>" role="alert">
			  <a href="#" class="alert-link"><?php  echo $str;?></a>
			</div>
			<?php }
			?> 

          <div class="row">
            <div class="content">
      <!----------------------start search box---->
              <div class="box">
                 <div class="col-lg-12">
							<form class="navbar-form  pull-right" action="index.php"  role="search">
							<input type="hidden" name="p" value="users">
							<input type="hidden" name="action" value="search">
                <div class="input-group">
                    <input type="text" class="form-control" size="20" placeholder="Search" name="val">
                </div>
				 <div class="input-group">
                    <select class="form-control" name="option">
					<option value="0">Name </option>
					<option value="1">Mobile </option>
					<option value="2">Email </option>
					</select>
                </div>
			    <div class="input-group">
                    <input type="submit" class="form-control btn btn-primary" value="Search">
                </div>
				</form>
				         </div>
                       </div>
                     <!----------end search------------------------>
                <div class="box-body">
                  <table id="example" style="font-size:14px" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="text-align: center;">Sr no</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Sex</th>
                        <th style="text-align: center;">Age</th>
                        <th style="text-align: center;">Mobile No</th>
						            <th style="text-align: center;">Email</th>
                        <th style="text-align: center;">Address</th>
                        <th style="text-align: center;">Status</th>
						          <th style="text-align: center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php  $date1=date('Y-m-d');
						for($i=0;$i<count($res);$i++)
                        { ?>
						<tr>
                                <td style="text-align: center;"><?php echo $start+$i+1; ?></td>
                                <td style="text-align: center;"><a href="index.php?p=userinfo&id=<?php echo $res[$i]['user_detail_id'];?>"><?php echo  $res[$i]['first_name']." ".$res[$i]['last_name'] ?></a></td>
                                <td style="text-align: center;"><?php echo ucwords($res[$i]['sex']);?></td>
                                <td style="text-align: center;"><?php member_age($res[$i]['birthday']);?></td>
                                <td style="text-align: center;"> <?php echo $res[$i]['phone'];?></td>
								<td style="text-align: center;"> <?php echo $res[$i]['email'];?></td>
                                <td style="text-align: center;"> <?php echo  $res[$i]['location']; ?></td> 
                                <td> 
									   <?php if($res[$i]['is_active']=='1')
												{	?>
													<a class="btn btn-success" style="padding:2px;" href="../model/users.php?a=update&start=<?php echo $start;?>&status=0&id=<?php echo $res[$i]['id']; ?>" title="Click to IN-Active Mode"><i class="fa fa-check"></i></a>
												<?php }?>
												<?php
											if($res[$i]['is_active']=='0')	
												{?>
													<a class="btn btn-danger" style="padding:2px;" href="../model/users.php?a=update&start=<?php echo $start;?>&status=1&id=<?php echo $res[$i]['id'];?>" title="Click to Active Mode"><i class="fa fa-hand-pointer-o"></i></a>
												<?php }?>
								</td>
						</td>
					   <td>
					   <a class="btn btn-success" style="padding:2px;" href="index.php?p=users&a=edit&id=<?php echo $res[$i]['user_detail_id']; ?>"><i class="fa fa-edit"></i> &nbsp; Edit</a>
					 <br>
					 <br>
							<?php if($res[$i]['is_blocked']=='1')
								{?>
									<a class="btn btn-danger btn-sm" style="padding:2px;" href="../model/users.php?a=block&start=<?php echo $start;?>&is_blocked=0&id=<?php echo $res[$i]['id']; ?>" title="Click to unblock mode"><i class="fa fa-remove"></i>&nbsp; BLOCKED</a>
								<?php }?>
								<?php
								if($res[$i]['is_blocked']=='0')	
								{?>
									<a class="btn btn-info btn-sm" style="padding:2px;" href="../model/users.php?a=block&start=<?php echo $start;?>&is_blocked=1&id=<?php echo $res[$i]['id'];?>" title="Click to block mode"><i class="fa fa-hand-pointer-o"></i> &nbsp;Click to block</a>
								<?php }?>
					   
					   </td>
                      </tr>
                        <?php  }?>
                    </tbody>
                   
                  </table>
				  
                    <div class="box"><?php include('paging.php');?></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
		  </div>
        </section><!-- /.content -->
		
      </div><!-- /.content-wrapper --><!-- /.content -->
      <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
 
      <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script> 

  <script>   
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
  <?php }?>

<?php if($a=='edit')
{ 
	$id=loadvariable('id','');	
	$SQL="select users.*,user_details.* FROM `users` inner join user_details on user_details.id = users.user_detail_id WHERE users.user_detail_id='".$id."'";
	
	$res=$db->get_results($SQL);
	
	?>


							  
				  <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Update Details For Users Infomaition </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="../model/users.php">
				<input type="hidden" name="a" value="edit">
				<input type="hidden" name="id" value="<?php echo $res[0]['user_detail_id']; ?>">
                  <div class="box-body">
                    
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['first_name']?>" class="form-control" name="first_name" id="inputEmail3" placeholder="First Name ">
                      </div>
                    </div>
                   
                   <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['last_name']?>" class="form-control" name="last_name" id="inputEmail3" placeholder="Last Name ">
                      </div>
                    </div>

                   

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Sex</label>
                      <div class="col-sm-6">
                      	<select class="form-control" name="sex" id="dptcentres_edit" placeholder="sex" >
                      		<option selected><?php echo $res[0]['sex'];?></option>
                      		<option  value="Male">Male</option>
                      		<option value="Female">Female</option>
                      		
						</select>
						</div>
					</div>
                     


                  
                  
                   <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['email'] ?>"class="form-control" name="email" id="inputEmail3" placeholder="Email ">
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['username'] ?>"class="form-control" name="username" id="inputEmail3" placeholder="username " readonly>
                      </div>
                    </div>
                   
                   <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Mobile No</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['phone'] ?>"class="form-control" name="phone" id="inputEmail3" placeholder="Mobile No ">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Phase of life</label>
                      <div class="col-sm-6">
                      	<select class="form-control" name="phase_of_life">
                      		<option value="" selected><?php echo get_phase_of_life($res[0]['phase_of_life']); ?></option>
                      		<option value="1">Single</option>
                      		<option value="2">Hard to explain</option>
                      		<option value="3">Married</option>
                      		<option value="4">Hanging out with someone</option>
                      		<option value="5">Divorced</option>
                      		<option value="6">Engaged</option>
                      		<option value="7">Widowed</option>
						</select>
						</div>
					</div>	
					
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Website</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php if($res[0]['website']){echo $res[0]['website'];}else{echo "https://www.callitme.com/".$res[0]['username'];}?>"class="form-control" name="website" id="inputEmail3" placeholder="website">
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label" >Birthday</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['birthday'];  ?>"class="form-control" name="birthday" id="inputEmail3" placeholder="Age" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Location</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['location'] ?>"class="form-control" name="location" id="inputEmail3" placeholder="location ">
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Education</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['education'] ?>"class="form-control" name="education" id="inputEmail3" placeholder="education">
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Employment</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['employment'] ?>"class="form-control" name="employment" id="inputEmail3" placeholder="employment">
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Designation</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['designation'] ?>"class="form-control" name="designation" id="inputEmail3" placeholder="designation">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">About</label>
                      <div class="col-sm-6">
                        <textarea rows="4" cols="50" class="form-control" name="about" id="inputEmail3" placeholder="about"><?php echo $res[0]['about']; ?></textarea>
                      </div>
                    </div>	

					<div class="form-group">
                    	<button type="submit" class="btn btn-default">Cancel</button>
                    	<button type="submit" class="btn btn-info" id="btnSubmit">update</button>
                  	</div>
				</div><!-- /.box-body -->
                </div>  <!-- /.box-footer -->
                </form>
               <?php }?>
				  
              </div>
              
<script>
var temp = "php";

// Create New Option.
var newOption = $('<option>');
newOption.attr('value', temp).text(temp);

// Append that to the DropDownList.
$('#dptcentres_edit').append(newOption);

// Select the Option.
$("#dptcentres_edit > [value=" + temp + "]").attr("selected", "true");
              
              </script>
               
				  