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
<div class="row">
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left">Quản lí bài viết</div>
		</div>
		<div class="block-content collapse in">
			<div class="span12">
				<?php echo $this->Form->create('User', array('action' => 'addUser')); ?>
				<fieldset>
					<legend>Nhập thông tin người dùng</legend>
					<div class="row">
						<div class="span4">
							<div class="control-group">
								<label>Tên đăng nhập</label>
								<div class="controls">
									<?php echo $this->Form->input("username", array('label' => false, 'div' => false, 'class' => 'input-xlarge')) ?>
								</div>
							</div>
							<div class="control-group">
								<label>Phân quyền</label>
								<div class="controls">
									<?php echo $this->Form->input('user_group_id', array('type'=>'select','options'=>array(DEFAULT_GROUP_ID=>'Nguời dùng bình thường',ADMIN_GROUP_ID=>'Người quản trị'), 'label' => false, 'div' => false, 'class' => 'input-xlarge')); ?>
								</div>
							</div>

							<div class="control-group">
								<label>Họ tên</label>
								<div class="controls">
									<?php echo $this->Form->input("first_name", array('label' => false, 'div' => false, 'class' => 'input-xlarge')) ?>
								</div>
							</div>

							<div class="control-group">
								<label>Địa chỉ email</label>
								<div class="controls">
									<?php echo $this->Form->input("email", array('label' => false, 'div' => false, 'class' => 'input-xlarge')) ?>
								</div>
							</div>

							<div class="control-group">
								<label>Mật khẩu</label>
								<div class="controls">
									<?php echo $this->Form->input("password", array("type" => "password", 'label' => false, 'div' => false, 'class' => "input-xlarge")) ?>
								</div>
							</div>
							<div class="control-group">
								<label>Nhập lại mật khẩu</label>
								<div class="controls">
									<?php echo $this->Form->input("cpassword", array("type" => "password", 'label' => false, 'div' => false, 'class' => "input-xlarge")) ?>
								</div>
							</div>
						</div>
						<div class="span4">
							<div class="control-group checkbox-group">
								<label class="control-label">Chọn danh mục được phép đăng</label>
								<div class="checkbox" id="category-checkbox">
									<?php
									foreach ($categories as $category) {
										echo $this->Menu->generateTree($category);
									}

									?>

								</div>
							</div>
						</div>	
						<div class="span4">
							<div class="control-group checkbox-group">
								<div class="checkbox">
									<label>Chọn chức năng cho phép sử dụng</label>
									<div class="root-category">
										<label class="label-root-category"><input type="checkbox"/>Chọn tất cả</label>
										<div class="child-category">
											<?php foreach ($modules as $k => $v) : ?>
												<label><input type="checkbox" name="data[Module][]" value="<?php echo $k ?>"/>Quản lý <?php echo $v['title'] ?></label>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<?php echo $this->Form->submit('Thêm người dùng', array('class' => 'btn btn-large btn-primary', 'div' => false)) ?>
					</div>
				</fieldset>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Html->script('vendor/jquery-ui.min', array('block' => 'scriptBottom')) ?>
<?php echo $this->Html->script('jtree/js/jquery.tree', array('block' => 'scriptBottom')) ?>
<?php echo $this->Html->script('jtree/js/jquery.treecheckbox', array('block' => 'scriptBottom')) ?>
<?php echo $this->Html->script('admin/add-user', array('block' => 'scriptBottom')); ?>
<?php //echo $this->Html->css('vendor/jquery-ui', array('block' => 'headerCss')); ?>
<?php
$script = '$("#category-checkbox").tree({});';
echo $this->Html->scriptBlock($script, array('block' => 'scriptBottom'));

?>