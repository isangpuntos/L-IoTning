<script type="text/javascript">
function check_register(){
	var input = $('#register input');
	for(var i=0;i<input.length;i++){
		var each = input[i];
		if($(each).val()==''){
			alert('<?=_l('Please Fill',$this);?> '+ $(each).parent().parent().find('span.lbname').text()+'!');
			$(each).focus();
			return false;
		}
	}
	if($('#register input#password').val()!=$('#register input#confirm').val()){
		alert('<?=_l('Password does not match!',$this);?>');
		$('#register input#confirm').focus();
		return false;
	}
}
</script>


<div class="ragister">
      <div class="ragister_login">
        <div>
          <h1><?=_l('User',$this);?> <?=_l('Register',$this);?></h1>
        </div>
      </div>
      <div class="ragister_in">
        <form style="width:740px;" action="" method="post" enctype="multipart/form-data" id="register" onsubmit="return check_register();" class="form-horizontal">
          <div class="control-group" style="float:left;">
            <label style="float:none; width:200px;" class="control-label" for="Username"><span class="required">*</span> <span class="lbname"><?=_l('First Name',$this);?></span>:</label>
            <div class="controls" style="margin-left: 20px; margin-top: 5px;">
             <input type="text" name="data[firstname]" value="<?php if(isset($data)) echo $data['firstname'] ?>" placeholder="" id="firtname">
            </div>
          </div>
          <div class="control-group" style="float:right;">
            <label style="float:none; width:200px;" class="control-label" for="Username"><span class="required">*</span> <span class="lbname"><?=_l('Last Name',$this);?></span>:</label>
            <div class="controls" style="margin-left: 20px; margin-top: 5px;">
              <input type="text" name="data[lastname]" value="<?php if(isset($data)) echo $data['lastname'] ?>" placeholder="" id="lastname">
            </div>
          </div>
          <div class="clear"></div>
          <div class="control-group" style="float:left;">
            <label style="float:none; width:200px;" class="control-label" for="Username"><span class="required">*</span> <span class="lbname"><?=_l('Username',$this);?></span>:</label>
            <div class="controls" style="margin-left: 20px; margin-top: 5px;">
             <input type="text" name="data[username]" value="<?php if(isset($data)) echo $data['username'] ?>" placeholder="" id="username">
             <?php if(isset($error_username)){ ?><p style="margin: 0 0 0 58px;"  class="error"><?php echo _l('Username has been used!',$this);?></p><?php } ?>
            </div>
          </div>
          <div class="control-group" style="float:left;">
            <label style="float:none; width:200px;" class="control-label" for="Username"><span class="required">*</span> <span class="lbname"><?=_l('E-mail',$this);?></span>:</label>
            <div class="controls" style="margin-left: 20px; margin-top: 5px;">
              <input type="text" name="data[email]" value="<?php if(isset($data)) echo $data['email'] ?>" placeholder="" id="email">
              <?php if(isset($error_email)){ ?><p style="margin: 0 0 0 58px;"  class="error"><?php echo _l('Email has been used!',$this);?></p><?php } ?>
            </div>
          </div>
          <div class="clear"></div>
          <div class="control-group" style="float:left;">
            <label style="float:none; width:200px;" class="control-label" for="Username"><span class="required">*</span> <span class="lbname"><?=_l('Password Confirm',$this);?></span>:</label>
            <div class="controls" style="margin-left: 20px; margin-top: 5px;">
              <input type="password" id="confirm" placeholder="" name="data[confirm]">
            </div>
          </div>
          <div class="control-group" style="float:right;">
            <label style="float:none; width:200px;" class="control-label" for="Username"><span class="required">*</span> <span class="lbname"><?=_l('Password',$this);?></span>:</label>
            <div class="controls" style="margin-left: 20px; margin-top: 5px;">
              <input type="password" id="password" placeholder="" name="data[password]">
            </div>
          </div>
          <div class="clear"></div>
          <div class="control-group" style="float:left;">
            <label style="float:none; width:200px;" class="control-label" for="Username"><span class="required">*</span> <span class="lbname"><?=_l('Website',$this);?></span>:</label>
            <div class="controls" style="margin-left: 20px; margin-top: 5px;">
              <input type="text" name="data[website]" value="<?php if(isset($data)) echo $data['website'] ?>" placeholder="" id="website">
            </div>
          </div>
          
           <?php foreach($property_data_default as $pro) {?>
              <div class="control-group" style="float:right;">
                <label style="float:none; width:200px;" for="Company" class="control-label"><?php echo $pro['property_name'];?>:</label>
                <div class="controls"  style="margin-left: 20px; margin-top: 5px;">
                  <input type="text" placeholder="" id="custom_default_<?php echo $pro['value_id'];?>" name="data[custom][<?php echo $pro['value_id'];?>]" value="<?php echo isset($pro['property_value'])?$pro['property_value']:""; ?>">
                </div>
              </div>
		   <?php }?>
          <div class="clear"></div>
          <div class="buttons">
    		<div class="left"><a class="button" href=""><?=_l('Back',$this);?></a></div>
    	        <div class="right">
    		    <input type="submit" class="button" value="<?=_l('Submit',$this);?>">
    		</div>
		  </div>
        </form>
      </div>
    </div>
    <div class="clear"></div>