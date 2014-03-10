<div class="row">
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left">Quản lí menu</div>
		</div>
		<div class="block-content collapse in">
			<?php echo $this->Session->flash() ?>
			<div class="span6">
				<?php echo $this->Form->create('Menu'); ?>
				<fieldset>
					<legend>Nhập thông tin menu</legend>
					<div class="control-group">
						<label class="control-label">Chọn menu cha</label>
						<div class="controls">
							<?php
							echo $this->Form->input('parent_id', array(
								'label' => false,
								'div' => false,
								'class' => 'input-xxlarge',
								'type' => 'select',
								'options' => $parentMenus,
								'empty' => '--Là menu cha--',
								//'required' => false,
								'escape' => false,
							));

							?>
						</div>
					</div>
					<div class="control-group">
						<label>Tên menu</label>
						<div class="controls">
							<?php echo $this->Form->input('title', array('class' => 'input-xxlarge', 'div' => false, 'label' => false, 'required' => false)) ?>
						</div>
					</div>
					<div class="control-group">
						<label>Loại menu</label>
						<div class="controls">
							<?php
							echo $this->Form->input('menu_type', array(
								'type' => 'select',
								'div' => false,
								'label' => false,
								'options' => $menu_titles,
								'empty' => '--Chọn kiểu menu--',
							))

							?>							
						</div>
					</div>
					<div class="control-group">
						<label>Nội dung menu</label>
						<div class="controls">
							<?php
							echo $this->Form->input('content', array(
								'class' => 'input-xxlarge',
								'div' => false,
								'label' => false,
								'required' => false,
								'disabled' => 'disabled',
							));

							?>
						</div>
					</div>
					<?php echo $this->Form->hidden('ext'); ?>
					<?php echo $this->Form->hidden('link'); ?>
					<div>
						<?php echo $this->Form->submit('Nhập', array('class' => 'btn btn-primary', 'div' => false)) ?>
					</div>
				</fieldset>				
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
<div id="menu-modal" class="modal hide" aria-hidden="true" style="display: none; width: 840px; margin-left: -420px">
	<div class="modal-header">
		<button data-dismiss="modal" class="close" type="button">×</button>
		<h3></h3>
	</div>
	<div class="modal-body">

	</div>
	<div class="modal-footer">
		<a data-dismiss="modal" class="btn btn-primary" href="#">Đồng ý</a>
	</div>

</div>
<script type="text/javascript">
	var menus = <?php echo json_encode($menu_types) ?>
</script>

