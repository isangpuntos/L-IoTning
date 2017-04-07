<script type="text/javascript">
function check_search() {
	url = '<?php echo $link_search;?>';
	var filter_search = $('#filter_search').attr('value');
	if (filter_search) {
		url += '&filter_search=' + encodeURIComponent(filter_search);
	}
	if (filter_search) {
		window.location = url;
	}
}
$(document).ready(function() {
	$('#filter_search').bind("keypress", function(e) {
		  if (e.keyCode == 13) {               
		    e.preventDefault();
		    check_search();
		  }
});
});

function check_information(){
	 var $radios = $('input:radio[name=shipping_address]');
	  <?php if($shipping==1) {?>
	  if($radios.is(':checked') === false)
	  	{
	  		alert('<?=_l('Please choose shipping address',$this);?>');
	  	}
	      else if($("#term:checked").length != 1)
			{
				alert('<?=_l('Please read and agree with our terms & conditions',$this);?>');
			}
			else
			{
				$("#update_quantity").attr("action", "<?php echo base_url();?>delivery");
				$("#update_quantity").submit();
			}
	  <?php } else { ?>
	     if($("#term:checked").length != 1)
			{
				alert('<?=_l('Please read and agree with our terms & conditions',$this);?>');
			}
			else
			{
				$("#update_quantity").attr("action", "<?php echo base_url();?>delivery");
				$("#update_quantity").submit();
			}
	  <?php } ?>
	    
		return;
}   
function show(type)
{
	if(type==1)
	{
		$('#new_address').show();
	}
	else
	{
		$('#new_address').hide();
	}
}

</script>

