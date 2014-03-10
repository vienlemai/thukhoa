<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" href="<?php echo $this->Html->webroot('img/favicon.ico') ?>" type="image/x-icon">
		<link rel="icon" href="<?php echo $this->Html->webroot('img/favicon.ico') ?>" type="image/x-icon">
        <title><?php echo $title_for_layout ?></title>
		<?php
		echo $this->Html->css(array(
			'vendor/bootstrap.min',
			//'vendor/jquery.fancybox',
			//'vendor/jquery.fancybox-buttons',
			'style',
		));
		echo $this->fetch('headCss');

		?>
		<?php
		echo $this->Html->script(array(
			'vendor/jquery-1.10.2.min',
				//'vendor/jquery.fancybox.pack',
				//'vendor/jquery.mousewheel-3.0.6.pack',
				//'vendor/jquery.fancybox-buttons',
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
                <div id="banner">
                    <div class="row">
                        <div class="col-lg-12">
							<?php echo $this->Html->image('frontend/banner_new.jpg') ?>
                        </div>

                    </div>
                </div>
                <!--<begin navbar>-->
				<?php
				echo $this->element('frontend/navbar');

				?>
                <!--<end navbar>-->
                <div id="content" style="height:1450px">
                    <!--<div id="content-top">-->
                    <div class="col-lg-9">
                        <div class="row" id="col-left" style=" margin-right: -10px; ">
                            <div class="col-lg-12">
								<?php echo $this->fetch('content') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="row"  id="col-right">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Thống kê</div>
                                        <div class="panel-body">
                                            <ul>
                                                <li>Đang truy cập: </li>
                                                <li>Hôm qua: </li>
                                                <li>Hôm nay: </li>
                                                <li>Tông số: </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--</div>-->
                <div id="footer">
                    <div class="col-lg-8">
                        <div class="footer-content">
                            <p class="text-center"><span style="font-weight: bold">TRANG THÔNG TIN ĐIỆN TỬ TRƯỜNG TRUNG HỌC PHỔ THÔNGTIỂU LA</span><br>
                                Địa chỉ: 01 Vũ Văn Dũng, Huyện Thăng Bình, Tỉnh Quảng Nam<br/>  Điện thoại: 0511.3944844 - Fax: 0511.3944936
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-content">
                            <p class="text-center">Website đươc thiết kế và xây dựng bởi Thuật Nguyễn<br/>
                                Email: thuatnt2@gmail.com - ĐT: 01642906837
                            </p>
                        </div>
                    </div>
                </div><!-- .end content -->
            </div> <!-- .container -->
			<?php
			echo $this->Html->script(array(
				//'vendor/bootstrap.min',
				'vendor/jquery.marquee',
				'vendor/jcarousellite_1.0.1c4',
			));
			echo $this->fetch('scriptBottom');

			?>
            <script type="text/javascript">
				$(document).ready(function() {
					$('.carousel').carousel({
						interval: 5000,
						pause: 'hover',
					});
					$(".jcarouse").jCarouselLite({
						vertical: true,
						hoverPause: true,
						visible: 3,
						auto: 500,
						speed: 1000
					});
				});
            </script>
    </body>
</html>