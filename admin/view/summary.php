<?php 

$db=new DB();
$str="";
$start=loadvariable('start','0');
$end=30;
$msg=loadvariable('msg','');
$action=loadvariable('action','');
$a=loadvariable('a','list');
$summary_users=loadvariable('summary_users','');

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

if($action=='search')
{
$val=loadvariable('val','');
$option=loadvariable('option','');
}

if($summary_users=="registered")
{
	
$SQL="select user_details.*, users.* FROM `users` inner join user_details on user_details.id = users.user_detail_id WHERE users.`not_registered`=0";
if($val!="")
{
	if($option==0)
	{
	$SQL.=" and user_details.first_name LIKE '%$val%'";
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




$SQL.=" ORDER BY  users.id DESC LIMIT $start,$end";
$res_s=$db->get_results($SQL);
$SQL_COUTN="select user_details.*, users.* FROM `users` inner join user_details on users.user_detail_id=user_details.id WHERE users.`not_registered`=0";
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
$thispage=$_SERVER['PHP_SELF']."?p=summary&summary_users=".$summary_users;
$num=$results1;
$per_page=30;
$showeachside=5;

if(empty($start)){$start=0;}
$max_pages=  ceil($num/$per_page);
$cur=  ceil($start/$per_page)+1; 

}
if($summary_users=="never_activated")
{
	

$SQL="select  user_details.*, users.* FROM `users` inner join  `user_details` on user_details.id= users.user_detail_id WHERE users.is_active= 0";
if($val!="")
{
	if($option==0)
	{
	$SQL.=" and user_details.first_name LIKE '%$val%'";
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
			$SQL.=" ORDER BY  users.id DESC LIMIT $start,$end ";
			$res_s=$db->get_results($SQL);
			$SQL_COUTN="select users.*, user_details.* FROM `users` inner join `user_details` on user_details.id= users.user_detail_id WHERE users.is_active= 0";
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
$thispage=$_SERVER['PHP_SELF']."?p=summary&summary_users=".$summary_users;
$num=$results1;
$per_page=30;
$showeachside=5;

if(empty($start)){$start=0;}
$max_pages=  ceil($num/$per_page);
$cur=  ceil($start/$per_page)+1; 

}

if($summary_users=="paid_member")
		{

			$SQL="select payments.*,user_details.*, users.* FROM `payments`,`users`,`user_details` WHERE payments.user_id=users.id and users.user_detail_id=user_details.id";
if($val!="")
{
	if($option==0)
	{
	$SQL.=" and user_details.first_name LIKE '%$val%'";
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
			$SQL.=" ORDER BY  users.id DESC LIMIT $start,$end ";
			$res_s=$db->get_results($SQL);
			$SQL_COUTN="select payments.*,user_details.*, users.* FROM `payments`,`users`,`user_details` WHERE payments.user_id=users.id and users.user_detail_id=user_details.id";
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
$thispage=$_SERVER['PHP_SELF']."?p=summary&summary_users=".$summary_users;
$num=$results1;
$per_page=30;
$showeachside=5;

if(empty($start)){$start=0;}
$max_pages=  ceil($num/$per_page);
$cur=  ceil($start/$per_page)+1; 

}

if($summary_users=="male_register")
		{
			
$SQL="select user_details.*, users.* FROM `user_details` inner join `users`  on user_details.id=users.user_detail_id WHERE `sex`='male' ";
if($val!="")
{
	if($option==0)
	{
	$SQL.=" and user_details.first_name LIKE '%$val%'";
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
			$SQL.=" ORDER BY  users.id DESC LIMIT $start,$end ";
			$res_s=$db->get_results($SQL);
			$SQL_COUTN="select user_details.*, users.* FROM `user_details` inner join `users`  on user_details.id=users.user_detail_id WHERE `sex`='male' ";
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
$thispage=$_SERVER['PHP_SELF']."?p=summary&summary_users=".$summary_users;
$num=$results1;
$per_page=30;
$showeachside=5;

if(empty($start)){$start=0;}
$max_pages=  ceil($num/$per_page);
$cur=  ceil($start/$per_page)+1; 

}

if($summary_users=="female_register")
		{
			
$SQL="select user_details.*, users.* FROM `user_details` inner join`users` on user_details.id=users.user_detail_id  WHERE `sex`='female' ";
if($val!="")
{
	if($option==0)
	{
	$SQL.=" and user_details.first_name LIKE '%$val%'";
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
			$SQL.=" ORDER BY  users.id DESC LIMIT $start,$end ";
			$res_s=$db->get_results($SQL);
			$SQL_COUTN="select user_details.*, users.* FROM `user_details`,`users` WHERE `sex`='female' AND user_details.id=users.user_detail_id";
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
$thispage=$_SERVER['PHP_SELF']."?p=summary&summary_users=".$summary_users;
$num=$results1;
$per_page=30;
$showeachside=5;

if(empty($start)){$start=0;}
$max_pages=  ceil($num/$per_page);
$cur=  ceil($start/$per_page)+1; 

}
if($summary_users=="past_hours")
		{
			
			$SQL="select user_details.*,users.* FROM `users`,`user_details` WHERE `registration_date` > DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND user_details.id=users.user_detail_id";
if($val!="")
{
	if($option==0)
	{
	$SQL.=" and user_details.first_name LIKE '%$val%'";
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
			$SQL.=" ORDER BY  users.id DESC LIMIT $start,$end ";
			$res_s=$db->get_results($SQL);
			$SQL_COUTN="select user_details.*,users.* FROM `users`,`user_details` WHERE `registration_date` > DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND user_details.id=users.user_detail_id";
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
$thispage=$_SERVER['PHP_SELF']."?p=summary&summary_users=".$summary_users;
$num=$results1;
$per_page=30;
$showeachside=5;

if(empty($start)){$start=0;}
$max_pages=  ceil($num/$per_page);
$cur=  ceil($start/$per_page)+1; 

}
if($summary_users=="active_after_register")
		{
				
			$SQL="select user_details.*,users.* FROM `users`,`user_details` WHERE `registration_date` IS NOT NULL AND `is_active`=1 AND user_details.id=users.user_detail_id";
if($val!="")
{
	if($option==0)
	{
	$SQL.=" and user_details.first_name LIKE '%$val%'";
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
			$SQL.=" ORDER BY  users.id DESC LIMIT $start,$end ";
			$res_s=$db->get_results($SQL);
			$SQL_COUTN="select user_details.*,users.* FROM `users`,`user_details` WHERE `registration_date` IS NOT NULL AND `is_active`=1 AND user_details.id=users.user_detail_id";
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
$thispage=$_SERVER['PHP_SELF']."?p=summary&summary_users=".$summary_users;
$num=$results1;
$per_page=30;
$showeachside=5;

if(empty($start)){$start=0;}
$max_pages=  ceil($num/$per_page);
$cur=  ceil($start/$per_page)+1; 

}
if($summary_users=="activated_but_deactivated")
		{
			
			$SQL="select user_details.*,users.* FROM `users` inner join user_details on user_details.id=users.user_detail_id WHERE `is_deleted`=1 and `is_active` = 1";
if($val!="")
{
	if($option==0)
	{
	$SQL.=" and user_details.first_name LIKE '%$val%'";
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
			$SQL.=" ORDER BY  users.id DESC LIMIT $start,$end ";
			$res_s=$db->get_results($SQL);
			$SQL_COUTN="select user_details.*,users.* FROM `users` inner join user_details on user_details.id=users.user_detail_id WHERE `is_blocked`=1";
			
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
$thispage=$_SERVER['PHP_SELF']."?p=summary&summary_users=".$summary_users;
$num=$results1;
$per_page=30;
$showeachside=5;

if(empty($start)){$start=0;}
$max_pages=  ceil($num/$per_page);
$cur=  ceil($start/$per_page)+1; 

}
if($summary_users=="unpaid_users")
		{
			
			$SQL="select user_details.*, users.*  FROM users inner join user_details on user_details.id=users.user_detail_id WHERE users.id NOT IN (SELECT user_id FROM payments) and  users.not_registered=0";
if($val!="")
{
	if($option==0)
	{
	$SQL.=" and user_details.first_name LIKE '%$val%'";
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
			$SQL.=" ORDER BY  users.id DESC LIMIT $start,$end ";
			$res_s=$db->get_results($SQL);
			$SQL_COUTN="select user_details.*, users.*  FROM users inner join user_details on user_details.id=users.user_detail_id WHERE users.id NOT IN (SELECT user_id FROM payments) and  users.not_registered=0";
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
$thispage=$_SERVER['PHP_SELF']."?p=summary&summary_users=".$summary_users;
$num=$results1;
$per_page=30;
$showeachside=5;

if(empty($start)){$start=0;}
$max_pages=  ceil($num/$per_page);
$cur=  ceil($start/$per_page)+1; 

}
?>




<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
	  <section class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <?php 
        	if($summary_users=="registered")
        	{
        	$nm="Registered";
        	}
        	if($summary_users=="never_activated")
        	{
        		$nm="Never Activated";
        	}
        	if($summary_users=="paid_member")
        	{
        		$nm="Paid";
        	}
        	if($summary_users=="male_register")
        	{
        		$nm="Male";
        	}
        	if($summary_users=="female_register")
        	{
        		$nm="Female";
        	}
        	if($summary_users=="past_hours")
        	{
        		$nm="Past 24 Hours";
        	}
        	if($summary_users=="active_after_register")
        	{
        		$nm="Active After Register";
        	}
        	if($summary_users=="activated_but_deactivated")
        	{
        		$nm="Activated But Deactivated";
        	}
        	if($summary_users=="unpaid_users")
        	{
        		$nm="Unpaid";
        	}

        	?>
          <h1><?php echo $nm;?> Users Information</h1>
      
          <ol class="breadcrumb">
	  <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="index.php?p=summary&summary_users=registered"><?= $nm;?></a></li> 	
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
							<input type="hidden" name="p" value="summary">
							<input type="hidden" name="summary_users" value="<?=$summary_users;?>">

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
                        for($i=0;$i<count($res_s);$i++)
                        { ?>
						<tr>
                                <td style="text-align: center;"><?php echo $start+$i+1; ?></td>
                                <td style="text-align: center;"><a href="index.php?p=userinfo&id=<?php echo $res_s[$i]['user_detail_id'];?>"><?php echo  $res_s[$i]['first_name']." ".$res_s[$i]['last_name'] ?></a></td>
                                <td style="text-align: center;"><?php echo ucwords($res_s[$i]['sex']);?></td>
                                <td style="text-align: center;"><?php member_age($res_s[$i]['birthday']);?></td>
                                <td style="text-align: center;"> <?php echo $res_s[$i]['phone'];?></td>
								<td style="text-align: center;"> <?php echo $res_s[$i]['email'];?></td>
                                <td style="text-align: center;">
                                	<?php
                                			if($res_s[$i]['location']){
                                 			echo  $res_s[$i]['location'];
                                 			}
                                 			elseif($res_s[$i]['ip']) {
                                 				$user_ip = $res_s[$i]['ip'];
                                				$api_key = "af1ca5f807a5aad7b4677dc6813f379536c9516c0f0e5a6c594abbec2f5fa069";

                               					 $url = "http://api.ipinfodb.com/v3/ip-city/?key=".$api_key."&ip=".$user_ip."&format=json";
                                					$ch = curl_init();

				                                curl_setopt($ch, CURLOPT_URL, $url);
				                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				                                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
				                                $data_country = curl_exec($ch);
				                                $location = json_decode( $data_country);
				                                echo $location->cityName." , ".$location->countryName;
                                 			}
                                 			elseif($res_s[$i]['location']=="" && $res_s[$i]['ip']=="")
                                 			{
                                 				echo "not disclosed";
				                            }
                                 	 ?>		
                                </td> 
                           <td> 
					   				<?php if($res_s[$i]['is_active']=='1')
									{?>
												<a class="btn btn-success" style="padding:2px;" href="../model/summary.php?a=update&summary_users=<?=$summary_users;?>&start=<?php echo $start;?>&status=0&id=<?php echo $res_s[$i]['id']; ?>" title="Click to IN-Active Mode"><i class="fa fa-check"></i></a>
									<?php }?>
									<?php
											if($res_s[$i]['is_active']=='0')	
									{?>
										<a class="btn btn-danger" style="padding:2px;" href="../model/summary.php?a=update&summary_users=<?=$summary_users;?>&start=<?php echo $start;?>&status=1&id=<?php echo $res_s[$i]['id'];?>" title="Click to Active Mode"><i class="fa fa-hand-pointer-o"></i></a>
									<?php }?>
						</td>
						</td>
					   <td>
					  	 <a class="btn btn-success" style="padding:2px;" href="index.php?p=users&a=edit&id=<?php echo $res_s[$i]['user_detail_id']; ?>"><i class="fa fa-edit"></i> &nbsp; Edit</a>
					 <br>
					 <br>
							<?php if($res_s[$i]['is_blocked']=='1')
								{?>
									<a class="btn btn-danger btn-sm" style="padding:2px;" href="../model/summary.php?a=block&summary_users=<?=$summary_users;?>&start=<?php echo $start;?>&is_blocked=0&id=<?php echo $res_s[$i]['id']; ?>" title="Click to IN-Active Mode"><i class="fa fa-remove"></i>&nbsp; BLOCKED</a>
								<?php }?>
								<?php
								if($res_s[$i]['is_blocked']=='0')	
								{?>
									<a class="btn btn-info btn-sm" style="padding:2px;" href="../model/summary.php?a=block&summary_users=<?=$summary_users;?>&start=<?php echo $start;?>&is_blocked=1&id=<?php echo $res_s[$i]['id'];?>" title="Click to Active Mode"><i class="fa fa-hand-pointer-o"></i> &nbsp;Click to block</a>
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