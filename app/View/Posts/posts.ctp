<?php
if (empty($posts)):
	echo 'Nội dung đang cập nhật . . .';
else:

	?>
	<div class="listposts">
		<?php foreach ($posts as $row): ?>
			<div class="box">
				<?php
				echo $this->Html->link($row['Post']['title'], array(
					'controller' => 'posts',
					'action' => 'view',
					'id' => $row['Post']['id'],
					'slug' => $row['Post']['alias']
						), array(
					'escape' => false,
					'class' => 'title',
				));

				?>
				<!--<div class="date">18/12/2013</div>-->
				<!--<div class="view">17 lượt xem</div>-->
				<div class="clear"></div>
				<?php
				echo $this->Html->link($this->Html->image($row['Post']['thumbnail']), array(
					'controller' => 'posts',
					'action' => 'view',
					'id' => $row['Post']['id'],
					'slug' => $row['Post']['alias']
						), array(
					'escape' => false,
				));

				?>
				<div class="summary">
					<p><?php echo $row['Post']['sumary'] ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>


<?php endif; ?>
<div class="clear"></div>