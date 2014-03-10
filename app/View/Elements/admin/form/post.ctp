<?php //debug($this->request->data);             ?>
<div class="row">
	<div class="block">
		<div class="navbar navbar-inner block-header">
			<div class="muted pull-left">Quản lí bài viết</div>
		</div>
		<div class="block-content collapse in">
			<div class="span12">
				<?php echo $this->Form->create('Post'); ?>
				<fieldset>
					<legend>Nhập nội dung bài viết</legend>
					<div class="control-group">
						<label class="control-label">Chọn danh mục</label>
						<div class="controls">
							<select name="data[Post][category_id]" class="input-xxlarge">
								<?php
								foreach ($categories as $k => $v):
									if (in_array($k, $categoryAllow)) {

										?>
										<option value="<?php echo $k ?>" <?php echo (isset($this->request->data['Post']['category_id']) && $this->request->data['Category']['id'] == $k) ? 'selected' : '' ?>><?php echo $v ?></option>
										<?php
									}

									?>

									<?php
								endforeach;

								?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label>Tiêu đề</label>
						<div class="controls">
							<?php echo $this->Form->input('title', array('class' => 'input-xxlarge', 'div' => false, 'label' => false)) ?>
						</div>
					</div>
					<div class="control-group">
						<label>Ảnh</label>
						<!--						<div class="controls">
						<?php
						if (!empty($this->request->data['Post']['thumbnail'])) {

							?>
																<div class="thumbnail post-thumnail" onclick="openKCFinder_singleFile(this)"><img src="<?php echo $this->request->data['Post']['thumbnail'] ?>"/></div>
							<?php
						} else {
							echo $this->Html->tag('div', 'Click để chọn hình.', array('class' => 'thumbnail post-thumnail', 'onclick' => 'openKCFinder_singleFile(this)'));
						}

						?>
												</div>-->
						<div class="controls">
							<?php echo $this->Form->input('thumbnail', array('id' => 'post-thumbnail', 'div' => false, 'label' => false, 'class' => 'input-xxlarge','placeholder'=>'Nhập link ảnh')); ?>
						</div>
					</div>
					<div class="control-group">
						<label>Tóm tắt</label>
						<div class="controls">
							<?php echo $this->Form->input('sumary', array('rows' => 6, 'div' => false, 'label' => false, 'class' => 'input-xxlarge textarea wysihtml5-editor')); ?>
						</div>
					</div>
					<div class="control-group">
						<label>Nội dung</label>
						<div class="controls">
							<?php
							echo $this->Form->input('content', array('div' => FALSE, 'label' => false, 'id' => 'full_text', 'class' => 'input-xxlarge textarea wysihtml5-editor'));
							echo $this->TvFck->create('full_text', array('toolbar' => 'extra', 'height' => '550px'), 'full_text');

							?>
						</div>
					</div>
					<div style="text-align: center">
						<?php echo $this->Form->submit('Lưu', array('class' => 'btn btn-success', 'div' => false)) ?>
					</div>
				</fieldset>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>

</div>