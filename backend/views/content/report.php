 <style>
table.form > tbody > tr > td:first-child {
    width: 200px;
}
table.form > tbody > tr > td {
    border-bottom: 1px dotted #CCCCCC;
    color: #000000;
    padding: 10px;
}
#ui-datepicker-div {
	z-index:1000 !important;
}
 </style>
 <!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>REPORT MANAGER</h2>	<p>Report manager</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <!-- START CONTENT -->
<div class="content">

 <div class="simplebox grid740" style="margin:0 auto;">
 						
                        <?php if($this->session->flashdata('message')){?>
						        <div class="albox succesbox" style="z-index: 690;">
                                	<b>Succes :</b> <?php echo $this->session->flashdata('message'); ?>
                                	<a class="close tips" href="#" original-title="close">close</a>
                                </div>
							<?php } ?>
							<?php if($this->session->flashdata('message_error')){?>
						      	<div class="albox errorbox" style="z-index: 670;">
                                	<b>Error :</b> <?php echo $this->session->flashdata('message_error'); ?> 
                                	<a class="close tips" href="#" original-title="close">close</a>
                                </div>
							<?php } ?>
                        	<div class="titleh" style="display:block;border:none;">
                        	  <div class="shortcuts-icons-button" style="z-index: 450;top:5px;left:5px;">
                        	  
                            	Date Start: <input type="text" value="<?php echo isset($start_date)?($start_date):"";?>" id="date-start" name="filter_date_start" class="datepicker-input">
                            	Date End:  <input type="text" value="<?php echo isset($end_date)?($end_date):"";?>" id="date-end" name="filter_date_end" class="datepicker-input">
                            	<a class="st-button" style="position:relative;bottom:5px;" href="javascript:filter()">Filter</a>
                            </div>
                        	                            
                            </div>
                 
                            
                            <!-- Start Data Tables Initialisation code -->
							<script type="text/javascript" charset="utf-8">
								$(document).ready(function() {
    								oTable = $('#example').dataTable({
        							"bJQueryUI": true,
        							"sPaginationType": "full_numbers"
        							});
									Date.format = 'dd/mm/yyyy';
									$( "#date-start" ).datepicker();
									$( "#date-end" ).datepicker();
    							} );
    						</script>
                            <!-- End Data Tables Initialisation code -->
							
							<table cellpadding="0" cellspacing="0" border="0" class="display data-table" id="example">             
								<thead>
									<tr>
                                    	<th class="" rowspan="1" colspan="1" style="width: 10px;">ID</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 100px;">Customers</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 70px;">Status</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 70px;">Created Date</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 70px;">Total</th>
                                    </tr>
                               	</thead>
                                <tbody>
                                 <?php
									$i=0;$total=0;
									foreach($banners as $item)
									{
									$i++;$total += $item['total_price'];
									?>
									 <tr class="<?php if($i%2==0) {?>odd <?php } else {?>even<?php }?>">
				                        <td style="text-align:center;" class=" sorting_1"><?php echo $i; ?></td>
				                        <td style="text-align:center;"><?php echo $item['username']; ?></td>                  
				                        <td rvid="18" style="text-align:center;">
				                        	<?php echo $item['status'] ==1?"Completed":"Pending";?>
				                        </td>
				                        
				                        <td style="text-align:center;"><?php echo my_int_date($item['created_date']); ?></td>
				                        <td align="center">$<?php echo $item['total_price']; ?></td>  
				                       
				                    </tr>
						           <?php }?>     
								</tbody>
								<tfoot>
								 <tr>
						           <td colspan="3"></td>
						           <td align="right" colspan="1" style="color:red;font-size:15px;">Total:</td>
						           <td align="right"colspan="1" style="color:red;font-size:15px;">$<?php Echo $total;?></td>
						           
						           </tr>   
								</tfoot>
							</table>
                        </div>
</div>
  <!-- END CONTENT -->
  <!-- START TABLE -->
<script type="text/javascript"><!--
function filter() {
	url = '<?php echo $report_link;?>';
	
	var filter_date_start = $('input[name=\'filter_date_start\']').attr('value');
	
	if (filter_date_start) {
		url += '&filter_date_start=' + encodeURIComponent(filter_date_start);
	}

	var filter_date_end = $('input[name=\'filter_date_end\']').attr('value');
	
	if (filter_date_end) {
		url += '&filter_date_end=' + encodeURIComponent(filter_date_end);
	}
		
//	var filter_group = $('select[name=\'filter_group\']').attr('value');
//	
//	if (filter_group) {
//		url += '&filter_group=' + encodeURIComponent(filter_group);
//	}
//	
//	var filter_order_status_id = $('select[name=\'filter_order_status_id\']').attr('value');
//	
//	if (filter_order_status_id != 0) {
//		url += '&filter_order_status_id=' + encodeURIComponent(filter_order_status_id);
//	}	

	location = url;
}
//--></script> 