          	<div class="bg_img">
            	<div class="bg_img_in">
                	<h1><span> <?=_l('Your',$this);?> </span> <?=_l('History',$this);?></h1>
                </div>
            </div>
            
            <div class="History_bg">
           	<div class="History">
                	<div class="history_box">
                    	<div class="id">
                        	<div><?=_l('ID',$this);?> </div>
                        </div>
                        <div class="Extensions_Name_history">
                        	<div><?=_l('Extension Name',$this);?></div>
                        </div>
                        <div class="amount_history">
                        	<div><?=_l('Amount',$this);?></div>
                        </div>
                        <div class="status_history">
                        	<div><?=_l('Status',$this);?>  </div>
                        </div>
                        <div class="date_add_history">
                        	<div><?=_l('Date Added',$this);?></div>
                        </div>
                        <div class="action_history" style="text-align:right;margin-right:10px;width:120px;">
                        	<div><?=_l('Action',$this);?> </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php if(isset($order_data) && $order_data !=null) {?>
           			<?php foreach($order_data as $order) {?>
                    <div class="history_box1">
                    	<div class="id_in">
                        	<div><?php echo $order['order_id'];?></div>                    
                        </div>
                        <div class="Extensions_Name_history_in">
                        	<div>
                                <?php echo $order['extension_name'];?><br>Quantity: <?php Echo $order['quantity'];?>
                                 <?php if($order['status']==3) {?><span id="btn-shipping-container<?php echo $order['order_id'];?>" style=" margin-left: 10px;padding: 0 5px;"><a class="button btn-shipping" onclick="shipping($(this),<?php echo $order['order_id'];?>,1)" style="margin-left:10px;padding: 0 5px;" href="javascript:;"><?=_l('Confirm',$this);?></a></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="amount_history_in">
                        	<div><?php echo $this->currency->format($order['total_price']);?></div>
                        </div>
                        <div class="status_history_in">
                        	<div id="current_shipping<?php echo $order['order_id'];?>"><?php if($order['status']==1) {?> Completed <?php } else if($order['status']==2) {?> Waiting Confirm <?php } else if($order['status']==3) {?>  Shipped <?php } else {?> Canceled <?php } ?></div>
                        </div>
                        <div class="date_add_history_in">
                        	<div><?php echo my_int_date($order['created_date']); ?></div>
                        </div>
                        <div class="action_history_in">
                        	<div><a style="margin-left:0px;" target="_blank"  href="<?php echo base_url();?>profile-history-invoice/<?php echo $order['order_id'];?>">Invoice</a><a href="<?php echo base_url();?>profile-history-detail/<?php echo $order['order_id'];?>"><?=_l('view',$this);?></a></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } } else {?>
          		<div class="history_box1" style="text-align:center;"><?=_l('No result',$this);?></div>
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
                        <li><a class="select" href="<?php echo base_url(); ?>profile-history"><?=_l('Order History',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-download"><?=_l('Your Downloads',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-extension"><?=_l('Manage Extensions',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile/sale"><?=_l('Your Sales',$this);?></a></li>
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
                