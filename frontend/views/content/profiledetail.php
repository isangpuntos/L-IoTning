<style>
.fileupload-exists .fileupload-new, .fileupload-new .fileupload-exists {
    display: none;
}
</style>
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
<style type="text/css">
input, textarea, .uneditable-input {
    width: 250px;
}
select {
    width: 265px;
}
</style>
<div class="bg_img">
            	<div class="bg_img_in">
                	<h1><span> <?=_l('Edit',$this);?> </span>  <?=_l('Details',$this);?> </h1>
                </div>
            </div>
            
            <div class="History_bg">
           		<div style="float:left;">
                	<form style="margin:0px;width:auto;" class="form-horizontal" onsubmit="return check_information();" id="editdetail" enctype="multipart/form-data" method="post" action="">
                	<div class="account_from" style="float:none;">
                        <div class="control-group">
                        <label class="control-label" for="User_Name"><span class="required">*</span> <span class="lbname"><?=_l('User Name',$this);?></span>:</label>
                        <div class="controls">
                        <input type="text" class="require" value="<?php echo isset($banners['username'])?$banners['username']:""; ?>" name="data[username]" id="User_Name" placeholder="<?=_l('User Name',$this);?>">
                        <?php if(isset($error_username)){ ?><p style="margin: 0 0 0 58px;"  class="error"><?php echo _l('Username has been used!',$this);?></p><?php } ?>
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="First_Name"><span class="required">*</span> <span class="lbname"><?=_l('First Name',$this);?></span>:</label>
                        <div class="controls">
                        <input type="text" name="data[firstname]" class="require"  value="<?php echo isset($banners['firstname'])?$banners['firstname']:""; ?>" id="First_Name" placeholder="<?=_l('First Name',$this);?>">
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="Last_Name"><span class="required">*</span> <span class="lbname"><?=_l('Last Name',$this);?></span>:</label>
                        <div class="controls">
                        <input type="text" class="require"  value="<?php echo isset($banners['lastname'])?$banners['lastname']:""; ?>" name="data[lastname]" id="Last_Name" placeholder="<?=_l('Last Name',$this);?>">
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="Email"><span class="required">*</span> <span class="lbname"><?=_l('E-mail',$this);?></span>:</label>
                        <div class="controls">
                        <input type="text" class="require" value="<?php echo isset($banners['email'])?$banners['email']:""; ?>" name="data[email]" id="Email" placeholder="<?=_l('E-mail',$this);?>">
                        <?php if(isset($error_email)){ ?><p style="margin: 0 0 0 58px;"  class="error"><?php echo _l('Email has been used!',$this)?></p><?php } ?>
                        </div>
                        </div>
                        <div class="control-group" >
                        <div class="controls" style="margin-left:0px;">
                        <label class="checkbox" style="float: left;width: 165px;"><?=_l('Payment method',$this);?>:</label>
                        <div><input checked type="radio" style="margin:-1px 0 0 34px;" value="1" name="payment_method"> PayPal</div>
                        <?php
// 							foreach($payment_method as $item)
// 							{
// 								if(isset($banners['payment_id']))
// 								{
// 									$checked=" ";
// 									if($banners['payment_id']==$item['payment_id'])
// 									{
// 										$checked=" checked";
// 									}
									
