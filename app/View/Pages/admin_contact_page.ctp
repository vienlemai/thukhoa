<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
        </div>

        <div class="block-content collapse in">
            <?php echo $this->Session->flash() ?>
            <div class="">
                <?php echo $this->Form->create('Page'); ?>
                <fieldset>
                    <?php echo $this->Form->input('id', array('type' => 'hidden')) ?>
                    <?php echo $this->Form->input('name', array('type' => 'hidden')) ?>
                    <?php echo $this->Form->input('title', array('label' => 'Tiêu đề trang')) ?>
                    <?php  
                    echo $this->Form->input('content', array('div' => FALSE, 'label' => 'Nội dung', 'id' => 'full_text', 'class' => 'wysihtml5-editor textarea-large'));
                    echo $this->TvFck->create('full_text', array('toolbar' => 'extra'), 'full_text');?>
                </fieldset>
                <button class="btn btn-success" type="submit">Lưu</button>
                <?php echo $this->Form->end(); ?>
            </div>           
        </div>

    </div>
</div>