<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/zozo.tabs.min.js"></script>
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

	function setcustom()
	{
		id = $('#category').val();
		jQuery.post("<?php echo base_url(); ?>getproperty_frontend", {name: id}, function( r ) {
				 $('#list_custom').html(r);
	            });
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
					alert("Success: Your file has been uploaded!");	
					 $('#' + upload + '-queue').hide();	
				}
				
			}		    
		});	
	}   
	function file_upload(field,upload,folder)
	{
		$('#' + upload).uploadify({		
			'buttonText' : 'Browse', 
			'hideButton' : true,    
			'swf'      : '<?php echo base_url(); ?>assets/uploadify/uploadify.swf',		        
			'uploader' : '<?php echo base_url()?>uploadfile?folder='+folder,				
			'onUploadSuccess' : function(file, data, response) {
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
<div class="bg_img">
            	<div class="bg_img_in">
                	<h1><span> <?=_l('Submit an  </span> Extensions',$this);?></h1>
                </div>
            </div>
            
            <div class="Extensions_bg">
            <form class="form-horizontal" style="width:auto;" onsubmit="return check_information();" id="editextension" enctype="multipart/form-data" method="post" action="">
           
           	<div class="Manage_Description">
           		<?php if(isset($message_error)){?>
           		<div class="warning">Error: <?php echo $message_error;?></div>
           		<?php }?>
            	<div class="Description_Manage"><?=_l('Submission Details',$this);?></div>
                <ul>
                	<li><?=_l('All uploaded files must be in zip or rar format and less than 5MB.',$this);?></li>
                    <li><?=_l('pease remember to include install instructions with each extension uploaded',$this);?></li>
                </ul>
                
                <div id="example" class="k-content">

            <div id="animation"> 
                <div id="tabbed-nav">
                    <ul>
                        <li><a><?=_l('General',$this);?></a></li>
                        <li><a><?=_l('Description',$this);?></a></li>
                        <li><a><?=_l('Documentation',$this);?></a></li>
                        <li><a><?=_l('Downloads',$this);?></a></li>
                        <li><a><?=_l('Images',$this);?></a></li>
                        <li><a><?=_l('Tags',$this);?></a></li>
                    </ul>

                    <div>
                        <div>
                        
                        <div class="control-group">
                            <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('Extension Name',$this);?></span>:</label>
                            <div class="controls" style="margin-left:319px;">
                            <input type="text" class="require" name="data[name]" value="<?php echo $extension['name'];?>" id="extension_name" placeholder="">
                            </div>
                        </div>
                            <div class="control-group" style="width:400px;">
                            <label class="control-label" for="Exension Category"><?=_l('Exension Category',$this);?>:</label>
                            <div class="Exension Category" style="margin-left:319px;">
<!--                            <select name="data[category_id]" id="category" onchange="setcustom()">-->
                            <select name="data[category_id]" id="category" >
							<?php
							foreach($extension_category as $item)
							{
								if(isset($extension['category_id']))
								{
									$checked=" ";
									if($extension['category_id']==$item['category_id'])
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
                            
                            </div>
                            </div><!--
                             <div id="list_custom">
                             <?php foreach($property_data as $pro) {?>
                              <div class="control-group">
		                        <label class="control-label" for="Advanced multiple Forms"><?php echo $pro['property_name'];?>:</label>
		                        <div class="controls" style="margin-left:319px;">
		                        <input type="text" class="require" name="data[custom][<?php echo $pro['value_id'];?>]" value="<?php echo isset($pro['property_value'])?$pro['property_value']:""; ?>" id="custom_<?php echo $pro['value_id'];?>" placeholder="">
		                        </div>
		                      </div>
		                      <?php }?>
                             </div>
                             
                             --><div id="list_custom1">
                             <?php foreach($property_data_default as $pro) {?>
                              <div class="control-group">
		                        <label class="control-label" for="Advanced multiple Forms"><?php echo $pro['property_name'];?>:</label>
		                        <div class="controls" style="margin-left:319px;">
		                        <input type="text" name="data[custom][<?php echo $pro['value_id'];?>]" value="<?php echo isset($pro['property_value'])?$pro['property_value']:""; ?>" id="custom_default_<?php echo $pro['value_id'];?>" placeholder="">
		                        </div>
		                      </div>
		                      <?php }?>
                             </div>
                            
                            <div class="profile_text_1" style="width:250px; margin-right:30px;">
                                <div><?=_l('Images',$this);?>:</div>
                            </div>
                            
                            <div class="profile_pic">
		                    	<div><img id="thumb_avatar" style="margin-bottom:10px;" src="<?php echo base_url(); ?><?php echo image($extension['image'],$settings['default_image'],220,120);?>"></div>
		                      	 <a class="clear-button" href="javascript:;" onclick="$('#image_avatar').val('');$('#thumb_avatar').attr('src','<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],220,120)?>');">Clear</a>
		                        <input type="hidden" name="data[image]" value="<?php echo $extension['image'];?>" id="image_avatar" />		
								<input type="file" name="file_upload" id="upload_avatar" style="display:none;" />
		                       
		                        <script type="text/javascript">image_upload('image_avatar', 'thumb_avatar', 'upload_avatar','images','220','120');</script>
		                        
		                    </div>
                        
                            <div class="clear"></div>
                            
                            <div class="profile_text_1" style="width:250px; margin-right:30px;">
                                <div><?=_l('Banner',$this);?>:</div>
                                <div style="font-size:10px; font-family:Arial, Helvetica, sans-serif; color:#999999;"><?=_l('this will be used on the extension info page aswell as a banner if your extension gets added to the fegture list. size should be 693x200',$this);?>
								</div>
                            </div>
                           
		                     <div class="profile_pic">
		                    	<div><img id="thumb_banner" style="margin-bottom:10px;" src="<?php echo base_url(); ?><?php echo image($extension['banner'],$settings['default_image'],220,120);?>"></div>
		                        <a class="clear-button" href="javascript:;" onclick="$('#image_banner').val('');$('#thumb_banner').attr('src','<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],220,120)?>');">Clear</a>
		                        <input type="hidden" name="data[banner]" value="<?php echo $extension['banner'];?>" id="image_banner" />		
								<input type="file" name="file_upload" id="upload_banner" style="display:none;" />
		                       
		                        <script type="text/javascript">image_upload('image_banner', 'thumb_banner', 'upload_banner','images','220','120');</script>
		                    </div>
		                    
                            <div class="clear"></div>
                            <div class="control-group" style="width:400px; margin-top:20px;">
                            <label class="control-label" for="Lecense"><?=_l('License',$this);?>:</label>
                            <div class="Exension Category" style="margin-left:319px;">
                            <select id="Lecense" name="data[license_id]">
                               <?php
								foreach($license as $item)
								{
									if(isset($extension['license_id']))
									{
										$checked=" ";
										if($extension['license_id']==$item['license_id'])
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
                            
                            </div>
                            </div>
                        <div class="control-group">
	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('Price (USD)',$this);?></span>:</label>
	                        <div class="controls" style="margin-left:319px;">
	                        <input type="text" class="require" value="<?php echo $extension['price'];?>" id="Advanced multiple Forms" name="data[price]" placeholder="">
	                        </div>
                        </div>
                        
                        <div class="control-group">
	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('Link Preview',$this);?></span>:</label>
	                        <div class="controls" style="margin-left:319px;">
	                        <input type="text" class="require" value="<?php echo $extension['link_preview'];?>" id="Advanced multiple Forms" name="data[link_preview]" placeholder="">
	                        </div>
                        </div>
                        
                        <div class="control-group" >
                        <div class="controls" style="margin-left:0px; width:560px;">
                        <label class="checkbox" style="float:left; width:285px;">
                        <div><?=_l('Publish',$this);?>:</div>
 						</label>
 						<?php if (isset($extension) && $extension['public'] == 1) {?>
                        <div style="float:left; margin:6px 0 0 0;"><input checked value="1" name="data[public]" type="radio" style="margin:-1px 0 0 14px;"> <?=_l('Yes',$this);?></div>
                        <div style="float:left; margin:6px 0 0 0;"><input value="0" name="data[public]" type="radio" style="margin:-1px 0 0 14px;"> <?=_l('No',$this);?></div>
                        <?php } else {?>
                        <div style="float:left; margin:6px 0 0 0;"><input value="1" name="data[public]" type="radio" style="margin:-1px 0 0 14px;"> <?=_l('Yes',$this);?></div>
                        <div style="float:left; margin:6px 0 0 0;"><input checked name="data[public]" value="0" type="radio" style="margin:-1px 0 0 14px;"> <?=_l('No',$this);?></div>
                        <?php }?>
                        <div class="clear"></div>
                        
                        </div>
                        </div>
                        <div class="control-group" >
                        <div class="controls" style="margin-left:0px; width:560px;">
                        <label class="checkbox" style="float:left; width:285px;">
                        	<div><?=_l('Send update email to Purchasers',$this);?>:</div>
                        </label>
                        <?php if (isset($extension) && $extension['send_to_purchase'] == 1) {?>
                        <div style="float:left; margin:6px 0 0 0;"><input checked value="1" name="data[send_to_purchase]" type="radio" style="margin:-1px 0 0 14px;"> <?=_l('Yes',$this);?></div>
                        <div style="float:left; margin:6px 0 0 0;"><input value="0" name="data[send_to_purchase]" type="radio" style="margin:-1px 0 0 14px;"> <?=_l('No',$this);?></div>
                        <?php  } else {?>
                        <div style="float:left; margin:6px 0 0 0;"><input value="1" name="data[send_to_purchase]" type="radio" style="margin:-1px 0 0 14px;"> <?=_l('Yes',$this);?></div>
                        <div style="float:left; margin:6px 0 0 0;"><input checked name="data[send_to_purchase]" value="0" type="radio" style="margin:-1px 0 0 14px;"> <?=_l('No',$this);?></div>
                        <?php } ?>
                        <div class="clear"></div>
                        
                        </div>
                        </div>
                        
                         <div class="control-group" >
                        <div class="controls" style="margin-left:0px; width:560px;">
                        <label class="checkbox" style="float:left; width:285px;">
                        	<div><?=_l('Shipping',$this);?>:</div>
                        </label>
                        <?php if (isset($extension) && $extension['shipping'] == 1) {?>
                        <div style="float:left; margin:6px 0 0 0;"><input checked value="1" name="data[shipping]" onclick="show(1)" type="radio" style="margin:-1px 0 0 14px;"> <?=_l('Yes',$this);?></div>
                        <div style="float:left; margin:6px 0 0 0;"><input value="0" name="data[shipping]" onclick="show(0)" type="radio" style="margin:-1px 0 0 14px;"> <?=_l('No',$this);?></div>
                        <?php  } else {?>
                        <div style="float:left; margin:6px 0 0 0;"><input value="1" name="data[shipping]" onclick="show(1)" type="radio" style="margin:-1px 0 0 14px;"> <?=_l('Yes',$this);?></div>
                        <div style="float:left; margin:6px 0 0 0;"><input checked name="data[shipping]" onclick="show(0)" value="0" type="radio" style="margin:-1px 0 0 14px;"> <?=_l('No',$this);?></div>
                        <?php } ?>
                        <div class="clear"></div>
                        
                        </div>
                        
                        </div>
                        <div id="shipping" <?php if (isset($extension) && $extension['shipping'] == 1) {?>style="display:block;" <?php }  else {?>style="display:none;"<?php }?>>
                        <div class="control-group">
    	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('weight',$this);?></span>:</label>
    	                        <div class="controls" style="margin-left:319px;">
    	                        <input type="text" id="weight" <?php if (isset($extension) && $extension['shipping'] == 1) {?> class="require" <?php }?> value="<?php echo $extension['weight'];?>" id="Advanced multiple Forms" name="data[weight]" placeholder="">
    	                        </div>
                        </div>
                        <div class="control-group">
    	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('Price per weight',$this);?></span>:</label>
    	                        <div class="controls" style="margin-left:319px;">
    	                        <input type="text" id="priceperweight" <?php if (isset($extension) && $extension['shipping'] == 1) {?> class="require" <?php }?> value="<?php echo $extension['priceperweight'];?>" id="Advanced multiple Forms" name="data[priceperweight]" placeholder="">
    	                        </div>
                            </div>
                        </div>
                        <div class="clear"></div>                      
                        </div>
                        <div style="padding:0px;">
                            <div>
                            	<textarea class="span12 ckeditor m-wrap" name="data[description]" id="description2" style="width: 761px; padding-left: 6px; height: 229px; margin-bottom: 0px;"><?php echo $extension['description'];?></textarea>
                            </div>
                           
<!--                    	<div class="choose_text" style="width:720px; height:230pX;">-->
<!--                        	<p>1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>-->
<!--                            <p>2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>-->
<!--                            <p>3. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>-->
<!--                            <p>4. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>-->
<!--                            <p>5. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>-->
<!--                            <p>6. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>-->
<!--                        </div>-->
                        </div>
                        <div style="padding:0px;">
                            <div>
                            	<textarea class="span12 ckeditor m-wrap" name="data[document]" style="width: 761px; padding-left: 6px; height: 229px; margin-bottom: 0px;"><?php echo $extension['document'];?></textarea>
                            </div>
                        </div>
                        
                        <div style="padding:0px;">
                        	 <div class="date_description_amount_bg">
								      <div class="Download_Name"><div><?=_l('Download Name',$this);?></div></div>
								     <div class="filename">
								        <div><?=_l('Filename',$this);?></div>
								    </div>
								   <div class="Compatibility">
								   	<div><?=_l('Compatibility',$this);?></div>
								   </div>
								   <div class="remove_button"></div>
								   <div class="clear"></div>               
							</div>
                            <div id="list_download">
                            	<?php $extension_download_count=0; if (isset($extension_download) && count($extension_download)>0) {?>
                            	<?php foreach($extension_download as $download) {?>
                            	<div id="comp_<?php echo $extension_download_count;?>">
								<div class="date_descript">
								   <div class="Download_Name_a">
								   		<div style="margin:70px 0 0 45px;"><input type="text" name="extension_download[<?php echo $extension_download_count;?>][item_name]" value="<?php echo $download['item_name']?>" /></div>
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
								               <input <?php if(isset($download['list_com']) && $download['list_com']!=null && in_array($com['compatibility_id'], $download['list_com'])) {?> checked <?php }?> type="checkbox" name="extension_download[<?php echo $extension_download_count;?>][list_com][]" value="<?php echo $com['compatibility_id'];?>"> <?php echo $com['compatibility_name'];?>
								           </label>
								      	</div>
							           	<?php }?>
							        </div>
							       </div>
							      <div class="remove_button_a">
							      		<div class="update" style="margin:70px 0 0 25px; float:none;">
							           <a href="javascript:;" onclick="$('#comp_<?php echo $extension_download_count;?>').remove();"><?=_l('Remove',$this);?></a>
							            </div> 
							      </div>
							      <div class="clear"></div>               
							    </div>
							    </div>
							    <?php $extension_download_count++; } }?>
                            </div>
                             <div id="button_add_download" class="update" style="margin:10px 20px 0 0px; padding-bottom:10px; height:37px; border-bottom:#C3C3C3 solid 1px; float:none;">
                                    <a href="javascript:;" onclick="addDownload();" style="float:right"><?=_l('Add Download',$this);?></a>
                             </div>  
                                    
                        </div>
                        
                        <div style="padding:0px;">
                            <div class="date_description_amount_bg">
                                <div class="images">
                                	<div class="images1" style="width:300px;">
                                    	<div><?=_l('Images',$this);?></div>
                                    </div>
                                    <div class="images_name" >
                                    	<div><?=_l('images Name',$this);?></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="images_button"></div>
                                <div class="clear"></div>                    
                            </div>
                            <div id="list_image">
                            <?php $extension_image_count=0; if (isset($extension_image) && count($extension_image)>0) {?>
                            <?php foreach($extension_image as $img) {?>
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
                                    	<div style="margin-top:80px;"><input type="text" value="<?php echo $img['name']; ?>" name="extension_image[<?php echo $extension_image_count?>][name]" /></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="images_button">	
                                	<div class="update" style="margin:80px 0 0 40px; float:none;">
                                    <a href="javascript:;" onclick="$('#img_<?php echo $extension_image_count;?>').remove();"><?=_l('Remove',$this);?></a>
                                    </div>                                
                                </div>
                                <div class="clear"></div>                    
                            </div>
                            <?php $extension_image_count++;} } ?>

                             <div id="button_add_image" class="update" style="margin:10px 20px 0 0px; padding-bottom:10px; height:37px; border-bottom:#C3C3C3 solid 1px; float:none;">
                                    <a href="javascript:;" onclick="addImage();" style="float:right"><?=_l('Add Image',$this);?></a>  
                        	</div>
                        
                            </div>
                        </div>
                        <div style="padding:0px;">
                            <div>
                            	<textarea name="data[tag]" style="width: 761px; padding-left: 6px; height: 229px; margin-bottom: 0px;"><?php echo $extension['tag'];?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>

    <style>
        #animation {
            width: 774px;
            padding: 15px 0px 0 0px;
            float: left;
        }

        #config-wrapper {
            float: left;
        }

        .options {
            position: relative;
        }

        #duration {
            position: absolute;
            right: 0;
        }

        .z-content {
		min-height:240px;
        }
		
		
    </style>



    <script>
        $(document).ready(function () {
            var tabbedNav = $("#tabbed-nav").zozoTabs({
                orientation: "horizontal",
                animation: { duration: 200 },                
                defaultTab: "tab1"
            });

            $("#duration").change(function () {
                var duration = parseInt($("#duration").val());
                tabbedNav.data("zozoTabs").setOptions({ "animation": { "duration": duration } });
            });

            $("#config input").change(function () {
                var effects = $('input[type=radio]:checked').attr("id");
                tabbedNav.data("zozoTabs").setOptions({ "animation": { "effects": effects } });
            });
        });
    </script>
    <div class="clear"></div>
                
                <div class="captcha">
                	<div class="captcha_text">
                    	<div class="captcha_a"><span class="required">*</span><span class="lbname"><?=_l('Captcha',$this);?></span></div>
                        <div class="enter_the"><?=_l('Enter the code in the box below',$this);?>:</div>
                    </div>
                    <div class="captcha_img">
                    	<input value="" type="text" class="require" name="data[captcha]"  style="width:180px; margin:0 0 5px 0;"/>
                        <div><?php echo $cap_image;?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <input type="hidden" name="data[current_id]" value="<?php echo $current_id;?>">
                <div class="Choose_payment_text1" style="width:756px;" >
                    	  <div style="float:left; margin:0px;" class="update"><a href="<?php echo base_url(); ?>profile-extension"><?=_l('Back',$this);?></a></div>
                            <div class="update" style="margin:0px;"><input type="submit" name="submit" value="<?=_l('Submit',$this);?>"></div>
                            <div class="clear"></div>
                    </div>
            </div>
            </form>
            	 <div class="account_right_links">
                <div><?=_l('Your Account',$this);?></div>
                	<ul>
                    	<li><a href="<?php echo base_url(); ?>profile"><?=_l('Account',$this);?></a></li>
                        <li><a  href="<?php echo base_url(); ?>profile-detail"><?=_l('Edit Details',$this);?></a></li>
                         <li><a href="<?php echo base_url(); ?>profile/address"><?=_l('Manage Address',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-password"><?=_l('Chang Password',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-history"><?=_l('Order History',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-download"><?=_l('Your Downloads',$this);?> </a></li>
                        <li><a class="select" href="<?php echo base_url(); ?>profile-extension"><?=_l('Manage Extensions',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile/sale"><?=_l('Your Sales',$this);?></a></li>
                        <li><a href="<?php echo base_url(); ?>profile/transaction"><?=_l('Transaction',$this);?></a></li>
                    </ul>
                    <!--<div class="Export">Export CSV</div>-->
                </div>
               
                <div class="clear"></div>
                
            </div>
 
 
<script type="text/javascript"><!--
function show(type)
{
    if(type==0)
    {
        $('#shipping').hide();
        $('#weight').removeClass('require');
        $('#priceperweight').removeClass('require');
    }	
    else
    {
    	$('#shipping').show();
    	$('#weight').addClass('require');
        $('#priceperweight').addClass('require');
    }
}
var extension_download_row = <?php echo $extension_download_count; ?>;
function addDownload() {
	html  = '<div id="comp_' + extension_download_row + '">';
	html += '<div class="date_descript">';
	html += '   <div class="Download_Name_a">';
	html += '   		<div style="margin:70px 0 0 45px;"><input type="text" name="extension_download['+extension_download_row+'][item_name]" /></div>';
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
    html += '   		<div class="update" style="margin:70px 0 0 25px; float:none;">';
    html += '        <a href="javascript:;" onclick="$(\'#comp_' + extension_download_row + '\').remove();"><?=_l('Remove',$this);?></a>';
    html += '        </div>   ';  
    html += '   </div>';
    html += '   <div class="clear"></div>  ';                  
    html += '</div>';
    html += '</div>';

	$('#button_add_download').before(html);
	extension_download_row++;
}
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
	html += '<a href="javascript:;" onclick="$(\'#img_'+extension_image_row+'\').remove();"><?=_l('Remove',$this);?></a>';
	html += '</div>  ';                              
	html += '</div>';
	html += '<div class="clear"></div> ';                   
	html += '</div>';
	$('#button_add_image').before(html);
	extension_image_row++;
}
//--></script> 