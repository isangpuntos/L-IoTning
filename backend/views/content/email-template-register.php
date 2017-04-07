<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Buy & Sell Script Newsletter</title>


<style type="text/css">

body { 
   font-family: Verdana, Arial, Helvetica, sans-serif;
   /*background-color: #e6e6e6;*/
   background-position: top center;
   background-image:url(<?=base_url(); ?>/assets/newsletter/top-bg.jpg);
   background-repeat: repeat-x;
   margin: 0;
   padding: 0;
}

   
a img {
   border: none;
}

table.main {
   /*background-color: #ffffff;*/
}

td.permission {
   /*background-color: #333537;*/
   padding: 10px 0 10px 0;
}

td.permission p {`

   font-family: 'Lucida Grande';
   font-size: 11px;
   font-weight: normal;
   color: #717273;
   margin: 0;
   padding: 0;
}

td.permission p a {
   font-family: 'Lucida Grande';
   font-size: 11px;
   font-weight: normal;
   color: #717273;
}

td.header {
	/*background-color: #333537;*/
	padding: 0 0 2px 0;
	height:77px;
	/*background-image:url(<?php /*?><?=base_url(); ?><?php */?>/assets/newsletter/top-bg.jpg);*/
	background-repeat:repeat-x;
}

td.header h1 {
   font-family: 'Lucida Grande';
   font-size: 35px;
   font-weight: bold;
   /*color: #ffffff;*/
   margin: 0 0 0 10px;
   padding: 0;
   display: inline;
}
td.header p {
	/*color: #ffffff;*/
}

td.splash {
	/*color: #ffffff;*/
	/*background-color:#333;*/
	padding: 15px 0px;
	/*border-bottom:solid 1px #999;*/
}

td.splash h1{
	/*color: #ffffff;*/
	font-weight:normal;
	font-size:28px;
}

td.splash h2{
	/*color: #ffffff;*/
	font-weight:normal;
	font-size:18px;
}

td.splash p{
	/*color: #ffffff;*/
	font-weight:normal;
	font-size:12px;
}
td.splash ul{
	padding-left: 18px;
}

td.splash li{
	/*color:#ffffff;*/
}

td.date {
   padding: 8px 0 8px 0;
}

td.date p {
   font-family: 'Lucida Grande';
   font-size: 12px;
   font-weight: normal;
   color: #666666;
   margin: 0;
   padding: 0;
}

td.sidebar ul {
   font-family: 'Lucida Grande';
   font-size: 12px;
   font-weight: normal;
   color: #333537;
   margin: 10px 0 10px 24px;
   padding: 0;
}

td.sidebar ul li a {
   font-family: 'Lucida Grande';
   font-size: 12px;
   font-weight: normal;
   color: #333537;
   text-decoration: none;
}

td.sidebar p {
   font-family: 'Lucida Grande';
   font-size: 12px;
   font-weight: normal;
   color: #4c4c4c;
   margin: 10px 0 0 0;
   padding: 0;
}

td.sidebar p a {
   font-size: 12px;
   font-weight: normal;
   color: #6cb9ce;
}

td.sidebar h4 {
   font-family: 'Lucida Grande';
   font-size: 13px;
   font-weight: bold;
   color: #333333;
   margin: 14px 0 0 0;
   padding: 0;
}

td.sideHeader h3 {
   font-family: 'Lucida Grande';
   font-size: 18px;
   font-weight: bold;
   /*color: #ffffff;*/
   margin: 0;
   padding: 0;
}

td.sideTitle h3 {
   font-family: 'Lucida Grande';
   font-size: 18px;
   font-weight: bold;
   /*color: #ffffff;*/
   margin: 0;
   padding: 0;
}

table.title { /*background: #333537; */}
table.title td { /*background: #333537;*/ }

td.mainbar h2 {
   font-family: 'Lucida Grande';
   font-size: 18px;
   font-weight: normal;
   /*color: #ffffff;*/
   margin: 0;
   padding: 0;
}


td.mainbar h2 a {
   font-family: 'Lucida Grande';
   font-size: 18px;
   font-weight: bold;
   /*color: #ffffff;*/
   text-decoration: none;
}

td.mainbar p {
   font-family: Arial;
   font-size: 12px;
   font-weight: normal;
   color: #4c4c4c;
   margin: 10px 0 0 0;
   padding: 0;
}

td.mainbar p.more {
   padding: 0 0 10px 0;
}

td.mainbar p a {
	font-family: Arial;
	font-size: 12px;
	font-weight: normal;
	color: #900;
}

td.mainbar p img {
}

td.mainbar ul {
   font-family: Arial;
   font-size: 12px;
   font-weight: normal;
   color: #4c4c4c;
   margin: 10px 0 10px 0;
   padding: 0;
   list-style-position: inside;
}

td.footer {
   padding: 10px 0 10px 0;
}

td.footer p {
   font-family: Arial;
   font-size: 11px;
   font-weight: normal;
   color: #333333;
   margin: 0;
   padding: 0;
}
td.footer a {
	color:#71af46;
}
</style>
</head>
<body>

<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main">
				<tr align="center">
					<td align="center" class="permission">
						
					</td>
				</tr>
				
				
				<tr>
					<td align="center" class="header">
						<table width="550" height="25" cellspacing="0" cellpadding="0">
							<tr style="background-color:red;">
								<td valign="top" style="margin-left:15px;"><img src="<?=base_url(); ?>assets/newsletter/logo.png" alt="logo" align="left"></td>
								<td align="right" style="margin-right:15px;color:white;"><p style="font-size:12px;margin-right:15px;"><? if(!isset($date)) echo date('l, F jS Y'); else echo date('l, F jS Y',$date);  ?></p></td>
							</tr>
						</table>
					</td>
				</tr>	
				<tr>
					<td align="center" >
						<table width="550" cellspacing="0" cellpadding="0">
							<tr align="left" valign="top">
								<td valign="top" class="mainbar">	
								
									<div style="padding:1px 20px 10px">
            
		            <font color="555b64" size="2" face="tahoma,arial,helvetica,sans-serif">
		            
		            
		            <h2 style="font-size:24px;font-weight:normal;margin-top:15px"><span style="color:#ff5c3e">Welcome!</span> We're happy you joined us.</h2>
		            <p>
		                Your account is <b><a target="_blank" style="text-decoration:none;color:#7aaa1b" href="mailto:<?php echo $email;?>"><?php Echo $username;?></a></b> and it's what you'll use to access your Buy&Sell 
		                Let's take a second to set up your Profile.
		            </p>
		            
		            <table cellpadding="5">
		                <tbody><tr>
		                    <td><img border="0" width="40" vspace="2" height="40" alt=""></td>
		                    <td><font color="#212121" size="2" face="arial,helvetica,sans-serif">Set up <a target="_blank" style="color:#0097ff" href="<?php echo $link_profile;?>"> Your Profile</a></font></td>
		                </tr>
		                <tr>
		                    <td><img border="0" width="40" vspace="2" height="40" alt=""></td>
		                    <td><font color="#212121" size="2" face="arial,helvetica,sans-serif">Post your extension<a target="_blank" style="color:#0097ff" href="<?php echo $link_post_extension;?>">here</a>.</font></td>
		                </tr>
		                <tr>
		                    <td><img border="0" width="40" vspace="2" height="40" alt=""></td>
		                    <td><font color="#212121" size="2" face="arial,helvetica,sans-serif">Visit <a target="_blank" style="color:#0097ff" href="<?php echo $link_home;?>">Buy&Sell</a> to buy good script with best price</font></td>
		                </tr>
		            	</tbody>
		            </table>
		            </font>
		                
		        </div>
								
								</td>
							</tr>
							
						</table>
					</td>
				</tr>									
					
						
				<tr>
					<td align="center" class="footer">
<!--						<p><a href="<?php //=site_url('home/unsubscribe/'.$email); ?>">Click Here</a> to unsubscribe</p>-->
						<p>&copy; copyright 2013. Buy & Sell Script. All Rights Reserved.</p>
                        <br>
						<br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
