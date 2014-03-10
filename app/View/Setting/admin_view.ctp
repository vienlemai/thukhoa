<legend>Cấu hình trang web</legend>
<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Danh sách môn học</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
				<div class="actions" style="margin-bottom: 20px">
					<a href="/admin/subjects/add" class="btn btn-primary">Thêm môn học</a>
				</div>
				<?php echo $this->Session->flash() ?>
				<table class="table table-striped table-bordered" >
					<thead>
						<tr>
							<th>TT</th>
							<th>Tên môn học</th>
							<th>Trạng thái</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//debug($categories);
						$stt = 1;
						foreach ($subjects as $row):

							?>
							<tr>
								<td><?php echo $stt++ ?></td>
								<td><?php echo $row['Subject']['name'] ?></td>
								<td>
									<?php
									if ($row['Subject']['is_active']) {
										echo $this->Html->link($this->Html->image('admin/approve.png'), array('controller' => 'subjects', 'action' => 'makeUnActive', $row['Subject']['id']), array('escape' => false));
									} else {
										echo $this->Html->link($this->Html->image('admin/dis-approve.png'), array('controller' => 'subjects', 'action' => 'makeActive', $row['Subject']['id']), array('escape' => false));
									}

									?>
								</td>
								<td>
									<?php
									echo $this->Html->link($this->Html->image('admin/edit.png'), array('controller' => 'subjects', 'action' => 'edit', $row['Subject']['id']), array('escape' => false));
									echo $this->Form->postLink(
											$this->Html->image('admin/delete.png'), array('controller' => 'subjects', 'action' => 'delete', $row['Subject']['id']), array('escape' => false), 'Bạn có chắc chắn muốn xóa ?'
									);

									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Danh sách năm học</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
				<div class="actions" style="margin-bottom: 20px">
					<a href="/admin/years/add" class="btn btn-primary">Thêm năm học</a>
				</div>
				<?php echo $this->Session->flash() ?>
				<table class="table table-striped table-bordered" >
					<thead>
						<tr>
							<th>TT</th>
							<th>Tên năm học</th>
							<th>Trạng thái</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//debug($categories);
						$stt = 1;
						foreach ($years as $row):

							?>
							<tr>
								<td><?php echo $stt++ ?></td>
								<td><?php echo $row['Year']['name'] ?></td>
								<td>
									<?php
									if ($row['Year']['is_active']) {
										echo $this->Html->link($this->Html->image('admin/approve.png'), array('controller' => 'years', 'action' => 'makeUnActive', $row['Year']['id']), array('escape' => false));
									} else {
										echo $this->Html->link($this->Html->image('admin/dis-approve.png'), array('controller' => 'years', 'action' => 'makeActive', $row['Year']['id']), array('escape' => false));
									}

									?>
								</td>
								<td>
									<?php
									echo $this->Html->link($this->Html->image('admin/edit.png'), array('controller' => 'years', 'action' => 'edit', $row['Year']['id']), array('escape' => false));
									echo $this->Form->postLink(
											$this->Html->image('admin/delete.png'), array('controller' => 'years', 'action' => 'delete', $row['Year']['id']), array('escape' => false), 'Bạn có chắc chắn muốn xóa ?'
									);

									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="pull-left">Nội dung trang tĩnh</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">

				<?php echo $this->Session->flash() ?>
                <table class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th>Tên trang</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Trang liên hệ</td>
                            <td><a href="/admin/trang-lien-he">Sửa</a></td>
                            <td></td>
                            <td>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


