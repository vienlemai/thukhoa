<ol class="breadcrumb">
	<li><?php echo $this->Html->link('Trang chủ', '/'); ?></li>
	<?php if (!empty($category['ParentCategory']['name'])): ?>
		<li><?php echo $category['ParentCategory']['name'] ?></li>
	<?php endif; ?>
	<li><?php echo $category['Category']['name'] ?>
	</li>	
</ol>
<?php
if (empty($posts)):
	echo 'Nội dung đang cập nhật . . .';
else:
	foreach ($posts as $row):

		?>
		<div style="padding:2px 4px 2px 4px">
			<h4 class="">
				<?php
				echo $this->Html->link($row['Post']['title'], array(
					'controller' => 'posts',
					'action' => 'view',
					'id' => $row['Post']['id'],
					'slug' => $row['Post']['alias']), array('escape' => false));

				?>
			</h4>
			<?php
			if (isset($row['Post']['thumbnail']) && $row['Post']['thumbnail'] != null) {
				echo $this->Html->image($row['Post']['thumbnail'], array('style="width:120px;height:80px;margin:3px 5px 3px 5px;border: 1px solid #eee;float: left"'));
			} else {
				echo $this->Html->image('frontend/no-images.jpg', array('style="width:120px;height:80px;margin:3px 5px 3px 5px;border: 1px solid #eee;float: left"'));
			}

			?>
			<p><?php echo $row['Post']['sumary'] . '...' ?></p>
			<?php
			echo $this->Html->link('Xem thêm...', array(
				'controller' => 'posts',
				'action' => 'view',
				'id' => $row['Post']['id'],
				'slug' => $row['Post']['alias']), array('style' => "float: right", 'escape' => false));

			?>
		</div>
		<div class="clearfix"></div>
		<hr>
		<?php
	endforeach;

	?>
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
<?php
endif;

?>
<?php echo $this->Js->writeBuffer(); ?>