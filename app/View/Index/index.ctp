<div class="tab-content">
    <div class="tab-pane active" id="tabs-news-content">
		
    </div>
    <div class="tab-pane" id="tabs-custom">
        
    </div>
    <div class="tab-pane" id="tab-confidential-content">
		<button type="button" id="btn-add-confidential" class="btn btn-primary">Đăng tâm sự</button>
		<div id="list-confidentials">

		</div>		
		<div id="form-confidential-wrap">
			<button type="button" id="btn-add-confidential" class="btn btn-primary">Đăng tâm sự</button>
			<div id="confidential-alert">
				<div class="alert alert-danger alert-dismissable" style="display: none">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<span class="alert-content"></span>
				</div>
				<div class="alert alert-success alert-dismissable" style="display: none">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<span class="alert-content"></span>
				</div>
			</div>
			<div id="confidential-content" style="display: none">
				<form class="form-horizontal" method="POST" id="form-confidential" role="form">
					<div class="form-group">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control input-sm" name="data[Confidential][email]" placeholder="Nhập email">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Tiêu đề</label>
						<div class="col-sm-10">
							<input type="text" class="form-control input-sm" name="data[Confidential][title]"  placeholder="Nhập tiêu đề">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Nội dung</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="confidential-editor" name="data[Confidential][content]" rows="10"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="form-actions col-lg-offset-2 col-lg-3">
							<button id="btn-confidential-cancel" class="btn btn-danger btn-sm" type="button">Hủy</button>
							<button id="btn-confidential-submit" type="button" class="btn btn-primary btn-sm">Đồng ý</button>
						</div>
					</div>
				</form>
			</div>

		</div>
    </div>
</div>
<?php echo $this->Html->script('vendor/jquery.validate.min', array('block' => 'scriptBottom')); ?>
<?php echo $this->Html->script('tinymce/tinymce.min', array('block' => 'scriptBottom')); ?>
<?php echo $this->Html->script('frontend/index-tab', array('block' => 'scriptBottom')); ?>