<?php
 $db=new DB();
$str="";
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

$SQL="SELECT * FROM `support_mail` WHERE id=$id";





$res=$db->get_results($SQL);
	
?>



<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
	  <section class="content">
	  
	   <?php        
       ($a=='reply')
	   ?>
    
	  
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Reply Box</h1>
      
          <ol class="breadcrumb">
	  <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="index.php?p=users">Reply</a></li> 	
          </ol>
		  <?php// echo  $SQL;?>
        </section>
      <div class="content">
         <!-- Main content -->
              
          <div class="row">
            <div class="content">
			<div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Reply Message</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
				  <input type="hidden" name="p" value="rplaimail">
				  	  <form class="form-horizontal" method="post" action="../model/replymail.php">
					    <input type="hidden" name="a" value="reply">
						 To:
                    <input type="email" class="form-control" name="email" placeholder="To:" value="<?php echo $res[0]['Email'];?>">
					
		
                  </div>
				 <div class="form-group">
				     From:
                    <input name="from" type="email" class="form-control" value="support@maangu.com">
                  </div>
                  <div class="form-group">
                       Subject:
                     <input type="text" name="sub" class="form-control" placeholder="Subject:" value="<?php echo $res[0]['Subject']."/".$res[0]['Issue_type'];?>">
                                   </div>
                  <div class="form-group">
                    <textarea name="msg" id="compose-textarea" class="form-control" style="height: 300px">
                      
                    </textarea>
                  </div>
                  
                </div>
				
		
				<div class="box-footer">
                  <div class="pull-right">
                    <button class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                  <i class="fa fa-envelope-o"> <input type="submit" name="sbt" value="Send" class="btn btn-primary"></i>
                  </div>
                  <button class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                </div>
				
</form>
								</div>
								</div>
								</div>
								</div>
								</div>

								</section>
								</div>
