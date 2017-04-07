<!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>CONTENT MANAGER - <?php echo $id==""?"Add":"Edit"?> Article</h2>	<p>Article manager - <?php echo $id==""?"Add":"Edit"?> Article</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <!-- START CONTENT -->
<div class="content">
<div class="simplebox grid740" style="z-index: 720;margin:0 auto;">
                            	<div class="titleh" style="z-index: 710;">
                                	<h3><?php echo $id==""?"Add":"Edit"?> Article</h3>
                                </div>
                                <div class="body" style="z-index: 690;">
                                <form action="<?php echo base_url(); ?>backend.php/cpanel/article_manipulate" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                                  
                                  	<div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Name</span>	
                                        <input placeholder="name" type="text" value="<?php echo isset($banners[0]['name'])?$banners[0]['name']:""; ?>" style="width:510px" id="name" class="st-forminput" name="name" original-title="name"> 
                                        <?php if($this->session->flashdata('message_error')) {?><span style="margin-left:160px;" class="st-form-error"><?php echo $this->session->flashdata('message_error'); ?></span><?php }?>
                                    
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Order</span>	
                                        <input placeholder="order" type="text" value="<?php echo isset($banners[0]['order'])?$banners[0]['order']:""; ?>" style="width:510px" id="order" class="st-forminput" name="order" original-title="order"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 620;">	
                                    	<textarea class="span12 ckeditor m-wrap" name="content" rows="6"><?php echo isset($banners[0]['content'])?$banners[0]['content']:""; ?></textarea>
                                  		<div class="clear" style="z-index: 610;"></div> 
                                    </div>
                                    <div class="st-form-line" style="z-index: 620;">	
                                    	<span class="st-labeltext">Status</span>	
                                    	<?php if (isset($banners[0]['public']) && $banners[0]['public']==1){?>
	                                    	<label class="margin-right10"><input checked value="1" type="radio" name="active" class="uniform"/> Enabled </label> 
	                                    	<label class="margin-right10"><input value ="0" type="radio" name="active" class="uniform"/> Disabled </label>
                                    	<?php } else {?>
	                                    	<label class="margin-right10"><input value="1" type="radio" name="active" class="uniform"/> Enabled </label> 
	                                    	<label class="margin-right10"><input checked value ="0" type="radio" name="active" class="uniform"/> Disabled </label>
                                    	<?php } ?>
                                  		<div class="clear" style="z-index: 610;"></div> 
                                    </div>
                                    <div class="button-box" style="z-index: 460;">
                                      <input type="hidden" name="currentid" value="<?php echo $id;?>">
                                      <input type="hidden" name="parent" value="<?php echo $parent;?>">
                                   	  <a href="<?php echo $back_link;?>" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                   	 
                                    </div>
                                  </form>
                                  
                                </div>
                            </div>
</div>
  <!-- END CONTENT -->
  

