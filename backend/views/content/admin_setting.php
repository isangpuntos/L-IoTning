 <script src="<?php echo base_url(); ?>assets/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/uploadify/uploadify.css" rel="stylesheet">
<style>
input, textarea, .uneditable-input {
width:200px;
}
.profile_pic {
    float: left;
    margin: 10px 0 0 20px;
}
.clear-button {
	float: right;
    margin-right: 25px !important;
    margin-top: 10px !important;
}
.cancel {
	display:none;
}
.uploadify-button {
	color:white !important;
}
.uploadify {
	margin:0px;
	padding:0px;
	float:left;
}
.uploadify-queue
{
display:block !important;
}
.gv_filmstripWrap
{
	top:305px;
}
</style>
 <script type="text/javascript">
$(document).ready(function (){
    CKFinder.setupCKEditor( null, '<?php echo base_url(); ?>assets/backend/js/ckfinder/' );
    // validate signup form on keyup and submit
    $("input[type=password]").val('');
});
   function check_information(){
		var input = $('#editdetail input.require');
		for(var i=0;i<input.length;i++){
			var each = input[i];
			if($(each).val()==''){
				alert('Please Fill '+ $(each).parent().parent().find('span.lbname').text()+'!');
				$(each).focus();
				return false;
			}
		}
		if($('select#city').val()==null)
		{
			alert('Please Fill City');
			return false;
		}
	}   

   function image_upload(field, thumb, upload, folder,w,h) {
	    $('#' + upload + '-queue').hide();	
		$('#' + upload).uploadify({		
			'buttonText' : 'Browse', 
			'hideButton' : true,    
			'swf'      : '<?php echo base_url(); ?>assets/uploadify/uploadify.swf',		        
			'uploader' : '<?php echo base_url()?>uploadimage?folder='+folder+'&w='+w+'&h='+h,				
			'onUploadSuccess' : function(file, data, response) {	
				if(data=="1")
				{
					alert("Warning: Incorrect file type!");
				}
				else
				{
					var dat =  $.parseJSON(data); 				
					$('#' + thumb).attr('src',dat.thumb);						
					$('#' + field).val(dat.source);		
					 $('#' + upload + '-queue').hide();	
				}
				
			}		    
		});	
	}   

</script>
 <!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>SETTING MANAGER - Setting</h2>	<p>Setting Manager - Setting</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <!-- START CONTENT -->
<div class="content">
<?php if($this->session->flashdata('message')){?>
						        <div class="albox succesbox" style="z-index: 690;">
                                	<b>Success :</b> <?php echo $this->session->flashdata('message'); ?>
                                	<a class="close tips" href="#" original-title="close">close</a>
                                </div>
							<?php } ?>
