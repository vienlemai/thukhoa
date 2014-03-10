<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Tâm sự thầy trò</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
				<?php echo $this->Session->flash() ?>
				<table class="table table-striped table-bordered dataTable" >
					<thead>
						<tr>
							<th>TT</th>
							<th>Tiêu đề</th>
							<th>Người đăng</th>
							<th>Trạng thái</th>
							<th>Ngày đăng</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//debug($categories);
						$stt = 1;
						foreach ($confidentials as $row):

							?>
							<tr>
								<td><?php echo $stt++ ?></td>
								<td><?php echo $this->Html->link($row['Confidential']['title'], array('action' => 'view', $row['Confidential']['id'])) ?></td>
								<td><?php echo $row['Confidential']['email'] ?></td>
								<td>
									<?php if ($row['Confidential']['is_active'] == 1): ?>
										<span style="color: green">Đã kiểm duyệt</span>
									<?php else: ?>
										<span style="color: red">Đang chờ kiểm duyệt</span>
									<?php endif; ?>
								</td>
								<td>
									<?php echo date('d/m/Y m:h:s', strtotime($row['Confidential']['created'])) ?>
								</td>
								<td>
									<?php
									echo $this->Html->link($this->Html->image('admin/preview.png'), array('action' => 'view', $row['Confidential']['id']), array('escape' => false));
									echo $this->Form->postLink(
											$this->Html->image('admin/delete.png'), array('action' => 'delete', $row['Confidential']['id']), array('escape' => false), 'Bạn có chắc chắn muốn xóa ?'
									);

									?>

								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div class="row">
					<div class="span6"></div>
					<div class="span6">
						<div class=" paging_bootstrap pagination">
							<ul>
								<?php
								echo $this->Paginator->prev('Trước', array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
								echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
								echo $this->Paginator->next('Tiếp', array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));

								?>
							</ul>
						</div>
					</div>

				</div>
            </div>
        </div>
    </div>
</div>

