<html lang="en">
<head>
<meta charset="utf-8">
<title>Buy & Sell Administrator</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="automartket ">
<meta name="author" content="automartket">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<meta name="keywords" content="Buy & Sell Administrator" >
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Buy & Sell Administrator ">
<meta name="author" content="Buy & Sell Administrator">

		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- Le styles -->
	<link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/backend/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/uniform.default.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/old/reset.css" /> 	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/old/tableshorter-theme.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/old/datatable_jui.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/old/typography.css" />
	

    
    <!-- Main Style File -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/old/root.css" />
     
    <!-- Grid Styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/old/grid.css" /> 

        <link href="<?php echo base_url(); ?>assets/backend/css/form_css.css" type="text/css" rel="stylesheet"></link>
		<link href="<?php echo base_url(); ?>assets/backend/css/leopedia.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/backend/css/old/datepicker.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/backend/css/old/prettify.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/backend/css/jquery.ui/jquery.ui.datepicker.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/backend/css/jquery.ui/jquery.ui.theme.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/backend/css/jquery.ui/jquery.ui.core.css" rel="stylesheet">
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery-ui-1.8.11.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery.ui.datepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/ckfinder/ckfinder.js"></script>  
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/toogle.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery.dataTables.js"></script>
		
		 <script type="text/javascript">

        $(document).ready(function () {
	        $('img').error(function(){
		        <?php if(isset($settings['default_image']) && $settings['default_image']!="") {?>
	                $(this).attr('src','<?php echo base_url(); ?><?php echo $settings['default_image'];?>');
	                <?php } else {?>
	                $(this).attr('src','<?php echo base_url(); ?>assets/backend/img/noimage.jpg');
	                <?php }?>
	         });
	    var title = $('#example1').find('.page-title .titlebar p').html();
	    title = title.toUpperCase();
		var link = $('#example1').find('.content .simplebox .titleh .shortcuts-icons-button a').attr('href');
		var link_title = $('#example1').find('.content .simplebox .titleh .shortcuts-icons-button a span').html();
		if (link ==null || link_title==null)
		{
			$('#example1').find('.content .simplebox').before('<legend>'+title+'</legend>');
		}
		else
		{
		$('#example1').find('.content .simplebox').before('<legend>'+title+'<div style="float:right;" class="input-prepend"><a href="'+link+'" id="add_new_user_btn" class="btn btn-small">'+link_title+'</a></div></legend>	');
		}
        });

    </script>   
<style>
#example_length {display:none;}
#example_filter {display:none;}
 </style>

	</head>

	<body>
<?php
if ($this->session->userdata('logged_in_status') == FALSE)
		{
			redirect('/admin/');
		}
?>
<!-- Navigation
================================================== -->

	<div class="navbar navbar-fixed-top">
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">

				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<h3><a class="brand" href="<?php echo base_url();?>admin">Admin Panel</a></h3>
				<div class="nav-collapse">
					<ul class="nav" id="findme">
							<li><a href="<?php echo base_url();?>">Home</a></li>
	                       
							<li><a href="<?php echo base_url();?>admin">Admin panel</a></li>
					</ul>
		
					<ul class="nav pull-right">
						<li class="dropdown">
						<p id="userDrop" data-toggle="dropdown" class="navbar-text dropdown-toggle"> <a href="#"><?php echo $this->session->userdata('username') ?></a><b class="caret"></b></p>
						<ul class="dropdown-menu">
						<li><a href="<?php echo base_url(); ?>backend.php/cpanel/admin_setting"><i class="icon-cog"></i> Account Settings</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url(); ?>backend.php/admin/logout"> Logout</a></li>
						</ul>
						</li>
					</ul>
				</div>
				</div>
			</div><!-- /navbar-inner -->
		</div><!-- /navbar -->
	</div><!-- /navbar-wrapper -->


		<div class="container">
		<div class="row">

		<div class="span12">	 
   <div class="tabbable tabs-left">
			<div id="search_suggest"></div>

			<ul class="nav nav-tabs" id="sidemenu">
				<li <?php if($page == "home") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel"><img src="<?php echo base_url(); ?>assets/backend/img/icons/sidemenu/laptop.png" width="16" height="16" alt="icon"/>Dashboard</a></li>
				<li <?php if($page == "extension") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/extensions"><img src="<?php echo base_url(); ?>assets/backend/img/icons/sidemenu/copy.png" width="16" height="16" alt="icon"/>Extension</a></li>
				<li <?php if($page == "category") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/category"><img src="<?php echo base_url(); ?>assets/backend/img/catalog.jpg" width="16" height="16" alt="icon"/>Category</a></li>
                    <li class="subtitle ">
                    	<a href="#" class="action"><img width="16" height="16" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/sidemenu/download.png">Content<img width="7" height="4" class="arrow" alt="arrow" src="<?php echo base_url(); ?>assets/backend/img/arrow-down.png"> </a>
                    	<ul class="submenu" style="<?php if($page == "content") {?>display:block;<?php }?>">
                        <!-- <li <?php if($title == "category") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/category">Category</a></li>
                        <li <?php if($title == "extension") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/extensions">Extension</a></li> -->
                        <li <?php if($title == "country") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/country">Country</a></li>
                        <li <?php if($title == "region") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/region">Region</a></li>
                        <li <?php if($title == "city") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/city">City</a></li>
                        <li <?php if($title == "compatibility") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/compatibility">Compatibility</a></li>
                        <li <?php if($title == "license") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/license">License</a></li>
                        <li <?php if($title == "subscribe") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/contactmanager">Subscribe</a></li>
                        <li <?php if($title == "content") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/staticmanager">Static Page</a></li>
                        <li <?php if($title == "slideshow") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/slideshow">Slideshow</a></li>
                       <!-- -<li <?php if($title == "featuremanager") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/featuremanager">Feature</a></li>
                        <li <?php if($title == "demo") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/demo">Demo</a></li>
                        <li <?php if($title == "download") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/download">Download</a></li>
                        <li <?php if($title == "documentationmanager") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/documentationmanager">Documentation</a></li>
                        <li <?php if($title == "supportmanager") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/supportmanager">Support</a></li>
                        <li <?php if($title == "partner") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/partner">Partner</a></li> --> 
                        </ul>
                    </li>
                    <li <?php if($page == "members") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/members"><img src="<?php echo base_url(); ?>assets/backend/img/user.jpg" width="16" height="16" alt="icon"/>Members</a></li>
                   <li class="subtitle">
                   <a href="#" class="action"><img width="16" height="16" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/sidemenu/download.png">Form Settings<img width="7" height="4" class="arrow" alt="arrow" src="<?php echo base_url(); ?>assets/backend/img/arrow-down.png"> </a>
                   <ul class="submenu" style="<?php if($page == "formsetting") {?>display:block;<?php }?>">
                        <li <?php if($title == "extensionsetting") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/extensionsetting">Extension Form</a></li>
                        <li <?php if($title == "signupsetting") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/signup_setting">Singup Form</a></li>
                   </ul>
                   </li>
                   
                   <li class="subtitle">
                   <a href="#" class="action"><img width="16" height="16" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/payment.jpg">Payment<img width="7" height="4" class="arrow" alt="arrow" src="<?php echo base_url(); ?>assets/backend/img/arrow-down.png"> </a>
                   <ul class="submenu" style="<?php if($page == "paymentgateway") {?>display:block;<?php }?>">
                        <li <?php if($title == "paypalsetting") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/paypal_setting">Paypal</a></li>
                   </ul>
                   </li>
                   
                   <li <?php if($page == "downloadsetting") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/download_setting"><img src="<?php echo base_url(); ?>assets/backend/img/download.png" width="16" height="16" alt="icon"/>Download</a></li>

                   
                	<li <?php if($page == "order") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/order"><img src="<?php echo base_url(); ?>assets/backend/img/sale.gif" width="16" height="16" alt="icon"/>Sales</a></li>
                    <li <?php if($page == "paymentrelease") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/payment_release"><img src="<?php echo base_url(); ?>assets/backend/img/icons/sidemenu/file_edit.png" width="16" height="16" alt="icon"/>Payment Release</a></li>