<div class="simplebox1 grid740" style="z-index: 720;margin:0 auto;">
<legend>SETTING MANAGER<div class="input-prepend" style="float:right;">
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_setting">Setting</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_profile">Profile</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_password">Change Password</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_commission">Commission</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/email_setting">Email</a>
</div></legend>
                            	<div class="titleh" style="z-index: 710;">
                                	 <div class="shortcuts-icons-button" style="z-index: 450; display:none;">
		                            	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_setting"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create.png"><span>Setting</span></a>
		                            	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_profile/"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create1.png"><span>Profile</span></a>
		                            	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_password"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create2.png"><span>Change Password</span></a>
		                            	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_commission"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create3.png"><span>Commission</span></a>
		                            </div>
                                </div>
                                <div class="body" style="z-index: 690;">
                                  <form action="" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                                  
                                  	 <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Company Name</span>	
                                        <input type="text" value="<?php echo isset($banners['company'])?$banners['company']:""; ?>" style="width:510px" id="company" class="st-forminput" name="data[company]" original-title="Your Company"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Email</span>	
                                        <input type="text" value="<?php echo isset($banners['email'])?$banners['email']:""; ?>" style="width:510px" id="email" class="st-forminput" name="data[email]" original-title="Your Email">
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Logo</span>	
	                                    <div class="profile_pic">
					                    	<div><img id="thumb_banner" style="margin-bottom:10px;" src="<?php echo base_url(); ?><?php echo image($banners['logo'],$settings['default_image'],220,120);?>"></div>
					                        <a class="clear-button" href="javascript:;" onclick="$('#image_banner').val('');$('#thumb_banner').attr('src','<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],220,120)?>');">Clear</a>
					                        <input type="hidden" name="data[logo]" value="<?php echo $banners['logo'];?>" id="image_banner" />		
											<input type="file" name="file_upload" id="upload_banner" style="display:none;" />
					                       
					                        <script type="text/javascript">image_upload('image_banner', 'thumb_banner', 'upload_banner','images','220','120');</script>
					                    </div>
					                    <div style="clear:both;"></div>
				                    </div>

                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Address 1</span>	
                                        <input type="text" value="<?php echo isset($banners['address1'])?$banners['address1']:""; ?>" style="width:510px" id="address1" class="st-forminput" name="data[address1]" original-title="Your Address 1"> 
                                    	<div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                     <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Address 2</span>	
                                        <input type="text" value="<?php echo isset($banners['address2'])?$banners['address2']:""; ?>" style="width:510px" id="address2" class="st-forminput" name="data[address2]" original-title="Your Address 2"> 
                                    	<div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                                                      
                                  	<div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Zip code</span>	
                                        <input type="text" value="<?php echo isset($banners['zip_code'])?$banners['zip_code']:""; ?>" style="width:510px" id="zip_code" class="st-forminput" name="data[zip_code]" original-title="Your Zip Code"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line">	<span class="st-labeltext">Country</span>	
                                   	<select id="country" name="data[country_id]">
                                   		 <?php
											foreach($country_data as $item)
											{
												if(isset($banners['country_id']))
												{
													$checked=" ";
													if($banners['country_id']==$item['country_id'])
													{
														$checked=" selected";
													}
													
													echo "<option value='".$item['country_id']."'".$checked.">".$item['country_name']."</option>";
												}
												else
												{
													echo "<option value='".$item['country_id']."'>".$item['country_name']."</option>";
												}
											}
											?>
                               		</select>
                                    	<div class="clear"></div> 
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Telephone</span>	
                                        <input type="text" value="<?php echo isset($banners['phone'])?$banners['phone']:""; ?>" style="width:510px" id="phone" class="st-forminput" name="data[phone]" original-title="Your Phone"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 480;">	
                                    	<span class="st-labeltext">Description</span>	
                                        <textarea cols="47" rows="3" style="width:510px" id="description" class="st-forminput" name="data[description]"><?php echo isset($banners['description'])?$banners['description']:""; ?></textarea> 
                                    <div class="clear" style="z-index: 470;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 620;">	
                                    	<span class="st-labeltext">Auto Currency</span>	
                                    	<label class="margin-right10"><input <?php if (isset($banners['auto_currency']) && $banners['auto_currency']==1 ) {?> checked <?php } ?> value="1" type="checkbox" name="data[auto_currency]" class="uniform"/></label>
                                  		<div class="clear" style="z-index: 610;"></div> 
                                    </div>
                                    
                                     <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Default Image</span>	
                                    <div class="profile_pic">
				                    	<div><img id="thumb_banner_default" style="margin-bottom:10px;" width="220" height="120" src="<?php echo base_url(); ?><?php echo image($banners['default_image'],$settings['default_image'],220,120);?>"></div>
				                        <a class="clear-button" href="javascript:;" onclick="$('#image_banner_default').val('');$('#thumb_banner_default').attr('src','<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],220,120)?>');">Clear</a>
				                        <input type="hidden" name="data[default_image]" value="<?php echo $banners['default_image'];?>" id="image_banner_default" />		
										<input type="file" name="file_upload" id="upload_banner_default" style="display:none;" />
				                       
				                        <script type="text/javascript">image_upload('image_banner_default', 'thumb_banner_default', 'upload_banner_default','images','718','300');</script>
				                    </div>
				                     <div class="clear" style="z-index: 650;"></div>
				                      </div>
                                    
                                    
                                   <div class="st-form-line" style="z-index: 480;">	
                                    	<span style="float:left;" class="st-labeltext">Checkout Description</span>	
                                        <div style="width:510px;float:left;">
                                        <textarea cols="47" rows="1" style="width:510px" id="checkout_description" class="span12 ckeditor m-wrap" name="data[checkout_description]"><?php echo isset($banners['checkout_description'])?$banners['checkout_description']:""; ?></textarea>
                                        </div> 
                                    <div class="clear" style="z-index: 470;"></div>
                                    </div>

                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">FB APP ID</span>	
                                        <input type="text" value="<?php echo isset($banners['fb_api'])?$banners['fb_api']:""; ?>" style="width:510px" id="fb_api" class="st-forminput" name="data[fb_api]" original-title="Your fb api"> 
                                    	<div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="button-box" style="z-index: 460;">
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/index" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                   	  
                                    </div>
                                    
                                    
                                  </form>
                                  
                                </div>
                            </div>
</div>
  <!-- END CONTENT -->