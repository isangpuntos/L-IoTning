  <style>
#button-newsletter {
    background: none repeat scroll 0 0 #23A1D1;
    border: 1px solid #4DC1DE;
    border-radius: 0 5px 5px 0;
    color: #FFFFFF;
    cursor: pointer;
    font-weight: bold;
    line-height: 27px;
    margin-left: -4px;
    padding: 0 5px;
    text-shadow: 1px 1px #2198BA;
    width: 35px;
}
  </style>
  <div class="footer">
   <div id="footer_in">
  <div>
    <h2><?=_l('Get Social',$this);?></h2>
    <!-- AddThis Follow BEGIN -->
	<p><?=_l('Follow us on the social media web sites.',$this);?></p>
	<div class="addthis_toolbox addthis_32x32_style addthis_default_style">
	<a class="addthis_button_facebook_follow" addthis:userid="YOUR-PROFILE"></a>
	<a class="addthis_button_twitter_follow" addthis:userid="YOUR-USERNAME"></a>
	<a class="addthis_button_linkedin_follow" addthis:userid="hehe" addthis:usertype="company"></a>
	<a class="addthis_button_youtube_follow" addthis:userid="hehe"></a>
	</div>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-518f0ebf4a46517d"></script>
	<!-- AddThis Follow END -->
	    
<!--     	<div style="margin-top:15px;">-->
<!--        	<a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/face.png" width="35" height="34" border="0" /></a>-->
<!--    <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/twitter.png" width="34" height="34" border="0" /></a>-->
<!--    <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/youtube.png" width="35" height="34" border="0" /></a>-->
<!--    <a href="#"><img src="<?php echo base_url(); ?>assets/frontend/img/in.png" width="34" height="34" border="0" /></a>  -->
<!--        </div>-->
     </div>
  
  <div>
    <h2><?=_l('Newsletter',$this);?></h2>
    <p>
     <form style="margin:0px;" role="search" method="post" action="" onsubmit="return check_form()">
	     <?php if(isset($success)) { ?><p style="color: rgb(0, 235, 0);padding: 5px 0;"><?=_l('Subscribe Successful!',$this);?></p><?php } ?>
	      <input style="margin-bottom:3px;" type="text" value="" name="s" id="s" placeholder="email">
	      <input type="submit" id="button-newsletter" style="padding:4px 5px 4px 5px;" value="Go">
     </form>
    </p>
    
    <p style="margin-top:10px;"><?=_l('Subscribe to our newsletters and be informed of new releases and other OpenCart events.',$this);?></p>
    
  </div>

  <div>
    <h2 style="margin-left:25px;"><?=_l('Contact Us',$this);?></h2>
    <p id="location"><?php echo $setting[0][''];?>,
<?php echo $setting[0][''];?></p>
    <p id="telephone"><?php echo $setting[0]['phone'];?></p>
    <p id="mail"><?=_l('Send email via our',$this);?> <a href="<?php echo $link_contact; ?>"><?=_l('contact form',$this);?></a></p>
  </div>
</div>
         </div>
         <div class="copy">
         <?=_l('Copyright © 2017 L-IoTning  - All rights reserved',$this);?>
         </div>
<script type="text/javascript">
       function check_form(){
         if($('#s').val()==''){
            alert('<?=_l('Please fill your email!',$this);?>');
            $('#s').focus();
            return false;
           }
      }
</script>   