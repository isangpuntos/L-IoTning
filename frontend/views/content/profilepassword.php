<script type="text/javascript">
function check_information()
{
	if($('#changepassword input#password').val()=='')
	{
		alert('<?=_l('Please Fill Password!',$this);?>');
		$('#changepassword input#password').focus();
		return false;
	}
	if($('#changepassword input#confirm').val()=='')
	{
		alert('<?=_l('Please Fill Password Confirm!',$this);?>');
		$('#changepassword input#confirm').focus();
		return false;
	}
	if($('#changepassword input#password').val()!=$('#changepassword input#confirm').val()){
	alert('<?=_l('Password does not match!',$this);?>');
	$('#changepassword input#confirm').focus();
	return false;
}
}
</script>

<div class="bg_img">
            	<div class="bg_img_in">
                	<h1><span><?=_l('Change your account',$this);?> </span><?=_l('Password',$this);?></h1>
                </div>
            </div>
            
            <div class="account_p_bg">
<!--            	<div class="chang_your_account">Change your account password</div>
-->            	<div class="account_from">
                	<form class="form-horizontal" onsubmit="return check_information();" id="changepassword" enctype="multipart/form-data" method="post" action="">
                         <div class="control-group">
                        <label for="Username" class="control-label"><span class="required">*</span> <span class="lbname"><?=_l('Password',$this);?></span>:</label>
                        <div class="controls">
                        <input type="password" name="data[password]" placeholder="" id="password">
                        </div>
                     </div>
                      <div class="control-group">
                        <label for="Username" class="control-label"><span class="required">*</span> <span class="lbname"><?=_l('Password Confirm',$this);?></span>:</label>
                        <div class="controls">
                        <input type="password" name="data[confirm]" placeholder="" id="confirm">
                        </div>
                     </div>
                        <label class="control-label" for="Username"><span class="lbname"></span>:</label>
                        <div class="control-group" >
                        <div class="controls">
                        <button type="submit" class="btn"><?=_l('Submit',$this);?></button>
                        </div>
                        </div>
                    </form>
                </div>
                
                 <div class="account_right_links">
                <div><?=_l('Your Account',$this);?></div>
                	<ul>
                    	<li><a href="<?php echo base_url(); ?>profile"><?=_l('Account',$this);?></a></li>
                        <li><a  href="<?php echo base_url(); ?>profile-detail"><?=_l('Edit Details',$this);?></a></li>
                        <li><a href="<?php echo base_url(); ?>profile/address"><?=_l('Manage Address',$this);?> </a></li>
                        <li><a class="select" href="<?php echo base_url(); ?>profile-password"><?=_l('Chang Password',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-history"><?=_l('Order History',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-download"><?=_l('Your Downloads',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-extension"><?=_l('Manage Extensions',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile/sale"><?=_l('Your Sales',$this);?></a></li>
                        <li><a href="<?php echo base_url(); ?>profile/transaction"><?=_l('Transaction',$this);?></a></li>
                    </ul>
                    <!--<div class="Export">Export CSV</div>-->
                </div>
                <div class="clear"></div>
                
                    
            </div>
    