<!DOCTYPE html>
<?php echo $this->Facebook->html(); ?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<link rel="shortcut icon" href="<?php echo $this->Html->webroot('img/favicon.ico') ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo $this->Html->webroot('img/favicon.ico') ?>" type="image/x-icon">
	<title><?php echo $title_for_layout ?></title>
	<?php
	echo $this->Html->css(array(
		'vendor/bootstrap.min',
		'style',
	));

	?>
	<?php
	echo $this->Html->script(array(
		'vendor/jquery-1.10.2.min'
	))

	?>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container" id="main-wrap">
		<div class="row" id="content-wrapper">
			<?php
			echo $this->element('frontend/banner');

			?>
			<!--<begin navbar>-->
			<?php
			echo $this->element('frontend/navbar',array('menus'=>$menus));

			?>
			<!--<end navbar>-->
			<div id="content">
				<div id="content-top">
					<div class="col-lg-9">
						<!--<begin slider>-->
						<?php
						echo $this->element('frontend/slider');

						?>
						<!--<end slider>-->
					</div>
					<div class="col-lg-3">
						<div class="row column-right">
							<div style="clear: both"></div>
							<div class="panel panel-primary" id="portal-links">
								<div class="panel-heading">
									Kết nối với chúng tôi
								</div>
								<div class="panel-body" >
									<?php echo $this->Facebook->likebox('https://www.facebook.com/thukhoa.vn', array('width' => '255px')); ?>
								</div>
							</div> 

						</div>
					</div>

					<div style="clear:both"> </div>
					<div id="content-bottom">
						<div class="col-lg-9">
							<div class="row column-left">
								<div class="panel panel-primary" id="tab-content">
									<div class="panel-heading">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#tabs-news-content" id="tab-news" data-toggle="tab">Tin tức chung</a></li>
										<li><a href="#tabs-custom" data-toggle="tab">Học cùng thủ khoa</a></li>
										<!--		<li><a href="#tab-confidential-content" id="tab-confidential" data-toggle="tab">Tâm sự thầy trò</a></li>-->
										</ul>
									</div>
									<div class="panel-body" style="">
										<!--<begin information>-->
										<?php
										echo $this->fetch('content');

										?>
										<!--<end information>-->
									</div>
								</div>
							</div>
						</div>
						<?php echo $this->element('frontend/right_sidebar') ?>
					</div>
				</div>

			</div>
			<div style="clear: both"></div>
			<?php echo $this->element('frontend/footer'); ?>
		</div>
	</div> <!-- .container -->
	<?php
	echo $this->Html->script(array(
		'vendor/bootstrap.min',
	));
	echo $this->fetch('scriptBottom');

	?>
	<script type="text/javascript">
		$('.carousel').carousel();
	</script>

</body>
<?php echo $this->Facebook->init(); ?>
</html>