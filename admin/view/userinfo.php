<?php 

$db=new DB();

$msg=loadvariable('msg','');

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


$SQL="select user_details.*,users.* from users inner join user_details on users.user_detail_id=user_details.id AND users.user_detail_id='".$id."'";

$res=$db->get_results($SQL);

//$p_id=$res[0]['partner_id'];

//$SQL_Patner="select * FROM `partners` WHERE id='".$p_id."' ";

//$res_patner=$db->get_results($SQL_Patner);



?>
   



<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
	  <section class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header" >
		
          <h1>Users Profile</h1>
          <ol class="breadcrumb">
	  <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="index.php?p=users">Users </a></li> 	
          </ol>
		

        </section>
      <div class="content">
	  <div class="box">
      
          <div class="row">
            <div class="col-xs-12">
     <div class="box">
        <a class="btn btn-info pull-right" href="index.php?p=users&a=edit&id=<?php echo $res[0]['user_detail_id']; ?>">Edit</a>
  </div>
                <div class="box-body">
                 
    
            <div class="row">
               <div class="col-md-4">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
				          <?php $URL=get_photo($res[0]['photo_id']);?>

                  <img class="profile-user-img img-responsive img-circle" src="../../upload/<?php echo $URL; ?>" alt="User profile picture">
                  <h3 class="profile-username text-center"><?php echo $res[0]['first_name']." ".$res[0]['last_name'];?></h3>
                  <p class="text-muted text-center"><?php echo $res[0]['education'];?></p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Friends</b> <a class="pull-right"><?php echo get_no_of_friends($res[0]['id']);?></a>
                    </li>
                   <!--<li class="list-group-item">
                      <b>Following</b> <a class="pull-right"><?php //echo get_following($res[0]['user_detail_id']);?></a>
                    </li>-->
                   
                  </ul>

                
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">About Me</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <strong><i class="fa fa-book margin-r-5"></i>  Education</strong>
                  <p class="text-muted">
                    <?php echo $res[0]['education']." ";
					if( $res[0]['education']!=""){ echo  "From ".$res[0]['education'];}?>
                  </p>

                  <hr>

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                  <p class="text-muted"><?php echo  $res[0]['location']; ?></p>

                  <hr>

                  <strong><i class="fa fa-pencil margin-r-5"></i> Extra Info</strong>
                  <p>
                     <p class="text-muted"><?php//if($res[0]['activation_date']!=""){ echo  "Activation date - ".$res[0]['activation_date'];} ?> </p>
						
                     <p class="text-muted">Age :&nbsp;  <?php member_age($res[0]['birthday']); ?></p>
                  </p>

                 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
                <div class="col-md-8">
                    <!--<div class="alert alert-info">
                        <h2>User Bio  </h2>
                        <h4>Bootstrap user profile template </h4>
                        <p>
                           
                        </p>
                    </div>-->
                    
                  
					
					<div class="col-md-12">
					<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                   <li class=""><a href="#activity" data-toggle="tab" aria-expanded="false">Personal Info</a></li>
                   <li class=""><a href="#aboutme" data-toggle="tab" aria-expanded="false">Last Activity</a></li>
                
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                    <!-- Post -->
                    <div class="post">
					
					
					  <ul class="list-group list-group-unbordered">
					 
                    
					<li class="list-group-item">
                     <span> <b>Employment </b></span><span>:</span><span> <a class="btn btn-xs bg-maroon pull-right"><?php  echo $res[0]['employment'];?></a></span>
                    </li>
                    
					  <li class="list-group-item">
                      <span> <b>Education </b> </span><span>:</span><span><a class=" btn btn-xs bg-maroon pull-right"><?php echo $res[0]['education'];?></a></span>
                    </li>
					
                     <li class="list-group-item">
                       <span><b>Friends </b> </span><span>:</span><span><a class="btn btn-xs bg-maroon pull-right"><?php echo get_no_of_friends($res[0]['id']);?></a></span>
                    </li>
					
					 <li class="list-group-item">
                       <span><b>Home Town </b></span><span>:</span><span> <a class="btn btn-xs bg-maroon pull-right"><?php echo $res[0]['home_town'];?></a></span>
                    </li>
					
					 <li class="list-group-item">
                      <span> <b>About </b> </span><span>:</span><span><a class="btn btn-xs bg-maroon pull-right"><?php echo $res[0]['about'];?></a></span>
                    </li>
					
					 <li class="list-group-item">
                      <span> <b>Website </b> </span><span>:</span><span><a class="btn btn-xs bg-maroon pull-right"><?php if($res[0]['website']){echo $res[0]['website'];}else{echo "https://www.callitme.com/".$res[0]['username'];}?></a></span>
                    </li>
					
					 <li class="list-group-item">
                      <span> <b>Designation </b> </span><span>:</span><span><a class="btn btn-xs bg-maroon pull-right"><?php echo $res[0]['designation'];?></a></span>
                    </li>
					
					 <li class="list-group-item">
                       <span><b>Phase of Life </b></span><span>:</span><span> <a class="btn btn-xs bg-maroon pull-right"><?php echo get_phase_of_life($res[0]['phase_of_life']);?></a></span>
                    </li>
					</ul>
				 
                     </div>
                  </div><!-- /.tab-pane -->
                 <!-- /.tab-pane -->
              
                  <div class="tab-pane" id="aboutme">
                
                   
                        <div class="box">
                   <div class="box-header">
                  <h3 class="box-title">Last Activity<small></small></h3>
				       </div>
					    <?php //echo "<pre>";print_r($res_activity);
						//echo "</pre>";?>
                  <!-- tools box -->
				  <div class="fix">
                  <div class="post">
                      <div class="user-block">
                        <img class="profile-user-img img-responsive img-circle" src="../../upload/<?php echo $URL; ?>" alt="User profile picture">
                        <span class="username">
                          <a href="#"><?php echo $res[0]['first_name']." ".$res[0]['last_name'];?></a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                        <span class="description">Shared publicly - 7:30 PM today</span>
                      </div><!-- /.user-block -->
                      <p>
                        <?php //echo get_follow($res[0]['follow']);?>
                      </p>
                      <ul class="list-inline">
                        <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                        <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>
                        <li class="pull-right"><a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments (5)</a></li>
                      </ul>

                      <input class="form-control input-sm" type="text" placeholder="Type a comment">
                    </div>
         
                    </div>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div>	 
              </div>                        
                    </div>
                </div>
				</div>
            </div>
            <!-- ROW END -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
			</div>
        
		  
        </section><!-- /.content -->
		
        </div><!-- /.row -->
   
  <script>   
  $(document).ready(function() {
    $('#example').DataTable();
	 CKEDITOR.replace('editor1');
	  $(".textarea").wysihtml5();
} );
</script>