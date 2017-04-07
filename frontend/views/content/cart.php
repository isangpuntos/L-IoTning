<?php
function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}
?>
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
</script>

<div class="bg_img">
            	<div class="bg_img_in">
                	<h1><span><?=_l('Cart',$this);?> </span></h1>
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
                    	<div class="Product_Name ">
                        	<div><?=_l('Product Name',$this);?></div>
                        </div>            
                        <div class="Quantity ">
                        	<div><?=_l('Quantity',$this);?></div>
                        </div>
                        <div class="Price  ">
                        	<div><?=_l('Price',$this);?></div>
                        </div>
                        <div class="Total">
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
                        <div class="Product_Name_a ">
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
                        <div class="Total_a">
                        	<div><?php echo $this->currency->format($row['amount']*$row['data']['price']);?></div>
                        </div>
                   
                        <div class="clear"></div>                    
                    </div>
                     <?php $total+= $row['amount']*$row['data']['price'];  ?>
	            <?php } ?>  
	           
	            
	                 <div class="By_an_Extension_License1">
                        <div class="Product_Name_a " style="border:none;width:311px;">
                        	<div></div>
                        </div>            
                        <div class="Quantity_a ">
                        	<div>
                             
                            </div>
                        </div>
                        <div class="Price_a  ">
                        	<div style="font-weight:bold;color:red;font-size:15px;"><?=_l('Total',$this);?></div>
                        </div>
                        <div class="Total_a">
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
                    <div class="clear"></div> 
   
                </div>
                    <div class="clear"></div>
                    <div class="Choose_payment_text1" >
                    		<input type="hidden" name="total_money" value="<?php echo isset($total)?$total:0;?>">
                    	  <div style="float:left; margin:0px;" class="update"><a href="<?php echo $link_back;?>"><?=_l('Back',$this);?></a></div>
                          <?php if(isset($meals)) { ?>
                          <div class="update" style="margin:0px;"><a href="<?php echo base_url()."checkout"?>"><?=_l('Checkout',$this);?></a></div>
                          <?php }?>
                            <div class="clear"></div>
                    </div>
                </div>
                
                 </form>
                
                <div class="clear"></div>
                    
            </div>