<script type="text/javascript">
function chkSubmit()
{
	if(isNaN(document.edit_user_form.commission.value))
	{
		alert('Please input Number only.');
		return false;
	}
	else if(document.edit_user_form.commission.value > 100)
	{
		alert('Commission error format');
		return false;
	}

}
function check_total()
{
	if(!isNaN(document.edit_user_form.commission.value) && document.edit_user_form.commission.value <= 100)
	{
		document.edit_user_form.total_balance.value = document.edit_user_form.total_price.value - (document.edit_user_form.total_price.value*document.edit_user_form.commission.value/100);
	}
	else
	{
		alert('Please commission error format');
	}
}
</script>
<!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>COMMISSION MANAGER - <?php echo $id==""?"Add":"Edit"?> Commission</h2>	<p>Commission manager - <?php echo $id==""?"Add":"Edit"?> Commission</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <!-- START CONTENT -->
<div class="content">
<div class="simplebox grid740" style="z-index: 720;margin:0 auto;">
                            	<div class="titleh" style="z-index: 710;">
                                	<h3><?php echo $id==""?"Add":"Edit"?> Commission</h3>
                                </div>
                                <div class="body" style="z-index: 690;">
                                <form onsubmit="return chkSubmit();" action="" method="post" enctype="multipart/form-data" name="edit_user_form" id="edit_user_form" class="form-horizontal form-row-seperated">
									<div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Total Amount($)</span>	
                                        <input type="text" disabled onkeypress='validate(event)' value="<?php echo isset($banners['total_price'])?$banners['total_price']:"0"; ?>" style="width:510px" class="st-forminput" original-title="Total price"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>

                                  	<div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Commission(%)</span>	
                                        <input type="text" onchange="check_total()" value="<?php echo isset($banners['commission'])?$banners['commission']:"0"; ?>" style="width:510px" id="commission" class="st-forminput" name="commission" original-title="Commission"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                    
                                    <div class="st-form-line" style="z-index: 680;">	
                                    	<span class="st-labeltext">Total Balance($)</span>	
                                        <input type="text" disabled value="<?php echo isset($banners['total_balance'])?$banners['total_balance']:"0"; ?>" style="width:510px" id="total_balance" class="st-forminput" name="total_balance" original-title="Total Balance"> 
                                    	<div class="clear" style="z-index: 670;"></div>
                                    </div>
                                   
                                    <div class="button-box" style="z-index: 460;">
                                    	<input type="hidden" name="currentid" value="<?php echo $id;?>">
                                    	<input type="hidden" name="total_price" value="<?php echo $banners['total_price'];?>">
                                   	  <a href="<?php echo base_url(); ?>backend.php/cpanel/admin_commission" class="button-gray">&laquo; Back</a>
                                   	  <input type="submit" class="st-button" value="Submit" id="button" name="button">
                                   	 
                                    </div>
                                  </form>
                                  
                                </div>
                            </div>
</div>
  <!-- END CONTENT -->