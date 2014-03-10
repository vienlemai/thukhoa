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
                    <legend><?php echo __('Sửa thông tin Album'); ?></legend>
                    <?php
                    echo $this->Form->input('id', array('type' => 'hidden'));
                    ?>
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
                <h3><?php echo __('Actions'); ?></h3>
                <ul>
                    <li><?php echo $this->Form->postLink('Xóa Album này', array('action' => 'delete', $this->Form->value('Album.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Album.id'))); ?></li>
                    <li><?php echo $this->Html->link('Danh sách Album', array('action' => 'index')); ?></li>
                </ul>
            </div>
        </div>
        
    </div>
</div>