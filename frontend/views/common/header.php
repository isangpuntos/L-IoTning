<style type="text/css">
.s_icon {
    position: absolute;
    top: 50%;
    margin-top: -13px;
    display: block;
    width: 23px;
    height: 23px;
    background-image: url(<?php echo base_url(); ?>assets/frontend/img/sprite.png);
    background-repeat: no-repeat;
    background-position: 0 -241px;
    background-color: white;
}
#cart_item{
    background: none repeat scroll 0 0 #FFFFFF;
    float: right;
    opacity: 1;
    position: absolute;
    right: -100px;
    margin-top: 51px;
    width: auto;
    z-index: 99999
}
.container_nav{
    overflow: visible;
}
</style>
<div class="b_header">
    <div class="b_top_nav">
      <div class="b_top_nav_in">
        <div class="b_left_section">
          <ul style="float:left;">
            <?php foreach($data_menu as $menu) {?>
              <li>
                   <a class="top" href="<?php echo base_url(); ?>article/<?php echo $menu['article_id']; ?>/<?php echo url_title($menu['url_title']); ?>.html"><?php echo $menu['name']?></a>
                   <?php if($menu['child']!=null) {?>
                    <ul class="sub-menu">
                      <?php foreach($menu['child'] as $me) {?>
						<li><a href="<?php echo base_url(); ?>article/<?php echo $me['article_id']; ?>/<?php echo url_title($me['url_title']); ?>.html"><?php echo $me['name'];?></a></li>
					  <?php } ?>
                   </ul>
                   
                            <?php }?>
               </li>
						<?php } ?>
            <!--<li class="currency"><a href="#">en</a></li>
            <li class="currency1"><a href="#">cn</a></li>-->
          </ul>
          <div style="float:right;margin-top:4px; margin-left:10px;">
            <div style="float:left;"> 
             
            <?php foreach($language as $lang) { ?>
               <a href="<?php if(strpos($lang_url,'lang')!=0) echo str_replace('lang='.$_SESSION['lang'], 'lang='.$lang['code'], $lang_url); else if(strpos($lang_url,'?')!=0) echo $lang_url.'&lang='.$lang['code']; else echo $lang_url.'?lang='.$lang['code']; ?>"><img width="20" src="<?php echo base_url(); ?><?php echo $lang['image']?>" /></a>
            <?php } ?>
            </div>
            
            <?php if (count($currencies) > 1) { ?>
					<form action="<?php echo $action; ?>" style="float:left;margin:0px;margin-left:10px;" method="post" enctype="multipart/form-data">
					  <div id="currency">
					    <?php foreach ($currencies as $currency) { ?>
					    <?php if ($currency['code'] == $currency_code) { ?>
					    <?php if ($currency['symbol_left']) { ?>
					    <a title="<?php echo $currency['title']; ?>"><b><?php echo $currency['symbol_left']; ?></b></a>
					    <?php } else { ?>
					    <a title="<?php echo $currency['title']; ?>"><b><?php echo $currency['symbol_right']; ?></b></a>
					    <?php } ?>
					    <?php } else { ?>
					    <?php if ($currency['symbol_left']) { ?>
					    <a title="<?php echo $currency['title']; ?>" onclick="$('input[name=\'currency_code\']').attr('value', '<?php echo $currency['code']; ?>'); $(this).parent().parent().submit();"><?php echo $currency['symbol_left']; ?></a>
					    <?php } else { ?>
					    <a title="<?php echo $currency['title']; ?>" onclick="$('input[name=\'currency_code\']').attr('value', '<?php echo $currency['code']; ?>'); $(this).parent().parent().submit();"><?php echo $currency['symbol_right']; ?></a>
					    <?php } ?>
					    <?php } ?>
					    <?php } ?>
					    <input type="hidden" name="currency_code" value="" />
					    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
					  </div>
					</form>
					<?php } ?>
          </div>
          <div class="clear"></div>
        </div>
        <div class="b_right_section">
          <ul style="float:left;">
             <?php if(!isset($_SESSION['user'])){ ?>
              <li><a href="<?php echo base_url(); ?>login"><?=_l('Login',$this);?></a></li>
              <li><a href="<?php echo base_url(); ?>register"><?=_l('Sign Up',$this);?></a></li>
            <?php } else {?>
             <li><a href="<?php echo base_url(); ?>profile"><?=_l('My Account',$this);?></a></li>
              <li><a href="<?php echo base_url(); ?>login/true"><?=_l('Log Out',$this);?></a></li>
            <?php }?>
            <li><a href="javascript:;" id="signup-fb-container"><img id="signup-fb" src="<?php echo base_url() ?>assets/frontend/img/b_facebook.png" title="Facebook"  /></a></li>
          </ul>
          <div style="float:right;">
          	<ul id="cart_nav" style=" margin-left:10px; margin-top:-19px !important;">
              <li>
                <a href="<?php echo base_url()?>cart" class="cart_li">My Cart <span id="price_cart"></span></a>
                <div class="cart_cont" id="cart_item" style="display:none;"></div>
              </li>
            </ul>
          </div>
          
          <div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    <div class="buy_n_sell_nav">
      <div class="buy_n_sell_nav_in">

        <div class="buy_n_sell_nav_b">
          <ul style="margin-left:10px;">
            <li style="padding-left:0px;"><a href="<?php echo base_url();?>" style="font-size:20px;">Buy & Sell</a> </li>            
            <li style="border-left:dashed 1px #e1e0e0; padding-left:18px;"><a href="<?php echo base_url();?>"><img src="<?php echo base_url() ?>assets/frontend/img/home_icon.png" /></a></li>            
              <?php foreach($data_category_menu as $menu) {?>
              <li>
                   <a class="top" href="<?php echo base_url(); ?>category/<?php echo $menu['category_id']; ?>/<?php echo url_title($menu['category_name']); ?>.html?type=list"><?php echo $menu['category_name']?></a>
               </li>
						<?php } ?>
               <li>
                    <a href="<?php echo base_url();?>category/"><?=_l('Extensions',$this);?></a>
               </li>
            
          </ul>
        </div>
        <div class="buy_n_sell_search">
          <div class="search_b">
            <input type="text" value="" class="filter_search" placeholder="search" name="filter_search">
            <a class="cw-sprite search-icon" href="javascript:check_search();" id="doSearch"><img src="<?php echo base_url() ?>assets/frontend/img/search_b.png" /></a></div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>	
 
