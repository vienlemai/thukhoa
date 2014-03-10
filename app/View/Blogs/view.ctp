<?php
$first = $posts[0];
?>
<div class="newest-article"> 
    <div class="head"> 
        <h3>
            <?php echo $first['Article']['title'] ?>
        </h3>
    </div>
    <div class="body"> 
        <p>
            <?php echo $first['Article']['content'] ?>
        </p>
    </div>
</div>
