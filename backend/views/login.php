<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>Buy & Sell Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<meta name="keywords" content="Buy & Sell Administrator" >
<link rel="Shortcut Icon" href="{{$LAYOUT_HELPER_URL}}admin/images/vi.ico">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Buy & Sell Administrator ">
<meta name="author" content="Buy & Sell Administrator">
<link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/backend/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/backend/css/leopedia.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/backend/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/backend/css/chosen.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/backend/css/prettify.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<style>
.admin_buttons {
	
	  border-image: none;
    border-radius: 4px 4px 4px 4px;
    border-style: solid;
    border-width: 1px;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-size: 13px;
    line-height: 18px;
    margin-bottom: 0;
    padding: 4px 10px;
    text-align: center;
    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
    vertical-align: middle;
    background-color: #0074CC;
    background-image: -moz-linear-gradient(center top , #0088CC, #0055CC);
    background-repeat: repeat-x;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
}
.admin_buttons {
border-image: none;
border-radius: 4px 4px 4px 4px;
border-style: solid;
border-width: 1px;
box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
color: #fff;
cursor: pointer;
display: inline-block;
font-size: 13px;
line-height: 18px;
margin-bottom: 0;
padding: 4px 10px;
text-align: center;
text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
vertical-align: middle;
background-color: #0074CC;
background-image: -moz-linear-gradient(center top , #0088CC, #0055CC);
background-repeat: repeat-x;
border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
}#returning-user
{
background:#CCC;
background: none repeat scroll 0 0 white;
border: 1px solid #E1E1E1;
border-radius: 5px 5px 5px 5px;
box-shadow: 0 0 1px rgba(0, 0, 0, 0.65);
padding: 10px 10px 10px 30px;
height: 260px;
width: 300px;
}
#returning-user ul li
{
list-style:none;
}
</style>
<script language="javascript" type="text/javascript">
    function setFocus() {
        document.login.username.select();
        document.login.username.focus();
    }
</script>
</head>
<body onload="javascript:setFocus()" id="login">
<div class="navbar navbar-fixed-top">
<div class="navbar">
<div class="navbar-inner">
<div class="container">
<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>
<h3><a class="brand" style="color:white;" href="<?php echo base_url(); ?>">Buy & Sell</a></h3>
<div class="nav-collapse">
</div>
</div>
</div>
</div>
</div>
<div class="container">
<div class="row">
<div class="span12"><div class="alert alert-error"><?php if ($this->session->flashdata('message')!='')
	{?>User or Password not Match !<?php } else { ?>You need to login to do that.<?php }?></div><div id="page-content">

<section id="log-in">
<div class="content-holder" style="width:350px; margin:auto;">
<div class="full-width">
<div class="one-half col-539">
 <?= form_open('admin/login/',array('class' => 'grey-corner-box', 'id'=>'returning-user')); ?>
<div class="alert-error"></div>
<fieldset>
<legend><span class="bold">Buy & Sell Administrator Login</span></legend>
<ul>
<li class="select-two">
<div>
<label for="login-email">Username:</label>
<input type="text"  id="username" name="username" />
</div>
<div>
<label for="login-password">Password:</label>
<input type="password" name="password" id="password" />
</div>

</li>
<li>
<div class="checkbox-custom submit-field">
<span class="submit">
<input type="submit" value="Sign in" class="btn login-submit" style="margin-right:5px;" id="login-submit" name="login"/>
</span>
</div>
</li>
</ul>
</fieldset>
</form>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
</div>
</body>
</html>
