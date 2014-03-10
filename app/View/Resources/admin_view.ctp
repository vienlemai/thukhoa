<div class="resources view">
<h2><?php echo __('Resource'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($schedule['Resource']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($schedule['Resource']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($schedule['Resource']['link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('View Link'); ?></dt>
		<dd>
			<?php echo h($schedule['Resource']['view_link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($schedule['Resource']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($schedule['Resource']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Created'); ?></dt>
		<dd>
			<?php echo h($schedule['Resource']['user_created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Resource Category Id'); ?></dt>
		<dd>
			<?php echo h($schedule['Resource']['resource_category_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Resource'), array('action' => 'edit', $schedule['Resource']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Resource'), array('action' => 'delete', $schedule['Resource']['id']), null, __('Are you sure you want to delete # %s?', $schedule['Resource']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Resources'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resource'), array('action' => 'add')); ?> </li>
	</ul>
</div>
