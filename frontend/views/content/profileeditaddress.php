<script src="<?php echo base_url(); ?>assets/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/uploadify/uploadify.css" rel="stylesheet">
<style>
input, textarea, .uneditable-input {
width:200px;
}
.profile_pic {
    float: left;
    margin: 10px 0 0 20px;
}
.clear-button {
	float: right;
    margin-right: 25px !important;
    margin-top: 10px !important;
}
.uploadify-button {
	color:white !important;
}
.uploadify {
	margin:0px;
	padding:0px;
	float:left;
}
.uploadify-queue
{
display:block !important;
}
.gv_filmstripWrap
{
	top:305px;
}
</style>
<script type="text/javascript">

   function check_information(){
		var input = $('#editextension input.require');
		for(var i=0;i<input.length;i++){
			var each = input[i];
			if($(each).val()==''){
				alert('Please Fill '+ $(each).parent().parent().find('span.lbname').text()+'!');
				$(each).focus();
				return false;
			}
		}
	}
 
</script>
<div class="bg_img">
            	<div class="bg_img_in">
                	<h1><span> <?=_l('Submit an  </span> Extensions',$this);?></h1>
                </div>
            </div>
            
            <div class="Extensions_bg">
            <form class="form-horizontal" style="width:auto;" onsubmit="return check_information();" id="editextension" enctype="multipart/form-data" method="post" action="">
           
           	<div class="Manage_Description">
           		<?php if(isset($message_error)){?>
           		<div class="warning">Error: <?php echo $message_error;?></div>
           		<?php }?>
                <div id="example" class="k-content">

            <div id="animation"> 
                <div id="tabbed-nav">


                    <div>
                        <div>
                        
                        <div class="control-group">
                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('Receiver Name',$this);?></span>:</label>
                        <div class="controls" style="margin-left:319px;">
                        <input type="text" class="require" name="data[name]" value="<?php echo $extension['name'];?>" id="extension_name" placeholder="">
                        </div>
                        </div>
                            <div class="control-group" style="width:400px;">
                            <label class="control-label" for="Exension Category"><?=_l('Country',$this);?>:</label>
                            <div class="Exension Category" style="margin-left:319px;">
<!--                            <select name="data[category_id]" id="category" onchange="setcustom()">-->
                            <select name="data[country_id]" id="category" >
							<?php
							foreach($country as $item)
							{
								if(isset($extension['country_id']))
								{
									$checked=" ";
									if($extension['country_id']==$item['country_id'])
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
                            
                          <div class="control-group">
	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('City',$this);?></span>:</label>
	                        <div class="controls" style="margin-left:319px;">
	                        <input type="text" class="require" value="<?php echo $extension['city_name'];?>" id="Advanced multiple Forms" name="data[city_name]" placeholder="">
	                        </div>
                        </div>
                           
                        <div class="control-group">
	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('Address 1',$this);?></span>:</label>
	                        <div class="controls" style="margin-left:319px;">
	                        <input type="text" class="require" value="<?php echo $extension['address1'];?>" id="Advanced multiple Forms" name="data[address1]" placeholder="">
	                        </div>
                        </div>
                        
                        <div class="control-group">
	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('Address 2',$this);?></span>:</label>
	                        <div class="controls" style="margin-left:319px;">
	                        <input type="text" class="require" value="<?php echo $extension['address2'];?>" id="Advanced multiple Forms" name="data[address2]" placeholder="">
	                        </div>
                        </div>
                        
                        <div class="control-group">
	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('State',$this);?></span>:</label>
	                        <div class="controls" style="margin-left:319px;">
	                        <input type="text" class="require" value="<?php echo $extension['state'];?>" id="Advanced multiple Forms" name="data[state]" placeholder="">
	                        </div>
                        </div>
                        
                        <div class="control-group">
	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('Postal/Zip',$this);?></span>:</label>
	                        <div class="controls" style="margin-left:319px;">
	                        <input type="text" class="require" value="<?php echo $extension['postal'];?>" id="Advanced multiple Forms" name="data[postal]" placeholder="">
	                        </div>
                        </div>
                                             
                        </div>
                    </div>
                </div>
            </div>
            

        </div>

    <style>
        #animation {
            width: 774px;
            padding: 15px 0px 0 0px;
            float: left;
        }

        #config-wrapper {
            float: left;
        }

        .options {
            position: relative;
        }

        #duration {
            position: absolute;
            right: 0;
        }

        .z-content {
		min-height:240px;
        }
		
		
    </style>
     <div class="clear"></div>
      <input type="hidden" name="data[current_id]" value="<?php echo $current_id;?>">
                <div class="Choose_payment_text1" style="width:756px;" >
                    	  <div style="float:left; margin:0px;" class="update"><a href="<?php echo base_url(); ?>profile/address"><?=_l('Back',$this);?></a></div>
                            <div class="update" style="margin:0px;"><input type="submit" name="submit" value="<?=_l('Submit',$this);?>"></div>
                            <div class="clear"></div>
                    </div>
            </div>
            </form>
            	 <div class="account_right_links">
                <div><?=_l('Your Account',$this);?></div>
                	<ul> class="select" 
                    	<li><a href="<?php echo base_url(); ?>profile"><?=_l('Account',$this);?></a></li>
                        <li><a  href="<?php echo base_url(); ?>profile-detail"><?=_l('Edit Details',$this);?></a></li>
                         <li><a  class="select" href="<?php echo base_url(); ?>profile/address"><?=_l('Manage Address',$this);?> </a></li>
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