<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Tâm sự thầy trò</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
				<?php echo $this->Html->link('Quay lại danh sách', array('action' => 'index'), array('class' => 'btn btn-primary')) ?>
				<hr>
				<div class="row-fluid">
					<h4>
						<?php echo $confidential['Confidential']['title'] ?>
						<p>
							<small>
								<?php echo $confidential['Confidential']['email'] ?> - 
								<?php echo date('d/m/Y m:h:s'); ?>
							</small>
						</p>
					</h4>
					<?php if ($confidential['Confidential']['is_active'] == 0): ?>
						<div class="alert alert-error">
							<button class="close" data-dismiss="alert">×</button>
							Bài viết này chưa được hiển thị trên trang web, bạn hãy kiểm duyệt
						</div>
					<?php else: ?>
						<div class="alert alert-success">
							<button class="close" data-dismiss="alert">×</button>
							Bài này đã được hiển thị trên trang chủ
						</div>
					<?php endif; ?>
					<hr>
					<?php echo $confidential['Confidential']['content'] ?>	

				</div>
            </div>
			<?php if ($confidential['Confidential']['is_active'] == 0): ?>
				<div>
					<a href="<?php echo $this->Html->url('/admin/confidentials/makeActive/' . $confidential['Confidential']['id']); ?>" class="btn btn-primary">Cho phép hiển thị trên trang web</a>
					<a href="<?php echo $this->Html->url('/admin/confidentials/makeUnactive/' . $confidential['Confidential']['id']); ?>" class="btn btn-warning">Không cho phép hiển thị trên trang web</a>
					<?php
					echo $this->Form->postLink('Xóa bài viết này', array('action' => 'delete', $confidential['Confidential']['id']), array('escape' => false, 'class' => 'btn btn-danger'), 'Bạn có chắc chắn muốn xóa ?');

					?>
				</div>
			<?php else: ?>
				<div>
					<a href="<?php echo $this->Html->url('/admin/confidentials/makeUnactive/' . $confidential['Confidential']['id']); ?>" class="btn btn-info">Ẩn bài này trên trang chủ</a>
					<?php
					echo $this->Form->postLink('Xóa bài viết này', array('action' => 'delete', $confidential['Confidential']['id']), array('escape' => false, 'class' => 'btn btn-danger'), 'Bạn có chắc chắn muốn xóa ?');

					?>
				</div>
			<?php endif; ?>

        </div>
    </div>
</div>

