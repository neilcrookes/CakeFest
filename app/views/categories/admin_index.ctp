<div id="main"><div class="block" id="block-tables">
<h2 class="title"><?php __('Categories');?></h2>
<div class="content">
<div class="inner">
<?php if (!empty($categories)) : ?><?php echo $this->element('admin_pagination_count'); ?><table cellpadding="0" cellspacing="0" class="table">
<tr>
	<th class="first"><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('post_count');?></th>
	<th><?php echo $paginator->sort('active');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="last"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($categories as $category):
	$class = ' class="odd"';
	if ($i++ % 2 == 0) {
		$class = ' class="even"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $category['Category']['id']; ?>
		</td>
		<td>
			<?php echo $category['Category']['name']; ?>
		</td>
		<td>
			<?php echo $category['Category']['post_count']; ?>
		</td>
		<td>
			<?php echo $category['Category']['active']; ?>
		</td>
		<td>
			<?php echo $time->niceShort($category['Category']['created']); ?>
		</td>
		<td>
			<?php echo $time->niceShort($category['Category']['modified']); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $category['Category']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $category['Category']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $category['Category']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table><div class="actions-bar">
<?php echo $this->element('admin_pagination_links'); ?><?php else : ?><p><?php __('No results'); ?></p>
<?php endif; ?><div class="clear"></div></div></div></div></div></div>
<div id="sidebar"><div class="block"><h3>Actions</h3>
	<ul class="navigation">
		<li><?php echo $html->link(__('New Category', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>
</div>