<div class="bg_img">
            	<div class="bg_img_in">
                	<h1><span><?=_l('Purchase',$this);?> </span><?=_l('License',$this);?> </h1>
                </div>
            </div>
            
            <div class="Purchase">
				<div class="Extension_Filter">
                	<div class="Extension_text"><?=_l('Extension Filter',$this);?></div>
                
                 
                    <div class="form-horizontal" style="margin-top:20px;">
                        <div class="control-group">
                        <label class="control-label" style="float:none; margin:0 0 0 0px;" for="Search"><?=_l('Search',$this);?></label>
                        <div class="controls" style="width:255px;float:none; margin:5px 0 0 0px;">
                            <input type="text" value="<?php echo isset($_GET['filter_search'])?$_GET['filter_search']:"";?>" style="border-radius: 5px 0 0 5px;width:208px;" name="filter_search" id="filter_search" placeholder="<?=_l('Search',$this);?>"><a id="button-search" href="javascript:check_search();"><?=_l('Go',$this);?></a>
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" style="float:none; margin:0 0 0 0px;" for="Categories"><?=_l('Categories',$this);?></label>
                        <div class="controls" style="float:none; margin:5px 0 0 0px;">
                            <select id="Categories" style="width:250px;" onchange="location = this.value">
                             <option value="<?php echo $link_category;?>"><?=_l('All',$this);?> (<?php echo $total_extension;?>)</option>
                            <?php
							foreach($extension_category as $item)
							{
								if(isset($_GET['path']))
								{
									$checked=" ";
									if($_GET['path']==$item['category_id'])
									{
										$checked=" selected";
									}

									echo "<option value='".base_url()."category/".$item['category_id']."/".url_title($menu['category_name'])."?type=thumb'".$checked.">".$item['category_name']." (".$item['total_extension'].") </option>";
								}
								else
								{
									echo "<option value='".base_url()."category/".$item['category_id']."/".url_title($menu['category_name'])."?type=thumb'>".$item['category_name']." (".$item['total_extension'].") </option>";
								}
							}
							?>
                            </select>
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" style="float:none; margin:0 0 0 0px;" for="License"><?=_l('License',$this);?></label>
                        <div class="controls" style="float:none; margin:5px 0 0 0px;">
                            <select id="License" style="width:250px;" onchange="location = this.value">
                             <option value="<?php echo $link_license;?>"><?=_l('All',$this);?></option>
                            	<?php
								foreach($license as $item)
								{
									if(isset($_GET['filter_license']))
									{
										$checked=" ";
										if($_GET['filter_license']==$item['license_id'])
										{
											$checked=" selected";
										}
										
										echo "<option value='".$link_license."&filter_license=".$item['license_id']."'".$checked.">".$item['license_name']."</option>";
									}
									else
									{
										echo "<option value='".$link_license."&filter_license=".$item['license_id']."'>".$item['license_name']."</option>";
									}
								}
								?>
                            </select>
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" style="float:none; margin:0 0 0 0px;" for="Version"><?=_l('Version',$this);?></label>
                        <div class="controls" style="float:none; margin:5px 0 0 0px;">
                            <select id="Version" style="width:250px;" onchange="location = this.value">
                            <option value="<?php echo $link_compatibility;?>"><?=_l('All',$this);?></option>
                             <?php
								foreach($compatibility as $item)
								{
									if(isset($_GET['filter_download_id']))
									{
										$checked=" ";
										if($_GET['filter_download_id']==$item['compatibility_id'])
										{
											$checked=" selected";
										}
										
										echo "<option value='".$link_compatibility."&filter_download_id=".$item['compatibility_id']."'".$checked.">".$item['compatibility_name']."</option>";
									}
									else
									{
										echo "<option value='".$link_compatibility."&filter_download_id=".$item['compatibility_id']."'>".$item['compatibility_name']."</option>";
									}
								}
								?>
                            </select>
                        </div>
                        </div>
                        <!-- <div class="control-group">
                        <label class="control-label" style="float:none; margin:0 0 0 0px;" for="Currency"><?=_l('Currency',$this);?></label>
                        <div class="controls" style="float:none; margin:5px 0 0 0px;">
                            <select id="Currency" style="width:250px;">
                            	<option>USD</option>
                            </select>
                        </div>
                        </div> -->

                    </div>
                </div>
                <?php if($this->session->flashdata('checkout_warning')){?>
		            <div class="error" style="margin:10px;">Warning: <?php echo $this->session->flashdata('checkout_warning');?>!</div>
		         <?php } ?>
		         
		         <form method="POST" id="update_quantity" style="margin:0px;">
                <div class="Buy_Extension">
                    <div class="Purchase_License"  style="margin:0px;">
                	<div class="By_an_Extension_License">
                    	<div class="Product_Name "   <?php if($shipping == 1) {?> style="width:220px" <?php }?>>
                        	<div><?=_l('Product Name',$this);?></div>
                        </div>            
                        <div class="Quantity ">
                        	<div><?=_l('Quantity',$this);?></div>
                        </div>
                        <div class="Price  ">
                        	<div><?=_l('Price',$this);?></div>
                        </div>
                        <?php if($shipping == 1) {?>
                        <div class="Price  ">
                        	<div><?=_l('Shipping Price',$this);?></div>
                        </div>
                        <?php }?>
                        <div class="Total"    <?php if($shipping == 1) {?>style="width:50px;" <?php }?>>
                        	<div><?=_l('Total',$this);?></div>
                        </div>
                        
                        
                        <div class="clear"></div>                    
                    </div>
                    
                 <?php if(isset($meals)) { ?>
	        	<?php $total=0; foreach($meals as $row) { ?>
                    <div class="By_an_Extension_License1">
                    	<!-- <div class="Product_Name_a ">
                        	<div><img src="<?php echo base_url(); ?><?php echo $row['data']['image']; ?>" width="140" height="105" /></div>
                        </div> -->
                        <div class="Product_Name_a "   <?php if($shipping == 1) {?> style="width:220px"<?php }?>>
                        	<div><?php echo $row['data']['name']; ?></div>
                        </div>            
                        <div class="Quantity_a ">
                        	<div>
                             <input type="text" value="<?php echo $row['amount'] ?>" style="width:95px; margin-bottom:0px; padding:3px 5px 3px 5px;" name="quantity[<?php echo $row['data']['extension_id']?>]" />
                             <input type="hidden" value="<?php echo $row['data']['price'] ?>" name="price[<?php echo $row['data']['extension_id']?>]">
                            </div>
                        </div>
                        <div class="Price_a  ">
                        	<div><?php echo $this->currency->format($row['data']['price']);?>  </div>
                        </div>
                          <?php if($shipping == 1) {?>
                        <div class="Price_a  ">
                            <?php if($row['data']['shipping'] == 0) {?>
                            <div><?php echo $this->currency->format(0);?> x <?php echo $row['amount']; ?>  </div>
                            <?php } else {?>
                        	<div><?php echo $this->currency->format($row['data']['priceperweight']*$row['data']['weight']);?> x <?php echo $row['amount']; ?>  </div>
                        	<?php }?>
                        </div>
                        <?php }?>
                        <div class="Total_a"   <?php if($shipping == 1) {?> style="width:50px"<?php }?>>
                        	 <?php if($row['data']['shipping'] == 0) {?>
                        	<div><?php echo $this->currency->format($row['amount']*$row['data']['price']);?></div>
                        	 <?php } else {?>
                        	 <div><?php echo $this->currency->format(($row['amount']*$row['data']['price'])+($row['amount']*$row['data']['priceperweight']*$row['data']['weight']));?></div>
                        	 <?php }?>
                        </div>
                   
                        <div class="clear"></div>                    
                    </div>
                     <?php if($row['data']['shipping'] == 0) {?>
                     <?php $total+= $row['amount']*$row['data']['price'];  ?>
                     <?php } else {?>
                     <?php $total+= $row['amount']*$row['data']['price'] + ($row['amount']*$row['data']['priceperweight']*$row['data']['weight']);  ?>
                     <?php }?>
	            <?php } ?>  
	           
	            
	                 <div class="By_an_Extension_License1">
                        <div class="Product_Name_a " style="border:none;  <?php if($shipping == 1) {?>width:221px;<?php } else {?>width:311px; <?php }?>">
                        	<div></div>
                        </div>            
                        <div class="Quantity_a ">
                        	<div>
                             
                            </div>
                        </div>  <?php if($shipping == 1) {?>
                        <div class="Price_a  ">
                        	<div style="font-weight:bold;color:red;font-size:15px;"></div>
                        </div>
                        <?php }?>
                        <div class="Price_a  ">
                        	<div style="font-weight:bold;color:red;font-size:15px;"><?=_l('Total',$this);?></div>
                        </div>
                        <div class="Total_a"   <?php if($shipping == 1) {?>style="width:50px;"<?php }?>>
                        	<div style="font-weight:bold;color:red;font-size:15px;"><?php echo $this->currency->format($total);?></div>
                        </div>
                   
                        <div class="clear"></div>                    
                    </div>  
               
                    
                     <div class="update" style="margin: 15px 20px 15px 0;"><a href="javascript:$('#update_quantity').submit();"><?=_l('Update',$this);?></a></div>
                    <?php } else {?>
                     <div style="text-align:center;padding-top:10px;">
                    	
                        	<div><?=_l('No item in cart',$this);?></div>

                        <div class="clear"></div>                    
                    </div>  
                    <?php }?> 
                    </div>       
                    <div class="clear"></div> 
   
                    <div class="clear"></div>
                    <div class="Buy_Extension">
                        <div class="Extension_text" style="margin-top:15px;"><?=_l('Choose Your payment Method',$this);?></div>
                        <div class="Choose_payment">
                            <div>
                            <div><input checked type="radio" style="margin:-1px 0 0 34px;" value="1" name="payment_method"> PayPal</div>
                            <?php
