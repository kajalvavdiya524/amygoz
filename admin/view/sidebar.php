<?php 

echo $p;
?>

   <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['Name'];?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
        
            <li <?php if($p=='home'|| $p==""){?>class="active"<?php } ?>><a href="index.php?p=home"><i class="fa fa-bar-chart-o"></i><span class="hidden-sm"> Dashboard</span></a></li>  
            <li <?php if($p=='users'){?>class="active"<?php } ?> ><a href="index.php?p=users"><i class="fa fa-table"></i><span class="hidden-sm"> Users</span></a></li>
            <li <?php if($p=='support'){?>class="active"<?php } ?>><a href="index.php?p=support"><i class="fa fa-edit"></i><span class="hidden-sm">Support</span></a></li>
                        <!---<li <?php if($p=='support'){?>class="active"<?php } ?>><a href="index.php?p=featured"><i class="fa fa-star"></i><span class="hidden-sm">Featured</span></a></li>-->
			<li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>User Property </span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
        <li><a href="index.php?p=userplans"><i class="fa fa-circle-o"></i> User Plans</a></li>
				 <!--<li><a href="index.php?p=built"><i class="fa fa-circle-o"></i> Built</a></li>
				  <li><a href="index.php?p=drink"><i class="fa fa-circle-o"></i> Drink</a></li>
				   <li><a href="index.php?p=education"><i class="fa fa-circle-o"></i> Education</a></li>
				    <li><a href="index.php?p=diet"><i class="fa fa-circle-o"></i> Diet</a></li>
				    <li><a href="index.php?p=religion"><i class="fa fa-circle-o"></i>Religion</a></li>
					 <li><a href="index.php?p=smoke"><i class="fa fa-circle-o"></i>Smoke</a></li><li><a href="index.php?p=native_language"><i class="fa fa-circle-o"></i>Native_language</a></li><li><a href="index.php?p=marital_status"><i class="fa fa-circle-o"></i>Marital_Status</a></li>
					 <li><a href="index.php?p=mangalik"><i class="fa fa-circle-o"></i>Manglik</a></li>
		      <li><a href="index.php?p=issues"><i class="fa fa-circle-o"></i>Issues</a></li>
					 <li><a href="index.php?p=complexion"><i class="fa fa-circle-o"></i>Complexion</a></li>
					 <li><a href="index.php?p=residency_status"><i class="fa fa-circle-o"></i>Residency_status</a></li>-->
                       
              </ul>
            </li>       <li <?php if($p=='public_users'){?>class="active"<?php } ?>><a href="index.php?p=public_users"><i class="fa fa-user"></i><span class="hidden-sm">Public Users</span></a></li>
			<li <?php if($p=='admin_users'){?>class="active"<?php } ?>><a href="index.php?p=admin_users"><i class="fa fa-user"></i><span class="hidden-sm">Admin Users</span></a></li>
		<!---	<li class="treeview">
              <a href="#">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                 <li><a href="index.php?p=mailbox"><i class="fa fa-circle-o"></i>Inbox</a></li>
				 <li><a href="index.php?p=compose"><i class="fa fa-circle-o"></i>Compose</a></li>
				  <li><a href="index.php?p=read"><i class="fa fa-circle-o"></i> Read</a></li>

              </ul>
            </li>--->		
						
            <li <?php if($p=='home'|| $p==""){?>class="active"<?php } ?>><a href="logout.php"><i class="fa fa-sign-out"></i><span class="hidden-sm"> Logout</span></a></li>
        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
