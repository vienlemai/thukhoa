<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Quản lí bài viết</div>
        </div>
        <div class="block-content collapse in">			
            <div class="span12">
				<div class="row-fluid">
					<div class="span5">
						<form method="GET" id="admin-form-posts-filter">
							<select name="filter" id="admin-posts-filter">
								<option value="mine" <?php echo $filter == 'mine' ? 'selected' : '' ?>>Chỉ những bài do tôi đăng</option>
								<option value="all" <?php echo $filter == 'all' ? 'selected' : '' ?>>Tất cả bài viết</option>
							</select>
						</form>
					</div>
					<div class="span7">
						<div class="actions">
							<a href="/admin/posts/add" class="btn btn-primary">Đăng bài viết</a>
						</div>
					</div>
				</div>
				<hr>
				<?php echo $this->Session->flash() ?>
				<table class="table-data table table-striped table-bordered dataTable" >
					<thead>
						<tr>
							<th>TT</th>
							<th width="50%">Tên bài viết</th>
							<th>Danh mục</th>
							<th>Người đăng</th>
							<th>Ngày đăng</th>
							<th>Trạng thái</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//debug($categories);
						$stt = 1;
						foreach ($posts as $row):

							?>
							<tr>
								<td><?php echo $stt++ ?></td>
								<td><?php
									echo $this->Html->link($row['Post']['title'], array(
										'controller' => 'posts',
										'action' => 'view',
										'id' => $row['Post']['id'],
										'slug' => $row['Post']['alias'],
										'admin' => false), array('escape' => false, 'target' => '_blank'));

									?></td>
								<td><?php echo $row['Category']['name'] ?></td>
								<td><?php echo $row['User']['first_name'] ?></td>
								<td>
									<?php echo date('d/m/Y', strtotime($row['Post']['created'])) ?>
								</td>
								<td>
									<?php
									if ($row['Post']['is_active']):
										echo $this->Html->link($this->Html->image('admin/approve.png'), array(
											'action' => 'makeUnActive', $row['Post']['id'],
												), array('escape' => false));

										?>

										<?php
									else:
										echo $this->Html->link($this->Html->image('admin/dis-approve.png'), array(
											'action' => 'makeActive', $row['Post']['id'],
												), array('escape' => false));

										?>
									<?php endif; ?>
								</td>
								<td>
									<?php
									if ($row['User']['id'] == $user_id || $user_id == ADMIN_GROUP_ID) {
										echo $this->Html->link($this->Html->image('admin/edit.png'), array('action' => 'edit', $row['Post']['id']), array('escape' => false, 'title' => 'Chỉnh sửa bài viết'));
										echo $this->Form->postLink(
												$this->Html->image('admin/delete.png'), array('action' => 'delete', $row['Post']['id']), array('escape' => false, 'title' => 'Xóa bài viết'), 'Bạn có chắc chắn muốn xóa ?'
										);
									}

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

