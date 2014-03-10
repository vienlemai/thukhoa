<div class="col-lg-3"  id="right-sidebar">	
	<div class="panel panel-primary">
        <div class="panel-heading">Đăng ký học cùng thủ khoa</div>
		<div class="panel-body" style="margin: 0px; padding: 0px">

			<a href="http://thukhoa.vn/chi-tiet-bai-viet/38-lop-hoc-cung-thu-khoa">
				<img style="width: 100%" height="100%" src="<?php echo $this->Html->webroot('img/frontend/dk_thu_khoa.jpg') ?>"/>
			</a>
		</div>

    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Thư viện video</div>
		<?php echo $this->element('frontend/video') ?>
    </div>
    <div class="panel panel-primary albums-preview">
        <div class="panel-heading">Thư viện ảnh</div>
		<?php echo $this->element('frontend/photo') ?>
    </div>
    <div class="panel panel-primary statistics">
        <div class="panel-heading">Thống kê</div>
        <div class="panel-body">
            <ul>
                <li>Đang online: 
                    <a href='#' id='lnolt_' class="user-online-counter">
                        <script language='JavaScript' src='http://blogutils.net/olct/online.php?site=thpttieula.edu.vn&interval=600'></script>
                    </a>
                </li>
                <li>Lượt truy cập: 
                    <img id="hit-counter"src="http://www.reliablecounter.com/count.php?page=thpttieula.edu.vn2&digit=style/plain/10/&reloads=1">
                </li>
            </ul>

        </div>
    </div>
</div>
<script type='text/javascript'>
	function openpage(link) {
		if (link !== '')
			window.open(link, '_blank');
	}

</script>