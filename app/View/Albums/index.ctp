<ol class="breadcrumb">
    <li><?php echo $this->Html->link('Trang chủ', '/'); ?></li>
    <li>Album ảnh</li>
</ol>
<?php foreach ($albums as $row): ?>
    <?php if (!$row['Album']['for_slide']) { ?>
        <h4><?php echo $row['Album']['name'] ?></h4>
        <p style="font-size: 0.85em" ><?php echo '(Ngày đăng: ' . $row['Album']['created_at'] . ')' ?></p>
        <?php foreach ($row['Photo'] as $key => $value): ?>
            <a href="<?php echo 'img/albums/' . $value['album_id'] . '/' . $value['url'] ?>" class="fancybox-buttons"data-fancybox-group="<?php echo 'album-' . $value['album_id'] ?>"  rel="gallery" title="<?php echo $row['Album']['name'] ?>">
                <?php echo $this->Html->image('albums/' . $value['album_id'] . '/' . $value['url'], array('alt="Facebook" width="85" height="65"')) ?>
            </a>
        <?php endforeach; ?>
    <?php } ?>
<?php endforeach; ?>
<?php
echo $this->Html->css('vendor/jquery.fancybox', array('inline' => false, 'block' => 'headerCss'));
echo $this->Html->css('vendor/jquery.fancybox-buttons', array('inline' => false, 'block' => 'headerCss'));
echo $this->Html->script('vendor/jquery.fancybox.pack', array('block' => 'scriptBottom'));
echo $this->Html->script('vendor/jquery.fancybox-buttons', array('block' => 'scriptBottom'));
echo $this->Html->script('frontend/album', array('block' => 'scriptBottom'));
?>