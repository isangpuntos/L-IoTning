<script src="<?php echo base_url(); ?>assets/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/uploadify/uploadify.css" rel="stylesheet">
<style>
input, textarea, .uneditable-input {
width:200px;
}
.profile_pic {
    float: left;
    margin: 10px 0 0 20px;
	width: 210px;
}
.clear-button {
	float: right;
    margin-right: 25px !important;
    margin-top: 10px !important;
}
.uploadify-button {
	color:white !important;
}
.uploadify {
	margin:0px;
	padding:0px;
	float:left;
}
.cancel {display:none;}
.uploadify-queue
{
display:block !important;
}
.gv_filmstripWrap
{
	top:305px;
}
</style><!-- start page title --> <script type="text/javascript">
jQuery(document).ready(function (){
    CKFinder.setupCKEditor( null, '<?php echo base_url(); ?>assets/backend/js/ckfinder/' );
    // validate signup form on keyup and submit
    $("input[type=password]").val('');
});
var imgId;
function chooseImage(id)
{
  imgId = id;
  // You can use the "CKFinder" class to render CKFinder in a page:
  var finder = new CKFinder();
  finder.basePath = '/buysellscript/assets/backend/js/ckfinder/'; // The path for the installation of CKFinder (default = "/ckfinder/").
  finder.selectActionFunction = setFileField;
  finder.popup();
} 
function setregion()
{
	$('#city').html('');
	id = $('#country').val();
	jQuery.post("<?php echo base_url(); ?>getregion", {name: id}, function( r ) {
			 $('#region').html(r);
            });
	 
}
function setcity()
{
	id = $('#region').val();
	jQuery.post("<?php echo base_url(); ?>getcity", {name: id}, function( r ) {
			 $('#city').html(r);
            });
}
//This is a sample function which is called when a file is selected in CKFinder.
function setFileField( fileUrl )
{
  document.getElementById( 'chooseImage_img' + imgId ).src = '/buysellscript/'+fileUrl;
  document.getElementById( 'chooseImage_input' + imgId).value = fileUrl.substr(1,fileUrl.length);
  document.getElementById( 'chooseImage_div' + imgId).style.display = '';
  $('#chooseImage_img' + imgId).attr('style','width:150px;height:auto;border:dashed thin;');
}

function clearImage(imgId)
{
  document.getElementById( 'chooseImage_img' + imgId ).src = '';
  document.getElementById( 'chooseImage_input' + imgId ).value = '';
  document.getElementById( 'chooseImage_div' + imgId).style.display = 'none';
  document.getElementById( 'chooseImage_noImage_div' + imgId).style.display = '';
}

