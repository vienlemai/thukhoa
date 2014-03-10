<div class="row">
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left">Quản lí Video</div>
		</div>
		<div class="block-content collapse in">
			<div class="span12">
				<?php echo $this->Form->create('Video'); ?>
				<fieldset>
					<legend>Nhập nội dung video</legend>
					<div class="control-group">
						<label>Tiêu đề</label>
						<div class="controls">
							<?php echo $this->Form->input('title', array('class' => 'input-xxlarge', 'div' => false, 'label' => false)) ?>
						</div>
					</div>
					<div class="control-group">
						<label>Đường dẫn trên Youtube</label>
						<div class="controls">
							<?php echo $this->Form->input('link', array('div' => false, 'label' => false, 'class' => 'input-xxlarge textarea wysihtml5-editor')); ?>
						</div>
					</div>
					<div class="control-group">
						<label>Mô tả</label>
						<div class="controls">
							<?php
							echo $this->Form->input('description', array('type'=>'textarea', 'div' => FALSE, 'label' => false, 'id' => 'full_text', 'class' => 'textarea'));

							?>
						</div>
					</div>
					<div class="form-actions">
						<?php echo $this->Form->submit('Nhập', array('class' => 'btn btn-large btn-primary', 'div' => false)) ?>
					</div>
				</fieldset>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>

</div>