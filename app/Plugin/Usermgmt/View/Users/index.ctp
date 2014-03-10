<?php
/*
  This file is part of UserMgmt.

  Author: Chetan Varshney (http://ektasoftwares.com)

  UserMgmt is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  UserMgmt is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 */

?>
<div class="row-fluid">	
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left">Danh sách người dùng</div>
		</div>
		<div class="block-content collapse in">			
			<div class="span12">
				<div class="dataTables_wrapper form-inline" role="grid">
					<div  class="row">
						<div class="actions" style="margin-bottom: 20px">
							<?php echo $this->Html->link('Thêm người dùng', $this->Html->url('/admin/them-nguoi-dung'), array('class' => 'btn btn-primary')) ?>
						</div>
					</div>
					<?php echo $this->Session->flash();?>
					<table class="table table-striped table-bordered dataTable" >
						<thead>
							<tr>
								<th>TT</th>
								<th>Họ tên</th>
								<th>Tên đăng nhập</th>
								<th>Email</th>
								<th>Ngày tạo</th>
								<th>Thao tác</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (!empty($users)) {
								$sl = 0;
								foreach ($users as $row) {
									$sl++;
									echo "<tr>";
									echo "<td>" . $sl . "</td>";
									echo "<td>" . h($row['User']['first_name']) . " " . h($row['User']['last_name']) . "</td>";
									echo "<td>" . h($row['User']['username']) . "</td>";
									echo "<td>" . h($row['User']['email']) . "</td>";
									echo "<td>" . date('d/m/Y', strtotime($row['User']['created'])) . "</td>";
									echo "<td>";
									//echo "<span class='icon'><a href='" . $this->Html->url('/viewUser/' . $row['User']['id']) . "'><img src='" . $this->Html->url('/') . "usermgmt/img/view.png' border='0' alt='View' title='View'></a></span>";
									echo "<span class='icon'><a href='" . $this->Html->url('/editUser/' . $row['User']['id']) . "'><img src='" . $this->Html->url('/') . "usermgmt/img/edit.png' border='0' alt='Edit' title='Edit'></a></span>";
									echo "<span class='icon'><a href='" . $this->Html->url('/changeUserPassword/' . $row['User']['id']) . "'><img src='" . $this->Html->url('/') . "usermgmt/img/password.png' border='0' alt='Đổi mật khẩu' title='Đổi mật khẩu'></a></span>";
									if ($row['User']['id'] != 1 && $row['User']['username'] != 'Admin') {
										echo $this->Form->postLink($this->Html->image($this->Html->url('/') . 'usermgmt/img/delete.png', array("alt" => 'Xóa người dùng', "title" => 'Xóa người dùng')), array('action' => 'deleteUser', $row['User']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this user?')));
									}
									echo "</td>";
									echo "</tr>";
								}
							} else {
								echo "<tr><td colspan=10><br/><br/>No Data</td></tr>";
							}

							?>
						</tbody>
					</table>
					<div class="row">
						<div class="span6"></div>
						<div class="span6">
							<div class="dataTables_paginate paging_bootstrap pagination">
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
</div>
