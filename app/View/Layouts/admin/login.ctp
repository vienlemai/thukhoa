<!DOCTYPE html>
<html>
	<head>
		<title>Đăng nhập hệ thống</title>

		<?php
		echo $this->Html->css('admin/css/bootstrap');
		echo $this->Html->css('admin/css/admin');

		?>
	</head>
	<body id="login">
		<div class="container">

			<?php
				echo $this->fetch('content');
			?>

		</div> <!-- /container -->
		<?php
		echo $this->Html->script('vendor/jquery-1.10.2.min');
		echo $this->Html->script('admin/bootstrap');

		?>
	</body>
</html>