<script src="<?php echo base_url(); ?>assets/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/uploadify/uploadify.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/ckfinder/ckfinder.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/ckeditor/ckeditor.js"></script>
<link href="<?php echo base_url(); ?>assets/frontend/css/css.css" type="text/css" rel="stylesheet" /> 
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
.cancel{display:none;}
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

<style type="text/css">
.form a{color: red;}
.form a:hover{color: darkred;}
.Download_Name {width:220px;}
.Download_Name_a{width:220px;}
</style>
<script type="text/javascript">
function file_upload(field,upload,folder)
{
	$('#' + upload).uploadify({		
		'buttonText' : 'Browse', 
		'hideButton' : true,    
		'swf'      : '<?php echo base_url(); ?>assets/uploadify/uploadify.swf',		        
		'uploader' : '<?php echo base_url()?>uploadfile?folder='+folder,				
		'onUploadSuccess' : function(file, data, response) {
console.log(file);
			if(data=="1")
			{
				$('#' + upload + '-queue').hide();	
				alert("Warning: Incorrect file type!");
			}
			else
			{
				$('#' + upload + '-queue').hide();	
				$('#' + field).val(data);
				alert("Success: Your file has been uploaded!");	
			}							
				
			
		}		    
	});	
}
</script>

<!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>CONTENT MANAGER - <?php echo $id==""?"Add":"Edit"?> Download of Extension</h2>	<p>Extension manager - <?php echo $id==""?"Add":"Edit"?> Download of Extension</p></div>
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
                                  	<div class="date_description_amount_bg" style="background:none;width:auto;font-weight:bold;">
								      <div class="Download_Name" style="border:none;"><div style="color:black;">Download Name</div></div>
								     <div class="filename" style="border:none;">
								        <div style="color:black;">Filename</div>
								    </div>
								   <div class="Compatibility" style="border:none;width:250px;">
								   	<div style="color:black;">Compatibility</div>
								   </div>
								   <div class="Compatibility" style="border:none;width:100px;">	<div style="color:black;">Action</div></div>
								   <div class="clear"></div>               
									</div>	
                                    	<div id="list_download">
                            	<?php $extension_download_count=0; if (isset($extension_download) && count($extension_download)>0) {?>
                            	<?php foreach($extension_download as $download) {?>
                
                            	<div id="comp_<?php echo $extension_download_count;?>">
								<div class="date_descript">
								   <div class="Download_Name_a">
								   		<div style="margin:65px 0 0 0px;"><input type="text" name="extension_download[<?php echo $extension_download_count;?>][item_name]" value="<?php echo $download['item_name']?>" /></div>
								   </div>
								   <div class="filename_a profile_pic" style="margin:0px;">
								    	  
					                      <div class="update" style="margin:64px 0 0 10px; float:none;">
					                      <?php if($download['item_file']!="") {?> 
					                      	<input type="hidden" value="<?php echo $download['item_file']?>" id="extension_download<?php echo $extension_download_count?>" name ="extension_download[<?php echo $extension_download_count?>][item_file]"></input>
					                      	<?php }?>
					                      	<input id="download_<?php echo $extension_download_count;?>" name="item_file<?php echo $extension_download_count;?>" type="file" class="default" style="display:none;" />
					                        <script type="text/javascript">file_upload('extension_download<?php echo $extension_download_count?>', 'download_<?php echo $extension_download_count;?>','files');</script>
					                      </div>
					                </div>
								   <div class="Compatibility_a">
								   	<div class="Compatibility_div">
									    <?php foreach($compatibility as $com) {?>
									    
										<div>
									           <label class="checkbox" style="width:100px;">
								               <input <?php if(isset($download['list_com']) && $download['list_com']!=null) { if(in_array($com['compatibility_id'], $download['list_com'])) {?> checked <?php } }?> type="checkbox" name="extension_download[<?php echo $extension_download_count;?>][list_com][]" value="<?php echo $com['compatibility_id'];?>"> <?php echo $com['compatibility_name'];?>
								           </label>
								      	</div>
							           	<?php }?>
							        </div>
							       </div>
							      <div class="remove_button_a">
							      		<div class="update" style="margin:64px 0 0 55px; float:none;">
							           <a href="javascript:;" onclick="$('#comp_<?php echo $extension_download_count;?>').remove();">Remove</a>
							            </div> 
							      </div>';
							      <div class="clear"></div>               
							    </div>
							    </div>
							    <?php $extension_download_count++; } }?>
                            </div>
                            <div id="button_add_download" class="update" style="margin:10px 20px 0 0px; padding-bottom:10px; height:37px; border-bottom:#C3C3C3 solid 1px; float:none;">
                                    <a href="javascript:;" onclick="addDownload();" style="float:right">Add Download</a>
                             </div> 
                                    </div>
                                      <div class="button-box" style="z-index: 460;">
                                    	<input type="hidden" name="currentid" value="<?php echo $id;?>">
                                    	<input type="hidden" name="type" value="download">
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/extensions" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                   	 
                                    </div>
                                 </form>
</div>
</div>
</div>


<script type="text/javascript">
<!--
var extension_download_row = <?php echo $extension_download_count; ?>;
function addDownload() {
	html  = '<div id="comp_' + extension_download_row + '">';
	html += '<div class="date_descript">';
	html += '   <div class="Download_Name_a">';
	html += '   		<div style="margin:65px 0 0 0px;"><input type="text" name="extension_download['+extension_download_row+'][item_name]" /></div>';
	html += '   </div>';

	html += '<div class="filename_a profile_pic" style="margin:0px;">';
	html += '<div class="update" style="margin:64px 0 0 10px; float:none;">';
	html += '<input type="hidden" value="" id="extension_download'+extension_download_row+'" name ="extension_download['+extension_download_row+'][item_file]"></input>';
	html += '<input id="download_'+extension_download_row+'" name="item_file'+extension_download_row+'" type="file" class="default" style="display:none;" />';
	html +='<script type="text/javascript">file_upload("extension_download'+extension_download_row+'", "download_'+extension_download_row+'","files");</script>';
    html += '</div>';
	html += '</div>';
	html += '   <div class="Compatibility_a">';
	html += '   	<div class="Compatibility_div">';
		    	<?php foreach($compatibility as $com) {?>
	html += '<div>';
	html += '            <label class="checkbox" style="width:100px;">';
	html += '                <input type="checkbox" name="extension_download[' + extension_download_row + '][list_com][]" value="<?php echo $com['compatibility_id'];?>"> <?php echo $com['compatibility_name'];?>';
	html += '            </label>';
	html += '       	</div>';
           	<?php }?>
    html += '    </div>';
    html += '   </div>';
    html += '   <div class="remove_button_a">';
    html += '   		<div class="update" style="margin:70px 0 0 55px; float:none;">';
    html += '        <a href="javascript:;" onclick="$(\'#comp_' + extension_download_row + '\').remove();">Remove</a>';
    html += '        </div>   ';  
    html += '   </div>';
    html += '   <div class="clear"></div>  ';                  
    html += '</div>';
    html += '</div>';

	$('#button_add_download').before(html);
	extension_download_row++;
}
//--></script> 
           	