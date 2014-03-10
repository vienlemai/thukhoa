<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left"><?php $page['Page']['title'] ?></div>
        </div>

        <div class="block-content collapse in">
            <?php echo $this->Session->flash() ?>
            <div class="">
                <?php echo $this->Form->create('Page'); ?>
                <fieldset>
                    <?php echo $this->Form->input('id',array('type' => 'hidden')) ?>
                    <?php echo $this->Form->input('name',array('type' => 'hidden')) ?>
                    <?php echo $this->Form->input('title') ?>
                    <?php echo $this->Form->input('content') ?>
                </fieldset>
                <button class="btn btn-success" type="submit">Lưu</button>
                <?php echo $this->Form->end(); ?>
            </div>           
        </div>

    </div>
</div>