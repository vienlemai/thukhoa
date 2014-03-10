<div class="row">
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left">Quản lí liên kết websites</div>
		</div>
		<div class="block-content collapse in">
			<div class="span6">
				<?php echo $this->Form->create('Link'); ?>
				<fieldset>
					<legend>Nhập thông tin liên kết</legend>
					<div class="control-group">
						<label class="control-label">Chọn danh mục liên kết</label>
						<div class="controls">
							<select name="data[Link][type]" >
								<?php foreach ($linkTypes as $k => $v): ?>
									<option value="<?php echo $k ?>"><?php echo $v ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label>Tên liên kết</label>
						<div class="controls">
							<?php echo $this->Form->input('title', array('class' => 'input-xxlarge', 'div' => false, 'label' => false)) ?>
						</div>
					</div>

					<div class="control-group">
						<label>Liên kết</label>
						<div class="controls">
							<?php echo $this->Form->input('link', array('class' => 'input-xxlarge', 'div' => false, 'label' => false)) ?>
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