// 							foreach($payment_method as $item)
// 							{
// 								if(isset($user_detail['payment_id']))
// 								{
// 									$checked=" ";
// 									if($user_detail['payment_id']==$item['payment_id'])
// 									{
// 										$checked=" checked";
// 									}
									
// 									echo '<div><input type="radio" name="payment_method" value="'.$item['payment_id'].'" '.$checked.' style="margin:-1px 0 0 34px;"> '.$item['payment_name'].'</div>';
// 								}
// 								else
// 								{
// 									echo '<div><input type="radio" name="payment_method" value="'.$item['payment_id'].'" style="margin:-1px 0 0 34px;"> '.$item['payment_name'].'</div>';
// 								}
// 							}
// 							?>
                            </div>
                        </div>
                    </div>
                    
                     <div class="clear"></div>
                     <?php if($shipping==1) {?>
                    <div class="Buy_Extension">
                        <div class="Extension_text" style="margin-top:15px;"><?=_l('Choose address to shipping',$this);?></div>
                        <div class="Choose_payment">
                            <div>
                            <?php
							foreach($shipping_data as $item)
							{
							    echo '<div><input type="radio" name="shipping_address" onclick="show(0)" value="'.$item['address_id'].'" style="margin:-1px 5px 0 34px;">'.$item['address'].'</div>';
							}
							?>
							
                            </div>
                            <div><input type="radio" name="shipping_address" onclick="show(1)" value="0" style="margin:-1px 5px 0 34px;">Địa chỉ mới</div>
                            <div style="clear:both;"></div>

           	<div class="Manage_Description" id="new_address" style="display:none;">
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
                        <input type="text" class="require" name="data[name]" value="" id="extension_name" placeholder="">
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
	                        <input type="text" class="require" value="" id="Advanced multiple Forms" name="data[city_name]" placeholder="">
	                        </div>
                        </div>
                            
                        <div class="control-group">
	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('Address 1',$this);?></span>:</label>
	                        <div class="controls" style="margin-left:319px;">
	                        <input type="text" class="require" value="" id="Advanced multiple Forms" name="data[address1]" placeholder="">
	                        </div>
                        </div>
                        
                        <div class="control-group">
	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('Address 2',$this);?></span>:</label>
	                        <div class="controls" style="margin-left:319px;">
	                        <input type="text" class="require" value="" id="Advanced multiple Forms" name="data[address2]" placeholder="">
	                        </div>
                        </div>
                        
                        <div class="control-group">
	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('State',$this);?></span>:</label>
	                        <div class="controls" style="margin-left:319px;">
	                        <input type="text" class="require" value="" id="Advanced multiple Forms" name="data[state]" placeholder="">
	                        </div>
                        </div>
                        
                        <div class="control-group">
	                        <label class="control-label" for="Advanced multiple Forms"><span class="required">*</span><span class="lbname"><?=_l('Postal/Zip',$this);?></span>:</label>
	                        <div class="controls" style="margin-left:319px;">
	                        <input type="text" class="require" value="" id="Advanced multiple Forms" name="data[postal]" placeholder="">
	                        </div>
                        </div>
                                             
                        </div>
                    </div>
                </div>
            </div>
            

        </div>

    <style>
         label.control-label {float:left}
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
     </div>
                        </div>
                        </div>
                <?php }?>
  
                    <div class="clear"></div>
                    <div class="Choose_payment_text" style="float:right;">
                    	<?php  echo  $des;  ?>
                    </div>
                    <div class="clear"></div>
                    <div style="float:right;"> 
                        	<div class="control-group" >
                        <div class="controls" style="margin-left:0px;">
                        <label class="checkbox" style="width:270px;">
                        <input name="term" <?php if(isset($term)) {?> checked <?php }?> type="checkbox" id="term"><?=_l(' I agree with the above terms & conditions',$this);?>
                        </label>
                        
                        </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="Choose_payment_text1" style="float:right;">
                    		<input type="hidden" name="total_money" value="<?php echo isset($total)?$total:0;?>">
                    			<input type="hidden" name="shipping" value="<?php echo $shipping;?>">
                    	  <div style="float:left; margin:0px;" class="update"><a href="<?php echo $link_back;?>"><?=_l('Back',$this);?></a></div>
                          <?php if(isset($meals)) { ?>
                          <div class="update" style="margin:0px;"><a href="javascript:check_information()"><?=_l('Checkout',$this);?></a></div>
                          <?php }?>
                            <div class="clear"></div>
                    </div>
                </div>
                
                 </form>
                 
                
                <div class="clear"></div>
                
                    
            </div>