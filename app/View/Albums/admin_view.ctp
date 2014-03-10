<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Quản lí albums</div>
        </div>
        <div class="block-content collapse in">
            <div class="albums view">
                <h2><?php echo $album['Album']['name'] ?></h2>
                <i>Ngày tạo: <?php echo $album['Album']['created_at'] ?></i>
                <?php if ($album['Album']['for_slide']) { ?>
                    <h4 class="text-warning">
                        <?php echo $album['Album']['description'] ?> 
                    </h4>
                <?php } ?>
                <br />
                <div class="photos-in-album">
                    <?php if (count($album['Photo']) == 0) { ?>   
                        <p>Không có ảnh nào trong album này.</p>
                    <?php } else { ?>
                        <?php foreach ($album['Photo'] as $photo) { ?>
                            <div class="photo-box-warpper">
                                <div class="photo-box">
                                    <?php $url = 'albums/' . $album['Album']['id'] . '/' . $photo['url'] ?>
                                    <?php echo $this->Html->image($url) ?>
                                </div>
                                <span class="delete-btn-box" style="display:none"  > 
                                    <a photo_id="<?php echo $photo['id'] ?>" title="Xóa ảnh này"> <?php echo $this->Html->image('admin/delete.png') ?> </a>
                                </span>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div> 
                <div class="upload-area">
                    <h4>Upload ảnh: </h4>
                    <form action="<?php echo Router::url('/admin/album-anh/upload') ?>" method="post" enctype="multipart/form-data">
                        <input type='hidden' name='data[album_id]' value='<?php echo $album['Album']['id'] ?>'>
                        <div id='photo-fields'>
                            <div class="photo-field">
                                <input accept="image/*" class="file" type="file" style="display:none" name="data[Photos][]">
                                <input class="input-large" class="photo_url" type="text" >
                                <a class="btn select-file-btn" >Chọn ảnh</a>
                                <button type="button" class='btn btn-small btn-info' id='add_more_fiel_field'> + Thêm</button>
                            </div>
                        </div>
                        <br />
                        <div style="text-align: center;width: 400px;border-top: 1px solid #eee;padding-top: 10px;">
                            <button type="submit" class="btn btn-success"> Upload </button>
                        </div> 
                    </form>

                </div>
            </div>
            <div id="photo-field-sample-wrapper" style='display:none'>
                <div class="photo-field">
                    <div style='clear:both'></div>
                    <input accept="image/*" class="file" type="file" style="display:none" name="data[Photos][]">
                    <input class="input-large" class="photo_url" type="text" >
                    <a class="btn select-file-btn" >Chọn ảnh</a>
                </div>
            </div>
            <div class="actions">
                <ul>
                    <li><?php echo $this->Form->postLink('Xóa album này', array('action' => 'delete', $album['Album']['id']), null, __('Are you sure you want to delete # %s?', $album['Album']['id'])); ?> </li>
                    <li><?php echo $this->Html->link('Danh sách Albums', array('action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__('Tạo Album mới'), array('action' => 'add')); ?> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.upload-area').on('click', '.select-file-btn, input[type=text]', function() {
            var file_field = $(this).parent().children('input[type=file]');
            file_field.trigger('click');
            file_field.on('change', function() {
                var file_path = file_field.val();
                var startIndex = (file_path.indexOf('\\') >= 0 ? file_path.lastIndexOf('\\') : file_path.lastIndexOf('/'));
                var filename = file_path.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }
                $(this).parent().children('input[type=text]').val(filename);
            });
        });
        $('input.file').change(function() {
            $('.photo_url').val($(this).val());
        });
        $('#add_more_fiel_field').on('click', function() {
            $('#photo-fields').append($('#photo-field-sample-wrapper').html());
        });
        $('.photo-box-warpper').mouseover(function() {
            var pos = $(this).children('.photo-box').children('img').position();
            $(this).children('.delete-btn-box').show();
            $(this).children('.delete-btn-box').css({top: (pos['top']), left: pos['left']});
        });
        $('.photo-box-warpper').mouseout(function() {
            $(this).children('.delete-btn-box').hide();
        });
        $('.delete-btn-box a').on('click', function() {
            var parent = $(this).parent().parent();
            if (window.confirm('Bạn chắc chắn muốn xóa ảnh này ?')) {
                $.ajax({
                    url: '<?php echo Router::url('/admin/album-anh/delete_photo') ?>',
                    type: 'POST',
                    data: {'album_id': '<?php echo $album['Album']['id'] ?>', 'photo_id': $(this).attr('photo_id')},
                    success: function(response) {
                        if (response['success']) {
                            parent.fadeOut(500, function() {
                                $(this).remove();
                                if ($('.photos-in-album .photo-box-warpper').length === 0) {
                                    $('.photos-in-album').append('<p>Không có ảnh nào trong album này.</p>');
                                }
                            });
                        }
                    },
                    error: function() {
                        alert('Đã có lỗi xảy ra. Thao tác không thành công.');
                    }
                });
            }
        });
    });

</script>