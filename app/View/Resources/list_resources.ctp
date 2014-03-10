<ol class="breadcrumb">
	<li><?php echo $this->Html->link('Trang chủ', '/'); ?></li>
	<li><?php echo $resource_title ?></li>
	<li><?php echo $resource_item;?></li>
</ol>
<div class="list-page-wrapper"> 
	<?php if (empty($resources)) : ?>
		<div class="empty text-center"> 
			<h3>Hiện không có tài liệu nào.</h3>
		</div>
	<?php else : ?>
		<div class="list-wrapper"> 
			<div class="text-center">
				<h3><?php echo $resource_title ?></h3>
			</div>
			<hr>
			<ul class="list">
				<?php
				foreach ($resources as $row):

					?>
					<li>
						<?php
						echo $this->Html->link($row['Resource']['title'], array(
							'controller' => 'resources',
							'action' => 'view',
							'id' => $row['Resource']['id'],
							'slug' => $row['Resource']['alias'],
						));

						?>
						<span class="date-posted">
							(<?php echo date('d/m/Y', strtotime($row['Resource']['created'])) ?>)
						</span>
					</li>
					<?php
				endforeach;

				?>
			</ul>
		</div>

		<ul class="pagination pagination-sm">
			<?php
			$this->Paginator->options(array(
				'update' => '#layout-content',
				'evalScripts' => true
			));			
			echo $this->Paginator->prev('Trước', array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
			echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li'));
			echo $this->Paginator->next('Tiếp', array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));

			?>
		</ul>
	<?php endif; ?>
</div>
<?php echo $this->Js->writeBuffer(); ?>