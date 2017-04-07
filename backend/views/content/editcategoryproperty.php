
<!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>CATEGORY MANAGER - <?php echo $id==""?"Add":"Edit"?> Category</h2>	<p>Category manager - <?php echo $id==""?"Add":"Edit"?> Category</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <!-- START CONTENT -->
<div class="content">
<div class="simplebox grid740" style="z-index: 720;margin:0 auto;">
                            	<div class="titleh" style="z-index: 710;">
                                	<h3><?php echo $id==""?"Add":"Edit"?> Category</h3>
                                </div>
                                <div class="body" style="z-index: 690;">
                                <form action="<?php echo base_url(); ?>backend.php/cpanel/category_manipulate" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                                  	<div id="list_property">
									<?php $i=1; foreach($banners as $ban) {?>
	                                  	<div id="pro_<?php echo $i;?>" class="st-form-line" style="z-index: 680;">	
	                                    	<span class="st-labeltext">Property Name</span>	
	                                        <input type="text" value="<?php echo isset($ban['property_name'])?$ban['property_name']:""; ?>" style="width:510px" id="property" class="st-forminput" name="property[]" original-title="Property name"> 
	                                    	<div class="clear" style="z-index: 670;"></div>
	                                    </div>
                                    <?php $i++;}?>
                                    
                                    </div>
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext"></span>	
                                        <a href="javascript:addmore()" class="button-gray">&laquo; Add More</a> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    <div class="button-box" style="z-index: 460;">
                                      <input type="hidden" name="currentid" value="<?php echo $id;?>">
                                      <input type="hidden" name="type" value="property">
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/category" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                    </div>
                                  </form>
                                  
                                </div>
                            </div>
</div>
<!-- END CONTENT -->

<script type="text/javascript">
var extension_property = <?php echo $i; ?>;
function addmore() {
	html  = '<div id="pro_'+extension_property+'" class="st-form-line" style="z-index: 680;">	';
	html  += '	<span class="st-labeltext">Property Name</span>';	
	html  += '    <input type="text" value="" style="width:510px" id="property" class="st-forminput" name="property[]" original-title="Property name">'; 
	html  += '	<div class="clear" style="z-index: 670;"></div>';
	html  += '</div>';
	$('#list_property').after(html);
	extension_property++;
}
</script>