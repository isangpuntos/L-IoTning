<div class="bg_img" style="margin:0;padding:0px;min-height:0px;">
    <div class="bg_img_in">
       <h1><span><?=_l('Contact to Admin',$this);?></span></h1>
   </div>
 </div>
<div class="box_a">
 <div class="b_grid_and_list">
     <form action="<?=base_url()?>sendemail" method="post" enctype="multipart/form-data" id="contact" onsubmit="return check_information();" class="form-horizontal" style="margin:0 auto;width:740px;">
                	<div style="float:none;" class="account_from">
                		<?php if($this->session->flashdata('message_success')){?>
			            <div class="success" style="margin:10px;">Success: Your <?php echo $this->session->flashdata('message_success');?> have been successfully sent!</div>
			            <?php } ?>
			            
			            <?php if($this->session->flashdata('message_error')){?>
			            <div class="error" style="margin:10px;">Error: <?php echo $this->session->flashdata('message_error');?>!</div>
			            <?php } ?>
                       <div class="control-group">
                        <div style="margin-left:0px;" class="controls">
                        <label style="float:left;height:50px;" class="checkbox"><?=_l('Reason',$this);?>:</label>
                        <div><input type="radio" style="margin:-1px 0 0 34px;" checked="" value=" <?=_l('I want to get support',$this);?>" name="reason"> <?=_l('Reason',$this);?><?=_l('I want to get support',$this);?></div>
                        <div><input type="radio" style="margin:-1px 0 0 34px;" value=" <?=_l('I want to get a refund',$this);?>" name="reason"> <?=_l('Reason',$this);?><?=_l('I want to get a refund',$this);?></div>     
                        <div><input type="radio" style="margin:-1px 0 0 34px;" value=" <?=_l('I want to discuss other business',$this);?>" name="reason"> <?=_l('Reason',$this);?><?=_l('I want to discuss other business',$this);?></div>                        
                        </div>
                        </div>
                        
                        <div class="control-group">
                        <label style="width:auto;" for="User_Name" class="control-label"><span class="required">*</span> <span class="lbname"><?=_l('Name',$this);?></span>:</label>
                        <div class="controls">
                        <input type="text" placeholder="Name" id="name" name="contactName" value="" class="require">
                                                </div>
                        </div>
                        
                        <div class="control-group">
                        <label style="width:auto;" for="Email" class="control-label"><span class="required">*</span> <span class="lbname"><?=_l('E-mail',$this);?></span>:</label>
                        <div class="controls">
                        <input type="text" placeholder="E-mail" id="Email" name="contactEmail" value="" class="require">
                                                </div>
                        </div>
                        
                        <div class="control-group">
                        <label style="width:auto;" for="PayPal" class="control-label"><?=_l('Website',$this);?>:</label>
                        <div class="controls">
                        <input type="text" placeholder="Website" id="website" value="" name="contactWebsite">
                        </div>
                        </div>
                        
                        <div class="control-group">
                        <label style="width:auto;" for="PayPal" class="control-label"><span class="required">*</span> <span class="lbname"><?=_l('Title',$this);?></span>:</label>
                        <div class="controls">
                        <input class="require" type="text" placeholder="title" id="title" value="" name="contactSubject">
                        </div>
                        </div>
                        
                        <div class="control-group">
                        <label style="width:auto;" for="Website" class="control-label"><span class="required">*</span> <span class="lbname"><?=_l('E-Enquiry',$this);?></span>:</label>
                        <div class="controls" style="width:597px;">
                        <textarea class="require" style="width:597px;height:150px;" name="contactMessage" id="email_content"></textarea>
                        </div>
                        </div>
                        
                </div>	
                <div style="width:420px;" class="Choose_payment_text1">
                            <div style="margin:0px;" class="update"><button class="btn" type="submit" style="position: relative;top: -5px;float:right;"><?=_l('Send',$this);?></button></div>
                            <div class="clear"></div>
                    </div>
                
                <div class="clear"></div>
                 </form>
</div>
</div>


<script type="text/javascript">
  function check_information(){
		var input = $('#contact input.require');
		for(var i=0;i<input.length;i++){
			var each = input[i];
			if($(each).val()==''){
				alert('Please Fill '+ $(each).parent().parent().find('span.lbname').text()+'!');
				$(each).focus();
				return false;
			}
		}
		if(!$.trim($('#contact textarea.require').val()))
		{
			alert('Please Fill E-Enquiry');
			$('#contact textarea.require').focus();
			return false;
		}
	}   
</script>

