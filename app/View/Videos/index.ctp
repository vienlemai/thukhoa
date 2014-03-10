<div class="row">
	<ol class="breadcrumb">
		<li><?php echo $this->Html->link('Trang chủ', '/'); ?></li>
        <li>Video</li>
    </ol>
    <div class="panel panel-primary" id="tab-content">
        <div class="panel-body" style="height: 1360px;">
			<div class="row">
				<div class="col-lg-12">
					<div class="form-horizontal">
						<?php
						foreach ($videos as $video):

							?>
							<div class="col-lg-3">
								<div class="thumbnail">
									<?php
									echo $this->Html->link($this->Html->image('http://img.youtube.com/vi/' . $video['Video']['youtube_id'] . '/0.jpg', array('class' => 'thumbnail')), array(
										'action' => 'view',
										'id' => $video['Video']['id'],
										'slug' => $video['Video']['alias'],
											), array('escape' => false))

									?>

								</div>
								<div class="caption">
									<h6>
										<?php
										echo $this->Html->link($video['Video']['title'], array(
											'action' => 'view',
											'id' => $video['Video']['id'],
											'slug' => $video['Video']['alias'],
												)
										);

										?>
									</h6>
								</div>
							</div>
							<?php
						endforeach;

						?>
					</div>				
				</div>
			</div>
			<div class="col-lg-12">
				<?php if (!empty($videos)) { ?>
					<ul class="pagination pagination-sm">
						<?php
						$this->Paginator->options(array(
							'update' => '#layout-content',
							'evalScripts' => true
						));
						echo $this->Paginator->prev('Trước', array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
						echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
						echo $this->Paginator->next('Tiếp', array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));

						?>
					</ul>
				<?php } ?>
			</div>
        </div>
    </div>
</div>
<?php echo $this->Js->writeBuffer(); ?>