 <?php
 $db=new DB();
$str="";
$start=loadvariable('start','0');
$end=30;
$msg=loadvariable('msg','');
$action=loadvariable('action','');
$a=loadvariable('a','list');
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


$SQL="SELECT * FROM `support_mail`";
if($action=='search')
{
 $email=loadvariable('email','');
 $name=loadvariable('name','');
 
 if($email!='' && $name !='')
 {
 $SQL.= " WHERE Email LIKE '%$email%' OR Name LIKE '%$name%' ";
 }
else if($name!='' && $email=='' )
 {
	$SQL.= " WHERE  Name LIKE '%$name%' ";
 }
 else if($name=='' && $email!='' )
 {
 $SQL.= " WHERE Email LIKE '%$email%'  ";
 }
}
$res=$db->get_results($SQL);

$thispage=$_SERVER['PHP_SELF']."?p=support";
$per_page=30;
$showeachside=5;

if(empty($start)){$start=0;}
$max_pages=  ceil($num/$per_page);
$cur=  ceil($start/$per_page)+1; 

if(empty($start)){$start=0;}
$max_pages=  ceil($num/$per_page);
$cur=  ceil($start/$per_page)+1; 

?>

 
 
 
 
 <!-- Content Wrapper. Contains page content -->  
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           User Search
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="index.php?p=support">Support</a></li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		
		     <?php 
				if($str!="")
				{?>
				<div class="<?php echo  $cls;?>" role="alert">
			  <a href="#" class="alert-link"><?php  echo $str;?></a>
			</div>
			<?php }
			?> 
        <div class="row">
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                <h4><i class="fa fa-edit"></i>User Search Form</h4>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post">
                <div class="box-body">
                    <div class="form-group">
				
					<input type="hidden" name="p" value="support">
					<input type="hidden" name="action" value="search">
                      <label for="inputEmail3" class="col-sm-2 control-label">Enter User Email</label>
                      <div class="col-sm-5">
                        <input type="email" class="form-control" id="email" name="email" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Enter User Email" class="col-sm-2 control-label">Enter User Name</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="name" name="name" required>
                      </div>
                    </div>
                    <div class="form-group">
						<label for="Date" class="col-xs-2 control-label">Date</label>
						<div class="col-sm-5">
						<div class="input-group">
                 
                    <input type="text" class="form-control" id="datepicker" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
					</div>
                </div>
                    
                    <div class="form-group">
                       <div class="col-sm-6">
                         <input type="reset" class="btn btn-default pull-right" value="Cancel" name="reset"  style="margin:5px;"/>
                          <input type="submit" class="btn btn-primary pull-right" value="Search" name="submit" style="margin:5px;"/ > 
                        </div>
                    </div>
					
					 </form>
					 </div>
					 <div class="box">
					 <section class="content-header">
							  <h1>
							 Support Team
								<small>Report</small>
							  </h1>
							  <ol class="breadcrumb">
								<li><a href="index.php?p=users">Users</a></li>
								<li class="active">Table</li>  	
							  </ol>
							</section>
							<div class="box">
							
					 <div class="box-body">
                   <table id="example" style="font-size:14px" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="text-align: center;">Id</th>
                        <th style="text-align: center;">Name</th>
                        <th style="text-align: center;">Email</th>
                        <th style="text-align: center;">Issue Type</th>
                        <th style="text-align: center;">Subject</th>
						<th style="text-align: center;">Message</th>
						<th style="text-align: center;">Time</th>
                        <th style="text-align: center;">Status</th>
                        <!--<th style="text-align: center;">Religion</th>-->
                        <th style="text-align: center;">Reply</th>
						<!--<th style="text-align: center;">Action</th>--->
                      </tr>
                    </thead>
					<tbody>
					
							<?php for($i=0;$i<count($res);$i++)
					{?>
							  <tr>
							
						     <td style="text-align: center;"><?php echo $start+$i+1; ?></td>
							 <td style="text-align: center;"><?php echo  $res[$i]['Name'];?></td>
							 
                                <td style="text-align: center;"><?php echo $res[$i]['Email'];?></td>
                                <td style="text-align: center;"><?php echo $res[$i]['Issue_type'];?></td>
                                <td style="text-align: center;"> <?php echo $res[$i]['Subject'];?></td>
								 <td style="text-align: center;"> <?php echo $res[$i]['Message'];?></td>
								  <td style="text-align: center;"> <?php echo $res[$i]['Time'];?></td>
								  
								<td style="text-align: center;">
								
									 <?php if($res[$i]['Status']=='0')
								{?>
									<a class="btn btn-success" style="padding:2px;" href="../model/support.php?a=update&start=<?php echo $start;?>&status=1&id=<?php echo $res[$i]['Id']; ?>" title="Click to IN-Active Mode"><i class="fa fa-check"></i></a>
								<?php }?>
								<?php
								if($res[$i]['Status']=='1')	
								{?>
									<a class="btn btn-danger" style="padding:2px;" href="../model/support.php?a=update&start=<?php echo $start;?>&status=0&id=<?php echo $res[$i]['Id'];?>" title="Click to Active Mode"><i class="fa fa-hand-pointer-o"></i></a>
								<?php }?>
								</td>
							 <td style="text-align: center;"> 
              <?php if($res[$i]['Reply']!=" ")
                {?>  
             <a class="btn btn-success" style="padding:2px;" href="index.php?p=replymail&id=<?php echo $res[$i]['Id']; ?>&a=reply"><i class="fa fa-edit"></i> &nbsp; Reply</a></td>
              <?php }
                else
                {?>
    <a class="btn btn-warning" style="padding:2px;" href="index.php?p=replymail&id=<?php echo $res[$i]['Id']; ?>&a=reply"><i class="fa fa-edit"></i> &nbsp; Reply</a></td>
              
                <?php }
              ?>

							
							</tr>
							 <?php }?>
					</tbody>
					</table>
					<div class="box"><?php include('paging.php');?></div>
					</div>

                    
                  </div><!-- /.box-body -->
               
                </div>
       </div> 
       </div>
       </section> 
       </div>
	<!-- Start Load jQuery and bootstrap datepicker scripts -->
	  <link rel="stylesheet" href="css/datepicker.css">
        <link rel="stylesheet" href="css/bootstrap.css">
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="code.jquery.com/jquery-2.1.4.min.js"></script>
      
		<link href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                $("#datepicker").datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", "0");
                //$('#datepicker').datepicker("setDate", new Date());
            
            });
        </script>

<style type="text/css" >
<!-- End Load jQuery and bootstrap datepicker scripts -->
/**
 * Override feedback icon position
 * See http://formvalidation.io/examples/adjusting-feedback-icon-position/
 */
#eventForm .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>
