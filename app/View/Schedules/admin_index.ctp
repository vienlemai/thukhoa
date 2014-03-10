<div class="row-fluid">	
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left">Quản lí lịch làm việc</div>
		</div>
		<div class="block-content collapse in">
			<div class="span12">
				<div class="dataTables_wrapper form-inline" role="grid">
					<div  class="row">
						<div class="actions" style="margin-bottom: 20px">
							<?php echo $this->Html->link('Thêm mới', array('action' => 'add'), array('class' => 'btn btn-primary')); ?>
						</div>
					</div>

					<?php
					$stt = 1;

					?>
					<?php echo $this->Session->flash() ?>
					<table class="table-data table table-striped table-bordered dataTable">
						<thead>
							<tr>
								<th>Thứ tự</th>
								<th>Tiêu đề</th>
								<th>Thể loại</th>
								<th>Ngày tạo</th>
								<th>Người tạo</th>
								<th>Thao tác</th>
							</tr>
						</thead>
						<tbody>
							<?php
							//debug($resources);
							foreach ($schedules as $row):

								?>
								<tr>
									<td><?php echo $stt++ ?></td>
									<td><?php echo $row['Schedule']['title']; ?></td>
									<td><?php echo $schedule_types[$row['Schedule']['type']] ?></td>
									<td><?php echo date('d/m/Y', strtotime($row['Schedule']['created'])) ?></td>
									<td><?php echo $row['Schedule']['user_create'] ?></td>
									<td>
										<?php
										echo $this->Html->link(
												$this->Html->image('admin/edit.png'), array('action' => 'edit', $row['Schedule']['id']), array('escape' => false));
										echo $this->Form->postLink($this->Html->image('admin/delete.png'), array('action' => 'delete', $row['Schedule']['id']), array('escape' => false), 'Bạn có chắc chắn muốn xóa ???')

										?>
									</td>
								</tr>
								<?php
							endforeach;

							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

