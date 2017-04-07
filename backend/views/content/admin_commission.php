 <!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>COMMISSION MANAGER</h2>	<p>Commission manager</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <!-- START CONTENT -->
<div class="content">
 <div class="simplebox1 grid740" style="margin:0 auto;">
 <legend>COMMISSION MANAGER<div class="input-prepend" style="float:right;">
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_setting">Setting</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_profile">Profile</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_password">Change Password</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_commission">Commission</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/email_setting">Email</a>
</div></legend>						
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
		                            	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_setting"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create.png"><span>Setting</span></a>
		                            	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_profile/"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create1.png"><span>Profile</span></a>
		                            	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_password"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create2.png"><span>Change Password</span></a>
		                            	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_commission"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create3.png"><span>Commission</span></a>
		                            </div>   
		                                              
                            </div>
                            <div style="" >
                           <form action="<?php echo base_url(); ?>backend.php/cpanel/admin_commission" method="post" enctype="multipart/form-data" name="edit_commission_form" id="edit_commission_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                            <table cellpadding="0" cellspacing="0" border="0">             
								<tbody>
									<tr>
				                       	<td style="padding-left:10px;height:15px;text-align:left;width:220px;">Set Default Commission to All: </td>
				                       	<td> <input type="text" name="commission_to_all" value="<?php echo isset($commission)?$commission:0; ?>"></td>
				                       	<td> <input type="submit" style="margin-left:10px;"class="st-button" name="submit" value="Submit"></td>
                                    </tr>
                               	</tbody>
                            </table>
                             </form>
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
					                    <th class="" rowspan="1" colspan="1" style="width: 100px;">Total Amount</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 70px;">Commission</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 100px;">Total Balance</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 70px;">Created Date</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 70px;">Action</th>
                                    </tr>
                               	</thead>
                                <tbody>
                                 <?php
									$i=0;$total=0;$total_commission=0;$total_amount=0;
									foreach($banners as $item)
									{
									$i++;$total += $item['total_price'];$total_commission+=$item['commission'];$total_amount+=$item['total_balance'];
									?>
									 <tr class="<?php if($i%2==0) {?>odd <?php } else {?>even<?php }?>">
				                        <td style="text-align:center;" class=" sorting_1"><?php echo $i; ?></td>
				                        <td><?php echo $item['username']; ?></td>                  
				                        <td align="right">$<?php echo $item['total_price']; ?></td>  
				                        <td align="right"><?php echo $item['commission']; ?>%</td>
				                        <td align="right">$<?php echo $item['total_balance']; ?></td>    
				                        <td style="text-align:center;"><?php echo my_int_date($item['created_date']); ?></td>
				                       
				                        <td class="center" style="text-align:center;">
				                            <!-- Icons -->
						                    <a class="icon-button tips button-form" title="[Edit Commission]" href="<?php echo base_url(); ?>backend.php/cpanel/editcommission/<?php echo $item['order_id']; ?>" original-title="Edit Commisson"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create.png"></a>
						                    
				                        </td>
				                    </tr>
						           <?php }?>     
								</tbody>
								<tfoot>
								 <tr>
						           <td align="right" colspan="2" style="color:red;font-size:15px;">Total:</td>
						           <td align="right" colspan="1" style="color:red;font-size:15px;">$<?php Echo $total;?></td>
						            <td align="right" colspan="1" style="color:red;font-size:15px;"><?php Echo $total_commission;?>%</td>
						           <td align="right"colspan="1" style="color:red;font-size:15px;">$<?php Echo $total_amount;?></td>
						           <td colspan="2"></td>
						           
						           </tr>   
								</tfoot>
							</table>
                        </div>
</div>
  <!-- END CONTENT -->
  <!-- START TABLE -->