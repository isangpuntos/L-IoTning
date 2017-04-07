<link href="<?php echo base_url(); ?>assets/uploadify/uploadify.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/ckfinder/ckfinder.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/ckeditor/ckeditor.js"></script> 
<link href="<?php echo base_url(); ?>assets/frontend/css/css.css" type="text/css" rel="stylesheet" /> 
<style type="text/css">
.form a{color: red;}
.form a:hover{color: darkred;}
.Download_Name {width:220px;}
.Download_Name_a{width:220px;}
</style>
<style>

body {
    padding-bottom: 40px;
    padding-top: 80px;
    position: relative;
}
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
.uploadify-button {
	color:white !important;
}
.uploadify {
	margin:0px;
	padding:0px;
	float:left;
}
.cancel {
	display:none;
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
				alert("Success: Your file has been uploaded!");	
				 $('#' + upload + '-queue').hide();	
			}
			
		}		    
	});	
} 
</script>

<!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>CONTENT MANAGER - <?php echo $id==""?"Add":"Edit"?> Image of Extension</h2>	<p>Extension manager - <?php echo $id==""?"Add":"Edit"?> Image of Extension</p></div>
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
                                  
                                  	<div style="padding:0px;">
                            	<div class="date_description_amount_bg" style="background:none;">
                                <div class="images" style="font-weight: bold;border-right:none;width:auto;">
                                	<div class="images1" style="width:290px;color:black;">
                                    	<div style="color:black;">Images</div>
                                    </div>
                                    <div class="images_name"  style="width:360px;color:black;" >
                                    	<div style="color:black;">Image Name</div>
                                    </div>
                                     <div class="images_name"><div style="color:black;">Action</div></div>
                                </div>
                               
                                <div class="clear"></div>                    
                            </div>
                            <div id="list_image">
                            <?php $extension_image_count=0; if (isset($allIMG) && count($allIMG)>0) {?>
                            <?php foreach($allIMG as $img) {?>
                            <div id="img_<?php echo $extension_image_count;?>" class="date_description_a" style="min-height:170px;">
                                <div class="images" style="min-height:170px;">
                                    <div style="width: 250px;float:left;padding:20px;"  class="imagesi<?php echo $extension_image_count;?>">
		                               
		                               <div class="profile_pic">
					                        <div><img id="thumb_list<?php echo $extension_image_count?>" style="margin-bottom:10px;" src="<?php echo base_url(); ?><?php echo image($img['image'],$settings['default_image'],220,120);?>"></div>
					                        <a class="clear-button" href="javascript:;" onclick="$('#image_list<?php echo $extension_image_count?>').val('');$('#thumb_list<?php echo $extension_image_count?>').attr('src','<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],220,120)?>');">Clear</a>
					                        <input type="hidden" name="extension_image[<?php echo $extension_image_count?>][image]" value="<?php echo $img['image'];?>" id="image_list<?php echo $extension_image_count?>" />		
											<input type="file" name="file_upload" id="upload_list<?php echo $extension_image_count?>" style="display:none;" />
					                        <script type="text/javascript">image_upload('image_list<?php echo $extension_image_count?>', 'thumb_list<?php echo $extension_image_count?>', 'upload_list<?php echo $extension_image_count?>','images','220','120');</script>
					                        
					                   </div>
					                   
                                    </div>
                                    
                                    <div class="images_name">
                                    	<div style="margin-top:50px;"><input type="text" value="<?php echo $img['name']; ?>" name="extension_image[<?php echo $extension_image_count?>][name]" /></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="images_button">	
                                	<div class="update" style="margin:75px 0 0 40px; float:none;">
                                    <a href="javascript:;" onclick="$('#img_<?php echo $extension_image_count;?>').remove();">Remove</a>
                                    </div>                                
                                </div>
                                <div class="clear"></div>                    
                            </div>
                            <?php $extension_image_count++;} } ?>

                        	  <div id="button_add_image" class="update" style="margin:10px 20px 0 0px; padding-bottom:10px; height:37px; border-bottom:#C3C3C3 solid 1px; float:none;">
                                    <a href="javascript:;" onclick="addImage();" style="float:right">Add Image</a>  
                        	</div>
                        
                            </div>
                        </div>

                                      <div class="button-box" style="z-index: 460;">
                                    	<input type="hidden" name="currentid" value="<?php echo $id;?>">
                                    	<input type="hidden" name="type" value="images">
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/extensions" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                   	 
                                    </div>
                                 </form>
</div>
</div>
</div>

<script type="text/javascript"><!--
var extension_image_row = <?php echo $extension_image_count; ?>;
function addImage() {
	html  = '<div id="img_'+extension_image_row+'" class="date_description_a" style="min-height:170px;">';
	html += '<div class="images" style="min-height:170px;">';
	
	html += '<div style="width: 250px;float:left;padding:20px;" class="imagesi'+extension_image_row+'">';

	html += '<div class="profile_pic">';
	html += '<div><img id="thumb_list'+extension_image_row+'" style="margin-bottom:10px;" src="<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],220,120)?>"></div>';
	html += '<a class="clear-button" href="javascript:;" onclick="$(\"#image_list'+extension_image_row+'\").val("");$(\"#thumb_list'+extension_image_row+'\").attr(\"src\",\"<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],220,120)?>\");">Clear</a>';
	html += '<input type="hidden" name="extension_image['+extension_image_row+'][image]" value="" id="image_list'+extension_image_row+'" />';		
	html += '<input type="file" name="file_upload" id="upload_list'+extension_image_row+'" style="display:none;" />';	
	html +='<script type="text/javascript">image_upload("image_list'+extension_image_row+'", "thumb_list'+extension_image_row+'","upload_list'+extension_image_row+'","files","220","120");</script>';
	html += '</div>';	
	html += '</div>';
	html += '<div class="images_name">';
	html += '	<div style="margin-top:80px;"><input type="text" name="extension_image['+extension_image_row+'][name]" /></div>';
	html += '</div>';
	html += '<div class="clear"></div>';
	html += '</div>';
	html += '<div class="images_button">	';
	html += '<div class="update" style="margin:70px 0 0 25px; float:none;">';
	html += '<a href="javascript:;" onclick="$(\'#img_'+extension_image_row+'\').remove();">Remove</a>';
	html += '</div>  ';                              
	html += '</div>';
	html += '<div class="clear"></div> ';                   
	html += '</div>';
	$('#button_add_image').before(html);
	extension_image_row++;
}
//--></script> 