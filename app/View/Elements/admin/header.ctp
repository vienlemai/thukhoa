<?php
$modules = $this->requestAction('admin/admin/getBackendMenu');
$controller = $this->request['controller'];

?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <div class="nav-collapse collapse">
                <a href="<?php echo $this->Html->url('/') ?>" target="_blank" class="brand">Trang chủ</a> 
                <a class="brand">|</a>
                <a href="<?php echo Router::url('/dashboard') ?>" class="brand">Quản trị</a>
				<?php
				$user = $this->Session->read('UserAuth');
				if (!empty($user)):

					?>
					<ul class="nav pull-right">

						<li class="dropdown">
							<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?php echo $user['User']['first_name'] ?> <i class="caret"></i>

							</a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo Router::url('/admin/doi-mat-khau') ?>">Đổi mật khẩu</a></li> 
								<li><a href="<?php echo Router::url('/logout') ?>">Đăng xuất</a></li> 
							</ul>
						</li>
					</ul>
					<?php
				endif;

				?>
                <ul class="nav">
					<li><a href="/admin/danh-sach-bai-viet">Bài viết</a></li>
					<?php foreach ($modules as $module): ?>
						<li class="<?php echo $controller == $module['controller'] ? 'active' : '' ?>"><?php echo $this->Html->link($module['title'], '/admin/' . $module['controller'], array('escape' => false)) ?></li>
					<?php endforeach; ?>
					<?php
					if (isset($user['UserGroup']['id']) && $user['UserGroup']['id'] == ADMIN_GROUP_ID):

						?>
						<!--<li class="<?php echo $controller == 'confidentials' ? 'active' : '' ?>"><a href="/admin/confidentials">Tâm sự thầy trò</a></li>--> 
						<li class="<?php echo $controller == 'users' ? 'active' : '' ?>"><a href="/admin/nguoi-dung">Người dùng</a></li> 
						<li>
							<a href="<?php echo $this->Html->url('/admin/cau-hinh-site') ?>">Cấu hình</a>
						</li>   
						<?php
					endif;

					?>


                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>