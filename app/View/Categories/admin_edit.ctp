<div class="row">
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left">Quản lí danh mục</div>
		</div>
		<div class="block-content collapse in">
			<div class="span6">
				<?php echo $this->Form->create('Category'); ?>
				<fieldset>
					<legend>Nhập thông tin danh mục</legend>
					<?php if ($this->request->data['Category']['parent_id'] != null): ?>
						<div class="control-group">
							<label class="control-label">Chọn danh mục cha</label>
							<div class="controls">
								<?php
								echo $this->Form->input('parent_id', array(
									'label' => false,
									'div' => false,
									'class' => 'input-xxlarge',
									'type' => 'select',
									'options' => $parentCategories,
									//'empty' => '--Là danh mục cha--',
									'required' => false,
									'escape'=>false,
								));

								?>
							</div>
						</div>
					<?php endif; ?>
					<div class="control-group">
						<label>Tên danh mục</label>
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