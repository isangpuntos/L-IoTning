<style>
.form-horizontal .control-label {
    float: left;
    font-size: 15px;
    margin: 0 0 0 20px;
    text-align: left;
    width: 145px;
	font-size:13px;
	padding:0px;
}
</style> 	
         <div class="bg_img">
            	<div class="bg_img_in">
                	<h1><span> <?=_l('Your',$this);?> </span> <?=_l('History',$this);?></h1>
                </div>
            </div>
            
            <div class="History_bg">
            <div class="floatleft" style="float:left;width:775px;">
           	<div class="History" style="min-height: 100px;">
                	<div class="history_box">
                    	<div class="id">
                        	<div><?=_l('ID',$this);?> </div>
                        </div>
                        <div class="amount_history">
                        	<div><?=_l('Image',$this);?></div>
                        </div>
                        <div class="Extensions_Name_history">
                        	<div><?=_l('Extension Name',$this);?></div>
                        </div>
                        
                        <div class="amount_history">
                        	<div><?=_l('Quantity',$this);?></div>
                        </div>
                        <div class="status_history">
                        	<div><?=_l('Price',$this);?>  </div>
                        </div>
                        <div class="date_add_history">
                        	<div><?=_l('Total',$this);?></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php if(isset($order_data) && $order_data !=null) {?>
           			<?php foreach($order_data as $order) {?>
                    <div class="history_box1" style="  min-height: 70px;">
                    	<div class="id_in" style="  min-height: 70px;">
                        	<div><?php echo $order['order_id'];?></div>                    
                        </div>
                        <div class="amount_history_in" style="  min-height: 70px;">
                        	<div><img src="<?php echo base_url(); ?><?php echo $order['image'];?>" width="50" height="50"></div>
                        </div>
                        <div class="Extensions_Name_history_in" style="  min-height: 70px;">
                        	<div><?php echo $order['extension_name'];?></div>
                        </div>
                        <div class="amount_history_in" style="  min-height: 70px;">
                        	<div><?php echo $order['quantity'];?></div>
                        </div>
                        <div class="status_history_in" style="  min-height: 70px;">
                        	<div><?php echo $this->currency->format($order['extension_price']);?></div>
                        </div>
                        <div class="date_add_history_in" style="  min-height: 70px;">
                        	<div><?php echo $this->currency->format($order['total_price']);?></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } } else {?>
          		<div class="history_box1" style="text-align:center;"><?=_l('No result',$this);?></div>
          		<?php }?>
          </div>
          		

           	<div class="History" style="min-height: auto; margin-top:10px;">
          		<form  class="form-horizontal" style="margin:0px;width:auto; width:auto;border-radius:0px;">
          		<div class="history_box">
          			<div class="id" style="width:100%;">
                        	<div><?=_l('Detail Information',$this);?> </div>
                        </div>
          		 </div>
          		<div style="float:none;width:auto;border-radius:0px;background:#fff;" class="account_from">
                        <div class="control-group">
                        <label for="User_Name" class="control-label"><span class="required"></span> <span class="lbname">Order ID</span>:</label>
                        <div class="controls">
                       <span class="lbtext"><?php echo $order['order_id'];?></span>
                        </div>
                        </div>
                        <div class="control-group">
                        <label for="First_Name" class="control-label"><span class="required"></span> <span class="lbname">Transaction Paypal</span>:</label>
                        <div class="controls">
                        <span class="lbtext"><?php echo $order['transaction_paypal_id'];?></span>
                        </div>
                        </div>
                        <div class="control-group">
                        <label for="Email" class="control-label"><span class="required"></span> <span class="lbname">Owner Name</span>:</label>
                        <div class="controls">
                        <span class="lbtext"><?php echo $order['username'];?></span>
                        </div>
                        </div>
                        <div class="control-group">
                        <label for="Email" class="control-label"><span class="required"></span> <span class="lbname">Owner Email</span>:</label>
                        <div class="controls">
                        <span class="lbtext"><?php echo $order['email'];?></span>
                        </div>
                         </div>
                        <div class="control-group">
	                        <label for="Email" class="control-label"><span class="required"></span> <span class="lbname">Owner Phone</span>:</label>
	                        <div class="controls">
	                        <span class="lbtext"><?php echo $order['phone'];?></span>
	                        </div>
                        </div>
                        
                          <div class="control-group">
	                        <label for="Email" class="control-label"><span class="required"></span> <span class="lbname">Status</span>:</label>
	                        <div class="controls">
	                        <span class="lbtext" style="color:orange;"><?php echo $order['status']==1?"Completed":"Canceled";?></span>
	                        </div>
                        </div>
                        
                        <div class="control-group">
	                        <label for="Email" class="control-label"><span class="required"></span> <span class="lbname">Payment Method</span>:</label>
	                        <div class="controls">
	                        <span class="lbtext"><?php echo $order['status']==1?"Paypal":"";?></span>
	                        </div>
                        </div>
                        
                        <div class="control-group">
	                        <label for="Email" class="control-label"><span class="required"></span> <span class="lbname">Total</span>:</label>
	                        <div class="controls">
	                        <span class="lbtext" style="font-size:14px;font-weight:bold;color:red;"><?php echo $this->currency->format($order['total_price']);?></span>
	                        </div>
                        </div>
                        
                        <div class="control-group">
	                        <label for="Email" class="control-label"><span class="required"></span> <span class="lbname">Added Date</span>:</label>
	                        <div class="controls">
	                        <span class="lbtext"><?php echo my_int_date($order['created_date']); ?></span>
	                        </div>
                        </div>
                  </div>
                 
                  </form>
                  <div style="margin:0px;" class="buttons">
				    <div class="left"><a href="<?php echo base_url(); ?>profile-history" class="button"><?=_l('Back',$this);?></a></div>				    
				  </div>
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
                
            </div>
            </div>
                