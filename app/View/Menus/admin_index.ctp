<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Quản lí menu</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
				<div class="actions" style="margin-bottom: 20px">
					<a href="/admin/menus/add" class="btn btn-primary">Thêm menu</a>
				</div>
				<?php echo $this->Session->flash() ?>
				<table class="table-data table table-striped table-bordered dataTable" >
					<thead>
						<tr>
							<th>TT</th>
							<th>Tên menu</th>
							<th>Menu cha</th>
							<th>Kiểu menu</th>
							<th>Trạng thái</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//debug($menus);
						$stt = 1;
						foreach ($menus as $row):

							?>
							<tr>
								<td><?php echo $stt++ ?></td>
								<td><?php echo $row['Menu']['title'] ?></td>
								<td><?php echo $row['ParentMenu']['title'] ?></td>
								<td><?php echo $menu_titles[$row['Menu']['menu_type']] ?></td>
								<td>
									<?php
									if ($row['Menu']['is_active']):
										echo $this->Html->link($this->Html->image('admin/approve.png'), array(
											'action' => 'makeUnActive', $row['Menu']['id'],
												), array('escape' => false));

										?>

									<?php
									else:
										echo $this->Html->link($this->Html->image('admin/dis-approve.png'), array(
											'action' => 'makeActive', $row['Menu']['id'],
												), array('escape' => false));

										?>
									<?php endif; ?>
								</td>
								<td>
									<?php
									echo $this->Html->link($this->Html->image('admin/edit.png'), array('action' => 'edit', $row['Menu']['id']), array('escape' => false));

									//echo $this->Form->postLink($this->Html->image('admin/delete.png'), array('action' => 'delete'), array('escape' => false));
									echo $this->Form->postLink(
											$this->Html->image('admin/delete.png'), array('action' => 'delete', $row['Menu']['id']), array('escape' => false), 'Bạn có chắc chắn muốn xóa ?'
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
