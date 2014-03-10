<div class="article_form">
    <h2>Sửa bài viết</h2>  
    <?php
    $user_slug = $this->Common->vnit_change_string(Inflector::slug($user['username']));
    $article_slug = $this->Common->vnit_change_string(Inflector::slug($article['Article']['title']));
    $url = Router::url(array(
                'controller' => 'blogs',
                'action' => 'editArticle',
                'bloger_id' => $user['id'],
                'slug' => $user_slug,
                'article_id' => $article['Article']['id'],
    ));
    ?>
    <?php echo $this->Form->create('Article', array('url' => $url));
    ?>
    <fieldset>
        <?php
        echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $user['id']));
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->input('title', array('label' => 'Tiêu đề'));
        echo $this->Form->input('content', array('label' => 'Nội dung', 'id' => 'article_content', 'required' => false));
        echo $this->TvFck->create('article_content', array('toolbar' => 'extra', 'height' => 400), 'article_content');
        ?>
        <?php // $this->Html->url() ?>
    </fieldset>
    <?php echo $this->Form->end(__('Cập nhật')); ?>
</div>
