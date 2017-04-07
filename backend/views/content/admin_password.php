<script type="text/javascript">
function check_information()
{
	if($('#changepassword input#password').val()=='')
	{
		alert('Please Fill Password!');
		$('#changepassword input#password').focus();
		return false;
	}
	if($('#changepassword input#confirm').val()=='')
	{
		alert('Please Fill Password Confirm!');
		$('#changepassword input#confirm').focus();
		return false;
	}
	if($('#changepassword input#password').val()!=$('#changepassword input#confirm').val()){
	alert('Password does not match!');
	$('#changepassword input#confirm').focus();
	return false;
}
}
</script>
 <!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>SETTING MANAGER - Change Password </h2><p>Setting manager - Change Password</p></div>
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
<legend>CHANGE PASSWORD<div class="input-prepend" style="float:right;">
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_setting">Setting</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_profile">Profile</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_password">Change Password</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/admin_commission">Commission</a>
<a class="btn btn-small" id="add_new_user_btn" href="<?php echo base_url();?>backend.php/cpanel/email_setting">Email</a>
</div></legend>
                            	<div class="titleh" style="z-index: 710;">
                            	 <div class="shortcuts-icons-button" style="z-index: 450; display:none;">
                                	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_setting"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create.png"><span>Setting</span></a>
		                            <a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_profile"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create1.png"><span>Profile</span></a>
		                            <a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_password"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create2.png"><span>Change Password</span></a>
		                            <a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/admin_commission"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create3.png"><span>Commission</span></a>
		                          </div>
                                </div>
                                <div class="body" style="z-index: 690;">
                                  <form action="" onsubmit="return check_information();" method="post" enctype="multipart/form-data" name="changepassword" id="changepassword" autocomplete="off"  class="form-horizontal form-row-seperated">
                                  
                                  	<div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Password</span>	
                                        <input type="password" value="" style="width:510px" id="password" class="st-forminput" name="data[password]" original-title="Your Password to login"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Confirm</span>	
                                        <input type="password" value="" style="width:510px" id="confirm" class="st-forminput" name="data[confirm]" original-title="Your Password to login"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    <div class="button-box" style="z-index: 460;">
                                    	<input type="hidden" name="type" value="profile">
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/setting" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                   	  
                                    </div>
                                  </form>
                                  
                                </div>
                            </div>
</div>
  <!-- END CONTENT -->