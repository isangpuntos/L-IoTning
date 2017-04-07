<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.carouFredSel-5.6.4-packed.js"></script>
<!-- Third, add the GalleryView Javascript and CSS files -->
<!-- First, add jQuery (and jQuery UI if using custom easing or animation -->
<!-- Second, add the Timer and Easing plugins -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/zozo.tabs.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery.timers-1.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery.easing.1.3.js"></script>
<!-- Third, add the GalleryView Javascript and CSS files -->
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery.galleryview-3.0-dev.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/jquery.galleryview-3.0-dev.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/darkwash.css" media="screen" />

<style>
.panel .overlay-background { height: 666px;background: none; }
.gv_panelWrap{cursor:pointer;background:none !important;}
.gv_galleryWrap{background:none !important; height:280px !important;}
.gv_gallery {height:280px !important;}
.gv_navWrap{display:none !important;}
.gv_showOverlay{display:none;}
.gv_gallery{background:#fff;}
.gv_filmstripWrap {display:none !important;}
</style>
<!-- Lastly, call the galleryView() function on your unordered list(s) -->
<script type="text/javascript">
	$(function(){
		$('#myGallery').galleryView({
		    panel_width: 990,
		    panel_height: 280,
		});
	});
</script>
<script>
        $(document).ready(function () {
            var tabbedNav = $("#tabbed-nav").zozoTabs({
                orientation: "horizontal",
                animation: { duration: 200 },                
                defaultTab: "tab1",
            });

            $("#duration").change(function () {
                var duration = parseInt($("#duration").val());
                tabbedNav.data("zozoTabs").setOptions({ "animation": { "duration": duration } });
            });

            $("#config input").change(function () {
                var effects = $('input[type=radio]:checked').attr("id");
                tabbedNav.data("zozoTabs").setOptions({ "animation": { "effects": effects } });
            });
        });
    </script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.carouFredSel-5.6.4-packed.js"></script>
<style type="text/css">
.caroufredsel_wrapper{height: 310px !important; margin: 0 !important; width: auto !important;}
ul.featured_cars li a .owner-box .vehicle_name_block .car-details{width:220px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;list-style:none;}
ul.featured_cars li a .price .main-number{font-size: 26px;padding-right: 5px;}
.car-details{margin:0;}
a.prev, a.next {
	background: url(<?php echo base_url(); ?>assets/frontend/img/miscellaneous_sprite.png) no-repeat transparent;
    display: block;
    height: 50px;
    position: absolute;
    top: 120px;
    width: 45px;
    z-index: 10;
}
a.prev {			left: 0px;
					background-position: 0 0; }
a.prev:hover {		background-position: 0 -50px; }
a.prev.disabled {	background-position: 0 -100px !important;  }
a.next {			right: 5px;
					background-position: -50px 0; }
a.next:hover {		background-position: -50px -50px; }
a.next.disabled {	background-position: -50px -100px !important;  }
a.prev.disabled, a.next.disabled {
	cursor: default;
}

a.prev span, a.next span {
	display: none;
}

.clearfix {
	 float: none;
	 clear: both;
}
div#foo2_pag {
    height: 15px;
    float:left;
	margin:0 auto;
    text-align: center;
    width:100%;
}
div#foo2_pag a {
    background: url("http://caroufredsel.dev7studios.com/images/miscellaneous_sprite.png") no-repeat scroll 0 -300px transparent;
    display: inline-block;
    height: 15px;
    margin: 0 5px 0 0;
    width: 15px;
}
div#foo2_pag a.selected {
    background-position: -25px -300px;
    cursor: default;
}
div#foo2_pag a span {
    display: none;
}	
</style>
<style type="text/css">
.active-menu{
	background-color: rgb(255, 204, 115) !important;
}
.content-area{
	width: 640px;
}
.box-meal img{
	width: 192px;
	height: 146px;
}
.box-meal p{
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
	margin: 2px;
}
.box-meal .meal-price{
	margin: 5px 0 15px 0;
}
.box-info-btn{margin-top: 0px;}
.ui-effects-transfer { border: 2px dotted gray; }
.meal-price{text-align:right;font-weight:bold !important;}
.type_price input[type=radio] {
	height: 13px;
	margin: 1px;
	position: relative;
	top: 2px;
}
.type_price {
	text-align: right;
	font-size: 12px !important;
}
.label_meal{
	position: relative;
	top: -55px;
	width: 18px;
	height: 18px;
	float: right;
	margin: 4px;
	padding: 8px;
	font-weight: lighter;
	font-family: 'Kaushan Script',Helvetica,Arial;
	font-size: 18px;
}
</style>
<script type="text/javascript">

