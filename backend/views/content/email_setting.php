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
</script>
 <!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>SETTING MANAGER - Email</h2>	<p>Setting Manager - Email</p></div>
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
                                    	<span class="st-labeltext">SMTP Host</span>	
                                        <input type="text" value="<?php echo isset($banners['smtp_host'])?$banners['smtp_host']:""; ?>" style="width:510px" id="smtp_host" class="st-forminput" name="data[smtp_host]"> 
                                    	<div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">SMTP Port</span>	
                                        <input type="text" value="<?php echo isset($banners['smtp_port'])?$banners['smtp_port']:""; ?>" style="width:510px" id="smtp_port" class="st-forminput" name="data[smtp_port]"> 
                                    	<div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">SMTP Username</span>	
                                        <input type="text" value="<?php echo isset($banners['smtp_username'])?$banners['smtp_username']:""; ?>" style="width:510px" id="smtp_username" class="st-forminput" name="data[smtp_username]"> 
                                    	<div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">SMTP Password</span>	
                                        <input type="text" value="<?php echo isset($banners['smtp_password'])?$banners['smtp_password']:""; ?>" style="width:510px" id="smtp_password" class="st-forminput" name="data[smtp_password]"> 
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