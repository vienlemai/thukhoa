<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Quản lí albums</div>
        </div>
        <div class="block-content collapse in">
            <?php echo $this->Session->flash() ?>
            <div class="albums index">
                <div class="actions" style="margin-bottom: 20px">
                    <a href="/admin/albums/add" class="btn btn-primary">Tạo album mới</a>
                </div>
                <table class="table-data table table-striped table-bordered dataTable">
                    <tr>
                        <th>Tiêu đề</th>
                        <th>Ngày tạo</th>
                        <th>Số lượng ảnh</th>
                        <th>Thao tác</th>
                    </tr>

                    <?php foreach ($albums as $album): ?>
                        <tr>
                            <td><?php echo $this->Html->link($album['Album']['name'], array('action' => 'view', $album['Album']['id'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($album['Album']['created_at'])); ?>&nbsp;</td>
                            <td><?php echo h(count($album['Photo'])); ?>&nbsp;</td>
                            <td class="actions">
                                <?php echo $this->Html->link($this->Html->image('admin/preview.png'), array('action' => 'view', $album['Album']['id']), array('escape' => false, 'title' => 'Xem album')); ?>
                                <?php echo $this->Html->link($this->Html->image('admin/edit.png'), array('action' => 'edit', $album['Album']['id']), array('escape' => false, 'title' => 'Sửa album')); ?>
                                <?php echo $this->Form->postLink($this->Html->image('admin/delete.png'), array('action' => 'delete', $album['Album']['id']), array('escape' => false, 'title' => 'Xóa album'), __('Bạn có chắc chắn muốn xóa album ' . $album['Album']['name'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>    
            <?php if (!$existsSlideAlbum) { ?>
                <div class="pull-right"> 
                    <button type="button" id="btn-create-slide-album" class="btn btn-success" data-url="<?php echo Router::url('/admin/albums/tao-slide-album') ?>">Tạo Album cho slide</button>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-create-slide-album').on('click', function() {
            if (confirm('Bạn chắc chắn muốn tiếp tục?')) {
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        console.log('success');
                        location.reload();
                    }
                });
                return false;
            }
        });
    });
</script> 