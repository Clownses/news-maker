<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title; ?></title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/animate.css'); ?>"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/icomoon.css'); ?>"/>
	<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>"/>
	<link type="text/css" rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<script src="<?php echo base_url('assets/js/modernizr-2.6.2.min.js'); ?>"></script>
</head>
<body>
	<div class="gtco-loader"></div>
	<div id="page">
		<nav class="gtco-nav" role="navigation">
		<div class="container">
			<div class="row">
				<div class="col-xs-2 text-left">
					<div id="gtco-logo"><a href="<?php echo base_url(); ?>">News<span>Maker</span></a></div>
				</div>
				<div class="col-xs-10 text-right menu-1">
					<ul>
						<li class="has-dropdown">
							<a href="category.html">Development</a>
							<ul class="dropdown">
								<li><a href="news/all">All news</a></li>
								<li><a href="#" data-toggle="modal" data-target="#modalCreateNewsForm">Create news</a></li>
							</ul>
						</li>
						<li><a href="<?php echo base_url(); ?>">Home</a></li>
						<?php if(!$isUserLoggedIn): ?>
						  <li><a class="signIn">Sign In</a></li>
						<?php else: ?>
							<li><a class="logout">Logout</a></li>
						<?php endif; ?>
						<div class="signIn-dialog" style="display: none;">
							<div class="title">Sign in</div>
							<?php echo form_open('signIn', ['class' => 'signIn-form']); ?>
								<div>
									<?php echo form_input(['type' => 'text', 'class' => 'username', 'placeholder' => 'Enter username']); ?>
								</div>
								<div>
									<?php echo form_input(['type' => 'password', 'class' => 'userpassword', 'placeholder' => 'Enter password']); ?>
								</div>
								<div class="signin-errors"></div>
								<button type="submit" class="btn btn-primary">Sign In</button>
							<?php echo form_close(); ?>
						</div>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<header id="gtco-header" class="gtco-cover" role="banner" style="background-image: url(<?php echo base_url('assets'); ?>/images/header_background.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>