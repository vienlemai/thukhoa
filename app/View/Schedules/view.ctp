<ol class="breadcrumb">
	<li><?php echo $this->Html->link('Trang chủ', '/'); ?></li>
	<li><?php echo $this->Html->link('Thời khóa biểu', array('controller' => 'schedules', 'action' => 'listSchedules')) ?></li>
	<li><?php echo $schedule['Schedule']['title'] ?></li>
</ol>
<div class="list-page-wrapper"> 
    <div class="text-center"> 
        <p class="item-title"><?php echo $schedule['Schedule']['title'] ?></p>
    </div>
    <p>Đăng bởi : <?php echo $schedule['Schedule']['user_create'] ?></p>
    <p>Ngày đăng : <?php echo date('d/m/Y', strtotime($schedule['Schedule']['created'])) ?></p>
    <p>Chú ý: Nếu không xem được, bạn có thể tải về máy
        <a href="<?php echo $schedule['Schedule']['file_path'] ?>">tại đây</a>
    </p>
    <iframe src="http://docs.google.com/viewer?url=<?php echo $schedule['Schedule']['file_path'] ?>&embedded=true" width="100%" height="980" style="border: none;"></iframe>
</div>
