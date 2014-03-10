<?php

/**
 * @author        Vo Van Tien <vantienvnn@gmail.com>
 * @package       cake
 * @subpackage    cake.app.helpers
 * @version       CakePHP(tm) >= v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 */
//App::uses('AppHelper', 'View/Helper');
class TvFckHelper extends AppHelper {

    var $helpers = array('Html', 'Form', 'Js');

    function create($fieldName, $options = array(), $id_replace = '') {
        // Mặc định nếu ko định nghĩa chọn toolbar loại nào sẽ sử dụng loại simple
        // Mặc định nếu ko định nghĩa chọn ngôn ngữ nào loại nào sẽ sử dụng ngôn ngữ tiếng việt
        $options+=array('toolbar' => 'simple', 'language' => 'vi');

        //định nghĩa trước một số kiểu toolbar trước

        switch ($options['toolbar']) {
            case 'extra':
                $options['toolbar'] = array(array('Source'), array('Preview'), array('PasteFromWord', '-', 'Print'), array('Undo', 'Redo', '-', 'Find', 'Replace', '-', 'RemoveFormat'), array('Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'), array('NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'), array('JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'), array('Link', 'Anchor'), array('Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'), array('Styles', 'Format', 'Font', 'FontSize'), array('TextColor', 'BGColor'), array('ShowBlocks', 'Maximize'));
                /*
                 * Nếu bạn khai báo phần tử image,flash,file và cho phép người sử dụng upload lên server thì phải cài đặt các chức năng tương ứng sau
                 */
                /* File upload url */
                $options['filebrowserUploadUrl'] = $this->webroot . "js/ckeditor/kcfinder/upload.php?type=files";
                /* Image upload url */
                $options['filebrowserImageUploadUrl'] = $this->webroot . "js/ckeditor/kcfinder/upload.php?type=images";
                /* Flash upload url */
                $options['filebrowserFlashUploadUrl'] = $this->webroot . "js/ckeditor/kcfinder/upload.php?type=flash";
                /* Xem file đã upload */
                $options['filebrowserBrowseUrl'] = $this->webroot . "js/ckeditor/kcfinder/browse.php?type=files";
                /* Xem images đã upload */
                $options['filebrowserImageBrowseUrl'] = $this->webroot . "js/ckeditor/kcfinder/browse.php?type=images";
                /* Xem flash đã upload */
                $options['filebrowserFlashBrowseUrl'] = $this->webroot . "js/ckeditor/kcfinder/browse.php?type=flash";
                break;
            case 'users':
                $options['toolbar'] = array(array('Preview', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'), array('Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Anchor', 'Image', 'Table', 'Smiley'), array('FontSize', 'TextColor', 'BGColor'), array('Undo', 'Redo', 'RemoveFormat', 'PasteFromWord'), array('Maximize'));
                break;
            /* your case here ... */
            default:
                $options['toolbar'] = array(array('Preview', 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', 'Smiley', 'SpecialChar'), array('FontSize', 'TextColor', 'BGColor'), array('RemoveFormat'));
        }

        require_once WWW_ROOT . DS . 'js' . DS . 'ckeditor' . DS . 'ckeditor.php';
        $CKEditor = new CKEditor();
        $CKEditor->basePath = $this->webroot . 'js/ckeditor/';
        $CKEditor->config = $options;
        //$attributes = $this->Form->_initInputField($fieldName, array());
        //return $CKEditor->editor($fieldName,$value);
        $CKEditor->config['height'] = 800;
        return $CKEditor->replace($id_replace);
        //return $CKEditor->replace($attributes['id'],$options);
        //$attributes = $this->Form->_initInputField($fieldName, array());
        //return $this->Html->scriptBlock("CKEDITOR.replace('" . $attributes['id'] . "',{{$this->Js->_parseOptions($options)}});");
    }

}