<!-- First, add jQuery (and jQuery UI if using custom easing or animation -->
<!-- Second, add the Timer and Easing plugins -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/zozo.tabs.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery.timers-1.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery.easing.1.3.js"></script>

<!-- Third, add the GalleryView Javascript and CSS files -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery.galleryview-3.0-dev.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/jquery.galleryview-3.0-dev.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/darkwash.css" media="screen" />

<style>
.panel .overlay-background { height: 666px; cursor:pointer;background: none; }
.gv_panelWrap{cursor:pointer;background:#000;}
.gv_showOverlay{display:none;}
.gv_gallery{background:#fff;}
</style>
<!-- Lastly, call the galleryView() function on your unordered list(s) -->
<script type="text/javascript">
	$(function(){
		$('#myGallery').galleryView({
		    filmstrip_position: 'right',
		    enable_overlays: true,
		    overlay_position: 'top',
		    panel_animation: 'crossfade',
		    panel_width: 585,
		    panel_height: 320,
		    frame_width: 100,
		    frame_height: 60
		});
	
	   $(".gv_panelWrap").click(function() {
		    //get the link href 
		    var link = $(".gv_panelWrap .gv_panel img").attr('src');
		    $("#linkSlideshow").attr('href',link);
		    $("#linkSlideshow").fancybox();
		    $("#linkSlideshow").click();
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
<div class="bg_img" style="color:#999;margin-bottom:0px;mine-height:60px;">
    <div class="bg_img_in">
        <h1 style="margin: 30px 5px;"><span><?php echo isset($extension['name'])?$extension['name']:"";?>    -  </span>( <?php echo isset($extension['price'])?$this->currency->format($extension['price']):$this->currency->format(0);?> ) </h1>
    </div>
</div>
<div class="buy_n_sell_main_section" style="padding-top:0px;">
    <div class="products_inner_img_box">
    	<div class="products_inner_img_section">
        	 <ul id="myGallery">
                 	<?php if(isset($extension_image) && count($extension_image) > 0) {?>
                 	<?php foreach($extension_image as $imge) {?>
					<li><img src="<?php echo base_url(); ?><?php echo image($imge['image'],$settings['default_image'],585,320);?>"/>
					<?php } } else {?>
					<li><img src="<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],585,320);?>"/>
					<?php }?>
				</ul>
				<a style="display:none;" id="linkSlideshow" href=""></a>
                 <br> 
    			<div class="inner_tab" style="width:620px; margin:0px 0 0 0;"></div>
                <div class="clear"></div>
        </div>
<div class="b_tab">
<div id="example" class="k-content">

            <div id="animation">
                <div class="normal medium silver z-rounded z-shadows z-tabs horizontal top-left" id="tabbed-nav">
                <ul class="z-tabs-nav">
                        <li class="z-tab" data-link="tab2"><a class="z-link"><?=_l('Description',$this);?></a></li>
                        <li class="z-tab z-first" data-link="tab1"><a class="z-link"><?=_l('Download',$this);?></a></li>
                        <li class="z-tab" data-link="tab3"><a class="z-link"><?=_l('Documentation',$this);?></a></li>
                        <li class="z-tab z-last z-active" data-link="tab4"><a class="z-link"><?=_l('Comments',$this);?>(<span id="total_comment"><?php echo count($extension_comment);?></span>)</a></li>
                </ul>   
                    
                <div class="z-container" style="width:96%;">
                		<div class="z-content" style="padding: 15px; display: none;"><?php echo isset($extension['description'])?$extension['description']:"";?></div>
                        <div class="z-content" style="padding: 0px; display: none;">
                        	<div class="downloads_prodect_page">
                           <div class="Download_Name_prodect">
                           	<div><?=_l('Download Name',$this);?> </div>
                           </div>
                           <div class="Documentation_prodect">
                           	<div><?=_l('Compatibility',$this);?> </div>
                           </div>
                           <div class="Action_prodect">
                           	<div><?=_l('Action',$this);?> </div>
                           </div>
                           <div class="clear"></div>
                        </div>
                        <?php if(isset($extension_download) && count($extension_download)>0) {?>
                        <?php foreach($extension_download as $download) {?>
                        <div class="downloads_prodect_page_a" style="height:70px;">
                           <div class="Download_Name_prodect_a" style="height:70px;">
                           	<div><?php echo $download['item_name'];?></div>
                           </div>
                        
                           <div class="Documentation_prodect_a" style="height:70px;">
                           	<div><?php echo $download['compatibility'];?></div>
                           </div>
                           <div class="Action_prodect_a" style="height:70px;">
                           	<div><a target="_blank" href="<?php echo base_url();?>extension-download?extension_download_id=<?php echo $download['download_id'];?>"><?=_l('Download',$this);?> </a> </div>
                           </div>
                           <div class="clear"></div>
                        </div>
                        <?php } } else {?>
                         <div class="downloads_prodect_page_a" style="text-align:center;height:25px;padding-top:5px;"><?=_l('No result',$this);?></div>
                        <?php }?>
                        </div>
                        
                        <div class="z-content" style="padding: 15px; display: none;">
                            <?php  echo isset($extension['document'])?$extension['document']:""; ?>
                        </div>
                        
                        <div id="reply_message" class="z-content z-active" style="padding: 15px; display: block;">
                           <span id="listhead" style="display:none;"></span>
                        	<?php if(isset($extension_comment) && count($extension_comment) >0) {?>
                           <?php $i=1; foreach($extension_comment as $comment) { ?>
                           <div id ="com<?php echo $i;?>" <?php if($i > 5){?>style="display:none;"<?php }?>>
	                           <div class="man-img"><img src="<?php echo base_url(); ?><?php echo image($comment['avatar'],$settings['default_image'],84,84);?>" ></div>
	                           <div class="Comments-text">
	                           	<div class="name"><?php echo $comment['username'];?> - <?php echo my_int_date($comment['created_date']);?></div>
	                            <div class="comment_border"></div>
	                            <div class="comment_text"><?php echo $comment['content'];?></div>
	                            <div class="reply"><a href="#post_comment">reply</a></div>
	                           </div>
	                           <div class="clear"></div>
	                           <div class="border"></div>
                           </div>
                           <?php $i++;} ?> 
                           <?php if($i > 5){?><a id="show_more" href="javascript:;" onclick="show_more();" style="margin-left: 42%;font-weight: bold;font-size: 13px;"><?=_l('- More -',$this);?></a><?php }?>
                          <?php } else {?>
                           	<p style="text-align:center;"><?=_l('No comment',$this);?></p>
                           <?php }?>
                          <?php if(isset($_SESSION['user'])) {?>
                           <div id="success" class="success" style="display:none;margin-top:15px;"></div>
                           <h2 id="post_comment"><?=_l('Add Your Comment',$this);?> </h2>
                            <form action="" method="post" name="comment" id="commentform">
                           <p>
						      <textarea rows="8" style="width: 98%;" name="comment"></textarea>
						    </p>
						    <div style="margin:0px;" class="buttons">
						      <div class="left"><a class="button" href=""><?=_l('Back',$this);?></a></div>
						      <div class="right">
						       <input type="hidden" name="id" class="button" value="<?php echo $current_id;?>">
						       <?php if (isset($_SESSION['user']['user_id'])) {?>
						       <input type="hidden" name="uid" class="button" value="<?php echo $_SESSION['user']['user_id'];?>">
						       <?php }?>
						        <input type="submit" id="button-comment" class="button" value="Submit">
						      </div>
						    </div>
						    </form>
						    <?php } else {?>
						    <p><?=_l('Please login to comment',$this);?></p>
						    <?php }?>
                          
                        </div>
                        
                        
                    </div></div>
            </div>
            

        </div>
<div style="clear:both;"></div>
    <style>
        #animation {
            width: 727px;
            padding: 0px;
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
           min-height: 240px;
        }
    </style>



    

</div>
</div>
<div class="products_inner_img_section2">
    	<div class="inner_box_1">
        	<a class="live_preview" href="<?php echo isset($extension['link_preview'])?$extension['link_preview']:"";?>">Live Preview</a> 
            <?php if($extension['price']!=0) {?>
            <a class="buy_now" onclick="add_to_cart('<?php echo $extension['name'];?>',<?php echo $extension['extension_id'];?>,<?php echo $extension['price']?>,0,0);" href="javascript:;">Add to cart</a>
            <?php } else {?>
            <a class="buy_now" href="javascript:;">Add to cart</a>
            <?php }?>
        </div>
        <div class="Details">
        	<h1>Details</h1>
            <div class="inner_text">License <span><?php echo isset($extension['license_name'])?$extension['license_name']:"";?></span></div>
                        <div class="inner_text">Price <span><?php echo isset($extension['price'])?$this->currency->format($extension['price']):$this->currency->format(0);?></span></div>
                        <div class="inner_text">Developer <span><a href="<?php echo base_url()?>profile-list/<?php echo isset($extension['user_id'])?$extension['user_id']:"";?>/<?php echo url_title($extension['username']); ?>.html"><?php echo isset($extension['username'])?$extension['username']:"";?></a></span></div>
                        <?php if($extension['created_date']!=0) {?>
                        <div class="inner_text">Date Added <span><?php echo isset($extension['created_date'])?my_int_date($extension['created_date']):"";?></span></div>
                        <?php }?>
                         <?php if($extension['updated_date']!=0) {?>
                        <div class="inner_text">Date Modified <span><?php echo isset($extension['updated_date'])?my_int_date($extension['updated_date']):"";?></span></div>
                        <?php }?>
<!--                        <div class="inner_text">Votes <span><?php echo isset($extension['votes'])?$extension['votes']:"";?></span></div>-->
                        <div class="inner_text">Views <span><?php echo isset($extension['views'])?$extension['views']:"";?></span></div>
                        <?php if(isset($_SESSION['user']['user_id']) && $check_user_like ==1) {?>
                        <div class="inner_text button-like">Like<span id="like_frame" style="width:50px;" ><a title="I like it" href="javascript:like(<?php echo $extension['extension_id'];?>,<?php echo $_SESSION['user']['user_id'];?>)"><img src="<?php echo base_url();?>assets/frontend/img/like.png"> <span id="like_total"><?php echo isset($extension['like'])?$extension['like']:"";?></span></a></span></div>
                        <div class="inner_text button-like">Dislike<span id="dislike_frame" style="width:50px;" ><a title="I dislike it" href="javascript:dislike(<?php echo $extension['extension_id'];?>,<?php echo $_SESSION['user']['user_id'];?>)"><img src="<?php echo base_url();?>assets/frontend/img/dislike.png"><span id="dislike_total"><?php echo isset($extension['dislike'])?$extension['dislike']:"";?></span></a></span></div>
                        <?php } else {?>
                        	
                        	<div class="inner_text button-like">Like<span id="like_frame" style="width:50px;" ><img src="<?php echo base_url();?>assets/frontend/img/<?php if(isset($user_like_img) && $user_like_img==1){?>like_selected.png<?php } else {?>like.png<?php }?>"> <span id="like_total"><?php echo isset($extension['like'])?$extension['like']:"";?></span></span></div>
                        	<div class="inner_text button-like">Dislike<span id="dislike_frame" style="width:50px;" ><img src="<?php echo base_url();?>assets/frontend/img/<?php if(isset($user_like_img) && $user_like_img==0){?>dislike_selected.png<?php } else {?>dislike.png<?php }?>"><span id="dislike_total"><?php echo isset($extension['dislike'])?$extension['dislike']:"";?></span></span></div>
                        <?php }?>
                      
        </div>
        
         <?php if(isset($extension_option) && count($extension_option) >0) {?>
                    <div class="Details">
                    <h1>Other informations</h1>
                    <div class="inner_right_section_bg_color">
                    	<?php foreach($extension_option as $ex) {?>
                    	<?php if($ex['property_value']!="") {?>
                    	<div class="inner_text"><?php echo $ex['property_name'];?> <span><?php echo $ex['property_value'];?></span></div>
                    	<?php } }?>
                    </div>
                    </div>
                    <?php }?>
        
        <div class="b_Support">
             <span><img src="http://leopediademo.com/buynsell/assets/frontend/img/icon.png" align="absbottom"><span><a href="<?php echo base_url()?>contact/<?php echo $extension['user_id'];?>/<?php echo url_title($extension['username']); ?>.html">Support</a></span></span>
             <span style="margin-left:30px;"><img src="http://leopediademo.com/buynsell/assets/frontend/img/icon1.png" align="absbottom"><span><a href="<?php echo base_url()?>contact">Extension</a></span></span>
        </div>
</div>
<div class="clear"></div>
</div>
                <div class="clear"></div>
                 <?php if(isset($extension_relate) && count($extension_relate) > 3) {?>
                <div class="related_products">Related products</div>
                <div class="inner_page_slider">
				<div style="float:left; margin:130px 20px 0 0;"><a href="javascript:;" class="prev"><img src="<?php echo base_url(); ?>assets/frontend/img/pre.png" height="26" width="26" border="0"></a></div>      
				<div style="float:right; margin:130px 0px 0 0;"><a href="javascript:;" class="next"><img src="<?php echo base_url(); ?>assets/frontend/img/next.png" height="26" width="26" border="0"></a></div>
				<div class="anyClass">
				    <ul>
				       
		            	<?php foreach($extension_relate as $data) {?>
		            	<li>
			            	<div class="prodcut_page_inner">
			                	<div><a href="<?php echo base_url();?>extension/<?php echo $data['extension_id'];?>/<?php echo url_title($data['name']); ?>.html"><img width="210" height="137" src="<?php echo base_url(); ?><?php echo $data['image'];?>" /></a></div>
			                    <div class="prodect_name"><a href="<?php echo base_url();?>extension/<?php echo $data['extension_id'];?>/<?php echo url_title($data['name']); ?>.html"><?php echo $data['name'];?></a></div>
			                    <div class="prodect_by"><span>by</span><?php echo $data['username'];?></div>
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
			                </div>
			                
		                </li>
		                <?php }  ?>
				      
				    </ul>
				</div>
                
                
                <div class="clear"></div>
                </div>
                <?php }?>
           </div>
<script type="text/javascript">
 
    var show_cur = 6;
   
	function show_more()
	{
		for(i=show_cur;i<show_cur+5;i++)
	    {
			$("#com"+i).attr('style','');
			$("#com"+i).hide();
			$("#com"+i).slideDown("slow");
			
		}
			
			
			show_cur = show_cur+5;
			if(show_cur > <?php echo count($extension_comment);?>)
			$("#show_more").attr('style','display:none');
		
	}

	$(document).ready(function(){
		var working = false;
		// submit form
		$('#commentform').submit(function(e){	
	 		e.preventDefault();
			if(working) return false;
			working = true;
			// form bang post
			$.post('<?php echo base_url();?>ajax/addcomment',$(this).serialize(),function(msg){					
				
				if(msg.status==1){

					// them thanh cong
					$(msg.html).insertBefore('#listhead');
					$('#comnew'+msg.id).hide();
					$('#total_comment').html(parseInt($('#total_comment').html())+1);
				    
					$('#comnew'+msg.id).slideDown("slow");
					$('html,body').animate({
				        scrollTop: $("#listhead").offset().top},
				        'slow');
					//reset lai khung comment
					$('#success').html(msg.success);
					$('#success').show();
				}
				else {
					
					// co loi xay ra	
								
					$('#success').html('');
					$('#error').html('');
					$.each(msg.errors,function(k,v){
						$('#error').append(v);
							
					});		
				}
				working = false;
			},'json');
			
		});
		
	});
	$(function() {
	    $(".anyClass").jCarouselLite({
	        btnNext: ".next",
	        btnPrev: ".prev",
	        visible:4,
	        auto:5000,
            speed:1000,
	    });
	});

	function like(ex_id,u_id){
        var total = jQuery('#like_total').html();  
        var total_dislike = jQuery('#dislike_total').html();  
        jQuery('#like_frame').html('<img src="<?php echo base_url();?>assets/backend/img/loading/3.gif" width="15px" height="15px">');
        jQuery.post('<?php echo base_url();?>like/'+ex_id+'/'+u_id,'',function(msg){
        if(msg.status==1){     
          jQuery('#like_frame').html('<img src="<?php echo base_url();?>assets/frontend/img/like_selected.png"><span id="like_total">'+(parseInt(total)+1)+'</span>');
          jQuery('#dislike_frame').html('<img src="<?php echo base_url();?>assets/frontend/img/dislike.png"><span id="like_total">'+(parseInt(total_dislike))+'</span>');
        }
      },'json');
      }

	function dislike(ex_id,u_id){
        var total = jQuery('#dislike_total').html();  
        var total_like = jQuery('#like_total').html();  
        jQuery('#dislike_frame').html('<img src="<?php echo base_url();?>assets/backend/img/loading/3.gif" width="15px" height="15px">');
        jQuery.post('<?php echo base_url();?>dislike/'+ex_id+'/'+u_id,'',function(msg){
        if(msg.status==1){     
          jQuery('#dislike_frame').html('<img src="<?php echo base_url();?>assets/frontend/img/dislike_selected.png"><span id="like_total">'+(parseInt(total)+1)+'</span>');
          jQuery('#like_frame').html('<img src="<?php echo base_url();?>assets/frontend/img/like.png"><span id="like_total">'+(parseInt(total_like))+'</span>');
        }
      },'json');
      }

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

<div style="clear:both;"></div>