<div class="row-fluid">	
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Chọn danh mục</div>
        </div>
        <div class="block-content collapse in">
            <div class="span12">
				<table class="table-data table table-striped table-bordered dataTable" >
					<thead>
						<tr>
							<th>Chọn</th>
							<th>Tên danh mục</th>
							<th>Danh mục cha</th>
							<th>Ngày tạo</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//debug($categories);
						foreach ($categories as $row):

							?>
							<tr>
								<td><input class="menu-check-item" type="checkbox" value="<?php echo $row['Category']['id'] ?>"/></td>
								<td class="select-name"><?php echo $row['Category']['name'] ?></td>
								<td><?php echo $row['ParentCategory']['name'] ?></td>
								<td>
									<?php echo date('d/m/Y', strtotime($row['Category']['created'])) ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
            </div>
        </div>
    </div>
</div>

