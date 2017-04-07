          	<div class="bg_img">
            	<div class="bg_img_in">
                	<h1><span> <?=_l('Your',$this);?> </span> <?=_l('Downloads',$this);?></h1>
                </div>
            </div>
            
            <div class="your_download">
           	<div class="your_download_bg">
           		<?php if(isset($download_data) && $download_data !=null) {?>
           		<?php foreach($download_data as $load) {?>
                	<div class="your_download_section">
                    	<div class="you_download_img"><img src="<?php echo base_url();?><?php echo image($load['image'],$settings['default_image'],210,137);?>"></div>
                        <div class="you_download_text">
                        	<h1><?php echo $load['name'];?></h1>
                            <p><?php echo split_words($load['description'],500,"...");?><br>

                            	<span style="font-weight:600;"><?=_l('Price',$this);?>:<span style="font-weight:500; margin-left:80px;"><?php echo $this->currency->format($load['price']);?></span></span>
<!--							<br><span style="font-weight:600;">Average Rating:<span style="font-weight:500; margin-left:16px;"><?php echo $load['votes'];?></span></span>-->
                                <br><span style="float:left;font-weight:600;width:100%;"><?=_l('Comments',$this);?>:<span style="font-weight:500; margin-left:45px;"><?php echo $load['comment'];?></span><a style="float:right;" target="_blank" href="<?php echo base_url();?>extension-download?extension_download_id=<?php echo $load['download_id'];?>"><?=_l('Download',$this);?> </a></span>
                            </p>
                            
                        </div>
                        <div class="clear"></div>
                    </div>
          		<?php } } else {?>
          		<div class="your_download_section" style="text-align:center;"><?=_l('No result',$this);?></div>
          		<?php }?>
                <div class="clear"></div>
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
                        <li><a class="select" href="<?php echo base_url(); ?>profile-download"><?=_l('Your Downloads',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-extension"><?=_l('Manage Extensions',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile/sale"><?=_l('Your Sales',$this);?></a></li>
                        <li><a href="<?php echo base_url(); ?>profile/transaction"><?=_l('Transaction',$this);?></a></li>
                    </ul>
                    <!--<div class="Export">Export CSV</div>-->
                </div>
                <div class="clear"></div>
                </div>
                