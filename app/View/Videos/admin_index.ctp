<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Quản lí video</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
                <div class="dataTables_wrapper form-inline" role="grid">
					<?php
					$stt = 1;

					?>
					<div class="actions" style="margin-bottom: 20px">
						<a href="/admin/videos/add" class="btn btn-primary">Thêm video</a>
					</div>
					<?php echo $this->Session->flash() ?>
                    <table class="table-data table table-striped table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>Thứ tự</th>
                                <th>Tiêu đề</th>
								<th>Đặt mặc định</th>
                                <th>Ngày đăng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
							foreach ($videos as $row):

								?>
								<tr>
									<td><?php echo $stt++ ?></td>
									<td><?php
										echo $this->Html->link($row['Video']['title'], $row['Video']['link'], array('target' => '_blank'));
										if ($row['Video']['is_default'])
											echo $this->Html->image('admin/star.png', array('width' => '25px', 'height' => '25px'));

										?></td>
									<td><?php
										if ($row['Video']['is_default'] == false)
											echo $this->Html->link('Đặt làm mặc định', array('action' => 'setDefault', $row['Video']['id']))

											?></td>
									<td><?php echo date('d/m/Y', strtotime($row['Video']['created'])) ?></td>
									<td>
										<?php
										echo $this->Html->link(
												$this->Html->image('admin/edit.png'), array('action' => 'edit', $row['Video']['id']), array('escape' => false));
										echo $this->Form->postLink($this->Html->image('admin/delete.png'), array('action' => 'delete', $row['Video']['id']), array('escape' => false), 'Bạn có chắc chắn muốn xóa ???')

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

