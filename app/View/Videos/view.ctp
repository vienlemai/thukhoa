
<div class="row">
    <ol class="breadcrumb">
		<li><?php echo $this->Html->link('Trang chủ', '/'); ?></li>
        <li><?php echo $this->Html->link('Video',array('controller'=>'videos','action'=>'index')); ?></li>
		<li><?php echo $videoDefault['Video']['title']?></li>
    </ol>
    <div class="panel panel-primary" id="tab-content">
        <div class="panel-body" style="height: 1360px;">
            <div class="col-lg-12">
                <iframe class="col-lg-10 col-lg-offset-1" src="<?php echo 'http://youtube.com/embed/' . $videoDefault['Video']['youtube_id'] ?>" width="640" height="390" frameborder="0"></iframe>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <br>
            <ol class="breadcrumb">
                <li><a href="#">CÁC VIDEO KHÁC</a></li>
            </ol>
            <div class="col-lg-12">
                <div class="form-horizontal">
                    <?php
                    foreach ($videos as $video):
                        ?>
                        <div class="col-lg-3">
                            <div class="thumbnail">
                                <?php
                                echo $this->Html->link($this->Html->image('http://img.youtube.com/vi/' . $video['Video']['youtube_id'] . '/0.jpg', array('class' => 'thumbnail')), array(
                                    'action' => 'view',
                                    'id' => $video['Video']['id'],
                                    'slug' => $video['Video']['alias'],
                                        ), array('escape' => false))
                                ?>

                            </div>
                            <div class="caption">
                                <h6>
                                    <?php
                                    echo $this->Html->link($video['Video']['title'], array(
                                        'action' => 'view',
                                        'id' => $video['Video']['id'],
                                        'slug' => $video['Video']['alias'],
                                            )
                                    );
                                    ?>
                                </h6>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>