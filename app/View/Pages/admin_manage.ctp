<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Các trang giới thiệu</div>
        </div>
        <div class="block-content collapse in">
            <?php echo $this->Session->flash() ?>
            <div class="albums index">
                <table class="table-data table table-striped table-bordered dataTable" >
                    <tr>
                        <th>Tên trang</th>
                        <th>Nội dung</th>
                    </tr>
                    <?php foreach ($pages as $page): ?>
                        <tr>
                            <td><?php echo $this->Html->link($page['Page']['title'], array('action' => 'edit', 'page_name' => $page['Page']['name'])); ?></td>
                            <td><?php echo h($page['Page']['content']); ?>&nbsp;</td>
                            <td class="actions">
                                <?php echo $this->Html->link('Xem', array('action' => 'edit', $page['Page']['name'])); ?>
                                <?php echo $this->Html->link('Sửa', array('action' => 'update', $page['Page']['name'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>           
        </div>
    </div>
</div>