// 									echo '<div><input type="radio" name="data[payment_id]" value="'.$item['payment_id'].'" '.$checked.' style="margin:-1px 0 0 34px;"> '.$item['payment_name'].'</div>';
// 								}
// 								else
// 								{
// 									echo '<div><input type="radio" name="data[payment_id]" value="'.$item['payment_id'].'" style="margin:-1px 0 0 34px;"> '.$item['payment_name'].'</div>';
// 								}
// 							}
							?>
                        
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="PayPal"><?=_l('PayPal',$this);?>:</label>
                        <div class="controls">
                        <input type="text" name="data[paypal]"  value="<?php echo isset($banners['paypal'])?$banners['paypal']:""; ?>" id="PayPal" placeholder="<?=_l('PayPal',$this);?>">
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="Telephone"><?=_l('Telephone',$this);?>:</label>
                        <div class="controls">
                        <input type="text" value="<?php echo isset($banners['phone'])?$banners['phone']:""; ?>" name="data[phone]" id="Telephone" placeholder="<?=_l('Telephone',$this);?>">
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="Website"><?=_l('Website',$this);?>:</label>
                        <div class="controls">
                        <input type="text" value="<?php echo isset($banners['website'])?$banners['website']:""; ?>" name="data[website]" id="Website" placeholder="<?=_l('Website',$this);?>">
                        </div>
                        </div>
                </div>	
                
                <div class="profile_text"><?=_l('Profile picture',$this);?></div>
                <div class="account_from" style="float:none; margin-top:10px;">
                
                     <div class="profile_text_1">
                    	<div><?=_l('Avatar',$this);?>:</div>
                    </div>
					
					<div class="profile_pic">
					 	<?php if(isset($banners['avatar']) && $banners['avatar'] !="") { ?>
                    	<div><img width="210" style="margin-bottom:10px;" src="<?php echo base_url(); ?><?php echo $banners['avatar']; ?>"></div>
                    	<?php }?>
                    	
                        <div> <input name="image" type="file" class="default" /></div>
                    </div>
                <div class="clear"></div>
                </div>
                
                <?php if(isset($property_data_default) && $property_data_default!=null) {?>
                <div class="profile_text"><?=_l('Your Custom Field',$this);?></div>
                <div class="account_from" style="float:none; margin:10px 0 0 0;">
                    <div id="list_custom1">
                  <?php foreach($property_data_default as $pro) {?>
		             <div class="control-group">
                        <label class="control-label" for="Company"><?php echo $pro['property_name'];?>:</label>
                        <div class="controls">
                        <input type="text" value="<?php echo isset($pro['property_value'])?$pro['property_value']:""; ?>" name="data[custom][<?php echo $pro['value_id'];?>]" id="custom_default_<?php echo $pro['value_id'];?>" placeholder="">
                        </div>
                        </div>
		           <?php }?>
                </div>    
                </div>
				<?php }?> 
                
                
                <div class="profile_text"><?=_l('Your Address',$this);?></div>
                <div class="account_from" style="float:none; margin:10px 0 0 0;">
                        <div class="control-group">
                        <label class="control-label" for="Company"><?=_l('Company',$this);?>:</label>
                        <div class="controls">
                        <input type="text" value="<?php echo isset($banners['company'])?$banners['company']:""; ?>" name="data[company]" id="Company" placeholder="Company">
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="Address1"><?=_l('Address1',$this);?>:</label>
                        <div class="controls">
                        <input type="text" name="data[address1]" value="<?php echo isset($banners['address1'])?$banners['address1']:""; ?>" id="Address1" placeholder="Address1">
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="Address2"><?=_l('Address2',$this);?>:</label>
                        <div class="controls">
                        <input type="text" name="data[address2]" value="<?php echo isset($banners['address2'])?$banners['address2']:""; ?>" id="Address2" placeholder="Address2">
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="post Code"><?=_l('post Code',$this);?>:</label>
                        <div class="controls">
                        <input type="text" name="data[post_code]" value="<?php echo isset($banners['post_code'])?$banners['post_code']:""; ?>" id="post Code" placeholder="post Code">
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="Country"><?=_l('Country',$this);?>:</label>
                        <div class="controls">
                        <select id="country" name="data[country]" onchange="setregion()">
                        <?php
							foreach($country_data as $item)
							{
								if(isset($banners['country_id']))
								{
									$checked=" ";
									if($banners['country_id']==$item['country_id'])
									{
										$checked=" selected";
									}
									
									echo "<option value='".$item['country_id']."'".$checked.">".$item['country_name']."</option>";
								}
								else
								{
									echo "<option value='".$item['country_id']."'>".$item['country_name']."</option>";
								}
							}
							?>
                        </select>
                        
                        </div>
                        </div>
                        <div class="control-group" style="width:400px;">
                        <label class="control-label" for="Region/State"><?=_l('Region/State',$this);?>:</label>
                        <div class="controls">
                        <select id="region" name="data[region]" onchange="setcity()">
                         <?php
							foreach($region_data as $item)
							{
								if(isset($banners['region_id']))
								{
									$checked=" ";
									if($banners['region_id']==$item['region_id'])
									{
										$checked=" selected";
									}
									
									echo "<option value='".$item['region_id']."'".$checked.">".$item['region_name']."</option>";
								}
								else
								{
									echo "<option value='".$item['region_id']."'>".$item['region_name']."</option>";
								}
							}
							?>
                        </select>
                        </div>
                        </div>
                         <div class="control-group" style="width:400px;">
                        <label class="control-label" for="Region/State"><span class="required">*</span> <span class="lbname"><?=_l('City',$this);?></span>:</label>
                        <div class="controls">
                        <select id="city" name="data[city_id]" >
                        <?php
							foreach($city_data as $item)
							{
								if(isset($banners['city_id']))
								{
									$checked=" ";
									if($banners['city_id']==$item['city_id'])
									{
										$checked=" selected";
									}
									
									echo "<option value='".$item['city_id']."'".$checked.">".$item['city_name']."</option>";
								}
								else
								{
									echo "<option value='".$item['city_id']."'>".$item['city_name']."</option>";
								}
							}
							?>
                        </select>
                        
                        </div>
                        </div>
                </div>
                <div class="profile_text"><?=_l('Notification Preferences',$this);?></div>
                <div class="account_from" style="float:none; margin:10px 0 0 0;">
                        <div class="control-group" >
                        <div class="controls" style="margin-left:0px; width:560px;">
                        <label class="checkbox" style="float:left; width:285px;">
                        	<div><?=_l('Notify Extension update',$this);?>:</div>
                            <div style="font-size:11px; color:#999999;"><?=_l('I want to receive an email notifying me when one of the extensions I have purchased is update',$this);?>I want to receive an email notifying me when one of the extensions I have purchased is update</div>
                        
 						</label>
 						<?php if (isset($notification) && $notification['notify_extension'] == 1) {?>
                        <div style="float:left; margin:25px 0 0 0;"><input checked value="1" name="notify[notify_extension]" type="radio" style="margin:-1px 0 0 34px;"> <?=_l('Yes',$this);?></div>
                        <div style="float:left; margin:25px 0 0 0;"><input type="radio" value="0" name="notify[notify_extension]" style="margin:-1px 0 0 15px;"> <?=_l('No',$this);?></div>
                        <?php } else {?>
                        <div style="float:left; margin:25px 0 0 0;"><input type="radio" value="1" name="notify[notify_extension]" style="margin:-1px 0 0 34px;"> <?=_l('Yes',$this);?></div>
                        <div style="float:left; margin:25px 0 0 0;"><input checked type="radio" value="0" name="notify[notify_extension]" style="margin:-1px 0 0 15px;"> <?=_l('No',$this);?></div>
                        <?php }?>
                        <div class="clear"></div>
                        
                        </div>
                        </div>
                        <div class="control-group" >
                        <div class="controls" style="margin-left:0px; width:560px;">
                        <label class="checkbox" style="float:left; width:285px;">
                        	<div><?=_l('Notify Purchase',$this);?>:</div>
                            <div style="font-size:11px; color:#999999;"><?=_l('I want to receive a email notifying me when some one buys my extensions.',$this);?></div>
                        
 </label>
                        <?php if (isset($notification) && $notification['notify_purchase'] ==1) {?>
                        <div style="float:left; margin:25px 0 0 0;"><input checked value="1" name="notify[notify_purchase]" type="radio" style="margin:-1px 0 0 34px;"> <?=_l('Yes',$this);?></div>
                        <div style="float:left; margin:25px 0 0 0;"><input type="radio" value="0" name="notify[notify_purchase]" style="margin:-1px 0 0 15px;"> <?=_l('No',$this);?></div>
                        <?php } else {?>
                        <div style="float:left; margin:25px 0 0 0;"><input type="radio" value="1" name="notify[notify_purchase]" style="margin:-1px 0 0 34px;"> <?=_l('Yes',$this);?></div>
                        <div style="float:left; margin:25px 0 0 0;"><input checked type="radio" name="notify[notify_purchase]" value="0" style="margin:-1px 0 0 15px;"> <?=_l('No',$this);?></div>
                        <?php }?>
                        <div class="clear"></div>
                        
                        </div>
                        </div>
                        <div class="control-group" >
                        <div class="controls" style="margin-left:0px; width:560px;">
                        <label class="checkbox" style="float:left; width:285px;">
                        	<div><?=_l('Notify Comment',$this);?>:</div>
                            <div style="font-size:11px; color:#999999;"><?=_l('I want to receive a email notifying me when some one posts comment about my extension.',$this);?></div>
                        
 </label>
                        <?php if (isset($notification) && $notification['notify_comment'] ==1) {?>
                        <div style="float:left; margin:25px 0 0 0;"><input checked value="1" name="notify[notify_comment]" type="radio" style="margin:-1px 0 0 34px;"> <?=_l('Yes',$this);?></div>
                        <div style="float:left; margin:25px 0 0 0;"><input type="radio" value="0" name="notify[notify_comment]" style="margin:-1px 0 0 15px;"> <?=_l('No',$this);?></div>
                        <?php } else {?>
                        <div style="float:left; margin:25px 0 0 0;"><input type="radio" value="1" name="notify[notify_comment]" style="margin:-1px 0 0 34px;"> <?=_l('Yes',$this);?></div>
                        <div style="float:left; margin:25px 0 0 0;"><input checked type="radio" value="0" name="notify[notify_comment]" style="margin:-1px 0 0 15px;"> <?=_l('No',$this);?></div>
                        <?php }?>
                        <div class="clear"></div>
                        
                        </div>
                        </div>
  
                </div>
                <button style="margin:15px 0 0 0px; float:right;" type="submit" class="btn"><?=_l('Submit',$this);?></button>
                <div class="clear"></div>
                 </form>
                </div>
               
                  <div class="account_right_links">
                <div><?=_l('Your Account',$this);?></div>
                	<ul>
                    	<li><a href="<?php echo base_url(); ?>profile"><?=_l('Account',$this);?></a></li>
                        <li><a class="select"  href="<?php echo base_url(); ?>profile-detail"><?=_l('Edit Details',$this);?></a></li>
                        <li><a href="<?php echo base_url(); ?>profile/address"><?=_l('Manage Address',$this);?> </a></li>
                        <li><a href="<?php echo base_url(); ?>profile-password"><?=_l('Chang Password',$this);?> </a></li>
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