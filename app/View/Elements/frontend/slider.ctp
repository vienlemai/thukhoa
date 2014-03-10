<?php
$photo_urls = $this->requestAction('albums/photosSlide');
?>
<div class="row">
    <div id="carousel-example-generic" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php foreach ($photo_urls as $key => $photo_url) { ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $key ?>" class="<?php echo ($key == 0) ? 'active' : '' ?>"></li>
            <?php } ?>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php foreach ($photo_urls as $key => $photo_url) { ?>
                <div class="item <?php echo ($key == 0) ? 'active' : '' ?>">
                    <?php echo $this->Html->image($photo_url) ?>
                </div> 
            <?php } ?>

        </div>
    </div>
</div>