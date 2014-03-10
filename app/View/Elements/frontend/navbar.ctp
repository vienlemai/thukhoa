<?php
$params = $this->params;
$controller = $params['controller'];
$action = $params['action'];
$ext = isset($params['pass']['0']) ? $params['pass']['0'] : 0;

?>
<nav id="nav">
	<ul>
		<li class="<?php echo ($controller == 'index' && $action == 'index') ? 'active' : '' ?>">
			<a href="<?php echo Router::url('/') ?>">Trang Chủ</a>
		</li>
		<?php
		foreach ($menus as $menu):
			$isHasChild = !empty($menu['ChildMenu']);
			$selected = '';
			if (($menu['Menu']['controller'] == $controller) && ($menu['Menu']['action'] == $action) && ($menu['Menu']['ext'] == $ext)) {
				$selected = 'active';
			}

			?>
			<li  class="<?php echo $selected ?>">
				<?php if (!empty($menu['Menu']['link'])): ?>
					<a href="<?php echo $menu['Menu']['link'] ?>"><?php echo $menu['Menu']['title'] ?></a>
				<?php else: ?>
					<?php
					if ($menu['Menu']['is_active']) {
						if ($isHasChild) {
							echo '<span>' . $menu['Menu']['title'] . '</span>';
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
					<ul>
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
	</ul>
</nav>
