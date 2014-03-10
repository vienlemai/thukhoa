<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="header">Quản trị nội dung trang web</div>
        </div>
		<?php echo $this->Session->flash() ?>
        <div class="block-content collapse in shortcut-links">

			<div class="shortcut-item">
				<a href="/admin/danh-sach-bai-viet">
					<?php echo $this->Html->image('admin/posts.png') ?> 
					BÀI VIẾT
				</a>
			</div>
			<?php foreach ($modules as $module): ?>
				<div class="shortcut-item">
					<a href="<?php echo '/admin/' . $module['controller'] ?>">
						<?php echo $this->Html->image('admin/' . $module['controller'] . '.png') ?> 
						<?php echo ($module['title']) ?>
					</a> 
				</div>
			<?php endforeach; ?>
			<?php if ($isAdmin): ?>
<!--				<div class="shortcut-item">
					<a href="/admin/confidentials">
						<?php echo $this->Html->image('admin/confidentials.png') ?> 
						Tâm sự thầy trò
					</a> 
				</div>-->
				<div class="shortcut-item">
					<a href="/admin/nguoi-dung">
						<?php echo $this->Html->image('admin/users.png') ?> 
						NGƯỜI DÙNG
					</a> 
				</div>
				<div class="shortcut-item">
					<a href="/admin/cau-hinh-site">
						<?php echo $this->Html->image('admin/configure.png') ?> 
						Cấu hình
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

