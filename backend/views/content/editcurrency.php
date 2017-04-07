<!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>CURRENCY MANAGER - <?php echo $id==""?"Add":"Edit"?> Currency</h2>	<p>Currency manager - <?php echo $id==""?"Add":"Edit"?> Currency</p></div>
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
</script>
 <!-- START CONTENT -->
<div class="content">
<div class="simplebox grid740" style="z-index: 720;margin:0 auto;">
                            	<div class="titleh" style="z-index: 710;">
                                	<h3><?php echo $id==""?"Add":"Edit"?> Currency</h3>
                                </div>
                                <div class="body" style="z-index: 690;">
                                <form action="<?php echo base_url(); ?>backend.php/cpanel/currency_manipulate" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                               
                                  	<div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Title</span>	
                                        <input type="text" value="<?php echo isset($banners['title'])?$banners['title']:""; ?>" style="width:510px" id="title" class="st-forminput" name="title" original-title="title name"> 
                                        <?php if($this->session->flashdata('message_error')) {?><span style="margin-left:160px;" class="st-form-error"><?php echo $this->session->flashdata('message_error'); ?></span><?php }?>
                                    
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Code</span>	
                                        <input type="text" value="<?php echo isset($banners['code'])?$banners['code']:""; ?>" style="width:510px" id="code" class="st-forminput" name="code" original-title="Code"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                   
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Symbol Left</span>	
                                        <input type="text" value="<?php echo isset($banners['symbol_left'])?$banners['symbol_left']:""; ?>" style="width:510px" id="symbol_left" class="st-forminput" name="symbol_left" original-title="Symbol Left"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                     
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Symbol Right</span>	
                                        <input type="text" value="<?php echo isset($banners['symbol_right'])?$banners['symbol_right']:""; ?>" style="width:510px" id="symbol_right" class="st-forminput" name="symbol_right" original-title="Symbol Right"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                     
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Decimal</span>	
                                        <input type="text" value="<?php echo isset($banners['decimal_place'])?$banners['decimal_place']:""; ?>" style="width:510px" id="decimal_place" class="st-forminput" name="decimal_place" original-title="Decimal"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                     
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Value</span>	
                                        <input type="text" value="<?php echo isset($banners['value'])?$banners['value']:""; ?>" style="width:510px" id="value" class="st-forminput" name="value" original-title="Value"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                   
<!--                                    <div class="st-form-line" style="z-index: 620;">	-->
<!--                                    	<span class="st-labeltext">Default</span>	-->
<!--                                    	<label class="margin-right10"><input <?php if (isset($banners['default']) && $banners['default']==1 ) {?> checked <?php } ?> value="1" type="checkbox" name="default" class="uniform"/> Default </label>-->
<!--                                  		<div class="clear" style="z-index: 610;"></div> -->
<!--                                    </div>-->
<!--                                    -->
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
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/currency" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                   	 
                                    </div>
                                  </form>
                                  
                                </div>
                            </div>
</div>
  <!-- END CONTENT -->