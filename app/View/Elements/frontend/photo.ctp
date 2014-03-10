<?php
$album = $this->requestAction('albums/recentAlbum');
//debug($album);
if (empty($album['Photo'])) {
	echo 'Album ảnh đang cập nhật . . .';
} else {

	?><div class="panel-body">
		<div class="col-lg-12">
			<div class="row">
				<?php echo $this->Html->image('albums/' . $album['Album']['id'] . '/' . $album['Photo'][0]['url'], array('alt="Hình ảnh hoạt động" width="350" height="185"')) ?>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="row">
				<a href="<?php echo $this->Html->url('/album-anh')?>"><?php echo $album['Album']['name'] ?></a>
			</div>
		</div>
		<?php
		for ($i = 1; $i <= 3; $i++):

			?>
			<div class="col-lg-4">
				<div class="row">
					<?php
					if (isset($album['Photo'][$i]))
						echo $this->Html->image('albums/' . $album['Album']['id'] . '/' . $album['Photo'][$i]['url'], array('alt="Hình ảnh hoạt động" width="85" height="65"'))

						?>
				</div>
			</div>
			<?php
		endfor;

		?>
		<div class="col-lg-12">
			<a href="<?php echo $this->Html->url('/album-anh')?>" class="pull-right">
				[Xem thêm] 
			</a>
		</div>
	</div>
	<?php
}

?>
