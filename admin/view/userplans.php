<?php
//include ('../application/config/stripe.php'); 
$db=new DB();
$str="";
$msg=loadvariable('msg','');
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
if($a=='list')
{
	$SQL="SELECT * FROM `stripes`";
	$res=$db->get_results($SQL);
}

if($a=='edit')
{
	$id=loadvariable('id','');
	$SQL="SELECT * FROM `stripes` WHERE id='".$id."'";
	$res=$db->get_results($SQL);
	
}
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
           User Plans
            
          </h1>
          <ol class="breadcrumb">

	  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="index.php?p=users">Users</a></li>
			<li class="active">User Plans</li>  	
          </ol>
        </section>

       
      <div class="content">
         <!-- Main content -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  <a class="btn btn-info pull-right" href="index.php?p=userplans&a=add"> Add New Plans</a>
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
                        <th>Name</th>
                        <th>Requests to Friends</th>
                        <th>Requests to Anyone</th>
                        <th>Message to Anyone</th>
                        <th>No. of Users</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

					<?php for($i=0;$i<count($res);$i++)
					{?>
                      <tr>
                     <td> <?php echo $res[$i]['plan_name']; ?></td>
					           <td> <?php echo $res[$i]['r_to_friends']." ".$res[$i]['validity'];  ?></td>
					           <td> <?php echo $res[$i]['r_to_anyone']." ".$res[$i]['validity']; ?></td>
					         <td> <?php echo $res[$i]['m_to_anyone']." ".$res[$i]['validity'];  ?></td>
						        <td><?php echo  get_user_plans($res[$i]['plan_name']);?></td>
             <td>
               <a class="btn btn-success" href="index.php?p=userplans&a=edit&id=<?php echo $res[$i]['id']; ?>"><i class="fa fa-edit"></i></a>
             <a class="btn btn-danger"href="../model/userplans.php?a=delete&id=<?php echo $res[$i]['id']; ?>"><i class="fa  fa-remove"></i></a>
             </td>
                      </tr>
					  <?php }?>
                     </tbody>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Requests to Friends</th>
                        <th>Requests to Anyone</th>
                        <th>Message to Anyone</th>
                        <th>No. of Users</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
				  <?php }?><!-----LIST CLOSE----------------->
				   <?php 			  
				  if($a=='add')
				  { ?>
				  <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Enter Details For caste </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="../model/userplans.php">
				<input type="hidden" name="a" value="add">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Plan</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control"  name="plan_name"id="inputEmail3" placeholder="Site Value">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Request to Friends</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control"  name="r_to_friends"id="inputEmail3" placeholder="Site Value">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Request to Anyone</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control"  name="r_to_anyone"id="inputEmail3" placeholder="Site Value">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Message to Friends</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control"  name="m_to_friends"id="inputEmail3" placeholder="Site Value">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Message to Anyone</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control"  name="m_to_anyone"id="inputEmail3" placeholder="Site Value">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Price</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="price" id="inputEmail3" placeholder="Value ">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Amount</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="amount" id="inputEmail3" placeholder="Value ">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Validity</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="validity" id="inputEmail3" placeholder="Value ">
                      </div>
                    </div>
                   
                   
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-info">Insert Data</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
				  <?php }
				  ?>
				  
				 <?php if($a=='edit')
				  { 
				// print_r($res);
				  ?>
				  <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Update Details For User Plan </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="../model/userplans.php">
				<input type="hidden" name="a" value="edit">
				<input type="hidden" name="id" value="<?php echo $res[0]['id']; ?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Plan</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" value="<?php echo $res[0]['plan_name']; ?>"  name="plan_name"id="inputEmail3" placeholder="Site Value">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Request to Friends</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" value="<?php echo $res[0]['r_to_friends']; ?>"  name="r_to_friends"id="inputEmail3" placeholder="Site Value">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Request to Anyone</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" value="<?php echo $res[0]['r_to_anyone']; ?>"  name="r_to_anyone"id="inputEmail3" placeholder="Site Value">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Message to Friends</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" value="<?php echo $res[0]['m_to_friends']; ?>"  name="m_to_friends"id="inputEmail3" placeholder="Site Value">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Message to Anyone</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" value="<?php echo $res[0]['m_to_anyone']; ?>"  name="m_to_anyone"id="inputEmail3" placeholder="Site Value">
                      </div>
                    </div>
          <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Price</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" value="<?php echo $res[0]['price']; ?>" name="price" id="inputEmail3" placeholder="Value ">
                      </div>
                    </div>
          <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Amount</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" value="<?php echo $res[0]['amount']; ?>" name="amount" id="inputEmail3" placeholder="Value ">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Validity</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" value="<?php echo $res[0]['validity']; ?>" name="validity" id="inputEmail3" placeholder="Value ">
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
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
		  </div>
        </section><!-- /.content -->
		
      </div><!-- /.content-wrapper --><!-- /.content -->
     
  
