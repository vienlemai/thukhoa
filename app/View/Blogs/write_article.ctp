<div class="article_form">
    <h2>Bài viết mới</h2>  
<?php echo $this->Form->create('Article', array('url' => Router::url('/blogs/writeArticle'))); 
?>
	<fieldset>
	<?php
		echo $this->Form->input('user_id',array('type' => 'hidden', 'value' => $user['id']));
		echo $this->Form->input('title', array('label' => 'Tiêu đề'));
		echo $this->Form->input('content', array('label' => 'Nội dung', 'id' => 'article_content','required' => false));
                echo $this->TvFck->create('article_content', array('toolbar' => 'extra', 'height' => 400), 'article_content');
	?>
        <?php // $this->Html->url() ?>
	</fieldset>
<?php echo $this->Form->end(__('Đăng bài')); ?>
</div>
