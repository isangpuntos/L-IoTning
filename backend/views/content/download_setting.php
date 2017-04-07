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
         <div class="titlebar">	<h2>DOWNLOAD SETTING - Download Setting</h2>	<p>Download Gateway - Download Setting</p></div>
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
                                	<h3>Download Setting</h3>
                                </div>
                                <div class="body" style="z-index: 690;">
                                  <form action="" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" autocomplete="off"  class="form-horizontal form-row-seperated">
                                  
                                  	 <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Download Type(rar,zip):</span>	
                                        <input type="text" value="<?php echo isset($banners['download_type'])?$banners['download_type']:""; ?>" style="width:510px" id="download_type" class="st-forminput" name="data[download_type]" original-title="Your Download Type"> 
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Download Times:</span>	
                                        <input type="text" value="<?php echo isset($banners['download_times'])?$banners['download_times']:""; ?>" style="width:510px" id="download_times" class="st-forminput" name="data[download_times]" original-title="Your Download Times">
                                    <div class="clear" style="z-index: 650;"></div>
                                    </div>
                                    
                                     <div class="st-form-line" style="z-index: 660;">	
                                    	<span class="st-labeltext">Download Expire(s):</span>	
                                        <input type="text" value="<?php echo isset($banners['download_expire'])?$banners['download_expire']:""; ?>" style="width:510px" id="download_expire" class="st-forminput" name="data[download_expire]" original-title="Your Download Expire">
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