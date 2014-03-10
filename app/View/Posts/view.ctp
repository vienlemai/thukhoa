<div class="row">
	<div class="8u skel-cell-important" id="content">
		<article id="main">
			<header>
				<h2><a href="#"><?php echo $article['Post']['title'] ?></a></h2>
			</header>
			<?php if (!empty($article['Post']['thumbnail'])): ?>
				<a href="#" class="image featured"><img src="<?php echo $article['Post']['thumbnail'] ?>" alt="" /></a>
			<?php endif; ?>
			<?php echo $article['Post']['sumary'] ?>
			<br/>
			<?php echo $article['Post']['content'] ?>


		</article>
	</div>
	<div class="4u" id="sidebar">
		<?php if (!empty($otherArticle)): ?>
			<section>
				<header>
					<h3><a href="#">Có thể bạn quan tâm</a></h3>
				</header>
				<?php foreach ($otherArticle as $row): ?>
					<div class="row half no-collapse">
						<div class="4u">
							<?php
							echo $this->Html->link($this->Html->image($row['Post']['thumbnail']), array(
								'controller' => 'posts',
								'action' => 'view',
								'id' => $row['Post']['id'],
								'slug' => $row['Post']['alias']
									), array(
								'escape' => false,
								'class' => 'image full'
							));

							?>
						</div>
						<div class="8u">
							<h4><?php echo $row['Post']['title']; ?></h4>
						</div>
					</div>
				<?php endforeach; ?>
			</section>
		<?php endif; ?>
	</div>
</div>	
