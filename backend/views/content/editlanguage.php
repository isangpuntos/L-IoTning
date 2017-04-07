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
</style><!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>LANGUAGE MANAGER - <?php echo $id==""?"Add":"Edit"?> Language</h2>	<p>Language manager - <?php echo $id==""?"Add":"Edit"?> Language</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <script type="text/javascript">
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
  $('#chooseImage_img' + imgId).attr('style','width:40px;height:auto;border:dashed thin;');
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
 <!-- START CONTENT -->
<div class="content">
<div class="simplebox grid740" style="z-index: 720;margin:0 auto;">
                            	<div class="titleh" style="z-index: 710;">
                                	<h3><?php echo $id==""?"Add":"Edit"?> Language</h3>
                                </div>
                                <div class="body" style="z-index: 690;">
                                <form action="<?php echo base_url(); ?>backend.php/cpanel/language_manipulate" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                               
                                  	<div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Language Name</span>	
                                        <input type="text" value="<?php echo isset($banners['language_name'])?$banners['language_name']:""; ?>" style="width:510px" id="language_name" class="st-forminput" name="language_name" original-title="Language name"> 
                                        <?php if($this->session->flashdata('message_error')) {?><span style="margin-left:160px;" class="st-form-error"><?php echo $this->session->flashdata('message_error'); ?></span><?php }?>
                                    
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Code</span>	
                                        <input type="text" value="<?php echo isset($banners['code'])?$banners['code']:""; ?>" style="width:510px" id="code" class="st-forminput" name="code" original-title="Code"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                   <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Image</span>	
                                         <div class="profile_pic">
						                    	<div><img id="thumb_avatar" width="220" height="110" style="margin-bottom:10px;" src="<?php echo base_url(); ?> <?php if(isset($banners)) { ?><?php echo image($banners['image'],$settings['default_image'],220,120);?> <?php }?>"></div>
						                      	 <a class="clear-button" href="javascript:;" onclick="$('#image_avatar').val('');$('#thumb_avatar').attr('src','<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],220,120)?>');">Clear</a>
						                        <input type="hidden" name="image" value="<?php echo isset($banners['image'])?$banners['image']:"";?>" id="image_avatar" />		
												<input type="file" name="file_upload" id="upload_avatar" style="display:none;" />
						                       
						                        <script type="text/javascript">image_upload('image_avatar', 'thumb_avatar', 'upload_avatar','images','220','120');</script>
						                        
						                    </div>
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Sort Order</span>	
                                        <input type="text" value="<?php echo isset($banners['sort_order'])?$banners['sort_order']:""; ?>" style="width:510px" id="sort_order" class="st-forminput" name="sort_order" original-title="Sort order"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 620;">	
                                    	<span class="st-labeltext">Default</span>	
                                    	<label class="margin-right10"><input <?php if (isset($banners['default']) && $banners['default']==1 ) {?> checked <?php } ?> value="1" type="checkbox" name="default" class="uniform"/> Default </label>
                                  		<div class="clear" style="z-index: 610;"></div> 
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 620;">	
                                    	<span class="st-labeltext">Status</span>	
                                    	<?php if (isset($banners['public']) && $banners['public']==1){?>
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
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/language" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                   	 
                                    </div>
                                  </form>
                                  
                                </div>
                            </div>
</div>
  <!-- END CONTENT -->