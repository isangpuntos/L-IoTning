<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   
        <?php
        $pageURL = 'http';
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        ?>
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="keywords" content="<?php //echo $webinfo[0]['keyword']   ?>" />
<meta name="description" content="<?php //echo $webinfo[0]['description']   ?>" />
        
<title><?php echo $title ?></title>
 
<link href="<?php echo base_url(); ?>assets/frontend/css/css.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/frontend/css/html5-pagination.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/frontend/css/form_css.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/frontend/css/footer_css.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/frontend/css/html5-pagination.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/frontend/css/skins/tango/skin.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/frontend/css/zozo.tabs.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url(); ?>assets/frontend/css/style.css"></script>
<script src="<?php echo base_url(); ?>assets/frontend/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/ckfinder/ckfinder.js"></script>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/ckeditor/ckeditor.js"></script> 



<!--<link href="<?php echo base_url(); ?>assets/frontend/css/main_section_css.css"  type="text/css" rel="stylesheet" />
-->
<script type="text/javascript">

        $('img').error(function(){
           <?php if(isset($settings['default_image']) && $settings['default_image']!="") {?>
           $(this).attr('src','<?php echo base_url(); ?><?php echo image($settings['default_image'],$settings['default_image'],220,120);?>');
          <?php } else {?>
          $(this).attr('src','<?php echo base_url(); ?><?php echo image("assets/frontend/img/noimage.jpg","assets/frontend/img/noimage.jpg",220,120);?>');
          <?php }?>
        });
        
       
    </script>
<link href="<?php echo base_url(); ?>assets/frontend/css/buynsell_stylesheet.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div  id="wrapper" class="buynsell_page">
  	<!--start header-->
    <?php require 'common/header.php'; ?>
    <!--start content-->
   <div class="buy_n_sell_main_section">
     <?php require_once ("content/" . $content . ".php"); ?>
    </div>

    <!--start footer-->
    <?php require 'common/footer.php'; ?>
</div>
</body>
</html>




