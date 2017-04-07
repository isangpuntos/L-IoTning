<script type="text/javascript">
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
         <div class="titlebar">	<h2>PAYMENT GATEWAY - Paypal Setting</h2>	<p>Payment Gateway - Paypal Setting</p></div>
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
<div class="simplebox grid740" style="z-index: 720;margin:0 auto;">
                            	<div class="titleh" style="z-index: 710;">
                                	<h3>Paypal Setting</h3>
                                </div>
                                <div class="body" style="z-index: 690;">
                                  <form action="" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                                  
                                  	 <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Paypal Username:</span>	
                                        <input type="text" value="<?php echo isset($banners['paypal_username'])?$banners['paypal_username']:""; ?>" style="width:510px" id="paypal_username" class="st-forminput" name="data[paypal_username]" original-title="Your Paypal Username"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Paypal Password:</span>	
                                        <input type="text" value="<?php echo isset($banners['paypal_password'])?$banners['paypal_password']:""; ?>" style="width:510px" id="paypal_password" class="st-forminput" name="data[paypal_password]" original-title="Your Paypal Password">
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                     <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Paypal Signature:</span>	
                                        <input type="text" value="<?php echo isset($banners['paypal_signature'])?$banners['paypal_signature']:""; ?>" style="width:510px" id="paypal_signature" class="st-forminput" name="data[paypal_signature]" original-title="Your Paypal Signature">
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