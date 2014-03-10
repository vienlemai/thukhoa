<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Quản lí albums</div>
        </div>
        <div class="block-content collapse in">
            <?php echo $this->Session->flash() ?>
            <div class="albums form">
                <?php echo $this->Form->create('Album'); ?>
                <fieldset>
                    <legend><?php echo __('Tạo album ảnh mới'); ?></legend>
                    <?php
                    echo $this->Form->input('name', array('label' => 'Tiêu đề:'));
                    ?>
                    <?php
                    echo $this->Form->input('description', array('label' => 'Mô tả:'));
                    ?>
                </fieldset>
                <button class="btn btn-success" type="submit">Lưu</button>
                <?php echo $this->Form->end(); ?>
            </div>
            <div class="actions">
                <?php echo $this->Html->link(__('Danh sách Albums'), array('action' => 'index')); ?>
            </div>

        </div>
    </div>
</div>