<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Liên kết websites</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
				<?php echo $this->Session->flash() ?>
				<table class="table table-striped table-bordered" >
					<thead>
						<tr>
							<th>TT</th>
							<th>Tiêu đề</th>
							<th>Liên kết</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//debug($categories);
						$stt = 1;
						foreach ($links as $row):

							?>
							<tr>
								<td><?php echo $stt++ ?></td>
								<td><?php echo $row['Link']['title'] ?></td>
								<td><?php echo $this->Html->link($row['Link']['link'], $row['Link']['link']) ?></td>
								<td>
									<?php
									echo $this->Html->link($this->Html->image('admin/edit.png'), array('action' => 'edit', $row['Link']['id']), array('escape' => false));
									echo $this->Form->postLink(
											$this->Html->image('admin/delete.png'), array('action' => 'delete', $row['Link']['id']), array('escape' => false), 'Bạn có chắc chắn muốn xóa ?'
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

