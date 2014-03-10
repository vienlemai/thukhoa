<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title><?php echo $title_for_layout ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <!-- Bootstrap -->
        <?php
        echo $this->Html->css('admin/css/bootstrap');
        echo $this->Html->css('admin/css/admin');
        echo $this->Html->css('admin/css/DT_bootstrap');
		echo $this->fetch('headerCss');
        ?>
        <?php
        echo $this->Html->script('vendor/jquery-1.10.2.min');
        ?>
        <script type="text/javascript">
            var base_url = '<?php echo $this->Html->webroot('/') ?>';
        </script>
    </head>
    <body>
        <?php echo $this->element('admin/header'); ?>
        <div class="container">
            <div class="jumbotron admin-content-wrapper">
                <?php
                echo $this->fetch('content');
                ?>
            </div>
        </div>

        <?php
        echo $this->Html->script('admin/bootstrap.min');
        echo $this->Html->script('admin/datatables/js/jquery.dataTables.min');
        echo $this->Html->script('admin/DT_bootstrap');
		echo $this->fetch('scriptBottom');
        echo $this->Html->script('admin/admin');
        ?>
    </body>
</html>
