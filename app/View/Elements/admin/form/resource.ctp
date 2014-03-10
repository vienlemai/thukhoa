<div class="row">
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left">Quản lí tài liệu</div>
		</div>
		<div class="block-content collapse in">
			<div class="span12">
				<?php echo $this->Form->create('Resource'); ?>
				<fieldset>
					<legend><?php echo $resource_title[$resource_type] ?></legend>
					<div class="control-group">
						<label class="control-label">Tiêu đề</label>
						<div class="controls">
							<?php
							echo $this->Form->input('title', array(
								'label' => false,
								'div' => false,
								'class' => 'input-xxlarge',
								'required' => false,
							));

							?>
						</div>
					</div>
					<div class="control-group">
						<label>Môn học</label>
						<div class="controls">
							<?php echo $this->Form->input('subject_id', array('label' => false, 'div' => false, 'class' => 'input-xxlarge')) ?>
						</div>
					</div>	

					<?php if ($resource_type == 1): ?>
						<div class="control-group">
							<label>Năm học</label>
							<div class="controls">
								<?php echo $this->Form->input('year_id', array('label' => false, 'div' => false, 'class' => 'input-xxlarge')) ?>
							</div>
						</div>	
					<?php endif; ?>

					<div class="control-group">
						<label>Link tài liệu trên Dropbox</label>
						<div class="controls">
							<?php
							echo $this->Form->input('link', array(
								'class' => 'input-xxlarge',
								'div' => false,
								'label' => false,
								'required' => false,
							));

							?>
						</div>
					</div>	

					<div class="control-group">
						<label>Mô tả</label>
						<div class="controls">
							<?php
							echo $this->Form->input('description', array(
								'type' => 'textarea',
								'class' => 'input-xxlarge',
								'div' => false,
								'label' => false,
							));

							?>
						</div>
					</div>		
					<div class="form-actions">
						<?php echo $this->Form->submit('Thêm tài liệu', array('class' => 'btn-large btn-primary', 'div' => false)) ?>
					</div>
				</fieldset>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>

</div>