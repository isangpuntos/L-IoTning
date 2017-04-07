<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Buy & Sell</title>


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
									
									<?php $body = preg_replace(
										'/<h2>([^<]+)<\/h2>/',
										'<table class="title" cellspacing="0" cellpadding="4" >
											<tr>
												<td>
													<h2>\1 &raquo;</h2>
												</td>
											</tr>
										</table>',
										$body
										);
									?>
									
									<?php $body = preg_replace('/{username}/', $username, $body); ?>
									<?php $body = preg_replace('/{content}/', $content, $body); ?>
									<?php $body = preg_replace('/{link}/', $link, $body); ?>
									<?php $body = preg_replace('/{spacer}/', '<img src="'.base_url().'/assets/newsletter/hr-big.gif" width="550" height="27" alt="spacer">', $body); ?>
									
									<?php print $body; ?>
									
									<br>
									<img src="<?=base_url(); ?>/assets/newsletter/hr-big.gif" width="550" height="27" alt="spacer">
									
								</td>
							</tr>
							
						</table>
					</td>
				</tr>			
				<tr>
					<td align="center" class="footer">
						<p>&copy; copyright 2013. Buy & Sell Script. All Rights Reserved.</p>
                        <br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
