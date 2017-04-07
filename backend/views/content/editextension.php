<script src="<?php echo base_url(); ?>assets/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/uploadify/uploadify.css" rel="stylesheet">
<style>
input, textarea, .uneditable-input {
width:200px;
}
.profile_pic {
    float: left;
   /* margin: 10px 0 0 20px;*/
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
.cke_contents {
	height:150px;
}
</style>
<script type="text/javascript">
jQuery(document).ready(function (){
    CKFinder.setupCKEditor( null, '<?php echo base_url(); ?>assets/backend/js/ckfinder/' );
    // validate signup form on keyup and submit
});
var imgId;
var imgId1;
var imgId2;
function chooseImage(id)
{
  imgId = id;
  // You can use the "CKFinder" class to render CKFinder in a page:
  var finder = new CKFinder();
  finder.basePath = '/buysellscript/assets/backend/js/ckfinder/'; // The path for the installation of CKFinder (default = "/ckfinder/").
  finder.selectActionFunction = setFileField;
  finder.popup();
}
function chooseFile(id)
{
  imgId1 = id;
  // You can use the "CKFinder" class to render CKFinder in a page:
  var finder = new CKFinder();
  finder.basePath = '/buysellscript/assets/backend/js/ckfinder/'; // The path for the installation of CKFinder (default = "/ckfinder/").
  finder.selectActionFunction = setFileField1;
  finder.popup();
} 
function chooseListImage(id)
{
  imgId2 = id;
  // You can use the "CKFinder" class to render CKFinder in a page:
  var finder = new CKFinder();
  finder.basePath = '/buysellscript/assets/backend/js/ckfinder/'; // The path for the installation of CKFinder (default = "/ckfinder/").
  finder.selectActionFunction = setFileField2;
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
function setcustom()
{
	id = $('#category_id').val();
	jQuery.post("<?php echo base_url(); ?>getproperty", {name: id}, function( r ) {
			 $('#list_custom').html(r);
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
function setFileField1( fileUrl1 )
{
  document.getElementById( 'chooseImage_inputd' + imgId1).value = fileUrl1.substr(1,fileUrl1.length);
  alert("choose file successful");
}
function setFileField2( fileUrl2 )
{
	document.getElementById( 'chooseImage_imgi' + imgId2 ).src = '/buysellscript/'+fileUrl2;
	document.getElementById( 'chooseImage_inputi' + imgId2).value = fileUrl2.substr(1,fileUrl2.length);
	document.getElementById( 'chooseImage_divi' + imgId2).style.display = '';
	$('#chooseImage_imgi' + imgId2).attr('style','width:150px;height:auto;border:dashed thin;');
}
function clearImage(imgId)
{
  document.getElementById( 'chooseImage_img' + imgId ).src = '';
  document.getElementById( 'chooseImage_input' + imgId ).value = '';
  document.getElementById( 'chooseImage_div' + imgId).style.display = 'none';
  document.getElementById( 'chooseImage_noImage_div' + imgId).style.display = '';
}


   function check_information(){
		var input = $('#editextension input.require');
		for(var i=0;i<input.length;i++){
			var each = input[i];
			if($(each).val()==''){
				alert('Please Fill '+ $(each).parent().parent().find('span.lbname').text()+'!');
				$(each).focus();
				return false;
			}
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
         <div class="titlebar">	<h2>CONTENT MANAGER - <?php echo $id==""?"Add":"Edit"?> Extension</h2>	<p>Extension manager - <?php echo $id==""?"Add":"Edit"?> Extension</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <!-- START CONTENT -->
<div class="content">
<div class="simplebox grid740" style="z-index: 720;margin:0 auto;">
                            	<div class="titleh" style="z-index: 710;">
                                	<h3><?php echo $id==""?"Add":"Edit"?> Extension</h3>
                                </div>
                                <div class="body" style="z-index: 690;">
                                <form action="<?php echo base_url(); ?>backend.php/cpanel/extension_manipulate" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                                  
                                  	<div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Extension Name</span>	
                                        <input type="text" value="<?php echo isset($banners['name'])?$banners['name']:""; ?>" style="width:510px" id="name" class="st-forminput" name="name" original-title="Extension name to login"> 
                                        <?php if($this->session->flashdata('message_error')) {?><span style="margin-left:160px;" class="st-form-error"><?php echo $this->session->flashdata('message_error'); ?></span><?php }?>
                                    
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                    
                                    <div class="st-form-line">	<span class="st-labeltext">Extension Category</span>	
<!--                                   	<select id="category_id" name="category_id" onchange="setcustom()">-->
                                   	<select id="category_id" name="category_id">
                                   		 <?php
											foreach($extension_category as $item)
											{
												if(isset($banners['category_id']))
												{
													$checked=" ";
													if($banners['category_id']==$item['category_id'])
													{
														$checked=" selected";
													}
													
													echo "<option value='".$item['category_id']."'".$checked.">".$item['category_name']."</option>";
												}
												else
												{
													echo "<option value='".$item['category_id']."'>".$item['category_name']."</option>";
												}
											}
											?>
                               		</select>
                                    	<div class="clear"></div> 
                                    </div><!--
                                    <div id="list_custom">
                                    	<?php foreach($property_data as $pro) {?>
                                    		<div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext"><?php echo $pro['property_name'];?></span>	
                                        <input type="text" value="<?php echo isset($pro['property_value'])?$pro['property_value']:""; ?>" style="width:510px" id="custom_<?php echo $pro['value_id'];?>" class="st-forminput" name="custom[<?php echo $pro['value_id'];?>]"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    	<?php }?>
                                    </div>
                                    
                                    --><div id="list_custom1">
                                    	<?php $i=0; foreach($property_data_default as $pro) { ?>
                                    		<div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext"><?php echo $pro['property_name'];?></span>	
                                        <input type="text" value="<?php echo isset($pro['property_value'])?$pro['property_value']:""; ?>" style="width:510px" id="custom_default_<?php echo $pro['value_id'];?>" class="st-forminput" name="custom[<?php echo $pro['value_id'];?>]"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    	<?php $i++;}?>
                                    </div>
                                    
                                    <div class="st-form-line">	<span class="st-labeltext">User</span>	
	                                   	<select id="user_id" name="user_id">
	                                   		 <?php
												foreach($user_data as $item)
												{
													if(isset($banners['user_id']))
													{
														$checked=" ";
														if($banners['user_id']==$item['user_id'])
														{
															$checked=" selected";
														}
														
														echo "<option value='".$item['user_id']."'".$checked.">".$item['username']."</option>";
													}
													else
													{
														echo "<option value='".$item['user_id']."'>".$item['username']."</option>";
													}
												}
												?>
	                               		</select>
                                    	<div class="clear"></div> 
                                    </div>
                                    
                                     <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Image</span>	
                                         <div class="profile_pic">
                                         
						                    	<div><img id="thumb_avatar" width="220" height="110" style="margin-bottom:10px;" src="<?php echo base_url(); ?><?php if(isset($banners['image'])) { ?><?php echo image($banners['image'],$settings['default_image'],220,120);?> <?php }?>"></div>
						                      	 <a class="clear-button" href="javascript:;" onclick="$('#image_avatar').val('');$('#thumb_avatar').attr('src','<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],220,120)?>');">Clear</a>
						                        <input type="hidden" name="image" value="<?php echo isset($banners['image'])?$banners['image']:"";?>" id="image_avatar" />		
												<input type="file" name="file_upload" id="upload_avatar" style="display:none;" />
						                       
						                        <script type="text/javascript">image_upload('image_avatar', 'thumb_avatar', 'upload_avatar','images','220','120');</script>
						                        
						                    </div>
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                     <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">banner</span>	
                                            <div class="profile_pic">
						                    	<div><img id="thumb_banner"  width="220" height="110" style="margin-bottom:10px;" src="<?php echo base_url(); ?><?php if(isset($banners['banner'])) { ?><?php echo image($banners['banner'],$settings['default_image'],220,120);?><?php }?>"></div>
						                        <a class="clear-button" href="javascript:;" onclick="$('#image_banner').val('');$('#thumb_banner').attr('src','<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],220,120)?>');">Clear</a>
						                        <input type="hidden" name="banner" value="<?php echo isset($banners['banner'])?$banners['banner']:"";?>" id="image_banner" />		
												<input type="file" name="file_upload" id="upload_banner" style="display:none;" />
						                       
						                        <script type="text/javascript">image_upload('image_banner', 'thumb_banner', 'upload_banner','images','220','120');</script>
						                    </div>
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                     <div class="st-form-line">	<span class="st-labeltext">License</span>	
                                   	<select id="license_id" name="license_id" onchange="setregion()">
                                   		  <?php
											foreach($license as $item)
											{
												if(isset($banners['license_id']))
												{
													$checked=" ";
													if($banners['license_id']==$item['license_id'])
													{
														$checked=" selected";
													}
													
													echo "<option value='".$item['license_id']."'".$checked.">".$item['license_name']."</option>";
												}
												else
												{
													echo "<option value='".$item['license_id']."'>".$item['license_name']."</option>";
												}
											}
											?>
                               		</select>
                                    	<div class="clear"></div> 
                                    </div>
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Price</span>	
                                        <input type="text" value="<?php echo isset($banners['price'])?$banners['price']:""; ?>" style="width:510px" id="price" class="st-forminput" name="price" original-title="Price"> 
                                        <?php if($this->session->flashdata('message_error')) {?><span style="margin-left:160px;" class="st-form-error"><?php echo $this->session->flashdata('message_error'); ?></span><?php }?>
                                    
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                   <div class="st-form-line" style="z-index: 480;">	
                                    	<span class="st-labeltext">Description</span>
                                    	 <div style="width:510px;float:left;">	
                                        <textarea cols="47" rows="3" style="width:510px;" id="description" class="st-forminput ckeditor m-wrap" name="description"><?php echo isset($banners['description'])?$banners['description']:""; ?></textarea>
                                         </div>  
                                    <div class="clear" style="z-index: 470;"></div>
                                    </div>
                                   
                                    
                                    <div class="st-form-line" style="z-index: 480;">
                                    	
                                    	<span class="st-labeltext">Document</span>	
                                    	<div style="width:510px;float:left;">	
                                        <textarea cols="47" rows="3" style="width:510px;" id="document" class="st-forminput ckeditor m-wrap" name="document"><?php echo isset($banners['document'])?$banners['document']:""; ?></textarea>
                                        </div> 
                                    <div class="clear" style="z-index: 470;"></div>
                                    </div>
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Link Preview</span>	
                                        <input type="text" value="<?php echo isset($banners['link_preview'])?$banners['link_preview']:""; ?>" style="width:510px" id="price" class="st-forminput" name="link_preview" original-title="link Preview"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                     <div class="st-form-line" style="z-index: 620;">	
                                    	<span class="st-labeltext">Publish</span>	
                                    	<?php if(isset($banners['public']) && $banners['public'] ==1) {?>
                                    	<label class="margin-right10"><input checked value="1" type="radio" name="public" class="uniform"/>Yes</label>
                                    	<label class="margin-right10"><input value="0" type="radio" name="public" class="uniform"/>No</label>
                                    	<?php } else {?>
                                    	<label class="margin-right10"><input value="1" type="radio" name="public" class="uniform"/>Yes</label>
                                    	<label class="margin-right10"><input checked value="0" type="radio" name="public" class="uniform"/>No</label>
                                    	<?php }?>
                                  		<div class="clear" style="z-index: 610;"></div> 
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 620;">	
                                    	<span class="st-labeltext">Send update email to Purchasers</span>	
                                    	<?php if(isset($banners['send_to_purchase']) && $banners['send_to_purchase'] ==1) {?>
                                    	<label class="margin-right10"><input checked value="1" type="radio" name="send_to_purchase" class="uniform"/>Yes</label>
                                    	<label class="margin-right10"><input value="0" type="radio" name="send_to_purchase" class="uniform"/>No</label>
                                    	<?php } else {?>
                                    	<label class="margin-right10"><input value="1" type="radio" name="send_to_purchase" class="uniform"/>Yes</label>
                                    	<label class="margin-right10"><input checked value="0" type="radio" name="send_to_purchase" class="uniform"/>No</label>
                                    	<?php }?>
                                  		<div class="clear" style="z-index: 610;"></div> 
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 620;">	
                                    	<span class="st-labeltext">Status</span>	
                                    	<?php if (isset($banners['status']) && $banners['status']==1){?>
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
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/extensions" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                   	 
                                    </div>
                                  </form>
                                  
                                </div>
                            </div>
</div>
  <!-- END CONTENT -->