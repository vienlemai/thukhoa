<!DOCTYPE html>
<?php echo $this->Facebook->html(); ?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title_for_layout ?></title>
		<link rel="shortcut icon" href="<?php echo $this->Html->webroot('img/favicon.ico') ?>" type="image/x-icon">
		<link rel="icon" href="<?php echo $this->Html->webroot('img/favicon.ico') ?>" type="image/x-icon">
		<?php
		echo $this->Html->css(array(
			'vendor/bootstrap.min',
			'style',
		));
		echo $this->fetch('headerCss');
		echo $this->Html->script(array(
			'vendor/jquery-1.10.2.min',
		));

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
            <div class="row">
				<?php
				echo $this->element('frontend/banner');

				?>
                <!--<begin navbar>-->
				<?php
				echo $this->element('frontend/navbar',array('menus'=>$menus));

				?>
                <!--<end navbar>-->
                <div id="content">
                    <div id="content-bottom">
                        <div class="col-lg-9">
                            <div class="row column-left">
                                <div class="panel panel-primary" id="tab-content">
                                    <div class="panel-body" id="layout-content">
                                        <!--<begin information>-->
										<?php
										echo $this->fetch('content');

										?>
                                        <!--<end information>-->
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php echo $this->element('frontend/right_sidebar_facebook') ?>
                    </div>

                </div>
                <div style="clear: both"></div>
                <?php echo $this->element('frontend/footer'); ?>
            </div>
        </div> <!-- .container -->
		<?php
		echo $this->fetch('scriptBottom');

		?>
    </body>
	 <?php echo $this->Facebook->init(); ?>
</html>