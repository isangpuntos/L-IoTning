
                <!-- start page title -->
                <div class="page-title">
                	<div class="in">
                    		<div class="titlebar">	<h2>DASHBOARD</h2>	<p>This is a quick overview of some features</p></div>
                            <div class="clear"></div>
                    </div>
                </div>
                <!-- end page title -->
                <!-- start stats -->

                <div id="stats" style="display:block">
                    <!-- use it up/down on <b> tag for different colors -->
                	<div class="column">	<b>$<?php echo $earn_today!=""?$earn_today:"0";?></b>	Earnings of today</div>
                	<div class="column">	<b>$<?php echo $earn_month!=""?$earn_month:"0";?></b>	Earnings of month</div>
                	<div class="column">	<b>$<?php echo $earn_year!=""?$earn_year:"0";?></b>	Earnings of year</div>
                	<div class="column">	<b><?php echo $total_view!=""?$total_view:"0";?></b>	Total View</div>
                    <!-- this is last column -->
                	<div class="column last">	<b class="up"><?php echo $total_member!=""?$total_member:"0";?></b> Total Member</div>
                   
                </div>
                <!-- end stats -->
                	<!-- START CONTENT -->
                    <div class="content">
                    
						<div class="grid360-left"  style="z-index: 420; width: 790px;">
                        
                            		<!-- start statistics codes -->
                                    <div class="simplebox2" style="z-index: 410;">
                                    	<div class="titleh" style="z-index: 400;"><h3 style="float:left;">Statistic</h3>
                                    	  <div class="range" style="float:right;margin-top:5px;margin-right:3px;">Select Range:          <select onchange="getSalesChart(this.value)" id="range">
									            <option value="day">Today</option>
									            <option value="week">This Week</option>
									            <option value="month">This Month</option>
									            <option value="year">This Year</option>
									          </select>
									        </div>
                                    	</div>
                                        <div class="body" style="z-index: 390;padding:10px;">
                                		<div id="report" style="width: 700px; height: 200px; margin: auto;padding:5px;"></div>
                                        </div>
                                    </div>
                            		<!-- end statistics codes -->
                                    
                            
                        </div>
                    <div style="clear:both;"></div>
                    <div class="grid360-left" style="z-index: 420;width:380px;">
                        
                            		<!-- start statistics codes -->
                                    <div class="simplebox2" style="z-index: 410;">
                                    	<div class="titleh" style="z-index: 400;"><h3>Recent Users</h3></div>
                                        <div class="body" style="z-index: 390;">
                                        	
                                            <table class="tablesorter" id="myTable" style=""> 
                                	<thead> 
                                		<tr> 
                                			<th class="header">Fullname</th> 
                                			<th class="header">Username</th> 
                                			<th class="header">phone</th>
                                			<th class="header">Date</th> 
                                		</tr> 
                                	</thead> 
                                    
                                    <tbody> 
                                    	<?php foreach($user_data as $user) {?>
                                    	<tr> 
                                    		<td><?php echo $user['firstname']." ".$user['lastname'];?></td> 
                                    		<td><div style="width: 100px;word-wrap: break-word;"><?php echo $user['username']; ?></div></td> 
                                    		<td><?php echo $user['phone'];?></td> 
                                    		<td><?php echo my_int_date($user['created_date']);?></td> 
                                    	</tr> 
                                    	<?php }?>
                                    </tbody> 
                                </table>
                                        </div>
                                    </div>
                            		<!-- end statistics codes -->
                                    
                            
                        </div>
                        <div class="grid360-right" style="z-index: 380;width:380px;">
                        
                            <!-- start statistics codes -->
                                    <div class="simplebox2" style="z-index: 410;">
                                    	<div class="titleh" style="z-index: 400;"><h3>Recent Orders</h3></div>
                                        <div class="body" style="z-index: 390;">
                                        	
                                    <table class="tablesorter" id="myTable"> 
                                	<thead> 
                                		<tr> 
                                			<th class="header">Customer</th> 
                                			<th class="header">Extension</th> 
                                			<th class="header">Total Price</th>
                                			<th class="header">Date</th> 
                                		</tr> 
                                	</thead> 
                                    
                                    <tbody> 
                                    	<?php foreach($order_data as $order) {?>
                                    	<tr> 
                                    		<td><div style="width: 100px;word-wrap: break-word;"><?php echo $order['username'];?></div></td> 
                                    		<td><?php echo $order['extension_name']; ?></td> 
                                    		<td><?php echo $order['total_price'];?></td> 
                                    		<td><?php echo my_int_date($order['created_date']);?></td> 
                                    	</tr> 
                                    	<?php }?>
                                    </tbody> 
                                </table>
                                        </div>
                                    </div>
                                
                           	</div>
                            <!-- end tabs codes -->
                            <div style="clear:both;"></div>
						
                       
                        
                           
                             
 <!-- START CHART -->
<!--[if IE]>                      
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery/flot/excanvas.js"></script>
<![endif]--> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery/flot/jquery.flot.js"></script>
<script type="text/javascript"><!--
function getSalesChart(range) {
	$.ajax({
		type: 'get',
		url: '<?php echo base_url();?>backend.php/cpanel/chart?range=' + range,
		dataType: 'json',
		async: false,
		success: function(json) {
			var option = {	
				shadowSize: 0,
				lines: { 
					show: true,
					fill: true,
					lineWidth: 1
				},
				grid: {
					backgroundColor: '#FFFFFF'
				},	
				xaxis: {
            		ticks: json.xaxis
				}
			}

			$.plot($('#report'), [json.order, json.customer], option);
		}
	});
}

getSalesChart($('#range').val());
//--></script> 
                             
                        </div>