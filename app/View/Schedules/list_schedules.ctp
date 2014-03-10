<ol class="breadcrumb">
	<li><?php echo $this->Html->link('Trang chủ', '/'); ?></li>
	<li><?php echo $schedule_types  ?></li>
</ol>
<div class="list-page-wrapper"> 
	<?php if (empty($schedules)) { ?>
		<div class="empty text-center"> 
			<h3>Hiện không có văn bản nào.</h3>
		</div>
	<?php } ?>
    <div class="list-wrapper"> 
        <ul class="list">
			<?php
			foreach ($schedules as $row):

				?>
				<li>
					<?php
					echo $this->Html->link($row['Schedule']['title'], array(
						'controller' => 'schedules',
						'action' => 'view',
						'id' => $row['Schedule']['id'],
						'slug' => $this->Common->vnit_change_string(Inflector::slug($row['Schedule']['title']))
					));

					?>
					<span class="date-posted">
						(<?php echo date('d/m/Y', strtotime($row['Schedule']['created'])) ?>)
					</span>
				</li>
				<?php
			endforeach;

			?>
        </ul>
    </div>
	<?php if (!empty($schedules)) { ?>
		<ul class="pagination pagination-sm">
			<?php
			$this->Paginator->options(array(
				'update' => '#layout-content',
				'evalScripts' => true
			));	
			echo $this->Paginator->prev('Trước', array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
			echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
			echo $this->Paginator->next('Tiếp', array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));

			?>
		</ul>
	<?php } ?>
</div>
<?php echo $this->Js->writeBuffer(); ?>