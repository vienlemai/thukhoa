<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Quản lí bài viết</div>
        </div>
        <div class="block-content collapse in">			
			<table class="table-data table table-striped table-bordered dataTable">
				<thead>
					<tr>
						<th>Chọn</th>
						<th>Tên bài viết</th>
						<th>Danh mục</th>
					</tr>
				</thead>
				<tbody>
					<?php
					//debug($categories);
					foreach ($posts as $row):

						?>
						<tr>
							<td><input class="menu-check-item" type="checkbox" value="<?php echo $row['Post']['id'] ?>"/></td>
							<td class="select-name"><?php echo $row['Post']['title'] ?></td>
							<td><?php echo $row['Category']['name'] ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>					
			</table>
		</div>
	</div>
</div>
</div>

