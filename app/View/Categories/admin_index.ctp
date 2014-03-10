<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Quản lí danh mục</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
				<div class="actions" style="margin-bottom: 20px">
					<a href="/admin/categories/add" class="btn btn-primary">Thêm danh mục</a>
				</div>
				<?php echo $this->Session->flash() ?>
				<table class="table-data table table-striped table-bordered dataTable" >
					<thead>
						<tr>
							<th>TT</th>
							<th>Tên danh mục</th>
							<th>Danh mục cha</th>
							<th>Ngày tạo</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//debug($categories);
						$stt = 1;
						foreach ($categories as $row):

							?>
							<tr>
								<td><?php echo $stt++ ?></td>
								<td><?php echo $row['Category']['name'] ?></td>
								<td><?php echo $row['ParentCategory']['name'] ?></td>
								<td>
									<?php echo date('d/m/Y', strtotime($row['Category']['created'])) ?>
								</td>
								<td>
									<?php
									echo $this->Html->link($this->Html->image('admin/edit.png'), array('action' => 'edit', $row['Category']['id']), array('escape' => false));
									if (!empty($row['Category']['parent_id'])):
										//echo $this->Form->postLink($this->Html->image('admin/delete.png'), array('action' => 'delete'), array('escape' => false));
										echo $this->Form->postLink(
												$this->Html->image('admin/delete.png'), array('action' => 'delete', $row['Category']['id']), array('escape' => false), 'Bạn có chắc chắn muốn xóa ?'
										);
									endif;

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

