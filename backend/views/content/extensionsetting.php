<!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>FORM SETTING -  Extension Setting</h2>	<p>Form setting - Extension Setting</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <!-- START CONTENT -->
<div class="content">
<div class="simplebox grid740" style="z-index: 720;margin:0 auto;">
                            	<div class="titleh" style="z-index: 710;">
                                	<h3>Extension Setting</h3>
                                </div>
                                <div class="body" style="z-index: 690;">
                                <form action="<?php echo base_url(); ?>backend.php/cpanel/category_manipulate" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                                  	 <?php if($this->session->flashdata('message')){?>
						        <div class="albox succesbox" style="z-index: 690;">
                                	<b>Succes :</b> <?php echo $this->session->flashdata('message'); ?>
                                	<a class="close tips" href="#" original-title="close">close</a>
                                </div>
								<?php } ?>
								<?php if($this->session->flashdata('message_error')){?>
							      	<div class="albox errorbox" style="z-index: 670;">
	                                	<b>Error :</b> <?php echo $this->session->flashdata('message_error'); ?> 
	                                	<a class="close tips" href="#" original-title="close">close</a>
	                                </div>
								<?php } ?>
                                  	<div id="list_property">
									<?php $i=1; foreach($banners as $ban) {?>
	                                  	<div id="pro_<?php echo $i;?>" class="st-form-line" style="z-index: 680;">	
	                                    	<span class="st-labeltext">Property Name</span>	
	                                        <input type="text" value="<?php echo isset($ban['property_name'])?$ban['property_name']:""; ?>" style="width:400px" id="property" class="st-forminput" name="property[<?php echo $ban['value_id'];?>]" original-title="Property name"> 
	                                    	 <a style="margin-left:15px;" href="javascript:;" onclick="$('#pro_<?php echo $i;?>').remove();">Remove</a>
	                                    	<div class="clear" style="z-index: 670;"></div>
	                                    </div>
                                    <?php $i++;}?>
                                    
                                    </div>
                                    <div id="button_add_property" class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext"></span>	
                                        <a href="javascript:addmore()" class="button-gray">&laquo; Add More</a> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    <div class="button-box" style="z-index: 460;">
                                      <input type="hidden" name="currentid" value="0">
                                      <input type="hidden" name="type" value="property">
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/extensionsetting" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                    </div>
                                  </form>
                                  
                                </div>
                            </div>
</div>
<!-- END CONTENT -->

<script type="text/javascript">
var extension_property = <?php echo ($i+9000); ?>;
function addmore() {
	html  = '<div id="pro_'+extension_property+'" class="st-form-line" style="z-index: 680;">	';
	html  += '	<span class="st-labeltext">Property Name</span>';	
	html  += '    <input type="text" value="" style="width:400px" id="property" class="st-forminput" name="property['+extension_property+']" original-title="Property name">'; 
	html  += '<a style="margin-left:15px;" href="javascript:;" onclick="$(\'#pro_'+extension_property+'\').remove();">Remove</a>';
	html  += '	<div class="clear" style="z-index: 670;"></div>';
	html  += '</div>';
	$('#button_add_property').before(html);
	extension_property++;
}
</script>