$(document).ready(function() {


$('#slider').carouFredSel({
	    circular: true,
		infinite: false,
		auto: {play: true,duration: 7500, easing: "linear", timeoutDuration : 0,},
		scroll : {items: 4,pauseOnHover: true,},
		prev	: {	
			button	: "#foo2_prev",
			key		: "left"
		},
		next	: { 
			button	: "#foo2_next",
			key		: "right"
		},
		responsive : false,
    });

$('#slider1').carouFredSel({
	circular: true,
	infinite: false,
    auto: {play: true,duration: 7500, easing: "linear", timeoutDuration : 0,},
    scroll : {items: 4,pauseOnHover: true},
	prev	: {	
		button	: "#foo2_prev1",
		key		: "left"
	},
	next	: { 
		button	: "#foo2_next1",
		key		: "right"
	},
	responsive : false,
});

});


</script>
 <?php if((isset($extension_data_popular) && count($extension_data_popular) > 0) || (isset($extension_data) && count($extension_data) > 0))  { $minheight = ""; } else {  $minheight = "min-height:250px;";  } ?>
<div class="b_n_sell_banner" style="padding-top:20px;<?php echo $minheight; ?>">
<?php if(isset($extension_image) && count($extension_image) > 0) {?>
     <ul id="myGallery">
      
                <?php foreach($extension_image as $imge) {?>
				<li><img src="<?php echo base_url(); ?><?php echo image($imge['image'],$settings['default_image'],990,280);?>"/>
				<?php } ?>
	</ul>
<?php } ?>
</div>


 <?php if(isset($extension_data_popular) && count($extension_data_popular) > 0) {?>
<div class="box_a">
  <div class="b_grid_and_list">
      <!-- <div class="b_grid">
       <a href="?type=list<?php echo $link_type; ?>" style="<?php if($type=='list') echo 'opacity:0.5;'; ?>" class="list"></a>
       <a href="?type=thumb<?php echo $link_type; ?>" style="<?php if($type=='thumb') echo 'opacity:0.5;'; ?>" class="grid"></a>
       </div>
        --> 
        <div class="most_popular"><a href="#">Most Popular</a></div>
        <div class="clear"></div>
        <div class="shadow"></div>
        <div class="products">
         <?php if($type=='thumb') { ?>
            <div class="bg_in jCarouselLite" style="margin:0px;position:relative;">
            <ul id="slider" class="featured_cars">
               
            	<?php foreach($extension_data_popular as $data) {?>
            	<li class="prodcut_page">
                	<div style="width:220px;height:149px;"><a href="<?php echo base_url();?>extension/<?php echo $data['extension_id'];?>/<?php echo url_title($data['name']); ?>.html"><img src="<?php echo base_url(); ?><?php echo image($data['image'],$settings['default_image'],220,149);?>" /></a></div>
                    <div class="prodect_name"><a href="<?php echo base_url();?>extension/<?php echo $data['extension_id'];?>/<?php echo url_title($data['name']); ?>.html"><?php echo $data['name'];?></a></div>
                    <div class="prodect_by"><span><?=_l('by',$this);?></span><?php echo $data['username'];?></div>
                    <div class="prodect_border"></div>
                    <div class="product_text"><?php echo $data['category_name'];?> </div>
                    <div class="review_bg">
                    	<span style="float:left;" class="cover-stat cover-stat-appreciations">
                            <span><img src="<?php echo base_url(); ?>assets/frontend/img/thumb1.png" width="13" height="12" align="absmiddle" style="margin:-3px 0 0 0;" /></span>
                            <span class="stat-value"><?php echo $data['like'];?></span>
                        </span>
                        <span style="float:left;margin-left:10px;" class="cover-stat">
                            <span><img src="<?php echo base_url(); ?>assets/frontend/img/thumb2.png" width="13" height="12" align="absmiddle" style="margin:-3px 0 0 10px;" /></span>
                            <span class="stat-value"><?php echo $data['dislike'];?></span>
                        </span>
                         <span style="float:right;" class="cover-stat" style="margin-left:50px;">
                            <span><img src="<?php echo base_url(); ?>assets/frontend/img/view_icon.png" width="14" height="9" align="absmiddle" style="margin:0px 0 0 10px;" /></span>
                            <span class="stat-value"><?php echo $data['views'];?></span>
                        </span>
                    </div>
                </li>
                <?php }  ?>
            </ul>
			<a class="prev" id="foo2_prev" href="javascript:;"><span>prev</span></a>
			<a class="next" id="foo2_next" href="javascript:;"><span>next</span></a>
            <?php } else { ?>
            	<div class="bg_in">
            	<?php if(isset($extension_data_popular) && count($extension_data_popular) > 0) {?>
            	<?php foreach($extension_data_popular as $data) {?>
            	<div class="product_list_style">
                	<div class="list-prodcut_img">
                    	<div><a href="<?php echo base_url();?>extension/<?php echo $data['extension_id'];?>/<?php echo url_title($data['name']); ?>.html"><img src="<?php echo base_url(); ?><?php echo image($data['image'],$settings['default_image'],223,149);?>"></a></div>
                    </div>
                    <div class="product_text12">
                    	<div class="David_Vicente"><a href="<?php echo base_url();?>extension/<?php echo $data['extension_id'];?>/<?php echo url_title($data['name']); ?>.html"><?php echo $data['name'];?></a></div>
                        <div class="David_Vicente_text"><?php echo split_words($data['description'],200,"...");?></div>
                        <div style="margin:20px 0 0 0;" class="product_text"><?php echo $data['category_name'];?> </div>
                        <div style="position:relative; width: 120px; left: 615px; top: -60px;" class="Price_index">
                        	<p> <?=_l('Price',$this);?>: <span style="color:#000000; font-weight:600;"><?php echo $data['price'];?></span></p>
                        </div>
                       <div style="background:none; padding-left:0px; position:relative; width:100px; left: 615px; top: -40px;" class="buynow">
                            <!-- <a href="<?php echo base_url();?>checkout/<?php echo $data['extension_id']; ?>" class="buy_now" style="margin:0px;"><?=_l('Buy Now',$this);?></a> -->
                            <?php if($data['price_orgi']!=0) {?>
                    	 <a href="javascript:;" onclick="add_to_cart('<?php echo $data['name'];?>',<?php echo $data['extension_id'];?>,<?php echo $data['price_orgi']?>,0,0);" class="buy_now cart" style="margin:0px;"><?=_l('Add to Cart',$this);?></a>
                    	<?php } else {?>
                    	 <a href="javascript:;" class="buy_now cart" style="margin:0px;"><?=_l('Add to Cart',$this);?></a>
                    	<?php }?>
                           
                            
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                </div>
                <div class="index_broder"></div>
				<?php } } ?>
                <div class="clear"></div>
                <div class="paging"><?php echo $pagination;?></div>
            </div>
            <?php }?>
        </div>
  </div>
</div>
</div>
<?php } ?>
<div style="clear:both;"></div>

  <?php if(isset($extension_data) && count($extension_data) > 0) {?>
<div class="box_a">
  <div class="b_grid_and_list">
      <!-- <div class="b_grid">
       <a href="?type=list<?php echo $link_type; ?>" style="<?php if($type=='list') echo 'opacity:0.5;'; ?>" class="list"></a>
       <a href="?type=thumb<?php echo $link_type; ?>" style="<?php if($type=='thumb') echo 'opacity:0.5;'; ?>" class="grid"></a>
       </div>
        --> 
        <div class="most_popular"><a href="#">Lastest</a></div>
        <div class="clear"></div>
        <div class="shadow"></div>
        <div class="products">
         <?php if($type=='thumb') { ?>
            <div class="bg_in jCarouselLite" style="margin:0px;position:relative;">
            <ul id="slider1" class="featured_cars">
                <?php if(isset($extension_data) && count($extension_data) > 0) {?>
            	<?php foreach($extension_data as $data) {?>
            	<li class="prodcut_page">
                	<div style="width:220px;height:149px;"><a href="<?php echo base_url();?>extension/<?php echo $data['extension_id'];?>/<?php echo url_title($data['name']); ?>.html"><img src="<?php echo base_url(); ?><?php echo image($data['image'],$settings['default_image'],220,149);?>" /></a></div>
                    <div class="prodect_name"><a href="<?php echo base_url();?>extension/<?php echo $data['extension_id'];?>/<?php echo url_title($data['name']); ?>.html"><?php echo $data['name'];?></a></div>
                    <div class="prodect_by"><span><?=_l('by',$this);?></span><?php echo $data['username'];?></div>
                    <div class="prodect_border"></div>
                    <div class="product_text"><?php echo $data['category_name'];?> </div>
                    <div class="review_bg">
                    	<span style="float:left;" class="cover-stat cover-stat-appreciations">
                            <span><img src="<?php echo base_url(); ?>assets/frontend/img/thumb1.png" width="13" height="12" align="absmiddle" style="margin:-3px 0 0 0;" /></span>
                            <span class="stat-value"><?php echo $data['like'];?></span>
                        </span>
                        <span style="float:left;margin-left:10px;" class="cover-stat">
                            <span><img src="<?php echo base_url(); ?>assets/frontend/img/thumb2.png" width="13" height="12" align="absmiddle" style="margin:-3px 0 0 10px;" /></span>
                            <span class="stat-value"><?php echo $data['dislike'];?></span>
                        </span>
                         <span style="float:right;" class="cover-stat" style="margin-left:50px;">
                            <span><img src="<?php echo base_url(); ?>assets/frontend/img/view_icon.png" width="14" height="9" align="absmiddle" style="margin:0px 0 0 10px;" /></span>
                            <span class="stat-value"><?php echo $data['views'];?></span>
                        </span>
                    </div>
                </li>
                <?php }  ?>
            </ul>
			<a class="prev" id="foo2_prev1" href="javascript:;"><span>prev</span></a>
			<a class="next" id="foo2_next1" href="javascript:;"><span>next</span></a>
            <?php } else { ?>
            	<div class="bg_in">
            	<?php if(isset($extension_data) && count($extension_data) > 0) {?>
            	<?php foreach($extension_data as $data) {?>
            	<div class="product_list_style">
                	<div class="list-prodcut_img">
                    	<div><a href="<?php echo base_url();?>extension/<?php echo $data['extension_id'];?>/<?php echo url_title($data['name']); ?>.html"><img src="<?php echo base_url(); ?><?php echo image($data['image'],$settings['default_image'],223,149);?>"></a></div>
                    </div>
                    <div class="product_text12">
                    	<div class="David_Vicente"><a href="<?php echo base_url();?>extension/<?php echo $data['extension_id'];?>/<?php echo url_title($data['name']); ?>.html"><?php echo $data['name'];?></a></div>
                        <div class="David_Vicente_text"><?php echo split_words($data['description'],200,"...");?></div>
                        <div style="margin:20px 0 0 0;" class="product_text"><?php echo $data['category_name'];?> </div>
                        <div style="position:relative; width: 120px; left: 615px; top: -60px;" class="Price_index">
                        	<p> <?=_l('Price',$this);?>: <span style="color:#000000; font-weight:600;"><?php echo $data['price'];?></span></p>
                        </div>
                       <div style="background:none; padding-left:0px; position:relative; width:100px; left: 615px; top: -40px;" class="buynow">
                            <!-- <a href="<?php echo base_url();?>checkout/<?php echo $data['extension_id']; ?>" class="buy_now" style="margin:0px;"><?=_l('Buy Now',$this);?></a> -->
                            <?php if($data['price_orgi']!=0) {?>
                    	 <a href="javascript:;" onclick="add_to_cart('<?php echo $data['name'];?>',<?php echo $data['extension_id'];?>,<?php echo $data['price_orgi']?>,0,0);" class="buy_now cart" style="margin:0px;"><?=_l('Add to Cart',$this);?></a>
                    	<?php } else {?>
                    	 <a href="javascript:;" class="buy_now cart" style="margin:0px;"><?=_l('Add to Cart',$this);?></a>
                    	<?php }?>
                           
                            
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                </div>
                <div class="index_broder"></div>
				<?php } } ?>
                <div class="clear"></div>
                <div class="paging"><?php echo $pagination;?></div>
            </div>
            <?php }?>
			</div>
		<?php }?>
  </div>
</div>
</div>
<?php } ?>
<div style="clear:both;"></div>
<!--
            <div class="list_grid">
            	<div class="list_grid_in">
                	<div class="product-filter">
				    <div class="limit"><b><?=_l('Show',$this);?>:</b>
				          <select onchange="location = this.value;" style="width:60px;">
				                        	<option  <?php if($limit==15){?>selected="selected" <?php }?> value="<?php echo $link_limit ;?>&amp;limit=15">15</option>
				                            <option  <?php if($limit==25){?>selected="selected" <?php }?> value="<?php echo $link_limit ;?>&amp;limit=25">25</option>
				                            <option  <?php if($limit==50){?>selected="selected" <?php }?> value="<?php echo $link_limit ;?>&amp;limit=50">50</option>
				                            <option  <?php if($limit==75){?>selected="selected" <?php }?> value="<?php echo $link_limit ;?>&amp;limit=75">75</option>
				                            <option  <?php if($limit==100){?>selected="selected" <?php }?> value="<?php echo $link_limit ;?>&amp;limit=100">100</option>
				          </select>
				    </div>
				    <div class="sort"><b><?=_l('Sort By',$this);?>:</b>
				    <select onchange="location = this.value;" style="width:160px;">
				                        <option <?php if($sortorder =="") { ?> selected="selected" <?php }?> value="<?php echo $link_sort ;?>"><?=_l('Default',$this);?></option>
				                        <option <?php if($sortorder =="nameASC") { ?> selected="selected" <?php }?> value="<?php echo $link_sort ;?>&amp;sort=name&amp;order=ASC"><?=_l('Name (A - Z)',$this);?></option>
				                        <option <?php if($sortorder =="nameDESC") { ?> selected="selected" <?php }?> value="<?php echo $link_sort ;?>&amp;sort=name&amp;order=DESC"><?=_l('Name (Z - A)',$this);?></option>
				                        <option <?php if($sortorder =="priceASC") { ?> selected="selected" <?php }?> value="<?php echo $link_sort ;?>&amp;sort=price&amp;order=ASC"><?=_l('Price (Low &gt; High)',$this);?></option>
				                        <option <?php if($sortorder =="priceDESC") { ?> selected="selected" <?php }?> value="<?php echo $link_sort ;?>&amp;sort=price&amp;order=DESC"><?=_l('Price (High &gt; Low)',$this);?></option>
				                      </select>
				    </div>
				     <div class="sort" style="margin-right:5px;"><b><?=_l('Categories',$this);?>:</b>
				   
                            <select id="Categories" style="width:80px;" onchange="location = this.value">
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
									
									echo "<option value='".$link_category."&path=".$item['category_id']."'".$checked.">".$item['category_name']." (".$item['total_extension'].") </option>";
								}
								else
								{
									echo "<option value='".$link_category."&path=".$item['category_id']."'>".$item['category_name']." (".$item['total_extension'].") </option>";
								}
							}
							?>
                            </select>
				     </div>
				    
				  </div>
                </div>
            </div>
            
  -->         
    <script type="text/javascript">
    function add_to_cart(name,id,price,update,type)
    {
        	$.ajax({
        	  url: "<?php echo base_url(); ?>add-cart?id="+id+"&price="+price+"&update="+update+"&type="+type,
        	  success: function(){
        	 	alert("Successfully, You added item '"+name+"' into your cart");
        	  }
        	});
       
    }
    </script>