 <!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>ORDER MANAGER</h2>	<p>Order manager</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <!-- START CONTENT -->
<div class="content">
 <div class="simplebox1 grid740" style="margin:0 auto;">
 						<legend>ORDER MANAGER<div class="input-prepend" style="float:right;"><a class="btn btn-small" id="add_new_user_btn" href="http://localhost/buysell/backend.php/cpanel/order">Order</a><a class="btn btn-small" id="add_new_user_btn" href="http://localhost/buysell/backend.php/cpanel/order_total_earn">Members total earnings</a></div></legend>
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
                        	<div class="titleh">
                        	  <div class="shortcuts-icons-button" style="z-index: 450; display:none;">
                            	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/order"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create.png"><span>Order</span></a>
                            	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/order_total_earn"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create.png"><span>Members total earnings</span></a>
                            </div>
                        	                            
                            </div>
                            
                            
                            <!-- Start Data Tables Initialisation code -->
							<script type="text/javascript" charset="utf-8">
								$(document).ready(function() {
    								oTable = $('#example').dataTable({
        							"bJQueryUI": true,
        							"sPaginationType": "full_numbers"
        							});
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
					                    <th class="" rowspan="1" colspan="1" style="width: 120px;">Action</th>
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
				                        <td><?php echo $item['username']; ?></td>                  
				                        <td rvid="18" style="text-align:center;">
				                        	<?php echo $item['status'] ==1?"Completed":"Pending";?>
				                        </td>
				                        
				                        <td style="text-align:center;"><?php echo my_int_date($item['created_date']); ?></td>
				                        <td align="center">$<?php echo $item['total_price']; ?></td>  
				                        <td class="center" style="text-align:center;">
				                            <!-- Icons -->
						                    <a class="icon-button tips button-form" title="[Delete]" href="javascript:;" onclick="if(confirm('Do you want to delete it?')) document.location.href='<?php echo base_url(); ?>backend.php/cpanel/deleteorder/<?php echo $item['order_id']; ?>'" original-title="Delete"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/delete.png"></a>
						                    
				                        </td>
				                    </tr>
						           <?php }?>     
								</tbody>
								<tfoot>
								 <tr>
						           <td colspan="3"></td>
						           <td align="right" colspan="1" style="color:red;font-size:15px;">Total:</td>
						           <td align="right"colspan="1" style="color:red;font-size:15px;">$<?php Echo $total;?></td><td>
						           
						           </tr>   
								</tfoot>
							</table>
                        </div>
</div>
  <!-- END CONTENT -->
  <!-- START TABLE -->