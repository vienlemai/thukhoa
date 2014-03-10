<div class="panel panel-default">
	<ul class="list-group">
		<?php foreach ($confidentials as $confidential): ?>
			<li class="list-group-item">
				<h4><?php echo $confidential['Confidential']['title']; ?>
					<p>
						<small>
							<?php echo $confidential['Confidential']['email']; ?>
							<span> - <?php echo date('d/m/Y H:i:s ', strtotime($confidential['Confidential']['modified'])); ?></span>
						</small>
					</p>
				</h4>
				<?php echo $confidential['Confidential']['content']; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
<ul class="pagination pagination-sm" style="margin-left: 20px">
	<?php
	$this->Paginator->options(array(
		'update' => '#list-confidentials',
		'evalScripts' => true
	));
	echo $this->Paginator->prev('Trước', array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
	echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
	echo $this->Paginator->next('Tiếp', array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
	?>
</ul>
<?php echo $this->Js->writeBuffer(); ?>
