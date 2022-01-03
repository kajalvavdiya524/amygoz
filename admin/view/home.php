<?php  $date =date('Y-m-d');
        $newdate1 = strtotime ( '-7 day' , strtotime ( $date ) ) ;
        
        $newdate=date('Y-m-d',$newdate1);
       
?>
                                                
<!-----------Pie Chart--------------------------------->
   

  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="font-size:14px; font-family:georgia;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">

	<?php // echo $newdate;
       /// echo $date;?>
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
		
            		
            	
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
		  <div class="content">
	<!---------- ENTER YOU CODE HERE-->
	<style>
	//.box .box-header h4 i{background: rgb(30, 143, 198);
    color: rgb(255, 255, 255);
    padding: 10px 0;
    width: 36px;
    display: inline-block;
    text-align: center;
    margin: -10px 20px -10px -20px;
	margin-left:2px;}
	
	</style>
						
				<div class="row">
				
					<div class="col-xs-12 col-log-12">
                        <div class="box">
                            <div class="box-header" style="background-color:grey;color:white;font-size:13px;margin-top:2px;">
                                <h4 style="font-family:georgia;" ><i class="fa fa-check"></i>  Summary Status (We will be looking for all the data in this page that is needed to analyze and grow.</h4>
								
                            </div>
							
                            <div class="box-content">
                                <div class="todo">
                                    <ul class="todo-list row">
                                        
                                        <li class="col-sm-6">
                                          <a href="index.php?p=summary&summary_users=registered">
                                            <?php   $res_user=  Resgister_User();
                                              
                                            ?>

                                            <span class="desc">Registered Users</span> 
                                            <span class="label label-success pull-right"><?php echo $res_user['register_user'];  ?></span>					
                                       </a> </li>
                                        
                                        
                                        <li class="col-sm-6">
                                          <a href="index.php?p=summary&summary_users=active_after_register">  
                                            <span class="desc">Activated After Registering</span>
                                            <span class="label label-success pull-right"><?php $active_after_register=  active_after_register(); echo $active_after_register['active_after_register'];  ?></span>
                                       </a> </li>
                                        
                                        
                                        <li class="col-sm-6">
                                          <a href="index.php?p=summary&summary_users=never_activated">
                                            <span class="desc">Never Activated</span>
                                            <span class="label label-warning pull-right"><?php $not_act=  never_activate(); echo $not_act['not_activate'];  ?></span>
                                        </a> </li>
                                          
                                          
                                        <li class="col-sm-6">
                                          <a href="index.php?p=summary&summary_users=activated_but_deactivated">
                                            <span class="desc">Activated but Deactivated Later</span>
                                            <span class="label label-warning pull-right"><?php $activated_but_deactivated= activated_but_deactivated(); echo $activated_but_deactivated['activated_but_deactivated'];  ?></span>
                                       </a> </li>
                                        
                                        
                                        <li class="col-sm-6">
                                          <a href="index.php?p=summary&summary_users=paid_member">
                                            <span class="desc">Paid Members</span>
                                            <span class="label label-success pull-right"><?php $paid=  paid_user(); echo $paid['paid_user'];  ?></span>
                                       </a> </li>
                                        
                                        
                                        <li class="col-sm-6">
                                          <a href="index.php?p=summary&summary_users=unpaid_users">
                                            <span class="desc">Unpaid Users</span>
                                            <span class="label label-success pull-right"><?php $unpaid_users= unpaid_users(); echo $unpaid_users['unpaid_users'];  ?></span>
                                        </a></li>
                                        
                                        
                                        <li class="col-sm-6">
                                          <a href="index.php?p=summary&summary_users=male_register">
                                            <span class="desc">Total Male Registered</span>
                                            <span class="label label-info pull-right"><?php $male=  male_reg(); echo $male['male_reg'];  ?></span>
                                        </a></li>
                                        
                                        <li class="col-sm-6">
                                        <a href="index.php?p=summary&summary_users=female_register">

                                            <span class="desc">Total Female Registered</span>
                                            <span class="label label-info pull-right"><?php $female=  female_reg(); echo $female['female_reg'];  ?></span>
                                        </a></li>
                                        
                                        
										                    <li class="col-sm-6">
                                          <a href="index.php?p=summary&summary_users=past_hours">
                                            <span class="desc">Users Added in Past 24 Hours</span>
                                            <span class="label label-info pull-right"><?php $last24hours=  last_24_hours_user(); echo $last24hours['last24user'];  ?></span>
                                          </a>
                                        </li>
                                        

                                    </ul>
                                </div>	
                            </div>
                        </div>
                    
                    </div>
				</div><!--/row-->
				
				<div class="row">
				<div class="col-xs-12 col-log-12">
				<div class="box">
							<div class="box-header"  style="background-color:grey;color:white;">
                                <h4><i class="fa fa-check"></i>Users by Country  </h4>
                            </div>
							
                         <div class="box-body">
                               <?php $users_by_country=users_by_country();?>
<!--                                <script type="text/javascript" src="http://www.google.com/jsapi"></script>-->
<!--        <script type="text/javascript">
            //load the Google Visualization API and the chart
            google.load('visualization', '1', {'packages':['columnchart','piechart','corechart' ]});
 
            //set callback
            google.setOnLoadCallback (createChart);
 
            //callback function
            function createChart() {
 
                //create data table object
                var dataTable = new google.visualization.DataTable();
 
                //define columns
                dataTable.addColumn('string','Country');
                dataTable.addColumn('number', 'Total');
                 dataTable.addRows([
                //<?php // for($i=0;$i<count($users_by_country);$i++){?>
                ['//<?php // echo $users_by_country[$i]['country']; ?>',<?php // echo $users_by_country[$i]['total']; ?>], 
                //<?php // }?>
                    ])
                //instantiate our chart objects
                var chart = new google.visualization.PieChart (document.getElementById('chart'));
                //var secondChart = new google.visualization.PieChart (document.getElementById('Chart2'));
 
                //define options for visualization
                var options = { height: 400, is3D: true, title: 'Country Wise Users'};
 
                //draw our chart
                chart.draw(dataTable, options);
                //secondChart.draw(dataTable, options);
 
            }
        </script><div id="chart"></div>-->
      <script type='text/javascript' src="https://www.google.com/jsapi"></script>

  

 <script type='text/javascript' src="https://www.google.com/jsapi"></script>

  <div id="regions_div" style="width: 100%; hieght:300px;"></div>

  <script type="text/javascript">
  google.load('visualization', '1', {'packages': ['geochart']});
     google.setOnLoadCallback(drawRegionsMap);

   function drawRegionsMap() {
     var data = google.visualization.arrayToDataTable([
       ['Country', 'No. of Users'],<?php  for($i=0;$i<count($users_by_country);$i++){?>
       ['<?php  echo $users_by_country[$i]['location']; ?>',<?php  echo $users_by_country[$i]['total']; ?>],<?php  }?>
       ]);
var view = new google.visualization.DataView(data);
								view.setColumns([0, 1,
												{ calc: "stringify",
													sourceColumn: 1,
													type: "string",

													role: "annotation" }
													
												]);
    var options = {
        annotations: {
												textStyle: {
												fontName: 'Times-Roman',
												fontSize: 14,
												bold: true,
												color: '#000000',     // The color of the text.
												//auraColor: '#000000', // The color of the text outline.
														// The transparency of the text.
												}
												},
           displayMode: 'text',
          colorAxis: {colors: ['#320D13', 'black', '#e31b23']},
          backgroundColor: '#0E4EEF',
          datalessRegionColor: '#F5425D',
          defaultColor: '#320D13',
        };
     var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

     chart.draw(data, options);
   }
  </script>
 
 
   
        
			</div>
				</div>
				</div>	
          </div>                   
      
        <div class="row">
            <div class="col-xs-12">
             
			   <div class="box">
              <div class="box box-solid">
                <div class="box-header" style="background-color:grey;color:white">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">Activity  Details for 15 days</h3>
                   <div class="box-tools pull-right">
                    <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>

                  </div>
                </div> 
                  <?php 
                 $date =date('Y-m-d');
        $newdate1 = strtotime ( '-15 day' , strtotime ( $date ) ) ;
        
        $newdate=date('Y-m-d',$newdate1);
        
        $array_graph=Resgister_linechart($date,$newdate);
        //print_r($array_graph);
                  ?>

                <div class="box-body">
                   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                <script src="https://highcharts.github.io/export-csv/export-csv.js"></script>
              <style>


                            #container {
                                height: 300px;
                                margin-top: 2em;
                            }
                            pre {
                                border: 1px solid silver;
                                border-radius: 0.5em;
                                padding: 1em;
                                color: green;
                            }
              </style>

                    <div id="container"></div>
                          <script type="text/javascript">
                              var chart = new Highcharts.Chart({

                              chart: {
                                  renderTo: 'container'
                                     },
                            
                              title: {
                                  text: 'Activity chart'
                                  },
                              
                              xAxis: {
                                  categories:[
                                   <?php for($i=0;$i<count($array_graph);$i++)
                                 {
                                  echo  "'".$array_graph[$i]['dates']."'";
                                  if($i < count($array_graph) -1)
                                  {
                                    echo ",";
                                  }
                               }?>
                             ] },

                              series: [{
                                name:'No of Actions',
                                  data: [
                                  <?php for($i=0;$i<count($array_graph);$i++)
                                 {
                                  echo  $array_graph[$i]['total'];
                                   if($i < count($array_graph) -1)
                                  {
                                    echo ",";
                                  }
                               }?>
                                  ]
                              }]

                          });

                          $('#preview').html(chart.getCSV());



                          </script> 

                                                        
                                                     
                                                    </div>  
                                                  </div>  
                                                
                                        

                                      </div>
  
    <!--column chart --> 
      
                                      <div class="row">
                                    <div class="col-xs-12 col-log-12">
                                        <div class="box">
                                            <div class="box-header"  style="background-color:grey;color:white;">
                                                <h4><i class="fa fa-user"></i>Register User   </h4>
                                            </div>

                                            <div class="box-body">
                                                <?php $ResgisterUsers_columnchart= ResgisterUsers_columnchart($date,$newdate); ?>

                                                         <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                <script type="text/javascript">
                function getValueAt(column, dataTable, row) {
                return dataTable.getFormattedValue(row, column);
                              }
                // Load the Visualization API and the piechart package.
                google.load('visualization', '1', {'packages':['corechart']});
                
                // Set a callback to run when the Google Visualization API is loaded.
                google.setOnLoadCallback(drawChart);
                
                function drawChart() {
                
                var data = new google.visualization.arrayToDataTable([
                  ['date_today','Register Users','Activated Users'],
                                                                       
        
                                                                        <?php for($i=0;$i<count($ResgisterUsers_columnchart);$i++)
                                                                        {
                                                                        echo "['".$ResgisterUsers_columnchart[$i]['dates']."',".$ResgisterUsers_columnchart[$i]['TLR'].",".$ResgisterUsers_columnchart[$i]['TLA']."],";
                                                                            
                                                                        }
?>
        ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                        { calc: "stringify",
                          sourceColumn: 1,
                          type: "string",

                          role: "annotation" },2,
                        { calc: "stringify",
                          sourceColumn: 2,
                          type: "string",

                          role: "annotation" }, 
                        ]);
                var options = {



                  annotations: {
                        textStyle: {
                        fontName: 'Times-Roman',
                        fontSize: 14,
                        bold: true,
                        color: '#000000',     // The color of the text.
                        //auraColor: '#000000', // The color of the text outline.
                            // The transparency of the text.
                        }
                        },
                    title: 'User Registration  ',
                      
                    bar: {groupWidth: "85%"},
                    
                    hAxis: {title: 'Time Clock', titleTextStyle: {color: 'red'}}
                        };

                // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.LineChart(document.getElementById('chart_div11'));
                    chart.draw(view,options);
                        }

                    $(window).resize(function(){ drawChart();});

                  </script>

                  <style>.chart2 {  width: 100%;  height: 360px;}
                  </style>
								<div id="chart_div11" class="chart2"></div>


                                            </div>
                                        </div>
                                    </div>	
                                </div>                   
 
                
                          
                
		
		
		
		
		
		
			</div><!--/container-->
<!--------------------CLOSE CONTENT PLACE-------------------------------------------------------------------------------->
          </div>
</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
   
    <script src="../plugins/knob/jquery.knob.js"></script>
	<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
  
    <script>
      $(function () {
        /* jQueryKnob */

        $(".knob").knob({
          /*change : function (value) {
           //console.log("change : " + value);
           },
           release : function (value) {
           console.log("release : " + value);
           },
           cancel : function () {
           console.log("cancel : " + this.value);
           },*/
          draw: function () {

            // "tron" case
            if (this.$.data('skin') == 'tron') {

              var a = this.angle(this.cv)  // Angle
                      , sa = this.startAngle          // Previous start angle
                      , sat = this.startAngle         // Start angle
                      , ea                            // Previous end angle
                      , eat = sat + a                 // End angle
                      , r = true;

              this.g.lineWidth = this.lineWidth;

              this.o.cursor
                      && (sat = eat - 0.3)
                      && (eat = eat + 0.3);

              if (this.o.displayPrevious) {
                ea = this.startAngle + this.angle(this.value);
                this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3);
                this.g.beginPath();
                this.g.strokeStyle = this.previousColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                this.g.stroke();
              }

              this.g.beginPath();
              this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
              this.g.stroke();

              this.g.lineWidth = 2;
              this.g.beginPath();
              this.g.strokeStyle = this.o.fgColor;
              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
              this.g.stroke();

              return false;
            }
          }
        });
        /* END JQUERY KNOB */
		
		
		  $(".sparkline").each(function () {
          var $this = $(this);
          $this.sparkline('html', $this.data());
        });

        /* SPARKLINE DOCUMENTAION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
        drawDocSparklines();
        //drawMouseSpeedDemo();

		
		});
		
		 function drawDocSparklines() {

        // Bar + line composite charts
        $('#compositebar').sparkline('html', {type: 'bar', barColor: '#aaf'});
        $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
                {composite: true, fillColor: false, lineColor: 'red'});


        // Line charts taking their values from the tag
        $('.sparkline-1').sparkline();

        // Larger line charts for the docs
        $('.largeline').sparkline('html',
                {type: 'line', height: '2.5em', width: '4em'});

        // Customized line chart
        $('#linecustom').sparkline('html',
                {height: '1.5em', width: '8em', lineColor: '#f00', fillColor: '#ffa',
                  minSpotColor: false, maxSpotColor: false, spotColor: '#77f', spotRadius: 3});

        // Bar charts using inline values
        $('.sparkbar').sparkline('html', {type: 'bar'});

        $('.barformat').sparkline([1, 3, 5, 3, 8], {
          type: 'bar',
          tooltipFormat: '{{value:levels}} - {{value}}',
          tooltipValueLookups: {
            levels: $.range_map({':2': 'Low', '3:6': 'Medium', '7:': 'High'})
          }
        });

        // Tri-state charts using inline values
        $('.sparktristate').sparkline('html', {type: 'tristate'});
        $('.sparktristatecols').sparkline('html',
                {type: 'tristate', colorMap: {'-2': '#fa7', '2': '#44f'}});

        // Composite line charts, the second using values supplied via javascript
        $('#compositeline').sparkline('html', {fillColor: false, changeRangeMin: 0, chartRangeMax: 10});
        $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
                {composite: true, fillColor: false, lineColor: 'red', changeRangeMin: 0, chartRangeMax: 10});

        // Line charts with normal range marker
        $('#normalline').sparkline('html',
                {fillColor: false, normalRangeMin: -1, normalRangeMax: 8});
        $('#normalExample').sparkline('html',
                {fillColor: false, normalRangeMin: 80, normalRangeMax: 95, normalRangeColor: '#4f4'});

        // Discrete charts
        $('.discrete1').sparkline('html',
                {type: 'discrete', lineColor: 'blue', xwidth: 18});
        $('#discrete2').sparkline('html',
                {type: 'discrete', lineColor: 'blue', thresholdColor: 'red', thresholdValue: 4});

        // Bullet charts
        $('.sparkbullet').sparkline('html', {type: 'bullet'});

        // Pie charts
        $('.sparkpie').sparkline('html', {type: 'pie', height: '1.0em'});

        // Box plots
        $('.sparkboxplot').sparkline('html', {type: 'box'});
        $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
                {type: 'box', raw: true, showOutliers: true, target: 6});

        // Box plot with specific field order
        $('.boxfieldorder').sparkline('html', {
          type: 'box',
          tooltipFormatFieldlist: ['med', 'lq', 'uq'],
          tooltipFormatFieldlistKey: 'field'
        });

        // click event demo sparkline
        $('.clickdemo').sparkline();
        $('.clickdemo').bind('sparklineClick', function (ev) {
          var sparkline = ev.sparklines[0],
                  region = sparkline.getCurrentRegionFields();
          value = region.y;
          alert("Clicked on x=" + region.x + " y=" + region.y);
        });

        // mouseover event demo sparkline
        $('.mouseoverdemo').sparkline();
        $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
          var sparkline = ev.sparklines[0],
                  region = sparkline.getCurrentRegionFields();
          value = region.y;
          $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
        }).bind('mouseleave', function () {
          $('.mouseoverregion').text('');
        });
      }

</script>