function addMoreImg()
{
  jQuery("ul#images > li.hidden").filter(":first").removeClass('hidden');
}

   $().ready(function() {
    // validate signup form on keyup and submit
 //  $("input[type=password]").val('');
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
         <div class="titlebar">	<h2>SETTING MANAGER - Edit Profile</h2>	<p>Setting manager - Edit Profile</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->
  <!-- START CONTENT -->
<div class="content">
<?php if($this->session->flashdata('message')){?>
						        <div class="albox succesbox" style="z-index: 690;">
                                	<b>Succes :</b> <?php echo $this->session->flashdata('message'); ?>
                                	<a class="close tips" href="#" original-title="close">close</a>
                                </div>
							<?php } ?>
<div class="simplebox1 grid740" style="z-index: 720;margin:0 auto;">
<legend>EDIT PROFILE<div class="input-prepend" style="float:right;">
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_setting">Setting</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_profile">Profile</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_password">Change Password</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_commission">Commission</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/email_setting">Email</a>
</div>
</legend>
                            	<div class="titleh" style="z-index: 710;">
                            	 <div class="shortcuts-icons-button" style="z-index: 450; display:none;">
                                	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_setting"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create.png"><span>Setting</span></a>
		                            <a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_profile/"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create1.png"><span>Profile</span></a>
		                            <a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_password"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create2.png"><span>Change Password</span></a>
		                            <a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_commission"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create3.png"><span>Commission</span></a>
		                          </div>
                                </div>
                                <div class="body" style="z-index: 690;">
                                  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                                  
                                  	<div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Username</span>	
                                        <input type="text" value="<?php echo isset($banners['username'])?$banners['username']:""; ?>" style="width:510px" id="username" class="st-forminput" name="username" original-title="Your Username to login"> 
                                        <?php if(isset($user_error)) {?><span style="margin-left:160px;" class="st-form-error"><?php echo $user_error; ?></span><?php }?>
                                    
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                                                      
                                  	<div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Firstname</span>	
                                        <input type="text" value="<?php echo isset($banners['firstname'])?$banners['firstname']:""; ?>" style="width:510px" id="firstname" class="st-forminput" name="firstname" original-title="Your Firstname"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Lastname</span>	
                                        <input type="text" value="<?php echo isset($banners['lastname'])?$banners['lastname']:""; ?>" style="width:510px" id="lastname" class="st-forminput" name="lastname" original-title="Your Lastname"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Email</span>	
                                        <input type="text" value="<?php echo isset($banners['email'])?$banners['email']:""; ?>" style="width:510px" id="email" class="st-forminput" name="email" original-title="Your Email">
                                        <?php if(isset($email_error)) {?><span style="margin-left:160px;" class="st-form-error"><?php echo $email_error; ?></span><?php }?> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Telephone</span>	
                                        <input type="text" value="<?php echo isset($banners['phone'])?$banners['phone']:""; ?>" style="width:510px" id="phone" class="st-forminput" name="phone" original-title="Your Phone"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Website</span>	
                                        <input type="text" value="<?php echo isset($banners['website'])?$banners['website']:""; ?>" style="width:510px" id="website" class="st-forminput" name="website" original-title="Your website"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                      <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Image</span>	
                                         <div class="profile_pic">
						                    	<div><img id="thumb_avatar" width="220" height="110" style="margin-bottom:10px;" src="<?php echo base_url(); ?> <?php if(isset($banners)) { ?><?php echo image($banners['avatar'],$settings['default_image'],220,120);?> <?php }?>"></div>
						                      	 <a class="clear-button" href="javascript:;" onclick="$('#image_avatar').val('');$('#thumb_avatar').attr('src','<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],220,120)?>');">Clear</a>
						                        <input type="hidden" name="avatar" value="<?php echo isset($banners['avatar'])?$banners['avatar']:"";?>" id="image_avatar" />		
												<input type="file" name="file_upload" id="upload_avatar" style="display:none;" />
						                       
						                        <script type="text/javascript">image_upload('image_avatar', 'thumb_avatar', 'upload_avatar','images','220','120');</script>
						                        
						                    </div>
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Company</span>	
                                        <input type="text" value="<?php echo isset($banners['company'])?$banners['company']:""; ?>" style="width:510px" id="company" class="st-forminput" name="company" original-title="Your Company"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                     <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Address 1</span>	
                                        <input type="text" value="<?php echo isset($banners['address1'])?$banners['address1']:""; ?>" style="width:510px" id="address1" class="st-forminput" name="address1" original-title="Your Address 1"> 
                                    	<div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                     <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Address 2</span>	
                                        <input type="text" value="<?php echo isset($banners['address2'])?$banners['address2']:""; ?>" style="width:510px" id="address2" class="st-forminput" name="address2" original-title="Your Address 2"> 
                                    	<div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Post Code</span>	
                                        <input type="text" value="<?php echo isset($banners['post_code'])?$banners['post_code']:""; ?>" style="width:510px" id="post_code" class="st-forminput" name="post_code" original-title="Your Post Code"> 
                                   		<div class="clear" style="z-index: 650;"></div>
                                    </div>
                                  
                                   	<div class="st-form-line">	<span class="st-labeltext">Country</span>	
                                   	<select id="country" name="country_id" onchange="setregion()">
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
                                    
                                    <div class="st-form-line">	<span class="st-labeltext">Region/State</span>	
                                   	<select id="region" name="region_id" onchange="setcity()">
                           	  		   <?php
										foreach($region_data as $item)
										{
											if(isset($banners['region_id']))
											{
												$checked=" ";
												if($banners['region_id']==$item['region_id'])
												{
													$checked=" selected";
												}
												
												echo "<option value='".$item['region_id']."'".$checked.">".$item['region_name']."</option>";
											}
											else
											{
												echo "<option value='".$item['region_id']."'>".$item['region_name']."</option>";
											}
										}
										?>
                               		</select>
                                    	<div class="clear"></div> 
                                    </div>
                                    
                                    <div class="st-form-line">	<span class="st-labeltext">City</span>	
	                                   	<select id="city" name="city_id" >
	                           	  		  <?php
											foreach($city_data as $item)
											{
												if(isset($banners['city_id']))
												{
													$checked=" ";
													if($banners['city_id']==$item['city_id'])
													{
														$checked=" selected";
													}
													
													echo "<option value='".$item['city_id']."'".$checked.">".$item['city_name']."</option>";
												}
												else
												{
													echo "<option value='".$item['city_id']."'>".$item['city_name']."</option>";
												}
											}
											?>
	                               		</select>
                                    	<div class="clear"></div> 
                                    </div>
                                    <div class="button-box" style="z-index: 460;">
                                    	<input type="hidden" name="currentid" value="<?php echo $id;?>">
                                    	<input type="hidden" name="type" value="profile">
                                    	<input type="hidden" name=" password" value="">
                                    	<input type="hidden" name="payment_id" value="<?php echo isset($banners['payment_id'])?$banners['payment_id']:""; ?>">
                                    	<input type="hidden" name="group_id" value="<?php echo isset($banners['group_id'])?$banners['group_id']:""; ?>">
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/setting" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                   	  
                                    </div>
                                  </form>
                                  
                                </div>
                            </div>
</div>
  <!-- END CONTENT -->