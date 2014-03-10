<div class="row">
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left">Quản lí môn học</div>
		</div>
		<div class="block-content collapse in">
			<div class="span6">
				<?php echo $this->Form->create('Subject'); ?>
				<fieldset>
					<legend>Nhập tên môn học</legend>
					<div class="control-group">
						<label>Tên môn học</label>
						<div class="controls">
							<?php echo $this->Form->input('name', array('class' => 'input-xxlarge', 'div' => false, 'label' => false)) ?>
						</div>
					</div>
					<div style="">
						<?php echo $this->Form->submit('Nhập', array('class' => 'btn btn-primary', 'div' => false)) ?>
					</div>
				</fieldset>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>

</div>