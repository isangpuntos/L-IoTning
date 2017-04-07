
<div class="bg_img">
            	<div class="bg_img_in">
                	<h1><span> <?=_l('Your',$this);?> </span> <?=_l('Sales',$this);?></h1>
                </div>
            </div>
            
            <div class="History_bg">
            <div class="History">
           			<div class="sales_bg">
                    	<div class="oreder_id">
                        	<div><?=_l('Order ID',$this);?></div>
                        </div>
                        <div class="Buyer">
                        	<div><?=_l('Buyer',$this);?>  </div>
                        </div>
                        <div class="Extension_sales">
                        	<div><?=_l('Extension',$this);?>   </div>
                        </div>
                        <div  class="status_sales">
                        	<div><?=_l('Status',$this);?>  </div>
                        </div>
                        <div class="date_add_sales">
                        	<div><?=_l('Date Add',$this);?>  </div>
                        </div>
                        <div class="amount_usd">
                        	<div><?=_l('Amount(USD)',$this);?></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <?php if(isset($sale_data) && $sale_data !=null) {?>
           			<?php foreach($sale_data as $sale) {?>
                    <div class="sales_bg1">
                    	<div class="oreder_id_1">            
                        	<div><?php echo $sale['order_id'];?></div>
                        </div>
                        <div class="Buyer_1">
                        	<div><a href="#"><?php echo $sale['username'];?></a></div>
                        </div>
                        <div class="Extension_sales_1">
                        	<div><?php Echo $sale['extension_name'];?><br>Quantity: <?php Echo $sale['quantity'];?>
                                <?php if($sale['status']==2 && $sale['owner']==1) {?> <br>
                                <span id="btn-shipping-container<?php echo $sale['order_id'];?>" style=" margin-left: 10px;padding: 0 5px;">
                                    <a class="button btn-shipping" onclick="shipping($(this),<?php echo $sale['order_id'];?>,3)" style="margin-left:10px;padding: 0 5px;" href="javascript:;"><?=_l('Ship',$this);?></a>
                                    <a class="button btn-shipping" onclick="shipping($(this),<?php echo $sale['order_id'];?>,0)" style="margin-left:10px;padding: 0 5px;" href="javascript:;"><?=_l('Cancel',$this);?></a>
                                </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="status_sales_1">
                        	<div id="current_shipping<?php echo $sale['order_id'];?>"><?php if($sale['status']==1) {?> Completed <?php } else if($sale['status']==2) {?> Waiting Confirm <?php } else if($sale['status']==3) {?>  Shipped <?php } else {?> Canceled <?php } ?></div>
                        </div>
                        <div class="date_add_sales_1">
                        	<div><?php echo my_int_date($sale['created_date']); ?></div>
                        </div>
                        <div class="amount_usd_1">
                        	<div><?php echo $this->currency->format($sale['total_balance']);?></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                   <?php } } else {?>
	          		<div class="sales_bg1" style="text-align:center;"><?=_l('No result',$this);?></div>
	          		<?php }?>
	          		 <div class="pagination"><div class="results"><?php echo $pagination;?></div></div>
				  <div style="margin:0px;" class="buttons">
				    <div class="right"><a href="<?php echo base_url(); ?>profile" class="button"><?=_l('Continue',$this);?></a></div>
				  </div>
				  </div>
				   <div class="account_right_links">
                <div><?=_l('Your Account',$this);?></div>
                	<ul>
                    	<li><a href="<?php echo base_url(); ?>profile"><?=_l('Account',$this);?></a></li>
                        <li><a  href="<?php echo base_url(); ?>profile-detail"><?=_l('Edit Details',$this);?></a></li>
                        <li><a href="<?php echo base_url(); ?>profile/address"><?=_l('Manage Address',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-password"><?=_l('Chang Password',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-history"><?=_l('Order History',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-download"><?=_l('Your Downloads',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-extension"><?=_l('Manage Extensions',$this);?> </a></li>
                        <li><a class="select" href="<?php echo base_url(); ?>profile/sale"><?=_l('Your Sales',$this);?></a></li>
                        <li><a href="<?php echo base_url(); ?>profile/transaction"><?=_l('Transaction',$this);?></a></li>
                    </ul>
                    <!--<div class="Export">Export CSV</div>-->
                </div>
                <div class="clear"></div>
            
<script type="text/javascript">
// Hover effect for the cart

function shipping(obj,id,type)
{
    $(obj).parent().html('<img width="16" height="16" alt="" src="<?php echo base_url(); ?>assets/frontend/img/loading.gif">');

              $.ajax({
                    url: '<?php echo base_url()?>ajax_shipping?id='+id+'&type='+type,
                    dataType: 'json',
                    type: 'POST',
                    complete: function(html) {
                         var result = html.responseText.split("|");
                        if(result[0]=='success') {
                            $('#current_shipping'+id).html(result[1]);
                            $('#btn-shipping-container'+id).html('<span style="color:green;">Successful</span>');
                        }
                    }
                }); 
}
</script>
</div>
