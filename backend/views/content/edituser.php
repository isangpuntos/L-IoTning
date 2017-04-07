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
         <div class="titlebar">	<h2>MEMBERS MANAGER - <?php echo $id==""?"Add":"Edit"?> Member</h2>	<p>mebers manager - <?php echo $id==""?"Add":"Edit"?> member</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <!-- START CONTENT -->
<div class="content">
<div class="simplebox grid740" style="z-index: 720;margin:0 auto;">
                            	<div class="titleh" style="z-index: 710;">
                                	<h3><?php echo $id==""?"Add":"Edit"?> Member</h3>
                                </div>
                                <div class="body" style="z-index: 690;">
                                  <form action="<?php echo $action; ?>" onsubmit="return check_information()" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                                  
                                  	<div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Username</span>	
                                        <input type="text" value="<?php echo isset($banners['username'])?$banners['username']:""; ?>" style="width:510px" id="username" class="st-forminput" name="username" original-title="Your Username to login"> 
                                        <?php if(isset($user_error)) {?><span style="margin-left:160px;" class="st-form-error"><?php echo $user_error; ?></span><?php }?>
                                    
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Password</span>	
                                        <input type="password" value="" style="width:510px" id="username" class="st-forminput" name="password" original-title="Your password to login"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                  
                                  	<div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Firstname</span>	
                                        <input type="text" value="<?php echo isset($banners['firstname'])?$banners['firstname']:""; ?>" style="width:510px" id="firstname" class="st-forminput" name="firstname" original-title="Your Firstname"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Lastname</span>	
                                        <input type="text" value="<?php echo isset($banners['lastname'])?$banners['lastname']:""; ?>" style="width:510px" id="lastname" class="st-forminput" name="lastname" original-title="Your Lastname"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Email</span>	
                                        <input type="text" value="<?php echo isset($banners['email'])?$banners['email']:""; ?>" style="width:510px" id="email" class="st-forminput" name="email" original-title="Your Email">
                                        <?php if(isset($email_error)) {?><span style="margin-left:160px;" class="st-form-error"><?php echo $email_error; ?></span><?php }?> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 620;">	
                                    	<span class="st-labeltext">Payment Method</span>	
                                    	<label class="margin-right10"><input checked value="1" type="radio" name="payment_id" class="uniform"/>Paypal</label>
                                    	<?php
// 										foreach($payment_method as $item)
// 										{
// 											if(isset($banners['payment_id']))
// 											{
// 												$checked=" ";
// 												if($banners['payment_id']==$item['payment_id'])
// 												{
// 													$checked="checked";
// 												}
												
// 												echo '<label class="margin-right10"><input '.$checked.' value="'.$item['payment_id'].'" type="radio" name="payment_id" class="uniform"/>'.$item['payment_name'].'</label>';
// 											}
// 											else
// 											{
// 												echo '<label class="margin-right10"><input value="'.$item['payment_id'].'" type="radio" name="payment_id" class="uniform"/>'.$item['payment_name'].'</label>';
// 											}
// 										}
										?>
                                  		<div class="clear" style="z-index: 610;"></div> 
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Paypal</span>	
                                        <input type="text" value="<?php echo isset($banners['paypal'])?$banners['paypal']:""; ?>" style="width:510px" id="paypal" class="st-forminput" name="paypal" original-title="Your Paypal"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Telephone</span>	
                                        <input type="text" value="<?php echo isset($banners['phone'])?$banners['phone']:""; ?>" style="width:510px" id="phone" class="st-forminput" name="phone" original-title="Your Phone"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Website</span>	
                                        <input type="text" value="<?php echo isset($banners['website'])?$banners['website']:""; ?>" style="width:510px" id="website" class="st-forminput" name="website" original-title="Your website"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Avatar</span>	
                                         
                                         <div class="profile_pic">
										 	<?php if(isset($banners['avatar']) && $banners['avatar'] !="") { ?>
					                    	<div><img width="140" style="margin-bottom:10px;" src="<?php echo base_url(); ?><?php echo $banners['avatar']; ?>">
					                    	</div>
					                    	<input style="margin-left:160px;" name="image" type="file" class="default" />
					                    	<?php } else {?>
					                    	 <div><input name="image" type="file" class="default" /></div>
					                    	<?php }?>
					                    	
					                       
					                    </div>
				                    	
				                    
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Company</span>	
                                        <input type="text" value="<?php echo isset($banners['company'])?$banners['company']:""; ?>" style="width:510px" id="company" class="st-forminput" name="company" original-title="Your Company"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                     <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Address 1</span>	
                                        <input type="text" value="<?php echo isset($banners['address1'])?$banners['address1']:""; ?>" style="width:510px" id="address1" class="st-forminput" name="address1" original-title="Your Address 1"> 
                                    	<div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                     <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Address 2</span>	
                                        <input type="text" value="<?php echo isset($banners['address2'])?$banners['address2']:""; ?>" style="width:510px" id="address2" class="st-forminput" name="address2" original-title="Your Address 2"> 
                                    	<div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Post Code</span>	
                                        <input type="text" value="<?php echo isset($banners['post_code'])?$banners['post_code']:""; ?>" style="width:510px" id="post_code" class="st-forminput" name="post_code" original-title="Your Post Code"> 
                                   		<div class="clear" style="z-index: 650;"></div>
                                    </div>
                                  
                                   	<div class="st-form-line">	<span class="st-labeltext">Country</span>	
                                   	<select class="require" id="country" name="country_id" onchange="setregion()">
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
                                    	<div class="clear"></div> 
                                    </div>
                                    
                                    <div class="st-form-line">	<span class="st-labeltext">Region/State</span>	
                                   	<select class="require" id="region" name="region_id" onchange="setcity()">
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
                                    	<div class="clear"></div> 
                                    </div>
                                    
                                    <div class="st-form-line">	<span class="st-labeltext">City</span>	
	                                   	<select class="require" id="city" name="city_id" >
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
                                    	<div class="clear"></div> 
                                    </div>
                                    
                                    <div class="st-form-line">	<span class="st-labeltext">Group</span>	
	                                   	<select name="group_id">
					                       <?php
												foreach($category as $item)
												{
													if(isset($banners['group_id']))
													{
														$checked=" ";
														if($banners['group_id']==$item['group_id'])
														{
															$checked=" selected";
														}
														
														echo "<option value='".$item['group_id']."'".$checked.">".$item['groupname']."</option>";
													}
													else
													{
														echo "<option value='".$item['group_id']."'>".$item['groupname']."</option>";
													}
												}
																?>
					                            </select>
                                    	<div class="clear"></div> 
                                    </div>
                                    
                                    
                                    
                                    <div class="st-form-line" style="z-index: 620;">	
                                    	<span class="st-labeltext">Status</span>	
                                    	<?php if (isset($banners['active']) && $banners['active']==1){?>
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
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/members" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                   	  
                                    </div>
                                  </form>
                                  
                                </div>
                            </div>
</div>
  <!-- END CONTENT -->