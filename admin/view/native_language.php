<?php 

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
	$SQL="SELECT * FROM `native_language`";
	$res=$db->get_results($SQL);
}

if($a=='edit')
{
$id=loadvariable('id','');
$SQL="SELECT * FROM `native_language` WHERE Id='".$id."'";
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
           Native Language
            <small>Report</small>
          </h1>
          <ol class="breadcrumb">

	  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="index.php?p=users">Users</a></li>
			<li class="active">Native Lauguge</li>  	
          </ol>
        </section>

       
    <div class="content">
         <!-- Main content -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <a class="btn btn-info pull-right" href="index.php?p=native_language&a=add"> Add New Record</a>
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
             { ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Site _Value</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php for($i=0;$i<count($res);$i++)
					{?>
                      <tr>
                     <td> <?php echo $i+1; ?></td>
					 <td> <?php echo $res[$i]['Id']; ?></td>
					  <td> <?php echo $res[$i]['Value']; ?></td>
					   <td> 
					   <?php if($res[$i]['Status']=='Y')
								{?>
									<a class="btn btn-success"  href="../model/native_language.php?a=update&status=N&id=<?php echo $res[$i]['Id']; ?>" title="Click to IN-Active Mode"><i class="fa fa-check"></i></a>
								<?php }?>
								<?php
								if($res[$i]['Status']=='N')	
								{?>
									<a class="btn btn-danger"  href="../model/native_language.php?a=update&status=Y&id=<?php echo $res[$i]['Id'];?>" title="Click to Active Mode"><i class="fa fa-hand-pointer-o"></i></a>
								<?php }?>
						</td>
					   <td>
					   <a class="btn btn-success" href="index.php?p=native_language&a=edit&id=<?php echo $res[$i]['Id']; ?>"><i class="fa fa-edit"></i></a>
             <a class="btn btn-danger"href="../model/native_language.php?a=delete&id=<?php echo $res[$i]['Id']; ?>"><i class="fa  fa-remove"></i></a>
					   
					   </td>
                      </tr>
					  <?php }?>
                     </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Site _Value</th>
                        <th>Value</th>
                        <th>Status</th>
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
                  <h3 class="box-title">Enter Details For Native Language </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="../model/native_language.php">
        <input type="hidden" name="a" value="add">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">VALUE</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control"  name="value"id="inputEmail3" placeholder="Site Value">
                      </div>
                    </div>
          <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">NAME</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Value ">
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
                    <button type="submit" class="btn btn-info">Add Record</button>
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
                  <h3 class="box-title">Update Records For Native language </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="../model/native_language.php">
        <input type="hidden" name="a" value="edit">
        <input type="hidden" name="id" value="<?php echo $res[0]['Id']; ?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">VALUE</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control"  value="<?php echo $res[0]['Id']; ?>" name="value" readonly id="inputEmail3" placeholder="Site Value">
                      </div>
                    </div>
          <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">NAME</label>
                      <div class="col-sm-6">
                        <input type="text"  value="<?php echo $res[0]['Value'] ?>"class="form-control" name="name" id="inputEmail3" placeholder="Value ">
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
                    <button type="submit" class="btn btn-info">Update Record</button>
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
     
  
