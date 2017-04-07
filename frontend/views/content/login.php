<script type="text/javascript">
function check_login(){
	var input = $('#login input');
	for(var i=0;i<input.length;i++){
		var each = input[i];
		if($(each).val()==''){
			alert('<?=_l('Please Fill',$this);?> '+ $(each).parent().find('span').text()+'!');
			$(each).focus();
			return false;
		}
	}
}
</script>

<div class="login">
    <div class="user_login">
    	<div><h1><?=_l('User',$this);?> <?=_l('Login',$this);?></h1></div>
    </div>
    	<div class="login_in">
        	<form class="form-horizontal" action="" method="post" id="login" onsubmit="return check_login()">
                        <div class="check-login">
                            <h5><img alt="" src="<?php echo base_url(); ?>assets/frontend/img/loading.gif"> Checking login status of Facebook.</h5>
                            <span class="hint">(Press F5 if done for too long. Try Clear your browser cache if that does not work.)</span>
                        </div>    
                        <div class="control-group">
                            <label class="control-label" style="width:100px;" for="Username"><?=_l('Username',$this);?>:</label>
                            <div class="controls">
                            <input type="text" name="username" id="Username" placeholder="Username">
                            </div>
                        </div>
                        <div style="margin-bottom:10px;" class="control-group">
                            <label class="control-label" style="width:100px;" for="Password"><?=_l('Password',$this);?>:</label>
                            <div class="controls">
                            <input type="password" name="password" id="Password" placeholder="Password">
                            <?php if(isset($error_login)){ ?><p style="margin: 0 0 0 58px;" class="error"><?php echo _l('Wrong username or password!',$this);?></p><?php } ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls" style="margin-left:122px;">
                            <label class="checkbox" style="width:100px;">
                            <input type="checkbox" name="remember" value="1"> <?=_l('Remember me',$this);?></label>
                            <button type="submit" class="btn" style="margin-top:10px;"><?=_l('Sign in',$this);?></button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
<div style="clear:both;"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<div id="fb-root"></div>
<script>
  FB.init({
   	appId: "<?php echo $fb_api_id;?>", 
  	status: true, 
  	cookie: true, 
  	xfbml: true
  });

 FB.getLoginStatus(function(response) {
      if (response.status=="connected") {
        FB.api('/me', function(response) {
          $.ajax({
             url: '<?php echo base_url()?>ajax_login_fb',
            dataType: 'json',
            type: 'POST',
            data: response,
            complete: function(html) {
              var result = html.responseText.split("|");
              if(result[0]=='success') {
          	    document.location.href = '<?php echo base_url()?>profile';

              } else {
                $('.check-login').remove();
                $('#form-login').css('display','block');
              }
            }
          }); 
        });  
      }else{
        $('.check-login').remove();
        $('#form-login').css('display','block');
      }
  });
  $('#form-login input[type=checkbox]').live('click',function(){
    if(!$(this).prop('checked')) $(this).val('0');
    else $(this).val('1');
  });

  $('.submit-login').live('click',function(){
    $('.error').remove();
    $('<img alt="" src="<?php echo base_url(); ?>assets/frontend/img/loading.gif">').insertBefore('.submit-login');
  	$('.submit-login').attr('disabled','disabled');
    $.ajax({
        url: '<?php echo base_url()?>ajax_login',
        dataType: 'json',
        type: 'POST',
        data: $('#form-login input'),
        complete: function(html) {
           var result = html.responseText.split("|");
            if(result[0]=='success') {
         	   document.location.href = '<?php echo base_url()?>profile';
            } else {
            $('.submit-login').removeAttr('disabled');
            $('.submit-login').prev().remove();
            $('<p style="color:red;" class="error">Username / Email or password not match!</p>').insertBefore('.submit-login');
          }
        }
      }); 
  });
</script>
            