<!--                    <li <?php if($page == "backup") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/backup"><img src="<?php echo base_url(); ?>assets/backend/img/icons/sidemenu/image.png" width="16" height="16" alt="icon"/>Backup and restore</a></li>-->
                    <li <?php if($page == "language") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/language"><img src="<?php echo base_url(); ?>assets/backend/img/language.jpg" width="16" height="16" alt="icon"/>Language</a></li>
                    <li <?php if($page == "currency") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/currency"><img src="<?php echo base_url(); ?>assets/backend/img/currency.png" width="16" height="16" alt="icon"/>Currency</a></li>
                    <li <?php if($page == "noticfication") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/newslettermanager"><img src="<?php echo base_url(); ?>assets/backend/img/icons/sidemenu/mail.png" width="16" height="16" alt="icon"/>Notifications</a></li>
<!--                    <li><a href="<?php echo base_url(); ?>backend.php/cpanel/payment_gateway"><img src="<?php echo base_url(); ?>assets/backend/img/icons/sidemenu/attach.png" width="16" height="16" alt="icon"/>Payment Gateway</a></li>-->
                    <li <?php if($page == "report") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/report"><img src="<?php echo base_url(); ?>assets/backend/img/icons/sidemenu/calendar.png" width="16" height="16" alt="icon"/>Report</a></li>
                    <li <?php if($page == "setting") {?>class="active" <?php }?>><a href="<?php echo base_url(); ?>backend.php/cpanel/admin_setting"><img src="<?php echo base_url(); ?>assets/backend/img/icons/sidemenu/trash.png" width="16" height="16" alt="icon"/>Settings</a></li>

			</ul>

<div class="tab-content" style="float:left;width:789px;">			
<div id="example1" class="k-content">
<?php echo $content; ?>
</div>

 <style>
        #animation {
            width: 794px;
            padding: 0px 0px 0 0px;
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
            min-height: 120px;
        }
    </style>


		</div>
		</div>

<!-- Footer
================================================== -->

	</div> <!-- /.span10 -->
	</div> <!-- /.row -->
	<footer>
		<hr>
		<p>
			<a href="<?php echo base_url();?>" target="_TOP">&copy;Buy& Sell</a></p>
	</footer>

</div> <!-- /.container -->

	<!-- Le javascript -->
<script src="<?php echo base_url();?>assets/backend/js/bootstrap-transition.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/bootstrap-collapse.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/bootstrap-modal.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/bootstrap-dropdown.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/bootstrap-button.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/bootstrap-tab.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/bootstrap-alert.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/bootstrap-tooltip.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/jquery.ba-hashchange.min.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/jquery.placeholder.min.js"></script>
	<script src="<?php echo base_url();?>assets/backend/js/jquery.leopedia.js"></script>
 	
	<!-- admin only -->

	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="assets/js/excanvas.min.js"></script><![endif]-->
<!-- <script src="<?php echo base_url();?>assets/js/prettify.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url();?>assets/js/chosen/chosen.jquery.min.js"></script> -->	

  </body>
</html>
<!--    <link href="../css/zozo.examples.min.css" rel="stylesheet" />
--> 