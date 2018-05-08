<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL;?>Public/CSS/default.css">
</head>
<body>

<header>
	<div class="links">
		<a href="<?php echo URL;?>index">Index</a>
		<a href="<?php echo URL;?>help">Help</a>
	
		<?php if (Session::get('loggedIN') == true): ?>
		<a href="<?php echo URL;?>dashboard/logout">LogOut</a>
		<a href="<?php echo URL;?>dashboard">Dashboard</a>
		<a href="<?php echo URL;?>myphoto">My Photos</a>
		<div id="ProfilePic"></div>
		<?php
		if (!empty(Session::get('loggued_on_user')))
			{
				?>
				<h4 class="user">
				Hello 
				<?php
				echo Session::get('loggued_on_user');
				?>
				</h4>
				<?php
			}
		?>
		<?php else: ?>
		<a href="<?php echo URL;?>login">LogIn</a>
		<a href="<?php echo URL;?>signup">SignUp</a>
		<?php endif; ?>
	</div>
</header>