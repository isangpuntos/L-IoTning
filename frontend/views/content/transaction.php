
<div class="bg_img">
            	<div class="bg_img_in">
                	<h1><span> <?=_l('Your',$this);?> </span> <?=_l('Transaction',$this);?></h1>
                </div>
            </div>
            
            <div class="History_bg">
           	<div class="History">
           		<?php if($this->session->flashdata('message')){?>
            	<div class="success">Success: <?php echo $this->session->flashdata('message');?></div>
            	<?php } ?>
            	<table class="list">
			    <thead>
			      <tr>
			        <td class="left"><a href=""><?=_l('Date added',$this);?></a></td>
			         <td class="left"><a href=""><?=_l('Order number',$this);?></a></td>
			         <td class="left"><a href=""><?=_l('Transaction Paypal',$this);?></a></td>
			        <td class="left"><a href=""><?=_l('Description',$this);?></a></td>
			        <td class="left"><a href=""><?=_l('Amount (USD)',$this);?></a></td>
			      </tr>
			    </thead>
			    <tbody>
			    	<?php if(count($banners) > 0) {?>
			        <?php foreach($banners as $ex) {?>
			        <tr>
			        <td class="left"><?php echo my_int_date($ex['created_date']); ?></td>
			        <td class="left"><?php echo ($ex['order_id']); ?></td>
			        <td class="left">
			        <?php if($ex['payment_release'] ==1 && $ex['user_id'] ==$_SESSION['user']['user_id']) {?>
			        <?php } else {?>
			         <?php echo ($ex['transaction_paypal_id']); ?>
			        <?php }?>
			        </td>
			        <td class="left">
			        <?php if($ex['payment_release'] ==1 && $ex['user_id'] ==$_SESSION['user']['user_id']) {?>
			        	Buy & Sell Admin release payment
			        <?php } else {?>
			        <?=_l('EX',$this);?>:<?php echo $ex['extension_name'];?>, <?=_l('Price',$this);?>:<?php echo $this->currency->format($ex['price']);?>, <?=_l('Quantity',$this);?>:<?php echo $ex['quantity'];?>
			        <?php }?>
			        </td>
			        <td class="left"><?php echo $this->currency->format($ex['total_price']);?></td>
			        
			      </tr>
			      	<?php } } else { ?>
			      	 <tr><td style="height: 40px;" colspan="6" align="center"><?=_l('No result',$this);?></td></tr>
			      	<?php } ?>
			      	
			   </tbody>
			  </table>
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
                        <li><a href="<?php echo base_url(); ?>profile/sale"><?=_l('Your Sales',$this);?></a></li>
                        <li><a class="select" href="<?php echo base_url(); ?>profile/transaction"><?=_l('Transaction',$this);?></a></li>
                    </ul>
                    <!--<div class="Export">Export CSV</div>-->
                </div>
                <div class="clear"></div>
                
            </div>
 
  


