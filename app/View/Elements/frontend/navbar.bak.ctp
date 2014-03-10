<?php
$params = $this->params;
$controller = $params['controller'];
$action = $params['action'];
$ext = isset($params['pass']['0']) ? $params['pass']['0'] : 0;

?>
<nav class="navbar navbar-default main-menu" role="navigation">
    <div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
            <li class="<?php echo ($controller == 'index' && $action == 'index') ? 'active' : '' ?>"><a href="<?php echo Router::url('/') ?>">
                    <span class="glyphicon glyphicon-home"></span>&nbspTrang Chủ</a>
            </li>

			<?php
			foreach ($menus as $menu):
				$isHasChild = !empty($menu['ChildMenu']);
				$selected = '';
				if (($menu['Menu']['controller'] == $controller) && ($menu['Menu']['action'] == $action) && ($menu['Menu']['ext'] == $ext)) {
					$selected = 'active';
				}

				?>
				<li  class="<?php echo $isHasChild ? 'dropdown' : '' ?> <?php echo $selected ?>">
					<?php if (!empty($menu['Menu']['link'])): ?>
						<a class="parent-link" href="<?php echo $menu['Menu']['link'] ?>"><?php echo $menu['Menu']['title'] ?></a>
					<?php else: ?>
						<?php
						if ($menu['Menu']['is_active']) {
							if ($isHasChild) {
								echo $this->Html->link($menu['Menu']['title'] . '<b class="caret"></b>', array(
									'controller' => $menu['Menu']['controller'],
									'action' => $menu['Menu']['action'],
									'id' => $menu['Menu']['ext'],
									'slug' => $menu['Menu']['alias'],
										), array(
									'escape' => false,
								));
							} else {
								echo $this->Html->link($menu['Menu']['title'], array(
									'controller' => $menu['Menu']['controller'],
									'action' => $menu['Menu']['action'],
									'id' => $menu['Menu']['ext'],
									'slug' => $menu['Menu']['alias'],
										), array(
									'escape' => false,
								));
							}
						}

						?>
					<?php endif; ?>
					<?php if (!empty($menu['ChildMenu'])) : ?>
						<ul class="dropdown-menu">
							<?php foreach ($menu['ChildMenu'] as $child): ?>
								<li>
									<?php if (!empty($child['link'])): ?>
										<a href="<?php echo $child['link'] ?>"><?php echo $child['title'] ?></a>
									<?php else: ?>
										<?php
										if ($child['is_active']) {
											echo $this->Html->link($child['title'], array(
												'controller' => $child['controller'],
												'action' => $child['action'],
												'id' => $child['ext'],
												'slug' => $child['alias']
											));
										}

										?>
									<?php endif ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle " data-toggle="dropdown">Thủ khoa giải đề<b class="caret"></b></a>
                <ul class="dropdown-menu">
					<li class="dropdown-submenu">
						<a href="#" tabindex="-1">Năm thi</a>						
						<ul class="dropdown-menu">
							<?php foreach ($years as $year): ?>
								<li>
									<?php
									echo $this->Html->link($year['Year']['name'], array(
										'controller' => 'resources',
										'action' => 'listResources',
										'id' => 1,
										'?' => array('year_id' => $year['Year']['id'])
											//'slug'=>$this->Common->vnit_change_string(Inflector::slug($v)),
									));

									?>
								</li>
							<?php endforeach; ?>
						</ul>
					</li>
					<li class="dropdown-submenu">
						<a href="#" tabindex="-1">Môn thi</a>						
						<ul class="dropdown-menu">
							<?php foreach ($subjects as $subject): ?>
								<li>
									<?php
									echo $this->Html->link($subject['Subject']['name'], array(
										'controller' => 'resources',
										'action' => 'listResources',
										'id' => 1,
										'?' => array('subject_id' => $subject['Subject']['id'])
											//'slug'=>$this->Common->vnit_change_string(Inflector::slug($v)),
									));

									?>
								</li>
							<?php endforeach; ?>
						</ul>
					</li>

				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle " data-toggle="dropdown">Tài liệu<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<?php
					foreach ($subjects as $subject):

						?>
						<li>
							<?php
							echo $this->Html->link($subject['Subject']['name'], array(
								'controller' => 'resources',
								'action' => 'listResources',
								'id' => 2,
								'?' => array('subject_id' => $subject['Subject']['id'])
									//'slug'=>$this->Common->vnit_change_string(Inflector::slug($v)),
							));

							?>
						</li>
						<?php
					endforeach;

					?>
				</ul>
			</li>
			<li><a href="<?php echo $this->Html->url('/lien-he') ?>" style="padding-right:35px">Liên hệ</a></li>
			<li>
			</li>
        </ul>
        <!--        <form>
                                <div class="input-group" id="search-form-navbar">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm...">
                                </div>
                        </form>-->
    </div><!-- /.navbar-collapse -->
</nav>
<script type="text/javascript">
	$(function() {
		$('li.dropdown').mouseover(function() {
			$(this).addClass('open');
		});
		$('li.dropdown').mouseleave(function() {
			$(this).removeClass('open');
		});
	});
</script>