<legend>Cấu hình trang web</legend>
<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Danh sách môn học</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
				<div class="actions" style="margin-bottom: 20px">
					<a href="/admin/links/add" class="btn btn-primary">Thêm môn học</a>
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
						foreach ($subject as $row):

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