<script type="text/javascript" src="<?php echo base_url()?>assets/frontend/js/jquery.number.min.js"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<div id="fb-root"></div>
<script type="text/javascript">
// Hover effect for the cart

FB.init({
	appId: "<?php echo $fb_api_id;?>", 
	status: true, 
	cookie: true, 
	xfbml: true
});

$('#signup-fb').live('click',function(){
	$('.error').remove();
	$('#signup-fb-container').html('<img width="16" height="16" alt="" src="<?php echo base_url(); ?>assets/frontend/img/loading.gif">');
	FB.login(function(response) {
	 	if (response.authResponse) {
			 FB.api('/me', function(response) {
			  $.ajax({
					url: '<?php echo base_url()?>ajax_signup',
					dataType: 'json',
					type: 'POST',
					data: response,
					complete: function(html) {
						 var result = html.responseText.split("|");
						if(result[0]=='success') {
			               document.location.href = '<?php echo base_url()?>profile';
						}
						else {
							$('.signup-content').html('<a href="javascript:;"><img id="signup-fb" alt="" src="<?php echo base_url(); ?>assets/frontend/img/facebook-signup-button.png"></a>');
							$('<div class="error" style="color:red;">An error has not happen in  registration process!</div>').insertAfter('.signup-content');
						}
					}
				});	
			});
		} else {
			$('.signup-content').html('<a href="javascript:;"><img id="signup-fb" alt="" src="<?php echo base_url(); ?>assets/frontend/img/facebook-signup-button.png"></a>');
	    }
	 }, {scope: 'user_hometown,user_about_me,email,user_birthday'});
});

$(".filter_search").keyup(function (e) {
    if (e.keyCode == 13) {
        check_search();
    }
});


function check_search() {
	url = '<?php echo base_url();?>category';
	var filter_search = $('input[name=\'filter_search\']').attr('value');
	if (filter_search) {
		url += '?filter_search=' + encodeURIComponent(filter_search);
	}
	if (filter_search) {
		window.location = url;
	}
}
$("#cart_nav").hover(
    function() {
        $('#cart_item').html('<img id="loading" src="<?php echo base_url(); ?>assets/frontend/img/loading.gif" style="text-align:center;margin-left:60px;margin-top:10px;" />');
        $("#cart_nav").find('#cart_item').css('display','block');
        $("#cart_nav").find('#price_cart').stop().animate({
            color: '#b12916',
        },150);
        $("#cart_nav").find('.s_icon').stop().animate({
            backgroundColor: '#b12916',
        },150);
        $("#cart_nav").find('#cart_item').stop().animate({
            opacity: '1'
        },150);
        $.ajax({
          url: "<?php echo base_url(); ?>item",
          success: function(data){
            $('#cart_item').html(data);
          }
        });
    }
    ,
    function() {
        $(this).find('#price_cart').stop().animate({
            color: '#ffffff',
        },150);
        $(this).find('.s_icon').stop().animate({
            backgroundColor: '#ffffff',
        },150);
         $(this).find('#cart_item').stop().animate({
            opacity: '0'
        },150,function(){$("#cart_nav").find('#cart_item').css('display','none');});
    }
);

function remove_cart(id,element,price,price_type){
        var total_cart = $('#cart_total_price');
         $.ajax({
          url:"<?php echo base_url(); ?>add-cart?id="+id+"&price="+price+"&update=2&type="+price_type,
          success: function(){
            var total_val = parseFloat(total_cart.html().replace(/,/g, '').replace(/\$/g, '')) - price;
            element.parent().parent().fadeOut('fast');
            total_cart.html('$'+$.number(total_val,2));
          }
        });

}

</script>
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
