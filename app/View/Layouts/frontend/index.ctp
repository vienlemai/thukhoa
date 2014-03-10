<!DOCTYPE HTML>
<!--
	Helios 1.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?php echo $title_for_layout ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet" type="text/css" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="<?php echo $this->Html->webroot('/js/frontend/jquery.min.js') ?>"></script>
		<script src="<?php echo $this->Html->webroot('/js/frontend/jquery.dropotron.min.js') ?>"></script>
		<script src="<?php echo $this->Html->webroot('/js/frontend/skel.min.js') ?>"></script>
		<script src="<?php echo $this->Html->webroot('/js/frontend/skel-panels.min.js') ?>"></script>
		<script src="<?php echo $this->Html->webroot('/js/frontend/init.js') ?>"></script>
		<link rel="stylesheet" href="<?php echo $this->Html->webroot('/css/frontend/skel-noscript.css') ?>" />
		<link rel="stylesheet" href="<?php echo $this->Html->webroot('/css/frontend/style.css') ?>" />
		<link rel="stylesheet" href="<?php echo $this->Html->webroot('/css/frontend/style-desktop.css') ?>" />
		<link rel="stylesheet" href="<?php echo $this->Html->webroot('/css/frontend/style-noscript.css') ?>" />
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
	</head>
	<body class="homepage">

		<!-- Header -->
		<div id="header">

			<!-- Inner -->
			<div class="inner">
				<header>
					<h1><a href="#" id="logo">HỌC CÙNG THỦ KHOA</a></h1>
					<hr />
					<span class="byline">Slogan comes here</span>
				</header>
				<footer>
					<a href="#banner" class="button circled scrolly">Bắt đầu</a>
				</footer>
			</div>

			<!-- Nav -->
			<?php echo $this->element('frontend/navbar') ?>

		</div>

		<!-- Banner -->
		<div id="banner">
			<h2>Chào mừng đến với <strong>Thukhoa.vn</strong></h2>
			<span class="byline">
				<img src="<?php echo $this->Html->webroot('/img/frontend/thukhoabanner.jpg') ?>"/>
			</span>
		</div>
		<!-- Footer -->
		<div id="footer">
			<div class="container">
				<div class="row">
					<div class="12u">

						<!-- Contact -->
						<section class="contact">
							<header>
								<h3>Nisl turpis nascetur interdum?</h3>
							</header>
							<p>Urna nisl non quis interdum mus ornare ridiculus egestas ridiculus lobortis vivamus tempor aliquet.</p>
							<ul class="icons">
								<li><a href="#" class="fa fa-twitter solo"><span>Twitter</span></a></li>
								<li><a href="#" class="fa fa-facebook solo"><span>Facebook</span></a></li>
								<li><a href="#" class="fa fa-google-plus solo"><span>Google+</span></a></li>
								<li><a href="#" class="fa fa-pinterest solo"><span>Pinterest</span></a></li>
								<li><a href="#" class="fa fa-dribbble solo"><span>Dribbble</span></a></li>
								<li><a href="#" class="fa fa-linkedin solo"><span>Linkedin</span></a></li>
							</ul>
						</section>

						<!-- Copyright -->
						<div class="copyright">
							<ul class="menu">
								<li>&copy; Untitled. All rights reserved.</li>
								<li>Design: <a href="http://html5up.net/">HTML5 UP</a></li>
							</ul>
						</div>

					</div>

				</div>
			</div>
		</div>
	</body>
</html>