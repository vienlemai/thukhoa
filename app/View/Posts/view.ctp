<ol class="breadcrumb">
	<li><?php echo $this->Html->link('Trang chủ', '/'); ?></li>
	<?php if (!empty($category['ParentCategory']['name'])): ?>
		<li><?php echo $category['ParentCategory']['name'] ?></li>
	<?php endif ?>
	<li><?php
		echo $this->Html->link($category['Category']['name'], array(
			'controller' => 'posts',
			'action' => 'posts',
			'id' => $category['Category']['id'],
			'slug' => $category['Category']['alias'],
		));

		?>
	</li>
	<li><?php echo $article['Post']['title'] ?></li>
</ol>
<span class="spanTime">Ngày Đăng:
	<?php
	$date = new DateTime($article['Post']['modified']);
	echo ' ' . $date->format('d-m-Y');

	?>
</span>
<h3 class="text-center"><?php echo $article['Post']['title'] ?></h3>
<p>
	<?php
	echo $article['Post']['content'];

	?>
</p>
<p class="pull-right" style="font-weight: bold">
    Người đăng: <?php echo ' ' . $article['User']['first_name'] ?>
</p>
<?php echo $this->Facebook->comments(array('width'=>'850px')); ?>
<br>
<div>
	<?php if (!empty($otherArticle)): ?>
		<h4 class="pull-left">Các tin khác:</h4>
	    <div class="clearfix"></div>
		<?php $i = 1; ?>
		<?php foreach ($otherArticle as $row): ?>
			<div class="col-lg-12">
				<?php
				echo '&bull;&nbsp;' . $this->Html->link($row['Post']['title'], array(
					'controller' => 'posts',
					'action' => 'view',
					'id' => $row['Post']['id'],
					'slug' => $row['Post']['alias']), array('escape' => false));

				?>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
