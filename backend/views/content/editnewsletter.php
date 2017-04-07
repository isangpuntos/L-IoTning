<!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>NEWSLETTER MANAGER - <?php echo $id==""?"Add":"Edit"?> Newsletter</h2>	<p>Newsletter manager - <?php echo $id==""?"Add":"Edit"?> Newsletter</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <!-- START CONTENT -->
<div class="content">
<div class="simplebox grid740" style="z-index: 720;margin:0 auto;">
                            	<div class="titleh" style="z-index: 710;">
                                	<h3><?php echo $id==""?"Add":"Edit"?> Newsletter</h3>
                                </div>
                                <div class="body" style="z-index: 690;">
                                <form action="<?php echo base_url(); ?>backend.php/cpanel/newsletter_manipulate" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                                  
                                  	<div class="st-form-line" style="z-index: 680;">	
<!--                                    	<span class="st-labeltext">Title</span>	-->
                                        <input placeholder="title" type="text" value="<?php echo isset($banners[0]['title'])?$banners[0]['title']:""; ?>" style="width:510px" id="title" class="st-forminput" name="title" original-title="title"> 
                                        <?php if($this->session->flashdata('message_error')) {?><span style="margin-left:160px;" class="st-form-error"><?php echo $this->session->flashdata('message_error'); ?></span><?php }?>
                                    
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 620;">	
                                    	<textarea class="span12 ckeditor m-wrap" name="content" rows="6"><?php echo isset($banners[0]['content'])?$banners[0]['content']:""; ?></textarea>
                                  		<div class="clear" style="z-index: 610;"></div> 
                                    </div>
                                    
                                    <div class="button-box" style="z-index: 460;">
                                    	<input type="hidden" name="currentid" value="<?php echo $id;?>">
                                    	<input type="hidden" name="type" value="<?php echo isset($banners[0]['type'])?$banners[0]['type']:6; ?>">
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/newslettermanager" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                   	 
                                    </div>
                                  </form>
                                  
                                </div>
                            </div>
</div>
  <!-- END CONTENT -->
  

