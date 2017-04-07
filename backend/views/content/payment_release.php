 <!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>PAYMENT RELEASE</h2>	<p>Payment Release</p></div>
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
                        	<div class="titleh">
                        	  <div class="shortcuts-icons-button" style="top:0px;" style="z-index: 450;">
		                            <h3>Payment Release</h3>
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
					                    <th class="" rowspan="1" colspan="1" style="width: 100px;">Total Balance</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 70px;">Action</th>
                                    </tr>
                               	</thead>
                                <tbody>
                                 <?php
									$i=0;$total_amount=0;
									foreach($banners as $item)
									{
									$i++;$total_amount+=$item['total_balance'];
									?>
									 <tr class="<?php if($i%2==0) {?>odd <?php } else {?>even<?php }?>">
				                        <td style="text-align:center;" class=" sorting_1"><?php echo $i; ?></td>
				                        <td align="center"><?php echo $item['username']; ?></td>                  
				                        <td align="center">$<?php echo $item['total_balance']; ?></td>    
				                        <td class="center" style="text-align:center;">
				                            <!-- Icons -->
						                    <?php if( $item['paypal']!="") {?>
						                     <a class="icon-button tips button-form" title="[Release to <?php echo $item['username']; ?>]" href="javascript:;" onclick="if(confirm('Do you want to release payment to <?php echo $item['username']; ?>?')){ <?php if ($this->session->userdata['group']==1) {?>$('#release_form_<?php echo $i;?>').submit(); <?php }?> }"  original-title="Set Release"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create.png"></a>
							                  <form id="release_form_<?php echo $i;?>" style="display:none;" method="post" action="<?php echo $action; ?>">
											  <input type="hidden" value="_xclick" name="cmd">
											  <input type="hidden" value="<?php echo $item['paypal']; ?>" name="business">
											  <input type="hidden" value="Release to <?php echo $item['username']; ?>" name="item_name">
											  <input type="hidden" value="Release" name="item_number">
											  <input type="hidden" value="<?php echo $item['total_balance']; ?>" name="amount">
											  <input type="hidden" value="0" name="discount_amount">        
											  <input type="hidden" value="0" name="no_shipping">
											  <input type="hidden" value="No comments" name="cn">
											  <input type="hidden" value="USD" name="currency_code">
											  <input type="hidden" value="<?php echo base_url(); ?>backend.php/cpanel/release/<?php echo $item['user_id'];?>" name="return">
											  <input type="hidden" value="2" name="rm">   
											  <input type="hidden" value="<?php echo $item['user_id'];?>" name="user_id">      
	<!--										  <input type="hidden" value="11255XXX" name="invoice">-->
											  <input type="hidden" value="US" name="lc">
											  <input type="hidden" value="PP-BuyNowBF" name="bn">
											  <input type="submit" value="Place Order!" name="finalizeOrder" id="finalizeOrder" class="submitButton">
											</form>
											<a class="icon-button tips button-form" title="[set release]" href="javascript:;" onclick="if(confirm('Do you want to set it?')){ document.location.href='<?php echo base_url(); ?>backend.php/cpanel/release/<?php echo $item['user_id'];?>' }"  original-title="Set Release"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create1.png"></a>
						                    <!-- <form id="release_form_<?php echo $i;?>" style="display:none;" action="<?php echo $action; ?>" method="post">
												  <input type="hidden" name="email" value="laichau90-facilitator@gmail.com" />
												  <input type="hidden" name="business" value="laichau90-facilitator@gmail.com" />
												  <input type="hidden" name="item_name_1" value="chau" />
												  <input type="hidden" name="item_number_1" value="chau" />
												  <input type="hidden" name="amount_1" value="20" />
												  <input type="hidden" name="quantity_1" value="1" />
												  <input type="hidden" name="weight_1" value="10" />
  
												  <input type="hidden" name="currency_code" value="USD" />
												  <input type="hidden" name="cmd" value="_cart" />
  												  <input type="hidden" name="upload" value="1" />
												  <input type="hidden" name="rm" value="2" />
												  <input type="hidden" name="no_note" value="1" />
												  <input type="hidden" name="charset" value="utf-8" />
												  <input type="hidden" name="return" value="<?php echo base_url(); ?>backend.php/cpanel/release/" />
												  <input type="hidden" name="notify_url" value="<?php echo base_url(); ?>backend.php/cpanel/payment_release" />
												  <input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>backend.php/cpanel/payment_release" />
												  <input type="hidden" name="paymentaction" value="sale" />
						                    </form> -->
						                    <?php } else {?>
						                    <span style="color:red;float:left;margin-top:10px;">Paypal Id Blank</span>
						                    <a class="icon-button tips button-form" title="[set release]" href="javascript:;" onclick=" document.location.href='<?php echo base_url(); ?>backend.php/cpanel/release/<?php echo $item['user_id'];?>'"  original-title="Set Release"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create1.png"></a>
						                    
						                    <?php }?>
				                        </td>
				                    </tr>
						           <?php }?>     
								</tbody>
								<tfoot>
								 <tr>
						           <td align="right" colspan="2" style="color:red;font-size:15px;">Total:</td>
						           <td align="right"colspan="1" style="color:red;font-size:18px;font-weight:bold;">$<?php Echo $total_amount;?></td>
						           <td colspan="2"></td>
						           
						           </tr>   
								</tfoot>
							</table>
                        </div>
</div>
  <!-- END CONTENT -->
  <!-- START TABLE -->