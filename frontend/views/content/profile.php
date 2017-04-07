<div class="bg_img">
            	<div class="bg_img_in">
                	<h1><span> <?=_l('Account',$this);?> </span>  <?=_l('Manager',$this);?></h1>
                </div>
            </div>
          
            <div class="History_bg">
           	<div class="History">
           			
           			<?php if($this->session->flashdata('message')){?>
		            <div class="success" style="margin:10px;">Success: Your <?php echo $this->session->flashdata('message');?> have been successfully updated!</div>
		            <?php } ?>
		            
		            <?php if($this->session->flashdata('message_signup')){?>
		            <div class="success" style="margin:10px;">Success: <?php echo $this->session->flashdata('message_signup');?></div>
		            <?php } ?>
		            
		            <?php if($this->session->flashdata('message_checkout')){?>
		            <div class="success" style="margin:10px;">Success: Your <?php echo $this->session->flashdata('message_checkout');?> have been  successfully checkout!</div>
		            <?php } ?>
		            
		            <?php if($this->session->flashdata('message_checkout_error')){?>
		            <div class="error" style="margin:10px;">Error: <?php echo $this->session->flashdata('message_checkout_error');?>!</div>
		            <?php } ?>
		            
                	<div class="account_Manager">
                    	<div class="text_icon">
                        	<div class="icon"><img src="<?php echo base_url(); ?>assets/frontend/img/Account-Details.png" width="32" height="32" /></div>
                            <div class="account_text1">
                            	<div><a href="<?php echo base_url(); ?>profile-detail"><?=_l('Account Details',$this);?></a></div>
                                <div><?=_l('Edit Your account details',$this);?></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="text_icon">
                        	<div class="icon"><img src="<?php echo base_url(); ?>assets/frontend/img/Order-History.png" width="32" height="32" /></div>
                            <div class="account_text1">
                            	<div><a href="<?php echo base_url(); ?>profile-history"><?=_l('Order History',$this);?></a></div>
                                <div><?=_l('view the extension you have previously purchased',$this);?></div>
                            </div>
                            <div class="clear"></div>
                      </div>
                        <div class="text_icon">
                        	<div class="icon"><img src="<?php echo base_url(); ?>assets/frontend/img/Manage-extensions.png" width="32" height="32" /></div>
                            <div class="account_text1">
                            	<div><a href="<?php echo base_url(); ?>profile-extension"><?=_l('Manage extensions',$this);?></a></div>
                                <div><?=_l('Edit Your account details',$this);?></div>
                            </div>
                            <div class="clear"></div>
                      </div>
                        <div class="text_icon">
                        	<div class="icon"><img src="<?php echo base_url(); ?>assets/frontend/img/Transactions1.png" width="32" height="32" /></div>
                            <div class="account_text1">
                            	<div><a href="<?php echo base_url(); ?>profile/transaction"><?=_l('Transactions',$this);?></a></div>
                                <div><?=_l('Edit Your account details',$this);?></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        
                    </div>
                    <div class="account_Manager1">
                    	<div class="text_icon">
                        	<div class="icon"><img src="<?php echo base_url(); ?>assets/frontend/img/Change-password.png" width="32" height="32" /></div>
                            <div class="account_text1">
                            	<div><a href="<?php echo base_url(); ?>profile-password"><?=_l('Change password',$this);?> </a></div>
                                <div><?=_l('Change Your paassword',$this);?> </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="text_icon">
                        	<div class="icon"><img src="<?php echo base_url(); ?>assets/frontend/img/Your-Downloads.png" width="32" height="32" /></div>
                            <div class="account_text1">
                            	<div><a href="<?php echo base_url(); ?>profile-download"><?=_l('Your Downloads',$this);?></a></div>
                                <div><?=_l('view the extension you have previously purchased',$this);?></div>
                            </div>
                            <div class="clear"></div>
                      </div>
                        <div class="text_icon">
                        	<div class="icon"><img src="<?php echo base_url(); ?>assets/frontend/img/Sales.png" width="32" height="32" /></div>
                            <div class="account_text1">
                            	<div><a href="<?php echo base_url(); ?>profile/sale"><?=_l('Sales',$this);?></a></div>
                                <div><?=_l('Edit Your account details',$this);?></div>
                            </div>
                            <div class="clear"></div>
                      </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="account_right_links">
                <div><?=_l('Your Account',$this);?></div>
                	<ul>
                    	<li><a class="select" href="<?php echo base_url(); ?>profile"><?=_l('Account',$this);?></a></li>
                        <li><a href="<?php echo base_url(); ?>profile-detail"><?=_l('Edit Details',$this);?></a></li>
                        <li><a href="<?php echo base_url(); ?>profile/address"><?=_l('Manage Address',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-password"><?=_l('Chang Password',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-history"><?=_l('Order History',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-download"><?=_l('Your Downloads',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-extension"><?=_l('Manage Extensions',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile/sale"><?=_l('Your Sales',$this);?></a></li>
                        <li><a href="<?php echo base_url(); ?>profile/transaction"><?=_l('Transaction',$this);?></a></li>
                    </ul>
                    <!--<div class="Export">Export CSV</div>-->
                </div>
                <div class="clear"></div>
                
            </div>